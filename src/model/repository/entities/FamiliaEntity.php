<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/03/2018
 * Time: 17:50
 */

namespace src\model\repository\entities;


class FamiliaEntity extends CalfEntity
{
    protected $table = 'familias';
    protected $fillable = [
        'pai_id',
        'mae_id',
        'filho_id'
    ];

    public function pai()
    {
        return $this->belongsTo('src\model\repository\entities\AnimalEntity', 'pai_id');
    }

    public function mae()
    {
        return $this->belongsTo('src\model\repository\entities\AnimalEntity', 'mae_id');
    }

    public function filho()
    {
        return $this->belongsTo('src\model\repository\entities\AnimalEntity', 'filho_id');
    }

}