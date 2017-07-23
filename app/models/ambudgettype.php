<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ambudgettype extends Model
{
    //
    protected $table = 'ambudgettypes';
    protected $fillable = ['no', 'type', 'spell','template'];

}