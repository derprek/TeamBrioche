<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
   public function categories()
    {
    	return $this->belongsTo('App\Category')->withTimestamps();
    }
}
