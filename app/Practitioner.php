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
    protected $casts = [
        'verified' => 'boolean'
    ];

    /**
     *Form the relationship between the practitioner and the reports model.
     *
     * @return $this
     */
    public function reports()
    {
        return $this->belongsToMany('App\Report')->withPivot('prid');
    }

    /**
     * Define a validate email scope.
     *
     * @param $query
     * @param $email
     */
    public function scopeValidateEmail($query, $email)
    {
        $query->where('email', '=', $email);
    }

    /**
     * Define a validate password scope.
     *
     * @param $query
     * @param $password
     */
    public function scopeValidatePassword($query, $password)
    {
        $query->where('password', '=', $password);
    }

    /**
     * Define a current practitioner scope.
     *
     * @param $query
     */
    public function scopeGetCurrent($query)
    {
        $query->where('id', '=', Session::get('prac_id'));
    }

    public function scopeNotCurrent($query)
    {
        $query->where('id', '!=', Session::get('prac_id'));
    }

}
