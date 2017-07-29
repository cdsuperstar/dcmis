<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\amotbudget
 *
 * @property int $id
 * @property string $otpicharge
 * @property string $otpicphone
 * @property string $otaddr
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereOtaddr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereOtpicharge($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereOtpicphone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $amapplication_id
 * @property string $name
 * @property float $bdg
 * @property string $otremark
 * @property string $addr
 * @property string $picharge
 * @property string $picphone
 * @property float $price
 * @property string $purchway
 * @property string $purchstate
 * @property int $amsupplier_id
 * @property string $reimstate
 * @property float $total
 * @property string $remark
 * @property-read \App\models\amapplication $amapplication
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereAddr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereAmapplicationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereAmsupplierId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereBdg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereOtremark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget wherePicharge($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget wherePicphone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget wherePurchstate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget wherePurchway($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereReimstate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereRemark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amotbudget whereTotal($value)
 */
class amotbudget extends Model
{
    //
    protected $table = 'amotbudgets';
    protected $fillable = ['amapplication_id','name','bdg','otremark','addr','picharge','picphone','contrprice','purchway','purchstate','amsuppliers_id','reimstate','total','remark'];
    public function amapplication(){
        return $this->belongsTo('App\models\amapplication');
    }

}
