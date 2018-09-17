<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 31/08/2018
 * Time: 16:09
 */

namespace CalfManager\Model\Repository\Entity;


class UsuarioEntity extends CalfEntity
{
    protected $table = "usuarios";
    protected $fillable = [
        'id',
        'login',
        'senha',
        'grupo_id'
    ];

    public function grupo(){
        return $this->belongsTo("CalfManager\Model\Repository\Entity\GrupoEntity", "grupo_id");
    }

}