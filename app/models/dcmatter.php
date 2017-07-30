<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class dcmatter extends Model
{
    //
    protected $table = 'dcmatters';
    protected $fillable = ['suser_id','ruser_id','title','content','enddate'];

    public function susers(){
        return $this->belongsTo('App\User','suser_id');
    }
    public function rusers(){
        return $this->belongsTo('App\User','ruser_id');
    }

}
