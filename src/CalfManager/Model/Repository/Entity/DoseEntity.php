<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 10/09/2018
 * Time: 21:46
 */

namespace CalfManager\Model\Repository\Entity;


/**
 * @property mixed id
 * @property mixed medicamento_id
 * @property mixed data
 * @property mixed quantidade_mg
 * @property mixed usuario_alteracao
 * @property string data_alteracao
 * @property int status
 * @property mixed usuario_cadastro
 * @property string data_cadastro
 * @property mixed funcionario_id
 * @property mixed animal_id
 */
class DoseEntity extends CalfEntity
{
    protected $table = "doses";
    protected $fillable = [
        'id',
        'animal_id',
        'medicamento_id',
        'funcionario_id',
        'quantidade_mg',
        'quantidade_unidade',
        'tipo_movimentacao',
        'data',
        'data_criacao',
        'data_alteracao',
        'usuario_cadastro',
        'usuario_alteracao',
        'status'
    ];
    protected $casts = [
        'data' => 'date:d/m/Y',
        'quantidade_mg' => 'double'
    ];
    public function animal(){
        return $this->belongsTo("CalfManager\Model\Repository\Entity\AnimalEntity", "animal_id");
    }
    public function medicamento(){
        return $this->belongsTo("CalfManager\Model\Repository\Entity\MedicamentoEntity", "medicamento_id");
    }

    public function funcionario(){
        return $this->belongsTo("CalfManager\Model\Repository\Entity\FuncionarioEntity", "funcionario_id");
    }
}