<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 18:55
 */

namespace CalfManager\Model\Repository\Entity;


/**
 * @property int status
 * @property mixed usuario_cadastro
 * @property string data_cadastro
 * @property mixed descricao
 * @property mixed nome
 */
class CargoEntity extends CalfEntity
{
    protected $table = "cargos";
    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'data_alteracao',
        'data_cadastro',
        'usuario_cadastro',
        'usuario_alteracao',
        'status'
    ];

    public function funcionarios()
    {
        return $this->hasMany("\CalfManager\Model\Repository\Entity\FuncionarioEntity");
    }
}