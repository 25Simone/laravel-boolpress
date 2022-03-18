<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Http\Controllers\Controller;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;

class PostController extends Controller {
    use SlugGenerator;

    public function index() {
        // Save the posts data in a variable
        $posts = Post::all();
        // Return in json the posts data
        return response()->json([
            "successfully" => true,
            "data" => $posts,
        ]);
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

    public function show(Post $post) {
        // Pass the dependent functions to the show
        $post->load("tags", "users");
        // Return the post
        return response()->json($post);
    }
    
}