<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 28/08/2018
 * Time: 22:11
 */

namespace CalfManager\Model\Repository\Entity;


class HemogramaEntity extends CalfEntity
{
    protected $table = "hemogramas";
    protected $fillable = [
        'id',
        'data_exame',
        'teste_ppt',
        'teste_hematocrito',
        'data_alteracao',
        'data_cadastro',
        'usuario_alteracao',
        'usuario_cadastro',
        'status'
    ];
    public function laboratorio() {
        return $this->hasMany('CalfManager\Model\Repository\Entity\LaboratorioEntity');
    }
}