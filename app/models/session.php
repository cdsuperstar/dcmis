<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class session extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
