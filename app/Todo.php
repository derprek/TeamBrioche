<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
	protected $fillable = ['body', 'completed'];

    public function getCompletedAttribute($value)
    {
    	return(boolean) $value;
    }
}
