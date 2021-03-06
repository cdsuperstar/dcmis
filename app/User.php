<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\Authenticatable;
use LaravelArdent\Ardent\Ardent;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;


use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Closure;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $perms
 * @mixin \Eloquent
 */
class User extends Ardent implements
    AuthenticatableContract,
//    AuthorizableContract,
    CanResetPasswordContract
{

    use Notifiable, Authenticatable, CanResetPassword;
    //Authorizable
    use EntrustUserTrait;
//    use EntrustUserTrait {
//        EntrustUserTrait::can insteadof Authorizable;
//    }
    public static $rules = array(
        'name' => 'required|between:1,32',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => ''
    );
    public static $angularrules = array(
        'name' => 'required|between:4,16|min_len:1|max_len:32',
        'email' => 'required|email|unique:users',
        'password' => 'required|min_len:6',
//        'password_confirmation' => 'match:dcEdition.password,Password|required',
    );
    public $autoPurgeRedundantAttributes = true;
    public $autoHydrateEntityFromInput = true;
    public static $passwordAttributes = array('password');
    public $autoHashPasswordAttributes = true;
    /**
     * hash new password
     * @return bool
     */
//    public function beforeSave()
//    {
//        // if there's a new password, hash it
//        if ($this->isDirty('password')) {
//            $this->password = \Hash::make($this->password);
//        }
//
//        return true;
//        //or don't return nothing, since only a boolean false will halt the operation
//    }

    /**
     * rewrite save method
     * @param array $rules
     * @param array $customMessages
     * @param array $options
     * @param Closure|null $beforeSave
     * @param Closure|null $afterSave
     * @return bool
     */
    public function save(array $rules = array(),
                         array $customMessages = array(),
                         array $options = array(),
                         Closure $beforeSave = null,
                         Closure $afterSave = null
    )
    {
        Cache::tags(Config::get('entrust.role_user_table'))->flush();

        return $this->internalSave($rules, $customMessages, $options, $beforeSave, $afterSave, false);
    }

    function __construct($attributes = array())
    {
        parent::__construct($attributes);

        $this->purgeFilters[] = function ($key) {
            $purge = array('messages', 'success');
            return !in_array($key, $purge);
        };
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','syscfg','usercfg'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

    public static $relationsData = array(
//        'userprofile'=>array(self::HAS_ONE,'App\models\userprofile')
    );
    public function userprofile(){
        return $this->hasOne('App\models\userprofile','id');
    }
    public function recvmsgs()
    {
        return $this->hasMany('App\models\usermsg','recver_id');
    }
    public function sendmsgs()
    {
        return $this->hasMany('App\models\usermsg','sender_id');
    }
    public function session(){
        return $this->hasOne('App\models\session');
    }

//    public function unitgrps()
//    {
//        return $this->belongsToMany('App\models\unitgrp','unitgrp_user','user_id');
//    }
}
