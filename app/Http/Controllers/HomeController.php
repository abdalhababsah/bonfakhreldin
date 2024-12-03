<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Retrieve coffee products with status 'active'
        $coffeeProducts = Category::with(['products' => function($query) {
            $query->where('status', 'active')->with('images');
        }])->find(1);
    
        // Retrieve chocolate products with status 'active'
        $chocolateProducts = Category::with(['products' => function($query) {
            $query->where('status', 'active')->with('images');
        }])->find(2);
        
        // Return the view with data
        return view('home', compact('coffeeProducts', 'chocolateProducts'));
    }
}