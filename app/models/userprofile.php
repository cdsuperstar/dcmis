<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use LaravelArdent\Ardent\Ardent;


class userprofile extends Ardent
{
    //
    public function user()
    {
        return $this->belongsTo('App\User','id');
    }
}
