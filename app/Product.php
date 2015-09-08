<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

     public function scopeCheckPrac($query)
    {
        $query->where('published_at', '<=', Carbon::now());

    }
    
    public function reports() // get articles associated with the given tag
    {
        return $this->belongsToMany('App\Report')->withPivot('request_by');
    }

    public function tags() // get articles associated with the given tag
    {
        return $this->belongsToMany('App\Tag');
    }

    public function categories() // get articles associated with the given tag
    {
        return $this->belongsToMany('App\Category');
    }
}
