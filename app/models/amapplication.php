<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\amapplication
 *
 * @property int $id
 * @property string $year
 * @property string $unitgrp_id
 * @property int $requester
 * @property string $name
 * @property int $ambudgettype_id
 * @property string $appstate
 * @property int $apper
 * @property string $appdate
 * @property int $progress
 * @property bool $isterm
 * @property string $termreason
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereAmbudgettypesId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereAppdate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereApper($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereAppstate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereIsterm($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereProgress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereRequester($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereTermreason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereUnitgrpsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereYear($value)
 * @mixin \Eloquent
 * @property string $syear
 * @property string $no
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\models\amasbudget[] $amasbudgets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\models\amcontrbudget[] $amcontrbudgets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\models\amotbudget[] $amotbudgets
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\models\amsvbudget[] $amsvbudgets
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amapplication whereSyear($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\models\amsubbudget[] $amsubbudgets
 */
class amapplication extends Model
{
    //
    protected $table = 'amapplications';
    protected $fillable = ['syear','unitgrp_id','requester','no','name','ambudgettype_id','appstate','apper','appdate','progress','isterm','termreason'];

    public function unitgrp()
    {
        return $this->belongsTo('App\models\unitgrp');

    }

    public function amsubbudgets()
    {
        return $this->hasMany('App\models\amsubbudget','amapplication_id');
    }
}
