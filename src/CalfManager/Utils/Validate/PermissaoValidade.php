<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 30/08/2018
 * Time: 22:27
 */

namespace CalfManager\Utils\Validate;


class PermissaoValidade implements IValidate
{
    public function validatePost($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['nome_modulo', 'create', 'read', 'update', 'delete']);
        if ($valida->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($valida);
            return $toReturn;
        }    }

    public function validateGet($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['nome_modulo']);
        if ($valida->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($valida);
            return $toReturn;
        }
    }


    public function validatePut($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['id','nome_modulo', 'create', 'read', 'update', 'delete']);
        if ($valida->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($valida);
            return $toReturn;
        }
    }

    public function validateDelete($params)
    {
        // TODO: Implement validateDelete() method.
    }

}