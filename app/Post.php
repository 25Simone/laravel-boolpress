<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {
    // Soft Delete
    use SoftDeletes;

    protected $fillable = [
        "title",
        "content",
        "image",
        "slug",
        "category_id",
    ];

    // expresses the dependence of Post towards User
    public function user() {
        return $this->belongsTo('App\User');
    }
    // expresses the dependence of Post towards Category
    public function category() {
        return $this->belongsTo('App\Category');
    }

    // expresses the dependence between Post and Tag
    public function tags() {
        return $this->belongsToMany("App\Tag");
    }
}
