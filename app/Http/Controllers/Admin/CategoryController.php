<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Display a listing of categories
    public function index(Request $request)
    {
        $categories = Category::paginate(10); // Adjust the per-page count as needed
        return view('admin.categories.index', compact('categories')); // Ensure this view exists
    }

    // Store a newly created category in storage
    public function store(Request $request)
    {

        // dd($request);
        $request->validate([
            'description_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        // Generate slug from description_en or fallback to description_ar
        $slug = Str::slug($request->description_en ?? $request->description_ar);

        Category::create([
            'slug' => $slug,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
        ]);

        // Redirect back to the current page
        $currentPage = $request->get('page', 1);

        return redirect()->route('admin.categories.index', ['page' => $currentPage])
            ->with('success', 'Category created successfully.');
    }

    // Show the form for editing the specified category
    public function edit(Request $request, Category $category)
    {
        return view('admin.categories.edit', compact('category')); // Ensure this view exists
    }

    // Update the specified category in storage
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'description_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        // Generate slug from updated description_en or fallback to description_ar
        $slug = Str::slug($request->description_en ?? $request->description_ar);

        $category->update([
            'slug' => $slug,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
        ]);

        // Redirect back to the current page
        $currentPage = $request->get('page', 1);

        return redirect()->route('admin.categories.index', ['page' => $currentPage])
            ->with('success', 'Category updated successfully.');
    }

    // Remove the specified category from storage
    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        // Redirect back to the current page
        $currentPage = $request->get('page', 1);

        return redirect()->route('admin.categories.index', ['page' => $currentPage])
            ->with('success', 'Category deleted successfully.');
    }
}