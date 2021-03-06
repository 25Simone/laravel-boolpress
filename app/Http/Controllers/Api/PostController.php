<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Http\Controllers\Controller;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;

class PostController extends Controller {
    use SlugGenerator;

    public function index(Request $request) {
        // Save the request filter in a variable
        $filter = $request->input("filter");
        
        if ($filter) {
            // If the filter exists filter the posts data
            $posts = Post::where("content", "LIKE", "%$filter%")->paginate();
        } else {
            $posts = Post::paginate(6);
        }

        // Load the user data
        $posts->load('user', 'category');

        // Define the image path foreach post
        $posts->each(function($post) {
            if($post->image) {
                $post->image = asset("storage/" . $post->image);
            }
        });

        // Return in json the posts data
        return response()->json($posts);
    }

    public function store(Request $request) {
        // Save the posts data in a variable and validate it
        $data = $request->validate([
            "title" => "required|min:5",
            "content" => "required|min:20",
            "image" => "nullable|url",
            "category_id" => "nullable",
            "tags" => "nullable"
        ]);
        // Create a new post
        $newPost = new Post();
        // Fill the post with data
        $newPost->fill($data);
        // At the moment define manually the user_id value
        $newPost->user_id = 1;
        // Define the slug value
        $newPost->slug = $this->getUniqueSlug($data["title"]);

        // Save the new post
        $newPost->save();
        
        // Starting from the request, if the key exists, assign the tags to the new post
        if(key_exists("tags", $data)) {
            $newPost->tags()->attach($data["tags"]);
        }

        // Return the new post
        return response()->json($newPost); 
    }

    public function show($slug) {
        $post = Post::where("slug", $slug)->with(["tags", "user", "category"])->first();

        // Define the image path the post
        if($post->image) {
            $post->image = asset("storage/" . $post->image);
        }

        if(!$post) {
            abort(404);
        }
        // Return the post
        return response()->json($post);
    }
    
}
