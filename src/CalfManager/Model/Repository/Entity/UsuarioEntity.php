<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 31/08/2018
 * Time: 16:09
 */

namespace CalfManager\Model\Repository\Entity;


/**
 * @property mixed id
 * @property int status
 * @property string data_cadastro
 * @property mixed usuario_cadastro
 * @property mixed grupo_id
 * @property null|string senha
 * @property null|string login
 */
class UsuarioEntity extends CalfEntity
{
    protected $table = "usuarios";
    protected $fillable = [
        'id',
        'login',
        'senha',
        'grupo_id',
        'data_alteracao',
        'data_cadastro',
        'usuario_cadastro',
        'usuario_alteracao',
        'status'
    ];

    public function grupo() {
        return $this->belongsTo("CalfManager\Model\Repository\Entity\GrupoEntity", "grupo_id");
    }

    public function funcionario() {
        return $this->hasOne(FuncionarioEntity::class,'usuario_id', 'id');
    }

}