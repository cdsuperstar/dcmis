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
 * @property-read \App\User $user
 * @property string $nickname
 * @property string $duties
 * @property int $unitid
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereDuties($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\userprofile whereUnitid($value)
 */
class userprofile extends Model
{
    protected $table='userprofiles';
    protected $fillable = ['id','no', 'nickname', 'sex', 'phone', 'birth', 'tel', 'address','duties','unitid', 'memo','signpic'];
//    public static $relationsData = array(
//        'user' => array(self::BELONGS_TO, 'App\User'),
//    );
    public function unitgrp(){
        return $this->belongsTo('App\models\unitgrp','unitid');
    }

    public function user(){
        return $this->belongsTo('App\User','id');
    }
}
