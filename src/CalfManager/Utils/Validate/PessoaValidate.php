<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 15:53
 */

namespace CalfManager\Utils\Validate;

use Valitron\Validator;

class PessoaValidate extends Validate
{
    public function validatePost($params)
    {
        $rules= [
            'required' => ['nome', 'rg', 'cpf', 'sexo', 'numero_telefone', 'data_nascimento', 'endereco_id'],
            'integer' => ['rg', 'cpf','numero_telefone', 'endereco_id'],
            'length' => [
                ['sexo', 1],
                ['cpf', 11],
                ['numero_telefone', 11]
            ],
            'lengthMin' => [
                ['nome', 4],
                ['rg', 5],
            ],
            'lengthMax' => [
                ['nome', 50],
                ['rg', 11],
            ],
            'in' => [
                ['sexo',['m', 'f']]
            ],
            'date' => 'data_nascimento'
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
            'required' => ['nome', 'rg', 'cpf', 'sexo', 'numero_telefone', 'data_nascimento', 'endereco_id'],
            'integer' => ['rg', 'cpf','numero_telefone', 'endereco_id'],
            'length' => [
                ['sexo', 1],
                ['cpf', 11],
                ['numero_telefone', 11]
            ],
            'lengthMin' => [
                ['nome', 50],
                ['rg', 11],
                ['endereco_id', 1]
            ],
            'lengthMax' => [
                ['nome', 4],
                ['rg', 5],
                ['endereco_id', 11]
            ],
            'in' => [
                ['sexo',['m', 'f']]
            ],
            'date' => 'data_nascimento'
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