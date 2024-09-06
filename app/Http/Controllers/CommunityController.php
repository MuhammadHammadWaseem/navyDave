<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.community.index');
    }

    public function post(Request $request)
    {
        // Validate request data
        $request->validate([
            'content' => 'required|string|



            ',
            'files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov|max:20480' // 200MB max
        ]);
        // Get the authenticated user's ID
        $userId = auth()->id();

        // Initialize variables to store image and video paths
        $imagePath = null;
        $videoPath = null;

        // Handle file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if (in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'gif'])) {
                    // Store images in 'community/images' folder
                    $imagePath = $file->store('community/images', 'public');
                } elseif (in_array($file->getClientOriginalExtension(), ['mp4', 'avi', 'mov'])) {
                    // Store videos in 'community/videos' folder
                    $videoPath = $file->store('community/videos', 'public');
                }
            }
        }

        // Create a new post
        $post = Post::create([
            'user_id' => $userId,
            'content' => $request->input('content', ''),
            'image' => $imagePath,
            'video' => $videoPath
        ]);
        return response()->json(['message' => 'Post submitted successfully!', 'post' => $post]);
    }

}
