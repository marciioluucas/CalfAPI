<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 22/02/2018
 * Time: 11:21
 */

namespace src\model\repository\entities;


class DoencaEntity extends CalfEntity
{
    protected $table = 'doencas';
    protected $fillable = [
        'nome',
        'descricao',
        'situacao',
        'data_criacao',
        'data_alteracao',
        'usuario_cadastro',
        'usuario_alteracao'
    ];
    public function animais() {
        return $this->belongsToMany('src\model\repository\entities\AnimalEntity',
            'animais_has_doencas', 'doencas_id','animais_id');
    }
}