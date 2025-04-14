<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::whereNull("category_id")->with(["children"])->get();

        return view('pages.shop.index', compact('categories'));
    }

    public function category($slug){
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = $category->products()
            ->with(['sizes', 'images', 'options', 'additions'])
            ->where('status', 'active')
            ->where('in_shop', true) // Ensure the product is marked as in_shop
            ->whereHas('sizes') // Ensure the product has sizes
            ->paginate(3);

        return view('pages.shop.products1', compact('products', 'category'));
    }

}