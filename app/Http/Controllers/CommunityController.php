<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Events\PostCreated;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Video;
use App\Models\Like;
use Illuminate\Support\Facades\Validator;

class CommunityController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.community.index');
    }

    public function postGet(Request $request)
    {
        $posts = Post::with('user', 'likes', 'comments', 'images', 'videos')->latest('created_at')->paginate(10);

        $posts->getCollection()->transform(function ($post) {
            // Check if the authenticated user has liked the post
            $post->hasLiked = $post->likes->where('user_id', auth()->id())->isNotEmpty();
            $post->likeCount = $post->likes->count();

            return $post;
        });

        return response()->json($posts);
    }

    public function post(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:5000',
            'files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,avi,mov,|max:20480'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Get the authenticated user's ID
        $userId = auth()->id();

        // Initialize variables to store image and video paths
        $imagePath = null;
        $videoPath = null;

        // Create a new post
        $post = Post::create([
            'user_id' => $userId,
            'content' => $request->input('content', ''),
            'image_id' => $imagePath,
            'video_id' => $videoPath
        ]);

        // Handle file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if (in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'gif', 'webp',])) {
                    // Store images in 'community/images' folder
                    $imagePath = $file->store('community/images', 'public');
                    Image::create([
                        'path' => $imagePath,
                        'post_id' => $post->id
                    ]);
                } elseif (in_array($file->getClientOriginalExtension(), ['mp4', 'avi', 'mov'])) {
                    // Store videos in 'community/videos' folder
                    $videoPath = $file->store('community/videos', 'public');
                    Video::create([
                        'path' => $videoPath,
                        'post_id' => $post->id
                    ]);
                }
            }
        }


        // Dispatch an event to broadcast the new post

        // PostCreated::dispatch($post);
        event(new PostCreated($post));
        return response()->json(['message' => 'Post submitted successfully!', 'post' => $post]);
    }

    public function fetchReplies($postId)
    {
        $comment = Comment::with('user')->where('post_id', '=', $postId)->get();
        return response()->json(['comments' => $comment]);
    }

    public function commentPost(Request $request, $postId)
    {

        $comment = new Comment();
        $comment->comment = $request->input('content');
        $comment->user_id = auth()->id();
        $comment->post_id = $postId;
        $comment->save();

        $newComment = Comment::with('user')->find($comment->id);
        $count = Comment::where('post_id', '=', $postId)->count();
        return response()->json(['message' => 'Comment submitted successfully!', 'comment' => $newComment, 'count' => $count]);
    }
    public function like(Request $request, $postId)
{
    $post = Post::findOrFail($postId);

    // Check if the user has already liked the post
    $existingLike = $post->likes()->where('user_id', auth()->id())->first();
    if ($existingLike) {
        // Remove the like
        $existingLike->delete();
        return response()->json(['message' => 'Post unliked successfully!', 'likes' => $post->likes()->count(), 'liked' => false]);
    }

    // Add a new like
    $post->likes()->create(['user_id' => auth()->id()]);

    // Get the updated like count
    $likes = $post->likes()->count();

    return response()->json(['message' => 'Post liked successfully!', 'likes' => $likes, 'liked' => true]);
}



}
