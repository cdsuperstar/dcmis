<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\amcontrbudget
 *
 * @property int $id
 * @property string $contrname
 * @property string $contrno
 * @property string $contrpicharge
 * @property string $contrpicphone
 * @property string $contraddr
 * @property string $contrworkreq
 * @property string $contrbegindate
 * @property string $contrenddate
 * @property string $paymentp
 * @property float $contrprice
 * @property string $payee
 * @property string $payeebank
 * @property string $bankacc
 * @property float $contralterp
 * @property float $sumpay
 * @property float $thepay
 * @property bool $isaccept
 * @property string $acceptdt
 * @property string $contrremark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereAcceptdt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereBankacc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereContraddr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereContralterp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereContrbegindate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereContrenddate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereContrname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereContrno($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereContrpicharge($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereContrpicphone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereContrprice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereContrremark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereContrworkreq($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereIsaccept($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget wherePayee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget wherePayeebank($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget wherePaymentp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereSumpay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereThepay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name
 * @property float $bdg
 * @property string $req
 * @property string $addr
 * @property string $picharge
 * @property string $picphone
 * @property float $price
 * @property string $purchway
 * @property string $purchstate
 * @property int $amsuppliers_id
 * @property string $reimstate
 * @property float $total
 * @property string $remark
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereAddr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereAmsuppliersId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereBdg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget wherePicharge($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget wherePicphone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget wherePurchstate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget wherePurchway($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereReimstate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereRemark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereReq($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amcontrbudget whereTotal($value)
 */
class amcontrbudget extends Model
{
    //
    protected $table = 'amcontrbudgets';
    protected $fillable = ['name','bdg','req','addr','picharge','picphone','price','purchway','purchstate','amsuppliers_id','reimstate','contrno','total','remark'];

}
