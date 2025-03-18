<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query()
        ->with(['sizes', 'images'])
        ->where('status', 'active');

    if ($request->filled('search')) {
        $query->where('name_en', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    $products = $query->select('id', 'name_en', 'description_en', 'slug', 'options', 'category_id', 'status')
    ->paginate(12);

    $categories = Category::all();

    return view('pages.shop.index', compact('products', 'categories'));
}


    public function show($slug)
    {
        $product = Product::with('sizes')->where('slug', $slug)->firstOrFail();
        return view('pages.shop.product', compact('product'));
    }

    

    
}
