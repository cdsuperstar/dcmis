<?php

namespace App\models;

use Baum\Node;

/**
 * App\models\dcMdGrp
 *
 * @property-read \App\models\dcmodel $dcmodel
 * @property-read \App\models\dcMdGrp $parent
 * @property-read \Baum\Extensions\Eloquent\Collection|\App\models\dcMdGrp[] $children
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node withoutNode($node)
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node withoutSelf()
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node withoutRoot()
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node limitDepth($limit)
 * @mixin \Eloquent
 * @property int $id
 * @property int $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property int $dcmodel_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcMdGrp whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcMdGrp whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcMdGrp whereLft($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcMdGrp whereRgt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcMdGrp whereDepth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcMdGrp whereDcmodelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcMdGrp whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\models\dcMdGrp whereUpdatedAt($value)
 */
class dcMdGrp extends Node
{
    //
    protected $table = 'dcmdgrps';

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

    public function dcmodel()
    {
        return $this->belongsTo('App\models\dcmodel');
    }

}
