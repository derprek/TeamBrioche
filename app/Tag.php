<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function products() // get articles associated with the given tag
    {
        return $this->belongsToMany('App\Product');
    }
}
