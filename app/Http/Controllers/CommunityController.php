<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Image;
use App\Models\Video;
use App\Models\Comment;
use App\Events\PostCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommunityController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.community.index');
    }

    public function postGet(Request $request)
    {
        $posts = Post::with('user', 'likes', 'comments.user', 'images', 'videos')->latest('created_at')->paginate(10);

        $posts->getCollection()->transform(function ($post) {
            // Check if the authenticated user has liked the post
            $post->hasLiked = $post->likes->where('user_id', auth()->id())->isNotEmpty();
            $post->likeCount = $post->likes->count();

            return $post;
        });

        return response()->json($posts);
    }

    // public function postGet(Request $request)
    // {
    //     // Retrieve the filter type from the request, defaulting to 'latest'
    //     $filter = $request->input('filter', 'latest');

    //     // Initialize the query with relationships
    //     $query = Post::with('user', 'likes', 'comments.user', 'images', 'videos');

    //     // Apply filtering logic based on the selected filter
    //     switch ($filter) {
    //         case 'popular':
    //             // Count likes and order by the count in descending order
    //             $posts = $query->withCount('likes')
    //                 ->orderBy('likes_count', 'desc')
    //                 ->paginate(10);
    //             break;

    //         case 'hot':
    //             // Get posts that have been liked or commented in the last 7 days
    //             $posts = $query->withCount([
    //                 'likes' => function ($query) {
    //                     $query->where('created_at', '>=', now()->subDays(7)); // Likes in the last 7 days
    //                 },
    //                 'comments' => function ($query) {
    //                     $query->where('created_at', '>=', now()->subDays(7)); // Comments in the last 7 days
    //                 }
    //             ])
    //                 ->having('likes_count', '>', 0) // Only consider posts that have likes
    //                 ->orHaving('comments_count', '>', 0) // Or comments
    //                 ->orderByRaw('likes_count + comments_count DESC') // Order by total engagement
    //                 ->paginate(10);
    //             break;

    //         case 'latest':
    //         default:
    //             // Default to latest posts if no filter is applied
    //             $posts = $query->latest('created_at')->paginate(10);
    //             break;
    //     }

    //     // Transform the posts to include like status and count
    //     $posts->getCollection()->transform(function ($post) {
    //         // Check if the authenticated user has liked the post
    //         $post->hasLiked = $post->likes->where('user_id', auth()->id())->isNotEmpty();
    //         $post->likeCount = $post->likes->count();

    //         return $post;
    //     });

    //     return response()->json($posts);
    // }

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

        $post = Post::with('user', 'likes', 'comments', 'images', 'videos')->find($post->id);
        // Check if the authenticated user has liked the post
        $post->hasLiked = $post->likes->where('user_id', auth()->id())->isNotEmpty();
        $post->likeCount = $post->likes->count();

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

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'content' => 'required|string|max:500', // Adjust validation rules as needed
        ]);

        // Find the comment by ID
        $comment = Comment::findOrFail($id); // Automatically returns a 404 if not found

        // Check if the user is authorized to update the comment
        // Assuming the user can update their own comments or an admin can update any
        if ($comment->user_id !== auth()->id() && !auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Update the comment's content
        $comment->comment = $request->input('content');
        $comment->save();

        // Return a success response
        return response()->json(['message' => 'Comment updated successfully', 'comment' => $comment]);
    }


    // comment delete
    public function deleteComment($id)
    {

        // Authorize that the user can delete the comment
        // Find the comment by ID
        $comment = Comment::findOrFail($id);
        // $this->authorize('delete', $comment);

        // Get the current authenticated user
        $user = auth()->user();
        // Check if the user is an admin or the owner of the comment
        if ($user->hasRole('admin') || $comment->user_id === $user->id) {
            // User is allowed to delete the comment
            $comment->delete();

            $count = Comment::where('post_id', '=', $comment->post_id)->count();

            return response()->json(['message' => 'Comment deleted successfully.', 'comment' => $comment, 'count' => $count], 200);
        } else {
            // User is not authorized to delete the comment
            return response()->json(['message' => 'You are not authorized to delete this comment.', 'comment' => $comment], 403);
        }
    }
}
