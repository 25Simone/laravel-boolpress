<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Category;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Save the db data in a variable
        $posts = Post::where('user_id', Auth::user()->id)->get();
        // Return the index view
        return view("admin.posts.index", compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // Import the categories
        $categories = Category::all();
        // Import the tags
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Save and validate the form's data
        $data = $request->validate(
            // Validation rules
            [
                "title" => "required|min:5",
                "content" => "required|min:20",
                "category_id" => "nullable",
                "tags" => "nullable"
            ]
        );
        // Instance a new line
        $newPost = new Post();
        // Fill the line
        $newPost->fill($data);   
        // Define the post's slug
        $newPost->slug = $this->getUniqueSlug($newPost->title);
        // Define the user_id value as the id of the logged in user
        $newPost->user_id = Auth::user()->id;

        // Save the line
        $newPost->save();
        
        // For the current post adds the relations with the tags taken from the form
        $newPost->tags()->attach($data["tags"]);

        return redirect()->route("admin.posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $post = Post::where("slug", $slug)->first();

        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) {
        // Import the categories
        $categories = Category::all();
        // Import the tags
        $tags = Tag::all();

        return view('admin.posts.edit', [
            "post"=>$post,
            "categories"=>$categories,
            "tags"=>$tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) {
        // Save and validate the form's data
        $data = $request->validate(
            // Validation rules
            [
                "title" => "required|min:5",
                "content" => "required|min:20",
                "category_id" => "nullable|exists:categories,id",
                "tags" => "nullable|exists:tags,id",
                ]
            );
            
            
            if ($data["title"] !== $post->title) {
                $data["slug"] = $this->getUniqueSlug($data["title"]);  
            }
            
            // dd($post);
            // Update the post
            $post->update($data);
            
        
        if (key_exists('tags', $data)) {

            // Update the pivot table post_tag
            // Invokes the tags function (in the post's model)
            // For the current post remove all the existing relations with the tags
            $post->tags()->detach();

            // For the current post adds the relations with the tags taken from the form
            $post->tags()->attach($data["tags"]);
        }

        return redirect()->route("admin.posts.show", $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }

    protected function getUniqueSlug($slugString) {
        // Create the slug using Str class
        $slug = Str::slug($slugString);
        
        // Check at db if there is already an element with the same slug
        $exists = Post::where("slug", $slug)->first();
        // Define a counter as an index
        $counter =  1;

        // If an element with this slug already exists in the db
        while($exists) {
            // Create a new slug
            $newSlug = $slug . "-" . $counter;
            //Increment the index
            $counter++;

            // Check at db if there is already an element with the new slug
            $exists = Post::where("slug", $newSlug)->first();
            // Set the slug's value
            if(!$exists) {
                $slug = $newSlug;
            }
        }
        return $slug;
    }
}
