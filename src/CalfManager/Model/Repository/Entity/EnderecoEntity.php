<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 27/08/2018
 * Time: 21:17
 */

namespace CalfManager\Model\Repository\Entity;


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