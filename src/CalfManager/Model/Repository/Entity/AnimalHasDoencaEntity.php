<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 02/07/2018
 * Time: 23:07
 */

namespace CalfManager\Model\Repository\Entity;


/**
 * @property  string situacao
 * @property  string data_adoecimento
 * @property  int doencas_id
 * @property  int animais_id
 */
class AnimalHasDoencaEntity extends CalfEntity
{
    protected $table = 'animais_has_doencas';
    protected $fillable = [
        'animais_id',
        'doencas_id',
        'situacao',
        'data_cura',
        'data_adoecimento'
    ];
    protected $casts = [
        'data_cura' => 'date:d/m/Y',
        'data_adoecimento' => 'date:d/m/Y'
    ];


}