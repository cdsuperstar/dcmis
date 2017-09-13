<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\models\amassreg
 *
 * @property int $id
 * @property string $meas
 * @property int $amt
 * @property int $asuser
 * @property string $unitgrp_id
 * @property string $userdate
 * @property string $validdate
 * @property string $state
 * @property int $scrapuser
 * @property string $scrapdate
 * @property string $remark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereAmt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereAsuser($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereMeas($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereRemark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereScrapdate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereScrapuser($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereUnitgrpsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereUserdate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereValiddate($value)
 * @mixin \Eloquent
 * @property int $amasbudget_id
 * @property string $scrapremark
 * @property-read \App\models\amasbudget $amasbudget
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereAmasbudgetId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amassreg whereScrapremark($value)
 * @property int $amsubbudget_id
 * @property-read \App\models\amsubbudget $amsubbudget
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amassreg whereAmsubbudgetId($value)
 */
class amassreg extends Model
{
    //
    protected $table = 'amassregs';
    protected $fillable = ['amsubbudget_id','amt','asuser','unitgrp_id','userdate','validdate','state','remark','scrapuser','scrapdate','scrapremark'];
    public function amsubbudget(){
        return $this->belongsTo('App\models\amsubbudget');
    }
}
