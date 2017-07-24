<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\amsupplier
 *
 * @property int $id
 * @property string $compname
 * @property string $principal
 * @property string $contacter
 * @property string $tel
 * @property string $phone
 * @property string $compaddr
 * @property string $remark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsupplier whereCompaddr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsupplier whereCompname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsupplier whereContacter($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsupplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsupplier whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsupplier wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsupplier wherePrincipal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsupplier whereRemark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsupplier whereTel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\amsupplier whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class amsupplier extends Model
{
    //
    protected $table = 'amsuppliers';
    protected $fillable = ['compname', 'principal','contacter','tel', 'phone','compaddr', 'remark'];

}
