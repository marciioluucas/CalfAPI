<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 08/02/2018
 * Time: 16:09
 */

namespace src\model\entities;


class AnimalEntity extends CalfEntity
{
    protected $table = "animais";
    protected $fillable = ['id','nome','data_nascimento','primogenito','codigo_brinco','codigo_raca',
        'status', 'data_alteracao', 'data_cadastro', 'usuario_cadastro', 'usuario_alteracao',
        'fazendas_id', 'lotes_id'];

    public function fazenda() {
        return $this->belongsTo('src\model\entities\FazendaEntity', 'fazendas_id');
    }

    public function pesagens() {
        return $this->hasMany('src\model\entities\PesagemEntity','animais_id', 'id');
    }

    public function scopeAtivo($query) {
        return $query->where('status',1);
    }
}