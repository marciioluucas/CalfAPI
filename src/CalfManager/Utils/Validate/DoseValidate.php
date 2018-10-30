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
        $valida = new Validator($params);
        $valida->rule('required', ['medicamento_id', 'quantidade_mg', 'data']);
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
        $valida = new Validator($params);
        $valida->rule('required', ['medicamento_id', 'doquantidade_mg', 'data']);
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