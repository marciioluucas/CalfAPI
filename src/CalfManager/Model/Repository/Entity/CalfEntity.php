<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 14/02/2018
 * Time: 17:09
 */

namespace CalfManager\Model\Repository\Entity;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class CalfEntity extends Model
{
    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_alteracao';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';


    public function scopeAtivo(Builder $query)
    {
        return $query->where('status', 1);
    }

    public function scopeInativo(Builder $query) {
        return $query->where('status', 0);
    }

    public function scopeFeitoPeloUsuario(Builder $query, int $idUsuario) {
        return $query->where('usuario_cadastro', $idUsuario);
    }
}