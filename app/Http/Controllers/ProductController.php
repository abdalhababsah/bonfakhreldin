<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('sizes')->latest()->paginate(10);
        return view('pages.products.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function productData(Request $request)
    {
        $locale = app()->getLocale();

        $categories = Category::select('id', "name_$locale as name")->get();

        $query = Product::select(
            'id',
            "name_$locale as name",
            "description_$locale as description",
            'category_id',
            'slug'
        )
        ->where('status', 'active')
        ->with([
            'images' => fn ($q) => $q->where('is_primary', true),
            'sizes'
        ]);

        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($locale, $request) {
                $q->where("name_$locale", 'LIKE', '%' . $request->search . '%')
                  ->orWhere("description_$locale", 'LIKE', '%' . $request->search . '%');
            });
        }

        $products = $query->paginate(9);

        return response()->json([
            'products' => $products,
            'categories' => $categories,
        ]);
    }
    public function show($slug)
    {
    $locale = app()->getLocale();

        $product = Product::where('slug', $slug)
            ->select(
                'id',
                "name_$locale as name",
                "description_$locale as description",
                'category_id',
                'slug'
            )
            ->with(['images', 'category' => function ($query) use ($locale) {
                $query->select('id', "name_$locale as name");
            }])
            ->where('status', 'active')
            ->firstOrFail();

        return view('pages.products.view', compact('product'));
    }

    public function store(Request $request)
    {
        dd('store reached'); 

        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'sizes' => 'required|string',
        ]);

        // Create product
        $product = Product::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'slug' => Str::slug($request->name_en),
        ]);

        // Save sizes
        if ($request->filled('sizes')) {
            $sizes = json_decode($request->sizes, true);
        
            Log::debug('SIZES PAYLOAD:', ['sizes' => $sizes]);
            
            if (is_array($sizes)) {
                $product->sizes()->createMany(array_filter($sizes, function ($size) {
                    return !empty($size['value']) && !empty($size['price']);
                }));
            }
        }        
    
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully!',
            'redirect' => route('admin.products.index'),
        ]);
        
            }

            public function simpleForm()
{
    return view('test.simple-product-form');
}

public function simpleStore(Request $request)
{
    $request->validate([
        'name_en' => 'required',
        'name_ar' => 'required',
        'category_id' => 'required',
        'status' => 'required',
        'sizes' => 'required|array',
        'sizes.*.value' => 'required|string',
        'sizes.*.price' => 'required|numeric',
    ]);

    $product = \App\Models\Product::create([
        'name_en' => $request->name_en,
        'name_ar' => $request->name_ar,
        'description_en' => $request->description_en,
        'description_ar' => $request->description_ar,
        'category_id' => $request->category_id,
        'status' => $request->status,
        'slug' => Str::slug($request->name_en),
    ]);

    // Save sizes
    $product->sizes()->createMany($request->sizes);

    return "✔️ Product created with sizes!";
}

        }