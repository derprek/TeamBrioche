<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    public function questions()
    {
        return $this->belongsToMany('App\Question', 'typology_answers')->withPivot('answers', 'id', 'typology_id')->withTimestamps();
    }

    public function scopeGetTypology($query, $report_id)
    {
        $query->where('report_id', '=', $report_id);
    }
}
