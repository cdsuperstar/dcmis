<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\amasbudget
 *
 * @property int $id
 * @property string $asname
 * @property string $aspara
 * @property int $amt
 * @property string $meas
 * @property float $price
 * @property string $purchdate
 * @property string $purchway
 * @property string $purchaser
 * @property bool $isassets
 * @property string $asremark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereAmt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereAsname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereAspara($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereAsremark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereIsassets($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereMeas($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget wherePurchaser($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget wherePurchdate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget wherePurchway($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float $bdgprice
 * @property float $purchprice
 * @property string $purchstate
 * @property string $reimstate
 * @property string $contrno
 * @property string $asstate
 * @property float $total
 * @property string $remark
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereAsstate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereBdgprice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereContrno($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget wherePurchprice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget wherePurchstate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereReimstate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereRemark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amasbudget whereTotal($value)
 */
class amasbudget extends Model
{
    //
    protected $table = 'amasbudgets';
    protected $fillable = ['amapplication_id','wzno','wzsmodel','amt','bdg','purchprice','purchway','purchstate','reimstate','contrno','asstate','total','remark'];
    public function amapplication(){
        return $this->belongsTo('App\models\amapplication','id');
    }


}
