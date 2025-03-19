<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // Display a listing of products
    public function index()
    {
        $products = Product::with('category', 'images')
        ->orderBy('id', 'DESC')
        ->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    private function generateUniqueSlug($name)
    {
        // Generate initial slug
        $slug = Str::slug($name);

        // Keep the original slug for reference
        $originalSlug = $slug;

        // Initialize a counter
        $counter = 1;

        // Check for existing slugs and append a counter if necessary
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    // Store method
    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        $slug = $this->generateUniqueSlug($request->input('name_en'));

        // Create the product with the generated slug
        $product = Product::create([
            'slug' => $slug,
            'name_en' => $validatedData['name_en'],
            'name_ar' => $validatedData['name_ar'],
            'description_en' => $validatedData['description_en'],
            'description_ar' => $validatedData['description_ar'] ?? null,
            'category_id' => $validatedData['category_id'],
            'status' => $validatedData['status'],
        ]);

         // ✅ Save sizes (as JSON)

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imagePath,
                    'is_primary' => $index === 0 ? true : false,
                    'alt_text_en' => $request->input('alt_text_en')[$index] ?? null,
                    'alt_text_ar' => $request->input('alt_text_ar')[$index] ?? null,
                ]);
            }
        }

        // Determine response type based on request
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Product created successfully.',
                'product' => $product->load('images', 'category','sizes'),
            ], 201);
        }

        // For non-AJAX requests, redirect as usual
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    // Display the specified product
    public function show(Product $product)
    {
        $product->load('category', 'images'); // Load related category and images
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load(['images', 'sizes', 'options']);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        // Validate the request data
        $validatedData = $request->validated();

        // Update product details
        $product->update($validatedData);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imagePath,
                    'is_primary' => false,
                    'alt_text_en' => $request->input('alt_text_en')[$index] ?? null,
                    'alt_text_ar' => $request->input('alt_text_ar')[$index] ?? null,
                ]);
            }
        }
        if ($request->filled('sizes')) {
            $sizes = json_decode($request->sizes, true);

            if (is_array($sizes)) {
            foreach ($sizes as $size) {
                if (!empty($size['id'])) {
                // Update existing size
                $productSize = ProductSize::find($size['id']);
                if ($productSize) {
                    $productSize->update([
                    'value' => $size['value'],
                    'price' => $size['price'],
                    ]);
                }
                } else {
                // Create new size
                if (!empty($size['value']) && !empty($size['price'])) {
                    $product->sizes()->create([
                    'value' => $size['value'],
                    'price' => $size['price'],
                    ]);
                }
                }
            }
            }
        }

        if ($request->filled('options')) {
            $options = json_decode($request->options, true);

            if (is_array($options)) {
            foreach ($options as $option) {
                if (!empty($option['id'])) {
                // Update existing option
                $productOption = $product->options()->find($option['id']);
                if ($productOption) {
                    $productOption->update([
                    'name_en' => $option['name_en'],
                    'name_ar' => $option['name_ar'],
                    ]);
                }
                } else {
                // Create new option
                if (!empty($option['name_en']) && !empty($option['name_ar'])) {
                    $product->options()->create([
                    'name_en' => $option['name_en'],
                    'name_ar' => $option['name_ar'],
                    ]);
                }
                }
            }
            }
        }

        // Determine response type based on request
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Product updated successfully.',
                'product' => $product->load('images', 'category'),
            ], 200);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from storage
    public function destroy(Product $product)
    {
        // Delete associated images
        foreach ($product->images as $image) {
            Storage::delete('public/' . $image->image_url);
            $image->delete();
        }

        // Delete the product
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function uploadImage(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $imagePath = $image->store('products', 'public');

        // Determine if a primary image already exists
        $hasPrimaryImage = $product->images()->where('is_primary', true)->exists();

        // Save the image in 'product_images' table
        $productImage = ProductImage::create([
            'product_id' => $product->id,
            'image_url' => $imagePath,
            'is_primary' => !$hasPrimaryImage, // Set as primary if no primary image exists
        ]);

        return response()->json([
            'message' => 'Image uploaded successfully.',
            'imageId' => $productImage->id,
            'isPrimary' => $productImage->is_primary,
        ], 200);
    }

    public function removeImage($id)
    {
        $image = ProductImage::findOrFail($id);
        $product = $image->product;
        $wasPrimary = $image->is_primary;

        Storage::delete('public/' . $image->image_url);
        $image->delete();

        // If the removed image was primary, set another image as primary
        if ($wasPrimary) {
            $nextImage = $product->images()->first();
            if ($nextImage) {
                $nextImage->is_primary = true;
                $nextImage->save();
            }
        }

        return response()->json(['message' => 'Image deleted successfully.'], 200);
    }
    // Get all images for a specific product
    public function getProductImages($id)
    {
        // Fetch the product along with its images
        $product = Product::with('images')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        return response()->json([
            'message' => 'Product images retrieved successfully.',
            'images' => $product->images,
        ], 200);
    }
}
