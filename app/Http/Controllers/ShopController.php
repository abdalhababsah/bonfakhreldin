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
        $categories = Category::all();

        return view('pages.shop.index', compact('categories'));
    }

    public function category($slug){
        $category = Category::where('slug', $slug)->first();

        if ($category->has('subcategories')){
            return view('pages.shop.subcategories', compact('category'));
        }
        return view('pages.shop.products');
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