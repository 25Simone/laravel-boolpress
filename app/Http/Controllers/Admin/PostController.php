<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Save the db data in a variable
        $posts = Post::all();
        // Return the index view
        return view("admin.posts.index", compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.posts.create');
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
            ]
        );
        // Instance a new line
        $newPost = new Post();
        // Fill the line
        $newPost->fill($data);   
        // Define the post's slug
        $newPost->slug = $this->getUniqueSlag($newPost->title);
        
        // Save the line
        $newPost->save();

        return redirect()->route("admin.posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) {
        return view('admin.posts.edit', compact('post'));
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
            ]
        );

        if ($data["title"] !== $post->title) {
            $data["slug"] = $this->getUniqueSlag($data["title"]);  
        }

        // Update the post
        $post->update($data);

        return redirect()->route("admin.posts.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    protected function getUniqueSlag($slugString) {
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
