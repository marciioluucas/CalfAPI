<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 30/08/2018
 * Time: 22:27
 */

namespace CalfManager\Utils\Validate;

use Valitron\Validator;

class PermissaoValidade extends Validate
{
    public function validatePost($params)
    {
        $rules = [
            'required' => ['nome_modulo', 'create', 'read', 'update', 'delete'],
            'lengthMin' => [['nome_modulo', 4]],
            'lengthMax' => [['nome_modulo', 25]],
            'in' => [
                ['create',['0','1']],
                ['read',['0','1']],
                ['update',['0','1']],
                ['delete',['0','1']]
            ]
        ];
        $valida = new Validator($params);
        $valida->rules($rules);
        if ($valida->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($valida);
            return $toReturn;
        }    }

    public function validateGet($params)
    {

    }


    public function validatePut($params)
    {
        $rules = [
            'required' => ['nome_modulo', 'create', 'read', 'update', 'delete'],
            'lengthMin' => [['nome_modulo', 4]],
            'lengthMax' => [['nome_modulo', 25]],
            'in' => [
                ['create',['0','1']],
                ['read',['0','1']],
                ['update',['0','1']],
                ['delete',['0','1']]
            ]
        ];
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