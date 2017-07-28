<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class amassscrap extends Model
{
    //
    protected $table = 'amassscraps';
    protected $fillable = ['amasbudget_id','scrapamt','scrapuser','scrapdate','remark'];
    public function amasbudget(){
        return $this->belongsTo('App\models\amasbudget');
    }

}
