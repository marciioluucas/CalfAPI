<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 19:04
 */

namespace CalfManager\Model\Repository\Entity;


class FuncionarioEntity extends CalfEntity
{
    protected $table = "funcionarios";
    protected $fillable = [
        'id',
        'salario',
        'cargo_id',
        'pessoa_id',
        'usuario_id',
        'fazenda_id',
        'data_alteracao',
        'data_cadastro',
        'usuario_alteracao',
        'usuario_cadastro',
        'status'

    ];
    public function cargo() {
        return $this->belongsTo("\CalfManager\Model\Repository\Entity\CargoEntity", "cargo_id");
    }

    public function usuario() {
        return $this->hasOne("\CalfManager\Model\Repository\Entity\UsuarioEntity", "usuario_id");
    }
    public function fazenda(){
        return $this->belongsTo("CalfManager\Model\Repository\Entity\FazendaEntity", "fazenda_id");
    }
    public function pessoa(){
        return $this->belongsTo("CalfManager\Model\Repository\Entity\PessoaEntity", "pessoa_id");
    }
}