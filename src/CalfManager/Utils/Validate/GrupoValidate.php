<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 31/08/2018
 * Time: 08:10
 */

namespace CalfManager\Utils\Validate;

use Valitron\Validator;

class GrupoValidate extends Validate
{
    public function validatePost($params)
    {
        $rules = [
            'required' => ['nome', 'descricao', 'permissao_id'],
            'integer' => 'permissao_id',
            'lengthMin' => [['nome', 4],['descricao', 4]],
            'lengthMax' => [['nome', 25],['descricao', 50]]

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

    public function validateGet($params)
    {
    }

    public function validatePut($params)
    {
        $rules = [
            'required' => ['nome', 'descricao', 'permissao_id'],
            'integer' => 'permissao_id',
            'lengthMin' => [['nome', 4],['descricao', 4]],
            'lengthMax' => [['nome', 25],['descricao', 50]]
        ];
        $valida = new Validator($params);
        $valida->rules($rules);
        if ($valida->validate()) {
            return true;
        } else {
            $toReturn = $this->filtrarValidacao($valida);
            return $toReturn;
        }    }

    public function validateDelete($params)
    {
        // TODO: Implement validateDelete() method.
    }

}