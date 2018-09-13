<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 30/08/2018
 * Time: 22:39
 */

namespace CalfManager\Model\Repository\Entity;


class GrupoEntity extends CalfEntity
{
    protected $table = "grupos";
    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'data_cadastro',
        'data_alteracao',
        'usuario_cadastro',
        'usuario_alteracao',
        'status'
    ];
    public function permissao(){
        return $this->hasMany("CalfManager\Model\Repository\Entity\PermissaoEntity");
    }
    public function usuario(){
        return $this->hasMany("CaldManager\Model\Repository\Entity\UsuarioEntity");
    }
}