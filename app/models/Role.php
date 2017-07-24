<?php

namespace App\models;

use Zizaco\Entrust\EntrustRole;

/**
 * App\models\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $perms
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Role whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\models\dcmodel[] $models
 */
class Role extends EntrustRole
{
    //
    protected $table = 'roles';
    protected $fillable = ['name', 'display_name', 'description'];
    public static $angularrules = array(
        'name' => 'required|between:4,16|min_len:1|max_len:255',
        'display_name' => 'required',
        'description' => '',
    );

    public function models()
    {
        return $this->belongsToMany('App\models\dcmodel');
    }
}
