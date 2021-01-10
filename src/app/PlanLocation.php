<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanLocation extends Model
{
    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
