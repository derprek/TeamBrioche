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
}
