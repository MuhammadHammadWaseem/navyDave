<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Events\PostCreated;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.community.index');
    }

    public function postGet(Request $request)
    {
        $posts = Post::with('user', 'likes', 'comments')->latest('created_at')->paginate(10);
        return response()->json($posts);
    }

    public function post(Request $request)
    {
        // Validate request data
        $request->validate([
            'content' => 'nullable|string|max:5000',
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

        // Dispatch an event to broadcast the new post

        // PostCreated::dispatch($post);
        event(new \App\Events\PostCreated($post));
        return response()->json(['message' => 'Post submitted successfully!', 'post' => $post]);
    }

    public function fetchReplies($postId) {
        $post = Post::with('comments.user')->find($postId);
        return response()->json(['comments' => $post->comment]);
    }

    public function commentPost(Request $request, $postId) {

        $comment = new Comment();
        $comment->comment = $request->content;
        $comment->user_id = auth()->id();
        $comment->post_id = $postId;
        $comment->save();

        $newComment = Comment::with('user')->find($comment->id);
        return response()->json(['message' => 'Comment submitted successfully!', 'comment' => $newComment]);
    }

}
