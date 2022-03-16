<?php

use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $tags = [
            'film',
            'serieTv',
            'Cinema',
            'Box Office',
            'Marvel',
            'Universal',
        ];

        foreach ($tags as $tag) {
            // Create a new line
            $newTag = new Tag();
            // Define tag's name
            $newTag->name = $tag;
            // Define tag's slug
            $newTag->slug = Str::slug($tag);
            // Save the line
            $newTag->save();
        }
    }
}
