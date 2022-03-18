<?php
namespace App\Traits;

use App\Post;
use Illuminate\Support\Str;

trait SlugGenerator {
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