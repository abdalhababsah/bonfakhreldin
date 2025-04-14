<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\HandleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use HandleImage;
    // Display a listing of categories
    public function index(Request $request)
    {
        $categories = Category::paginate(10); // Adjust the per-page count as needed
        $mainCategories = Category::whereNull('category_id')->get();

        return view('admin.categories.index', compact('categories', 'mainCategories')); // Ensure this view exists
    }

    // Store a newly created category in storage
    public function store(CategoryRequest $request)
    {

        // Generate slug from name_en or fallback to name_ar
        $slug = Str::slug($request->name_en ?? $request->name_ar);

        Category::create([
            'slug' => $slug,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'category_id' => $request->category_id,
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $this->uploadImage($request->file('image'), 'categories');
        }

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
    public function update(CategoryRequest $request, Category $category)
    {

        // Generate slug from updated name_en or fallback to name_ar
        $slug = Str::slug($request->name_en ?? $request->name_ar);

        $category->update([
            'slug' => $slug,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $this->destroyImage($category->image);
            $this->uploadImage($request->file('image'), 'categories');
        }

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