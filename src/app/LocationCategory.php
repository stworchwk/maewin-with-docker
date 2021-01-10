<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationCategory extends Model
{
    protected $appends = ['icon_url'];

    public function locations()
    {
        return $this->hasMany('App\Location');
    }

    public function getIconUrlAttribute()
    {
        return url($this->attributes['icon_path']);
    }

    protected $hidden = [
        'created_at', 'updated_at', 'icon_path',
    ];
}
