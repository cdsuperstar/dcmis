<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * App\models\session
 *
 * @property int $id
 * @property int $user_id
 * @property string $ip_address
 * @property string $user_agent
 * @property string $payload
 * @property int $last_activity
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\models\session whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\session whereIpAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\session whereLastActivity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\session wherePayload($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\session whereUserAgent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\session whereUserId($value)
 * @mixin \Eloquent
 */
class session extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
