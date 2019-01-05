<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 12/09/2018
 * Time: 21:22
 */

namespace CalfManager\Utils\Validate;

use Valitron\Validator;

class DoseValidate extends Validate
{
    public function validatePost($params)
    {
        $rules = [];
        $valida = new Validator($params);
        $valida->rules($rules);
        if ($valida->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($valida);
            return $toReturn;
        }
    }

    public function validateGet($params)
    {
    }

    public function validatePut($params)
    {
        $rules = [];
        $valida = new Validator($params);
        $valida->rules($rules);
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