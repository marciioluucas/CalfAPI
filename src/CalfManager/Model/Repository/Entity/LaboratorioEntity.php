<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 28/08/2018
 * Time: 21:59
 */

namespace CalfManager\Model\Repository\Entity;


class LaboratorioEntity extends CalfEntity
{
    protected $table = "laboratorios";
    protected $fillable = [
        'id',
        'animal_id',
        'dose_aplicada_id',
        'hemograma_id',
        'data_entrada',
        'data_saida',
        'data_criacao',
        'data_alteracao',
        'usuario_cadastro',
        'usuario_alteracao',
        'status'
    ];

    public function animal(){
        return $this->belongsTo('CalfManager\Model\Repository\Entity\AnimalEntity', 'animal_id');
    }
    public function doseAplicada(){
        return $this->belongsTo('CalfManager\Model\Repository\Entity\MedicamentoEntity', 'medicamento_id');
    }
    public function hemograma(){
        return $this->belongsTo('CalfManager\Model\Repository\Entity\HemogramaEntity', 'hemograma_id');
    }

}