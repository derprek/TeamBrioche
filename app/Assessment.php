<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    public function questions()
    {
        return $this->belongsToMany('App\Question', 'assessment_answers')->withPivot('answers', 'id', 'assessment_id','version_id')->withTimestamps();
    }

    public function scopeGetAssessment($query, $report_id)
    {
        $query->where('report_id', '=', $report_id);
    }
}
