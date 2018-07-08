<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:07
 */

namespace CalfManager\Utils\validate;


use Valitron\Validator;

class LoteValidate extends Validate
{

    public function validatePost($params)
    {
        $v = new Validator($params);
        $v->rule('required', ['codigo']);
        if ($v->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($v);
            return $toReturn;
        }
    }

    public function validateGet($params)
    {
        $v = new Validator($params);
        $v->rule('required', ['id']);
        $v->rule('required', ['codigo']);
        if ($v->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($v);
            return $toReturn;
        }
    }

    public function validatePut($params)
    {
        $v = new Validator($params);
        $v->rule('required', ['id']);
        $v->rule('required', ['codigo']);
        if ($v->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($v);
            return $toReturn;
        }
    }

    public function validateDelete($params)
    {
        // TODO: Implement validateDelete() method.
    }
}