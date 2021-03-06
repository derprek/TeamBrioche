<?php

namespace App;

use Session;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class User
 * @package App
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'users';


    /**
     * Set password of the user.
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Define the scope of clients associated with current practitioner.
     *
     * @param $query
     */
    public function scopeMyClient($query)
    {
        $query->where('prac_id', '=', Session::get('prac_id'));
    }

    public function scopeGetUnverified($query)
    {
        $query->where('verified', '=', 0);
    }

    public function scopeGetPractitionerClients($query,$prac_id)
    {
        $query->where('prac_id', '=', $prac_id);
    }

    public function scopeValidateEmail($query, $email)
    {
        $query->where('email', '=', $email);
    }

    public function scopeValidatePassword($query, $password)
    {
        $query->where('password', '=', $password);
    }


    /**
     *
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fname', 'sname', 'gender', 'prac_id', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Form the relationship between the user and the Report model.
     *
     * @return $this
     */
    public function reports()
    {
        return $this->hasMany('App\Report'); // form relation

    }

    public function getVerifiedAttribute($value)
    {
        return(boolean) $value;
    }
}
