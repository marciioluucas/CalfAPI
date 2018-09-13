<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 12/09/2018
 * Time: 20:17
 */

namespace CalfManager\Utils\Validate;


class LaboratorioValidate implements IValidate
{
    public function validatePost($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['data_entrada', 'animal_id', 'hemograma_id']);
        if ($valida->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($valida);
            return $toReturn;
        }
    }

    public function validateGet($params)
    {
        // TODO: Implement validateGet() method.
    }

    public function validatePut($params)
    {
        $valida = new Validator($params);
        $valida->rule('required', ['id','data_entrada', 'animal_id', 'hemograma_id']);
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