<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class usermsg extends Model
{
    //
    protected $fillable = ['sender_id', 'recver_id', 'body'];

    public function show()
    {
        echo "helo";
    }
    public function sender()
    {
        return $this->belongsTo('App\User','sender_id');
    }
    public function recver()
    {
        return $this->belongsTo('App\User','recver_id');
    }
}
