<?php

/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 00:10
 */

namespace CalfManager\Utils\Validate;

use Valitron\Validator;

class AnimalValidate extends Validate
{

    public function validatePost($params)
    {
        $rules = [
            'optional' => ['codigo_raca','pai', 'mae','fase_vida'],
            'required' => ['nome','sexo','lote','pesagem','hemograma','data_nascimento', 'codigo_brinco', 'is_vivo', 'is_primogenito'],
            'alpha' => ['nome', 'sexo'],
            'lengthMax' => [['sexo',1]],
            'in' => [
                ['sexo', ['m','f']],
                ['fase_vida', ['RECEM_NASCIDO','BEZERRO','NOVILHO','ADULTO']]
            ],
            'integer' => ['pai', 'mae'],
            'dateFormat' => [
                ['data_nascimento', 'd/m/Y']
            ],
            'numeric' => 'codigo_brinco',
            'alphaNum' => 'codigo_raca',
            'boolean' => ['is_vivo', 'is_primogenito']
        ];
        $v = new Validator($params);
        $v->rules($rules);

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
        $rules = [
            'optional' => ['codigo_raca','pai', 'mae','fase_vida'],
            'required' => ['nome','sexo','lote','pesagem','hemograma','data_nascimento', 'codigo_brinco', 'is_vivo', 'is_primogenito'],
            'alpha' => ['nome', 'sexo'],
            'lengthMax' => [['sexo', 1]],
            'in' => [
                ['sexo', ['m','f']],
                ['fase_vida', ['RECEM_NASCIDO','BEZERRO','NOVILHO','ADULTO']]
            ],
            'integer' => ['pai', 'mae'],
            'dateFormat' => [
                ['data_nascimento', 'd/m/Y']
            ],
            'numeric' => 'codigo_brinco',
            'alphaNum' => 'codigo_raca',
            'boolean' => ['is_vivo', 'is_primogenito']
        ];
        $v = new Validator($params);
        $v->rules($rules);

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
