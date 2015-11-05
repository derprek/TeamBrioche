<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    public function scopeGetVersion($query, $report_id)
    {
        $query->where('report_id', '=', $report_id);
    }

    public function scopeByAssessment($query)
    {
        $query->where('report_type', '=', 1);
    }
}
