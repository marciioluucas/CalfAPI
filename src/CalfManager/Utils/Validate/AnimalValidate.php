<?php

/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 00:10
 */

namespace CalfManager\Utils\validate;

use Valitron\Validator;

class AnimalValidate extends Validate
{

    public function validatePost($params)
    {
        $v = new Validator($params);
        $v->rule('required', ['data_nascimento', 'codigo_raca', 'codigo_brinco']);
        if ($v->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($v);
            return $toReturn;
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
