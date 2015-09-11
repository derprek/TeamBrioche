<?php

namespace App;

use Session;
use Auth;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * @package App
 */
class Report extends Model
{
    protected $fillable = [

        'userid',
        'step',
        'date',
        'status'
    ];

    public function scopeProgress($query)
    {
        $query->where('status', '=', 'In Progress');
    }

    public function scopeFinished($query)
    {
        $query->where('status', '=', 'Finished');
    }

    public function scopePractitioner($query)
    {
        $query->where('prac_id', '=', Session::get('userid'));
    }

    public function scopeGetUserReports($query)
    {
        $query->where('userid', '=', Auth::User()->id);
    }

    public function questions()
    {
        return $this->belongsToMany('App\Question')->withTimestamps()->withPivot('answers', 'rqid');
    }

    public function users()
    {
        return $this->belongsTo('App\User')->withTimestamps();
    }

    public function practitioners()
    {
        return $this->belongsToMany('App\Practitioner')->withPivot('prid');
    }

    public function products() // get articles associated with the given tag
    {
        return $this->belongsToMany('App\Product')->withPivot('request_by');
    }
}
