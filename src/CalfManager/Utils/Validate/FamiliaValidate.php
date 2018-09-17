<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 31/08/2018
 * Time: 10:24
 */

namespace CalfManager\Utils\Validate;


class FamiliaValidate implements IValidate
{
    public function validatePost($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['pai_id', 'mae_id', 'filho_id']);
        if ($valida->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($valida);
            return $toReturn;
        }
    }

    public function validateGet($params)
    {

    }

    public function validatePut($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['id', 'pai_id', 'mae_id', 'filho_id']);
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