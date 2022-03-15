<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    protected $fillable = [
        "title",
        "content",
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
}
