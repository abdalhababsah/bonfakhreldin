<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.products.index');
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
        ->with(['images' => function ($query) {
            $query->where('is_primary', true);
        }]);

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
}
