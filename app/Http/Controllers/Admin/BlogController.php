<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Display a listing of blogs
    public function index()
    {
        $blogs = Blog::where('status', 'published')->get();
        return view('blogs.index', compact('blogs'));
    }

    // Show the form for creating a new blog
    public function create()
    {
        return view('blogs.create');
    }

    // Store a newly created blog in storage
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:blogs,slug',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'meta_description_en' => 'nullable|string|max:255',
            'meta_description_ar' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:published,draft',
        ]);

        $data = $request->only([
            'slug',
            'title_en',
            'title_ar',
            'content_en',
            'content_ar',
            'meta_description_en',
            'meta_description_ar',
            'status',
        ]);

        if($request->hasFile('thumbnail')) {
            $data['thumbnail_url'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('blogs.index')
                         ->with('success', 'Blog created successfully.');
    }

    // Display the specified blog
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    // Show the form for editing the specified blog
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    // Update the specified blog in storage
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'slug' => 'required|unique:blogs,slug,' . $blog->id,
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'meta_description_en' => 'nullable|string|max:255',
            'meta_description_ar' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:published,draft',
        ]);

        $data = $request->only([
            'slug',
            'title_en',
            'title_ar',
            'content_en',
            'content_ar',
            'meta_description_en',
            'meta_description_ar',
            'status',
        ]);

        if($request->hasFile('thumbnail')) {
            // Optionally, delete the old thumbnail
            if($blog->thumbnail_url) {
                \Storage::disk('public')->delete($blog->thumbnail_url);
            }
            $data['thumbnail_url'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('blogs.index')
                         ->with('success', 'Blog updated successfully.');
    }

    // Remove the specified blog from storage
    public function destroy(Blog $blog)
    {
        // Optionally, delete the thumbnail
        if($blog->thumbnail_url) {
            \Storage::disk('public')->delete($blog->thumbnail_url);
        }

        $blog->delete();

        return redirect()->route('blogs.index')
                         ->with('success', 'Blog deleted successfully.');
    }
}