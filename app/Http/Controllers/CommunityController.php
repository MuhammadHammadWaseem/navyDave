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
    public function commentGet(Request $request)
    {
        $posts = Post::where('id', $request->id)->with('user', 'likes', 'comments.user', 'images', 'videos')->latest('created_at')->paginate(10);

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'category_id'           => 'required',
            'product_type'          => 'required',
            'digital_product_type'  => 'required_if:product_type,==,digital',
            'digital_file_ready'    => 'required_if:digital_product_type,==,ready_product|mimes:jpg,jpeg,png,gif,zip,pdf',
            'unit'                  => 'required_if:product_type,==,physical',
            'image'                 => 'required',
            'tax'                   => 'min:0',
            // 'tax_model'             => 'required',
            'unit_price'            => 'required|numeric|gt:0',
            // 'purchase_price'        => 'required|numeric|gt:0',
            'discount'              => 'required|gt:-1',
            // 'shipping_cost'         => 'required_if:product_type,==,physical|gt:-1',
            'code'                  => 'required|numeric|min:1|digits_between:6,20|unique:products',
            'minimum_order_qty'     => 'required|numeric|min:1',

        ], [
            'name.required'                     => 'Product name is required!',
            'category_id.required'              => 'category  is required!',
            'image.required'                    => 'Product thumbnail is required!',
            'unit.required_if'                  => 'Unit is required!',
            'code.min'                          => 'The code must be positive!',
            'code.digits_between'               => 'The code must be minimum 6 digits!',
            'minimum_order_qty.required'        => 'The minimum order quantity is required!',
            'minimum_order_qty.min'             => 'The minimum order quantity must be positive!',
            'digital_file_ready.required_if'    => 'Ready product upload is required!',
            'digital_file_ready.mimes'          => 'Ready product upload must be a file of type: pdf, zip, jpg, jpeg, png, gif.',
            'digital_product_type.required_if'  => 'Digital product type is required!',
            'shipping_cost.required_if'         => 'Shipping Cost is required!',
        ]);

        if(!$request->has('colors_active') && !$request->file('images')) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'images', 'Product images is required!'
                );
            });
        }
        
        if($request->has('other_brand') && !empty($request->other_brand)){
            $brand = new Brand;
            $brand->name = $request->other_brand;
            $brand->status = 1;
            $brand->save();
             // Use this new brand's ID for the product
            $request->merge(['brand_id' => $brand->id]);
        }

        $brand_setting = BusinessSetting::where('type', 'product_brand')->first()->value;
        if ($brand_setting && empty($request->brand_id)) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'brand_id', 'Brand is required!'
                );
            });
        }

        if ($request['discount_type'] == 'percent') {
            $dis = ($request['unit_price'] / 100) * $request['discount'];
        } else {
            $dis = $request['discount'];
        }

        if ($request['unit_price'] <= $dis) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'unit_price', 'Discount can not be more or equal to the price!'
                );
            });
        }

        if (is_null($request->name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name', 'Name field is required!'
                );
            });
        }

        $product = new Product();
        $product->user_id = auth('seller')->id();
        $product->hand_orientation = $request->hand_orientation;
        $product->added_by = "seller";
        $product->name = $request->name[array_search('en', $request->lang)];
        $product->slug = Str::slug($request->name[array_search('en', $request->lang)], '-') . '-' . Str::random(6);

        $product_images = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            foreach ($request->colors as $color) {
                $color_ = str_replace('#','',$color);
                $img = 'color_image_'.$color_;
                if($request->file($img)){
                    $image_name = ImageManager::upload('product/', 'png', $request->file($img));
                    $product_images[] = $image_name;
                    $color_image_serial[] = [
                        'color'=>$color_,
                        'image_name'=>$image_name,
                    ];
                }
            }
            if(count($product_images) != count($request->colors)) {
                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'images', 'Color images is required!'
                    );
                });
            }
        }

        $category = [];

        if ($request->category_id != null) {
            array_push($category, [
                'id' => $request->category_id,
                'position' => 1,
            ]);
        }
        if ($request->sub_category_id != null) {
            array_push($category, [
                'id' => $request->sub_category_id,
                'position' => 2,
            ]);
        }
        if ($request->sub_sub_category_id != null) {
            array_push($category, [
                'id' => $request->sub_sub_category_id,
                'position' => 3,
            ]);
        }

        $product->category_ids          = json_encode($category);
        $product->brand_id              = $request->brand_id;
        $product->unit                  = $request->product_type == 'physical' ? $request->unit : null;
        $product->digital_product_type  = $request->product_type == 'digital' ? $request->digital_product_type : null;
        $product->product_type          = $request->product_type;
        $product->code                  = $request->code;
        $product->minimum_order_qty     = $request->minimum_order_qty;
        $product->details               = $request->description[array_search('en', $request->lang)];

        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $product->colors = $request->product_type == 'physical' ? json_encode($request->colors) : json_encode([]);
        } else {
            $colors = [];
            $product->colors = $request->product_type == 'physical' ? json_encode($colors) : json_encode([]);
        }
        $choice_options = [];
        if ($request->has('choice')) {
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_' . $no;
                $item['name'] = 'choice_' . $no;
                $item['title'] = $request->choice[$key];
                $item['options'] = explode(',', implode('|', $request[$str]));
                array_push($choice_options, $item);
            }
        }
        $product->choice_options = $request->product_type == 'physical' ? json_encode($choice_options) : json_encode([]);
        //combinations start
        $options = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }
        //Generates the combinations of customer choice options
        $combinations = Helpers::combinations($options);
        $variations = [];
        $stock_count = 0;
        if (count($combinations[0]) > 0) {
            foreach ($combinations as $key => $combination) {
                $str = '';
                foreach ($combination as $k => $item) {
                    if ($k > 0) {
                        $str .= '-' . str_replace(' ', '', $item);
                    } else {
                        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                            $color_name = Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        } else {
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }
                $item = [];
                $item['type'] = $str;
                $item['price'] = Convert::usd(abs($request['price_' . str_replace('.', '_', $str)]));
                $item['sku'] = $request['sku_' . str_replace('.', '_', $str)];
                $item['qty'] = abs($request['qty_' . str_replace('.', '_', $str)]);
                array_push($variations, $item);
                $stock_count += $item['qty'];
            }
        } else {
            $stock_count = (integer)$request['current_stock'];
        }

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        //combinations end
        $product->variation      = $request->product_type == 'physical' ? json_encode($variations) : json_encode([]);
        $product->unit_price     = Convert::usd($request->unit_price);
        $product->purchase_price = Convert::usd($request->purchase_price);
        $product->tax            = $request->tax ?? 0;
        $product->tax_type       = $request->tax_type;
        $product->tax_model      = $request->tax_model;
        $product->discount       = $request->discount_type == 'flat' ? Convert::usd($request->discount) : $request->discount;
        $product->discount_type  = $request->discount_type;
        $product->attributes     = $request->product_type == 'physical' ? json_encode($request->choice_attributes) : json_encode([]);
        $product->current_stock  = $request->product_type == 'physical' ? abs($stock_count) : 0;
        $product->video_provider = 'youtube';
        $product->video_url      = $request->video_link;
        $product->request_status = Helpers::get_business_settings('new_product_approval')==1?0:1;
        $product->status         = 1;
        $product->shipping_cost  = $request->product_type == 'physical' ? Convert::usd($request->shipping_cost) : 0;
        $product->multiply_qty   = ($request->product_type == 'physical') ? ($request->multiplyQTY=='on'?1:0) : 0;

        if ($request->ajax()) {
            return response()->json([], 200);
        } else {
            if ($request->file('images')) {
                foreach ($request->file('images') as $img) {
                    $image_name = ImageManager::upload('product/', 'png', $img);
                    $product_images[] = $image_name;
                    if($request->has('colors_active')){
                        $color_image_serial[] = [
                            'color'=>null,
                            'image_name'=>$image_name,
                        ];
                    }else{
                        $color_image_serial = [];
                    }
                }
            }
            $product->color_image = json_encode($color_image_serial);
            $product->images = json_encode($product_images);
            $product->thumbnail = ImageManager::upload('product/thumbnail/', 'png', $request->file('image'));

            if($request->product_type == 'digital' && $request->digital_product_type == 'ready_product') {
                $product->digital_file_ready = ImageManager::upload('product/digital-product/', $request->digital_file_ready->getClientOriginalExtension(), $request->digital_file_ready);
            }

            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            $product->meta_image = ImageManager::upload('product/meta/', 'png', $request->meta_image);
            $product->save();

            $tag_ids = [];
            if ($request->tags != null) {
                $tags = explode(",", $request->tags);
            }
            if(isset($tags)){
                foreach ($tags as $key => $value) {
                    $tag = Tag::firstOrNew(
                        ['tag' => trim($value)]
                    );
                    $tag->save();
                    $tag_ids[] = $tag->id;
                }
            }
            $product->tags()->sync($tag_ids);

            $data = [];
            foreach ($request->lang as $index => $key) {
                if ($request->name[$index] && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Model\Product',
                        'translationable_id' => $product->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
                if ($request->description[$index] && $key != 'en') {
                    array_push($data, array(
                        'translationable_type' => 'App\Model\Product',
                        'translationable_id' => $product->id,
                        'locale' => $key,
                        'key' => 'description',
                        'value' => $request->description[$index],
                    ));
                }
            }
            
            
            Translation::insert($data);
            Toastr::success('Product added successfully!');
            return redirect()->route('seller.product.list');
        }
    }
}
