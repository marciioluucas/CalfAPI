<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 28/08/2018
 * Time: 22:11
 */

namespace CalfManager\Model\Repository\Entity;


/**
 * Class HemogramaEntity
 * @property mixed id
 * @property int status
 * @property mixed usuario_cadastro
 * @property string data_cadastro
 * @property  int animal_id
 * @property mixed hematocrito
 * @property mixed ppt
 * @property mixed data
 * @package CalfManager\Model\Repository\Entity
 */
class HemogramaEntity extends CalfEntity
{
    protected $table = "hemogramas";
    protected $fillable = [
        'id',
        'animal_id',
        'funcionario_id',
        'data',
        'ppt',
        'hematocrito',
        'data_alteracao',
        'data_cadastro',
        'usuario_alteracao',
        'usuario_cadastro',
        'status'
    ];
    protected $casts = [
        'data' => 'date:d/m/Y'
    ];

    public function animal()
    {
        return $this->belongsTo('CalfManager\Model\Repository\Entity\AnimalEntity', 'animal_id');
    }
}