<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 16/09/17
 * Time: 14:56
 */

namespace model\validate;


use Valitron\Validator;

class CiclosVidaValidate implements IValidate
{
    public function validatePost($params)
    {

        $v = new Validator($params);
        $v->rule('required', ['enumFaseVida', 'enumLocalizacao', 'fkAnimal']);
        $v->rule('integer','fkAnimal');

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