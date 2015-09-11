<?php

namespace App;
use Session;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Practitioner
 * @package App
 */
class Practitioner extends Model
{
    public function products() // get articles associated with the given tag
    {
        return $this->belongsToMany('App\Product');
    }

    public function reports() // get articles associated with the given tag
    {
        return $this->belongsToMany('App\Report')->withPivot('prid');;
    }

    public function scopeGetCurrent($query)
    {
        $query->where('id', '=', Session::get('userid'));
    }

}
