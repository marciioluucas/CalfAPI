<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 15:51
 */

namespace CalfManager\Utils\Validate;

use Valitron\Validator;

class EnderecoValidate extends Validate
{
    public function validatePost($params)
    {
        $rules = [
            'required' => ['logradouro', 'numero', 'bairro', 'cidade', 'estado', 'pais', 'cep'],
            'alpha' => ['estado', 'pais'],
            'length' => [['estado', 2]],
            'lengthMin' => [
                ['logradouro', 4],
                ['numero', 1],
                ['bairro', 2],
                ['cidade', 4],
                ['pais', 3],
                ['cep', 2]
            ],
            'lengthMax' => [
                ['logradouro', 100],
                ['numero', 11],
                ['bairro', 50],
                ['cidade', 50],
                ['pais', 25],
                ['cep', 11]
            ],
            'integer' => 'cep'
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
        $rules = [
            'required' => ['logradouro', 'numero', 'bairro', 'cidade', 'estado', 'pais', 'cep'],
            'alpha' => ['estado', 'pais'],
            'length' => [['estado', 2]],
            'lengthMin' => [
                ['logradouro', 4],
                ['numero', 1],
                ['bairro', 2],
                ['cidade', 4],
                ['pais', 3],
                ['cep', 2]
            ],
            'lengthMax' => [
                ['logradouro', 100],
                ['numero', 11],
                ['bairro', 50],
                ['cidade', 50],
                ['pais', 25],
                ['cep', 11]
            ],
            'integer' => 'cep'
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

    public function validateDelete($params)
    {
        // TODO: Implement validateDelete() method.
    }

}