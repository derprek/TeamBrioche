<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [

        'question',
        'category',
        'modifydate',

    ];

    public function reports() // get articles associated with the given tag
    {
        return $this->belongsTo('App\Report')->withPivot('answers', 'rqid');
    }
}
