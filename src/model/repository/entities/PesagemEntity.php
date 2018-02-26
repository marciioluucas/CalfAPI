<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 15/02/2018
 * Time: 15:47
 */

namespace src\model\repository\entities;


class PesagemEntity extends CalfEntity
{
    protected $table = 'pesagens';
    protected $fillable =[
        'data_pesagem',
        'peso',
        'usuario_cadastro',
        'usuario_alteracao',
        'status',
        'animais_id'
    ];


    public function animal() {
        return $this->belongsTo('src\model\repository\entities\AnimalEntity', 'animais_id');
    }
}