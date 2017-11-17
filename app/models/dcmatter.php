<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\models\dcmatter
 *
 * @property int $id
 * @property int $suser_id
 * @property int $ruser_id
 * @property string $title
 * @property string|null $content
 * @property string $enddate
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\User $rusers
 * @property-read \App\User $susers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\dcmatter whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\dcmatter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\dcmatter whereEnddate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\dcmatter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\dcmatter whereRuserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\dcmatter whereSuserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\dcmatter whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\dcmatter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class dcmatter extends Model
{
    //
    protected $table = 'dcmatters';
    protected $fillable = ['suser_id','ruser_id','title','content','enddate'];

    public function susers(){
        return $this->belongsTo('App\User','suser_id');
    }
    public function rusers(){
        return $this->belongsTo('App\User','ruser_id');
    }

}
