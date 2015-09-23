<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    public function questions()
    {
        return $this->belongsToMany('App\Question')->withPivot('answers', 'qsid');
    }

    public function scopeGetReports($query,$report_id)
    {
        $query->where('report_id', '=', $report_id);
    }

}
