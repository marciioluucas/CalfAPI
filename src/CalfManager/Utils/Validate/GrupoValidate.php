<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 31/08/2018
 * Time: 08:10
 */

namespace CalfManager\Utils\Validate;

use Valitron\Validator;

class GrupoValidate extends Validate
{
    public function validatePost($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['nome', 'descricao']);
        if ($valida->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($valida);
            return $toReturn;
        }
    }

    public function validateGet($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['nome']);
        if ($valida->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($valida);
            return $toReturn;
        }    }

    public function validatePut($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['id', 'nome', 'descricao']);
        if ($valida->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($valida);
            return $toReturn;
        }    }

    public function validateDelete($params)
    {
        // TODO: Implement validateDelete() method.
    }

}