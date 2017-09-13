<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:35
 */

namespace model\validate;


use Valitron\Validator;

class PesagemValidate implements IValidate
{

    public function validatePost($params)
    {
        $v = new Validator($params);
        $v->rule('required', ['peso','data']);
        $v->rule('integer','peso');
        $v->rule('date', 'data');
        if ($v->validate()) {
            return true;
        } else {
            // Errors
            return $v->errors();
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