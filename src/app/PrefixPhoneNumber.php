<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrefixPhoneNumber extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
