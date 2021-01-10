<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Traveler extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guard = 'traveler';

    protected $fillable = [
        'email', 'password', 'full_name', 'social_google', 'nationality_id', 'prefix_phone_number_id', 'phone_number', 'id_card', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function prefixPhone()
    {
        return $this->belongsTo('App\PrefixPhoneNumber', 'prefix_phone_number_id');
    }

    public function plans()
    {
        return $this->hasMany('App\Plan');
    }

    public function nationality()
    {
        return $this->belongsTo('App\Nationality', 'nationality_id');
    }
}
