<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    // expresses the dependence between Post and Tag
    public function posts() {
        return $this->belongsToMany("App\Post");
    }
}
