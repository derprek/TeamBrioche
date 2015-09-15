<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * @package App
 */
class Question extends Model
{

    /**
     * Specify which attributes are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [

        'question',
        'category',
        'modifydate',

    ];

    /**
     * Get the id of the answers.
     *
     * @return mixed
     */
    public function reports()
    {
        return $this->belongsTo('App\Report')->withPivot('answers', 'rqid');
    }

    /**
     * Define step two scope.
     *
     * @param $query
     */
    public function scopeStepTwo($query)
    {
        $query->where('step', '=', '2');
    }

    /**
     * Define step one scope.
     *
     * @param $query
     */
    public function scopeStepOne($query)
    {
        $query->where('step', '=', '1');
    }

    /**
     * Define questions category scope.
     *
     * @param $query
     * @param $ans
     */
    public function scopeGetquestionsbycat($query, $ans)
    {
        $query->where('category_id', '=', $ans);
    }
}
