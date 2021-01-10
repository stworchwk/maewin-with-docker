<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanMessage extends Model
{
    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }

    public function systemMessage()
    {
        return $this->belongsTo('App\SystemMessage', 'system_message_id');
    }
}
