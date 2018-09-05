<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 30/08/2018
 * Time: 22:32
 */

namespace CalfManager\Model\Repository\Entity;


class PermissaoEntity extends CalfEntity
{
    protected $table = "permissoes";
    protected $fillable = [
        "id",
        "nome_modulo",
        "create",
        "read",
        "update",
        "delete",
        "grupo_id"
    ];
    public function grupo(){
        return $this->belongsTo("CalfManager\Model\Repository\Entity\GrupoEntity", "grupo_id");
    }
}