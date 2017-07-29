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
 * @property string $unitgrps_id
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
 */
class amassreg extends Model
{
    //
    protected $table = 'amassregs';
    protected $fillable = ['amasbudget_id','amt','asuser','unitgrps_id','userdate','validdate','state','remark','scrapuser','scrapdate','scrapremark'];
    public function amasbudget(){
        return $this->belongsTo('App\models\amasbudget');
    }
}
