<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subcategory
 * @package App
 */
class Subcategory extends Model
{
    public function categories()
    {
        return $this->belongsTo('App\Category')->withTimestamps();
    }
}
