<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;

/**
 * App\models\unitgrp
 *
 * @property-read \Baum\Extensions\Eloquent\Collection|\App\models\unitgrp[] $children
 * @property-read \App\models\unitgrp $parent
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node limitDepth($limit)
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node withoutNode($node)
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node withoutRoot()
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node withoutSelf()
 * @mixin \Eloquent
 * @property int $id
 * @property int $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $name
 * @property string $brief
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\models\unitgrp whereBrief($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\unitgrp whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\unitgrp whereDepth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\unitgrp whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\unitgrp whereLft($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\unitgrp whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\unitgrp whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\unitgrp whereRgt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\unitgrp whereUpdatedAt($value)
 */
class unitgrp extends Node
{
    //
    protected $table = 'unitgrps';

    // 'parent_id' column name
    protected $parentColumn = 'parent_id';

    // 'lft' column name
    protected $leftColumn = 'lft';

    // 'rgt' column name
    protected $rightColumn = 'rgt';

    // 'depth' column name
    protected $depthColumn = 'depth';

    // guard attributes from mass-assignment
    protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

    protected $fillable = ['name',  'brief'];

    public function users()
    {
        return $this->belongsToMany('App\User','unitgrp_user','unitgrp_id');
    }
}
