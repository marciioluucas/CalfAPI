<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 27/08/2018
 * Time: 21:12
 */

namespace CalfManager\Model\Repository\Entity;


class PessoaEntity extends CalfEntity
{
    protected $table = "pessoas";
    protected $fillable = [
        'id',
        'nome',
        'rg',
        'cpf',
        'sexo',
        'numero_telefone',
        'data_nascimento',
        'data_alteracao',
        'data_cadastro',
        'usuario_cadastro',
        'usuario_alteracao',
        'status'
    ];
    public function endereco() {
        return $this->hasMany("\CalfManager\Model\Repository\Entity\EnderecoEntity");
    }
    public function funcionario(){
        return $this->hasMany("CalfManager\Model\Repository\Entity\FuncionarioEntity");
    }
}