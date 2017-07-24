<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\ambudget
 *
 * @property int $id
 * @property string $type
 * @property string $no
 * @property string $unit
 * @property string $requester
 * @property string $reqdate
 * @property string $summary
 * @property float $total
 * @property bool $isappr
 * @property bool $isdone
 * @property bool $isabort
 * @property string $abortsum
 * @property string $remark
 * @property string $asname
 * @property string $aspara
 * @property int $amt
 * @property string $meas
 * @property float $price
 * @property string $purchdate
 * @property string $purchway
 * @property string $purchaser
 * @property bool $isassets
 * @property string $contrname
 * @property string $paymentp
 * @property float $contrprice
 * @property string $contrno
 * @property string $payee
 * @property string $payeebank
 * @property string $bankacc
 * @property float $contralterp
 * @property float $sumpay
 * @property float $thepay
 * @property bool $isaccept
 * @property string $acceptdt
 * @property string $itemname
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereAbortsum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereAcceptdt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereAmt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereAsname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereAspara($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereBankacc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereContralterp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereContrname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereContrno($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereContrprice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereIsabort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereIsaccept($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereIsappr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereIsassets($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereIsdone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereItemname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereMeas($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget wherePayee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget wherePayeebank($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget wherePaymentp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget wherePurchaser($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget wherePurchdate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget wherePurchway($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereRemark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereReqdate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereRequester($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereSummary($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereSumpay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereThepay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereTotal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereUnit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $budgetname
 * @property string $begindate
 * @property string $enddate
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereBegindate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereBudgetname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereEnddate($value)
 * @property string $syear
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudget whereSyear($value)
 */
class ambudget extends Model
{
    //
    protected $fillable = ['syear','type','unit','total','remark'];


}
