<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\ambudgettype
 *
 * @property int $id
 * @property string $no
 * @property string $type
 * @property string $spell
 * @property string $template
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudgettype whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudgettype whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudgettype whereNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudgettype whereSpell($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudgettype whereTemplate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudgettype whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\ambudgettype whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ambudgettype extends Model
{
    //
    protected $table = 'ambudgettypes';
    protected $fillable = ['no', 'type', 'spell','template'];

}