<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\usermsg
 *
 * @property int $id
 * @property int $sender_id
 * @property int $recver_id
 * @property string $body
 * @property string $readtime
 * @property string $s_delat
 * @property string $r_delat
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $recver
 * @property-read \App\User $sender
 * @method static \Illuminate\Database\Query\Builder|\App\models\usermsg whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\usermsg whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\usermsg whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\usermsg whereRDelat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\usermsg whereReadtime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\usermsg whereRecverId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\usermsg whereSDelat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\usermsg whereSenderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\usermsg whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class usermsg extends Model
{
    //
    protected $fillable = ['sender_id', 'recver_id', 'body'];

    public function show()
    {
        echo "helo";
    }
    public function sender()
    {
        return $this->belongsTo('App\User','sender_id');
    }
    public function recver()
    {
        return $this->belongsTo('App\User','recver_id');
    }
}
