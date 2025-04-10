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
        $category = Category::where('slug', $slug)->first();

        $products = $category->products()
            ->with(['sizes', 'images', 'options', 'additions'])
            ->where('status', 'active')
            ->where('in_shop', true) // Ensure the product is marked as in_shop
            ->whereHas('sizes') // Ensure the product has sizes
            ->paginate(9);

        return view('pages.shop.products', compact('products', 'category'));
    }

    public function gold(Request $request){

        $query = Product::query()
        ->with(['sizes', 'images'])
        ->where('status', 'active')
        ->where('subcategory_id', 2); 

    $products = $query->paginate(9);

    $categories = Category::all();

    return view('pages.shop.gold', compact('products', 'categories'));
    
    }

    public function deluxe(Request $request)
    {
        $query = Product::query()
            ->with(['sizes', 'images'])
            ->where('status', 'active')
            ->where('subcategory_id', 1); // ✅ Only Deluxe products

        $products = $query->paginate(9);

        $categories = Category::all();

        return view('pages.shop.deluxe', compact('products', 'categories'));
    }


    public function gift()
    {
        $query = Product::query()
            ->with(['sizes', 'images'])
            ->where('status', 'active')
            ->where('category_id', 4); // 

        $products = $query->paginate(9);

        $categories = Category::all();

        return view('pages.shop.gift', compact('products', 'categories'));
    }

    public function coffee()
    {
        $query = Product::query()
            ->with(['sizes', 'images'])
            ->where('status', 'active')
            ->where('category_id', 1); // 

        $products = $query->paginate(9);

        $categories = Category::all();

        return view('pages.shop.coffee', compact('products', 'categories'));
    }

    public function nuts()
    {
        $query = Product::query()
            ->with(['sizes', 'images'])
            ->where('status', 'active')
            ->where('category_id', 3); // 

        $products = $query->paginate(9);

        $categories = Category::all();

        return view('pages.shop.nuts', compact('products', 'categories'));
    }


}