<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 10/09/2018
 * Time: 21:46
 */

namespace CalfManager\Model\Repository\Entity;


class DoseAplicadaEntity extends CalfEntity
{
    protected $table = "doses_aplicadas";
    protected $fillable = [
        'id',
        'medicamento_id',
        'dose',
        'data_aplicacao',
        'data_criacao',
        'data_alteracao',
        'usuario_cadastro',
        'usuario_alteracao',
        'status'
    ];
    public function medicamento(){
        return $this->belongsTo("CalfManager\Model\Repository\Entity\MedicamentoEntity", "medicamento_id");
    }
}