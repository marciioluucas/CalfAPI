<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/03/2018
 * Time: 17:50
 */

namespace CalfManager\Model\Repository\Entity;


/**
 * @property int|null mae_id
 * @property int|null pai_id
 * @property int|null filho_id
 * @property int id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class FamiliaEntity extends CalfEntity
{
    protected $table = 'familias';
    protected $fillable = [
        'pai_id',
        'mae_id',
        'filho_id',
        'status',
    ];

    public function pai()
    {
        return $this->belongsTo('CalfManager\Model\Repository\Entity\AnimalEntity', 'pai_id');
    }

    public function mae()
    {
        return $this->belongsTo('CalfManager\Model\Repository\Entity\AnimalEntity', 'mae_id');
    }

    public function filho()
    {
        return $this->belongsTo('CalfManager\Model\Repository\Entity\AnimalEntity', 'filho_id');
    }

}