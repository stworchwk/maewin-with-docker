<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckResponse extends Model
{
    public function checkRequest()
    {
        return $this->belongsTo('App\CheckRequest', 'check_request_id');
    }
}
