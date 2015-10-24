<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    public function questions()
    {
        return $this->belongsToMany('App\Question', 'evaluation_answers')->withPivot('answers', 'id', 'evaluation_id')->withTimestamps();
    }

    public function scopeGetEvaluation($query, $report_id)
    {
        $query->where('report_id', '=', $report_id);
    }
}
