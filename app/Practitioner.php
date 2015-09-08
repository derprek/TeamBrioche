<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practitioner extends Model
{
    public function products() // get articles associated with the given tag
    {
    	return $this->belongsToMany('App\Product');
    }

     public function reports() // get articles associated with the given tag
    {
    	return $this->belongsToMany('App\Report');
    }

}
