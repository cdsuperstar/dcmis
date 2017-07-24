<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\amsvbudget
 *
 * @property int $id
 * @property string $svpicharge
 * @property string $svpicphone
 * @property string $svaddr
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereSvaddr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereSvpicharge($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereSvpicphone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name
 * @property float $bdg
 * @property string $req
 * @property string $addr
 * @property string $picharge
 * @property string $picphone
 * @property float $contrprice
 * @property string $purchway
 * @property string $purchstate
 * @property int $amsuppliers_id
 * @property string $reimstate
 * @property float $total
 * @property string $remark
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereAddr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereAmsuppliersId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereBdg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereContrprice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget wherePicharge($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget wherePicphone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget wherePurchstate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget wherePurchway($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereReimstate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereRemark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereReq($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsvbudget whereTotal($value)
 */
class amsvbudget extends Model
{
    //
    protected $table = 'amsvbudgets';
    protected $fillable = ['name','bdg','req','addr','picharge','picphone','contrprice','purchway','purchstate','amsuppliers_id','reimstate','total','remark'];

}
