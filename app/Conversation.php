<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function scopeGetFirstParty($query, $email)
    {
        $query->where('firstuser_email', '=', $email);
    }

    public function scopeGetSecondParty($query, $email)
    {
        $query->where('seconduser_email', '=', $email);
    }
}
