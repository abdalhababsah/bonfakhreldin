<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.products'); // Load the initial view
    }

    public function productData(Request $request)
    {
        $locale = app()->getLocale();
    
        // Fetch categories for the filter dropdown
        $categories = Category::select('id', "name_$locale as name")->get();
    
        // Fetch products with optional category filtering
        $query = Product::select(
            'id', 
            "name_$locale as name", 
            "description_$locale as description", 
            'category_id', 
            'slug'
        )
        ->where('status', 'active') // Ensure the product is active
        ->with(['images' => function ($query) {
            // Filter to include only primary images
            $query->where('is_primary', true);
        }]);
    
        // Apply category filter if provided
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
    
        // Paginate the results
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

        return view('pages.viewproduct', compact('product'));
    }
}