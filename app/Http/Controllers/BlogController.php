<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
        public function index()
        {
            return view('dashboard.admin.blog.index');
        }

        public function create(){
            return view('dashboard.admin.blog.create');
        }


        public function edit($id)
        {
            $blog = Blog::findOrFail($id);
            return view('dashboard.admin.blog.create')->with(compact('blog'));
        }
        public function store(Request $request)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:blogs',
                'short_description' => 'required|string',
                'long_description' => 'required|string',
                'page_title' => 'required|string|max:255',
                'meta_tag' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $data = $request->only(['title', 'slug', 'short_description', 'long_description', 'page_title', 'meta_tag']);
            // Handle image upload
        if ($request->hasFile('image')) {
            // $imagePath = $request->file('image')->store('public/blog');
            // $finalPath = explode('public/', $imagePath)[1];
            // $data['image'] = $finalPath;

            $extension = $request->file('image')->getClientOriginalExtension();
            $uniqueName = 'blog' . Str::random(40) . '.' . $extension;
            $request->file('image')->storeAs('public', $uniqueName);
            $validated['image'] = $uniqueName;
        }

            Blog::create($data);

            return redirect()->route('admin.blog')->with('success', 'Blog created successfully.');
        }
        public function update($id, Request $request)
        {
            // dd($request->all());
            $blog = Blog::findOrFail($id);

            // Validate the incoming request
            $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id, // Ignore current blog slug during validation
                'short_description' => 'required|string',
                'long_description' => 'required|string',
                'page_title' => 'required|string|max:255',
                'meta_tag' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Prepare the data for update
            $data = $request->only(['title', 'slug', 'short_description', 'long_description', 'page_title', 'meta_tag','image']);

            // Handle image upload if a new image is provided
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($blog->image) {
                    $oldImagePath = storage_path('app/public/' . $blog->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Remove old image
                    }
                }

                // Upload the new image
                $extension = $request->file('image')->getClientOriginalExtension();
                $uniqueName = 'blog' . Str::random(40) . '.' . $extension;
                $request->file('image')->storeAs('public', $uniqueName);
                $validated['image'] = $uniqueName;
            }

            // Update the blog entry with the new data
            $blog->update($data);

            // Redirect with success message
            return redirect()->route('admin.blog')->with('success', 'Blog post updated successfully.');
        }


        public function destroy(Request $request, $id)
        {
            $blog = Blog::findOrFail($id);
            // Delete the image file if it exists
            if ($blog->image) {
               $imagePath = storage_path('app/public/' . $blog->image);
               if (file_exists($imagePath)) {
                   unlink($imagePath);
               }
           }
           $blog->delete();
           return response()->json(['success' => true, 'message' => 'Staff deleted successfully!']);
        }
        // public function show($slug)
        // {
        //     $blog = Blog::where('slug', $slug)->first();
        //     return view('blogs.show')->with(compact('blog'));
        // }

        public function showAll()
        {
            $blogs = Blog::all();
            return response()->json($blogs);
        }

    }
