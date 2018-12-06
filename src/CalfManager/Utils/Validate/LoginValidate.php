<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 05/12/2018
 * Time: 19:30
 */

namespace CalfManager\Utils\Validate;


use Valitron\Validator;

class LoginValidate extends Validate
{
    public function validatePost($params)
    {
        $rules = [
//            'required' => ['login','senha'],
//            'slug' => ['login', 'senha'],
////            'equals' => [['senha', 're-senha']],
//            'different' => [['login','senha']],
//            'lengthMin' => [
//                ['login', 5],
//                ['senha', 8]
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
        // TODO: Implement validateGet() method.
    }

    public function validatePut($params)
    {
        // TODO: Implement validatePut() method.
    }

    public function validateDelete($params)
    {
        // TODO: Implement validateDelete() method.
    }

}