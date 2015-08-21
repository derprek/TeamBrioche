<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [

    	'userid',
    	'step',
    	'date',
    	'status'
    ];

    public function questions()
    {
    	return $this->belongsToMany('App\Question')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsTo('App\User')->withTimestamps();
    }

    public function products() // get articles associated with the given tag
    {
        return $this->belongsToMany('App\Product')->withPivot('request_by');
    }
}
