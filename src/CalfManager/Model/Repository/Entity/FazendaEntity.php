<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 11/02/2018
 * Time: 17:47
 */

namespace CalfManager\Model\Repository\Entity;

use CalfManager\Model\Usuario;


/**
 * @property string data_alteracao
 * @property string nome
 * @property string data_cadastro
 * @property Usuario usuario_cadastro
 * @property int id
 */
class FazendaEntity extends CalfEntity
{
    protected $table = 'fazendas';
    protected $fillable = [
        'nome',
        'data_criacao',
        'data_alteracao',
        'usuario_cadastro',
        'usuario_alteracao',
        'status'
    ];

    protected $appends = ['quantidade_animais'];


    public function lote(){
        return $this->hasMany('\CalfManager\Model\Repository\Entity\LoteEntity' , 'fazenda_id');
    }

    public function funcionarios() {
        return $this->hasMany(FuncionarioEntity::class,'funcionario_id', 'id');
    }

    public function getQuantidadeAnimaisAttribute()
    {
//        return $this->hasMany(
//            '\CalfManager\Model\Repository\Entity\AnimalEntity',
//            'fazendas_id',
//            'id')
//            ->count();
    }
}