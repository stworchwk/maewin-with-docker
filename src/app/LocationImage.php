<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationImage extends Model
{
    protected $appends = ['image_url'];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function getImageUrlAttribute()
    {
        return url($this->attributes['path']);
    }

    protected $hidden = [
        'created_at', 'updated_at', 'path',
    ];
}
