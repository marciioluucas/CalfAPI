<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 15:54
 */

namespace CalfManager\Utils\Validate;

use Valitron\Validator;
class FuncionarioValidate extends Validate
{
    public function validatePost($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['pessoa', 'usuario','cargo','fazenda', 'salario']);
        if($valida->validate()){
            return true;
        } else {
            $toreturn = $this->filtrarValidacao($valida);
            return $toreturn;
        }
    }

    public function validateGet($params)
    {
        // TODO: Implement validateGet() method.
    }

    public function validatePut($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['pessoa', 'usuario','cargo', 'pessoa','fazenda' ,'salario']);
        if($valida->validate()){
            return true;
        } else {
            $toreturn = $this->filtrarValidacao($valida);
            return $toreturn;
        }    }

    public function validateDelete($params)
    {
        // TODO: Implement validateDelete() method.
    }

}