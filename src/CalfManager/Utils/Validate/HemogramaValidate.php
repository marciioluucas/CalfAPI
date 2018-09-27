<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 29/08/2018
 * Time: 17:03
 */

namespace CalfManager\Utils\Validate;
use Valitron\Validator;

class HemogramaValidate extends Validate
{
    public function validatePost($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['ppt', 'hematocrito']);
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
        $valida->rule('required', ['id','ppt', 'hematocrito']);
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
        $valida->rule('required', ['id','ppt', 'hematocrito']);
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