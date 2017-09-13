<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 11:49
 */

namespace model\validate;

use Valitron\Validator;
class FazendaValidate implements IValidate
{

    public function validatePost($params)
    {
        $v = new Validator($params);
        $v->rule('required', ['nome']);
        $v->rule('lengthMin','nome',4);
        $v->rule('lengthMax','nome',100);
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