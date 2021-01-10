<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanRequest extends Model
{
    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }

    public function checkRequest()
    {
        return $this->belongsTo('App\CheckRequest', 'check_request_id');
    }
}
