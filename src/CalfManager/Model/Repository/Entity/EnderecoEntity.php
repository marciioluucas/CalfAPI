<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 27/08/2018
 * Time: 21:17
 */

namespace CalfManager\Model\Repository\Entity;


/**
 * @property mixed id
 * @property int status
 * @property mixed usuario_cadastro
 * @property string data_cadastro
 * @property mixed cep
 * @property mixed pais
 * @property mixed estado
 * @property mixed cidade
 * @property mixed bairro
 * @property mixed numero
 * @property mixed logradouro
 */
class EnderecoEntity extends CalfEntity
{
    protected $table = "enderecos";
    protected $fillable = [
        'id',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'pais',
        'cep',
        'data_alteracao',
        'data_cadastro',
        'usuario_alteracao',
        'usuario_cadastro',
        'status'
    ];
    public function pessoas() {
        return $this->hasMany("\CalfManager\Model\Repository\Entity\PessoaEntity");
    }
}