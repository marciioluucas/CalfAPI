<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 30/08/2018
 * Time: 22:32
 */

namespace CalfManager\Model\Repository\Entity;


/**
 * @property mixed id
 * @property int status
 * @property mixed usuario_cadastro
 * @property string data_cadastro
 * @property mixed delete
 * @property mixed update
 * @property mixed read
 * @property mixed create
 * @property mixed nome_modulo
 */
class PermissaoEntity extends CalfEntity
{
    protected $table = "permissoes";
    protected $fillable = [
        'id',
        'nome_modulo',
        'create',
        'read',
        'update',
        'delete',
        'data_alteracao',
        'data_cadastro',
        'usuario_alteracao',
        'usuario_cadastro',
        'status'
    ];

}