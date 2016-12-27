<?php

namespace App\models;

use Zizaco\Entrust\EntrustRole;

/**
 * App\models\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $perms
 * @mixin \Eloquent
 */
class Role extends EntrustRole
{
    //
    protected $table = 'roles';
    protected $fillable = ['name', 'display_name', 'description'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
