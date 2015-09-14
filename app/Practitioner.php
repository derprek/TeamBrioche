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
    public function reports() // get articles associated with the given tag
    {
        return $this->belongsToMany('App\Report')->withPivot('prid');
    }

    public function scopeValidateEmail($query, $email)
    {
        $query->where('email', '=', $email);
    }

    public function scopeValidatePassword($query, $password)
    {
        $query->where('password', '=', $password);
    }

    public function scopeGetCurrent($query)
    {
        $query->where('id', '=', Session::get('prac_id'));
    }

}
