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


}
