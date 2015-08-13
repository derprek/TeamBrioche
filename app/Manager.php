<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public function questions() // get articles associated with the given tag
    {
    	return $this->belongsToMany('App\Question');
    }
}
