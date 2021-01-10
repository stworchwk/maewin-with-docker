<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckRequest extends Model
{
    public function checkResponses()
    {
        return $this->hasMany('App\CheckResponse');
    }
}
