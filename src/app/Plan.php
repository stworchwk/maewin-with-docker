<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function traveler()
    {
        return $this->belongsTo('App\Traveler', 'traveler_id');
    }

    public function locations()
    {
        return $this->hasMany('App\PlanLocation');
    }

    public function trackings()
    {
        return $this->hasMany('App\PlanTracking');
    }

    public function requests()
    {
        return $this->hasMany('App\PlanRequest');
    }

    public function messages()
    {
        return $this->hasMany('App\PlanMessage');
    }

    public function logs()
    {
        return $this->hasMany('App\PlanLog');
    }
}
