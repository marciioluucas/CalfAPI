<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/02/2018
 * Time: 09:37
 */

namespace src\model\repository\entities;


class LoteEntity extends CalfEntity
{
    protected $table = 'lotes';
    protected $fillable = [
        'codigo',
        'data_alteracao',
        'data_cadastro',
        'usuario_cadastro',
        'usuario_alteracao',
        'status',
    ];

    public function animais() {
        return $this->hasMany('\src\model\repository\entities\AnimalEntity');
    }
}