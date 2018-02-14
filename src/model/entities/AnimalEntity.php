<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 08/02/2018
 * Time: 16:09
 */

namespace src\model\entities;


use Illuminate\Database\Eloquent\Model;

class AnimalEntity extends Model
{
    protected $table = "animais";
    protected $fillable = ['nome','data_nascimento','primogenito','codigo_brinco','codigo_raca',
        'status', 'data_alteracao', 'data_cadastro', 'usuario_cadastro', 'usuario_alteracao',
        'fazendas_id', 'lotes_id'];
    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_alteracao';

    public function fazenda() {
        return $this->belongsTo('src\model\entities\FazendaEntity', 'fazendas_id');
    }

    public function scopeAtivo($query) {
        return $query->where('status',1);
    }
}