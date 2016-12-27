<?php

namespace App\models;

use Zizaco\Entrust\EntrustPermission;

/**
 * App\models\Permission
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\models\Role[] $roles
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\Permission whereUpdatedAt($value)
 */
class Permission extends EntrustPermission
{
    //
}
