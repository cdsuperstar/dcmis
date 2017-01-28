<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use LaravelArdent\Ardent\Ardent;


/**
 * App\models\userprofile
 *
 * @property int $id
 * @property string $no
 * @property string $name
 * @property string $sex
 * @property string $phone
 * @property string $birth
 * @property string $tel
 * @property string $address
 * @property string $signpic
 * @property string $memo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereBirth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereMemo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereSignpic($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereTel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class userprofile extends Ardent
{

    protected $fillable = ['id', 'name', 'sex', 'phone', 'birth', 'tel', 'address', 'memo'];
    public static $relationsData = array(
        'user' => array(self::BELONGS_TO, 'App\User'),
    );
}
