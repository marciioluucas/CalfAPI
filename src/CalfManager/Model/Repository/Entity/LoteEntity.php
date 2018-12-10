<?php

namespace CalfManager\Model\Repository\Entity;
use CalfManager\Model\Usuario;


/**
 * @property int|string codigo
 * @property  string data_alteracao
 * @property  string data_cadastro
 * @property  Usuario usuario_cadastro
 * @property mixed fazenda_id
 */
class LoteEntity extends CalfEntity
{
    protected $table = 'lotes';
    protected $fillable = [
        'codigo',
        'fazenda_id',
        'data_alteracao',
        'data_cadastro',
        'usuario_cadastro',
        'usuario_alteracao',
        'status',
    ];

    public function animais() {
        return $this->hasMany('\CalfManager\Model\Repository\Entity\AnimalEntity');
    }
    public function fazenda(){
        return $this->belongsTo('\CalfManager\Model\Repository\Entity\FazendaEntity', 'fazenda_id');
    }
}