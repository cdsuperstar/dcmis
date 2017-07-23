<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class amsupplier extends Model
{
    //
    protected $table = 'amsuppliers';
    protected $fillable = ['compname', 'principal','contacter','tel', 'phone','compaddr', 'remark'];

}
