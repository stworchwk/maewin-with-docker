<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanLog extends Model
{
    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
}
