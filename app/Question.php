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

    public function assessments()
    {
        return $this->belongsToMany('App\Assessment', 'assessment_answers')->withPivot('answers', 'id', 'assessment_id','version_id')->withTimestamps();
    }

    public function typologys()
    {
        return $this->belongsToMany('App\Typology', 'typology_answers')->withPivot('answers', 'id', 'typology_id')->withTimestamps();
    }

    public function evaluations()
    {
        return $this->belongsToMany('App\Evaluation', 'evaluation_answers')->withPivot('answers', 'id', 'evaluation_id')->withTimestamps();
    }

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
     * Define step one scope.
     *
     * @param $query
     */
    public function scopeAssessment($query)
    {
        $query->where('step', '=', '1');
    }

    /**
     * Define step two scope.
     *
     * @param $query
     */
    public function scopeTypology($query)
    {
        $query->where('step', '=', '2');
    }

    /**
     * Define step three scope.
     *
     * @param $query
     */
    public function scopeEvaluation($query)
    {
        $query->where('step', '=', '3');
    }

    /**
     * Define goals scope
     *
     * @param $query
     */
    public function scopeGetGoals($query)
    {
        $query->where('question', 'LIKE', "Client's goals");
    }

    /**
     * Define body structure scope
     *
     * @param $query
     */
    public function scopeGetBodyStructure($query)
    {
        $query->where('question', 'LIKE', "Body functions and structures");
    }

    /**
     * Define body structure scope
     *
     * @param $query
     */
    public function scopeGetActivities($query)
    {
        $query->where('question', 'LIKE', "Activities and participation");
    }

    /**
     * Define body structure scope
     *
     * @param $query
     */
    public function scopeGetEnvFactors($query)
    {
        $query->where('question', 'LIKE', "Environmental factors");
    }

    /**
     * Define body structure scope
     *
     * @param $query
     */
    public function scopeGetPersonalFactors($query)
    {
        $query->where('question', 'LIKE', "Personal factors");
    }

    public function scopeGetProduct($query)
    {
        $query->where('question', 'LIKE', "Product(s) evaluated for selection:");
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
