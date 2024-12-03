<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import the required models
use App\Models\Category;
use App\Models\Product;
use App\Models\ContactUs;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', 'active')->count();
        $contactUsMessages = ContactUs::count();

        return view('admin.dashboard', compact('totalCategories', 'totalProducts', 'activeProducts', 'contactUsMessages'));
    }
}