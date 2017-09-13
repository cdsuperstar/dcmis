<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\amsubbudget
 *
 * @property int $id
 * @property int $amapplication_id
 * @property string|null $name
 * @property string|null $req
 * @property string|null $addr
 * @property string|null $picharge
 * @property string|null $picphone
 * @property string|null $wzno
 * @property string|null $wzsmodel
 * @property int|null $amt
 * @property float|null $bdg
 * @property float|null $price
 * @property string|null $purchway
 * @property string|null $purchstate
 * @property string|null $reimstate
 * @property string|null $contrno
 * @property int|null $amsupplier_id
 * @property string|null $asstate
 * @property int|null $regamt
 * @property int|null $scrapamt
 * @property float|null $total
 * @property string|null $remark
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\models\amapplication $amapplication
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\models\amassreg[] $amassregs
 * @property-read \App\models\ambaseas|null $ambaseas
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereAmapplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereAmsupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereAmt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereAsstate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereBdg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereContrno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget wherePicharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget wherePicphone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget wherePurchstate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget wherePurchway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereRegamt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereReimstate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereReq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereScrapamt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereWzno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\amsubbudget whereWzsmodel($value)
 * @mixin \Eloquent
 */
class amsubbudget extends Model
{
    //
    protected $table = 'amsubbudgets';
    protected $fillable = ['amapplication_id','name','req','addr','picharge','picphone','wzno','wzsmodel','amt','bdg','price','purchway','purchstate','reimstate','contrno','amsupplier_id','asstate','regamt','scrapamt','total','remark'];

    public function amapplication(){
        return $this->belongsTo('App\models\amapplication');
    }

    public function ambaseas(){
        return $this->belongsTo('App\models\ambaseas','wzno','no');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function amassregs(){
        return $this->hasMany('App\models\amassreg');
    }
}
