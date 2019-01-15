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
        $rules = [
            'required' => ['pessoa_id','cargo_id','fazenda_id', 'salario'],
            'integer' => ['pessoa_id','cargo_id','fazenda_id'],
            'numeric' => 'salario'
        ];
        $valida = new Validator($params);
        $valida->rules($rules);
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
        $rules = [
            'required' => ['pessoa_id','cargo_id','fazenda_id', 'salario'],
            'integer' => ['pessoa_id','cargo_id','fazenda_id'],
            'numeric' => 'salario'
        ];
        $valida = new Validator($params);
        $valida->rules($rules);
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