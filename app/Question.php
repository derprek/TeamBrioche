<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * @package App
 */
class Question extends Model
{
    protected $fillable = [

        'question',
        'category',
        'modifydate',

    ];

    /**
     * Get articles associated with the given tag.
     *
     * @return mixed
     */
    public function reports()
    {
        return $this->belongsTo('App\Report')->withPivot('answers', 'rqid');
    }

    public function scopeSteptwo($query)
    {
        $query->where('step', '=', '2');
    }

    public function scopeStepone($query)
    {
        $query->where('step', '=', '1');
    }

    public function scopeGetquestionsbycat($query, $ans)
    {
        $query->where('category_id', '=', $ans);
    }
}
