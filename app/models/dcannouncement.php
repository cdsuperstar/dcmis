<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\dcannouncement
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcannouncement whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcannouncement whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcannouncement whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcannouncement whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcannouncement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcannouncement whereUserId($value)
 * @mixin \Eloquent
 */
class dcannouncement extends Model
{
    //
    protected $table = 'dcannouncements';
    protected $fillable = ['title','user_id','body'];

}
