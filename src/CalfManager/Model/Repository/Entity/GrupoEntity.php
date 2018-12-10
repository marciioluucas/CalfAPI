<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 30/08/2018
 * Time: 22:39
 */

namespace CalfManager\Model\Repository\Entity;


/**
 * @property mixed id
 * @property int status
 * @property mixed usuario_cadastro
 * @property string data_cadastro
 * @property mixed permissao_id
 * @property mixed descricao
 * @property mixed nome
 */
class GrupoEntity extends CalfEntity
{
    protected $table = "grupos";
    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'permissao_id',
        'data_cadastro',
        'data_alteracao',
        'usuario_cadastro',
        'usuario_alteracao',
        'status'
    ];
    public function permissao(){
        return $this->belongsTo("CalfManager\Model\Repository\Entity\PermissaoEntity", "permissao_id");
    }
    public function usuario(){
        return $this->hasMany("CaldManager\Model\Repository\Entity\UsuarioEntity");
    }
}