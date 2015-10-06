<?php

namespace App;

use Session;
use Auth;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * @package App
 */
class Report extends Model
{
    /**
     * Specify which attributes are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [

        'userid',
        'step',
        'date',
        'status'
    ];

     protected $casts = [
        'published' => 'boolean'
    ];

    /**
     * Define report scope where status is in progress.
     *
     * @param $query
     */
    public function scopeProgress($query)
    {
        $query->where('status', '=', '0');
    }

    /**
     * Define report scope where status is finished.
     *
     * @param $query
     */
    public function scopeFinished($query)
    {
        $query->where('status', '=', '1');
    }

    /**
     * Get the login practitioner.
     *
     * @param $query
     */
    public function scopePractitioner($query)
    {
        $query->where('prac_id', '=', Session::get('prac_id'));
    }

    public function scopeGetThisPractitionerReports($query,$prac_id)
    {
        $query->where('prac_id', '=', $prac_id);
    }

    /**
     * Get the user reports.
     *
     * @param $query
     */
    public function scopeGetUserReports($query)
    {
        $query->where('userid', '=', Auth::User()->id);
    }

    public function scopeGetClientReports($query, $client_id)
    {
        $query->where('userid', '=', $client_id);
    }

    public function scopePublished($query)
    {
        $query->where('published', '=', 1);
    }

    public function getHumanUpdatedAtAttribute()
    {
         return $this->getHumanTimestampAttribute("updated_at");
    }

    /**
     * Form the relationship between the report and the Question model.
     *
     * @return $this
     */
    public function questions()
    {
        return $this->belongsToMany('App\Question')->withTimestamps()->withPivot('answers', 'rqid');
    }

    /**
     * Form the relationship between the report and the User model.
     *
     * @return mixed
     */
    public function users()
    {
        return $this->belongsTo('App\User')->withTimestamps();
    }

    /**
     * Form the relationship between the report and the Practitioner model.
     *
     * @return $this
     */
    public function practitioners()
    {
        return $this->belongsToMany('App\Practitioner')->withPivot('prid');
    }

    /**
     * get articles associated with the given tag
     *
     * @return $this
     */
    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('request_by');
    }
}
