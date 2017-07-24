<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\ambaseas
 *
 * @property int $id
 * @property string $class
 * @property string $no
 * @property string $name
 * @property string $measunit
 * @property string $spell
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambaseas whereClass($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambaseas whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambaseas whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambaseas whereMeasunit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambaseas whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambaseas whereNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambaseas whereSpell($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambaseas whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ambaseas extends Model
{
    //
    protected $table = 'ambaseass';
    protected $fillable = ['class', 'no','name', 'measunit','spell'];

}
