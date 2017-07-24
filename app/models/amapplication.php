<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class amapplication extends Model
{
    //
    protected $table = 'amapplications';
    protected $fillable = ['year','unitgrps_id','requester','name','ambudgettypes_id','appstate','apper','appdate','progress','isterm','termreason'];

}
