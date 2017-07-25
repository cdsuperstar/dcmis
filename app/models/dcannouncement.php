<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class dcannouncement extends Model
{
    //
    protected $table = 'dcannouncements';
    protected $fillable = ['title','user_id','body'];

}
