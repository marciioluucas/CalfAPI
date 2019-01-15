<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 15:55
 */

namespace CalfManager\Utils\Validate;

use Valitron\Validator;

class UsuarioValidate extends Validate
{
    public function validatePost($params)
    {
        $rules = [
//            'required' => ['login','senha','re_senha'],
//            'slug' => ['login', 'senha','re_senha'],
////            'equals' => [['senha', 're-senha']],
//            'different' => [['login','senha']],
//            'lengthMin' => [
//                ['login', 5],
//                ['senha', 8],
//                ['re-senha', 8]
//            ]
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

    }

    public function validatePut($params)
    {

        $valida = new Validator($params);
        $valida->rule('required', ['login', 'senha']);
        if($valida->validate()){
            return true;
        } else {
            $toreturn = $this->filtrarValidacao($valida);
            return $toreturn;
        }
    }

    public function validateDelete($params)
    {
        // TODO: Implement validateDelete() method.
    }

}