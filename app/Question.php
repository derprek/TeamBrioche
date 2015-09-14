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
     * Get
     *
     * @return mixed
     */
    public function reports()
    {
        return $this->belongsTo('App\Report')->withPivot('answers', 'rqid');
    }

    public function scopeStepTwo($query)
    {
        $query->where('step', '=', '2');
    }

    public function scopeStepOne($query)
    {
        $query->where('step', '=', '1');
    }

    public function scopeGetquestionsbycat($query, $ans)
    {
        $query->where('category_id', '=', $ans);
    }
}
