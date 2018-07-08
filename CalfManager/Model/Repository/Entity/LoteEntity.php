<?php

namespace CalfManager\Model\Repository\entities;
use CalfManager\Model\Usuario;


/**
 * @property int|string codigo
 * @property  string data_alteracao
 * @property  string data_cadastro
 * @property  Usuario usuario_cadastro
 */
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
        return $this->hasMany('\CalfManager\Model\Repository\Entity\AnimalEntity');
    }
}