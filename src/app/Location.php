<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $appends = ['thumbnail_url'];

    public function images()
    {
        return $this->hasMany('App\LocationImage');
    }

    public function category()
    {
        return $this->belongsTo('App\LocationCategory', 'location_category_id');
    }

    public function getThumbnailUrlAttribute()
    {
        return url($this->attributes['thumbnail']);
    }

    protected $hidden = [
        'created_at', 'updated_at', 'thumbnail',
    ];
}
