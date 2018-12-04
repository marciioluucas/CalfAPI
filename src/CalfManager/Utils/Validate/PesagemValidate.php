<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:35
 */

namespace CalfManager\Utils\Validate;

use Valitron\Validator;

class PesagemValidate extends Validate
{

    public function validatePost($params)
    {
        $rules = [
            'required'=> ['peso', 'data_pesagem', 'animais_id'],
            'numeric' => 'peso',
            'dateFormat' => [['data_pesagem', 'd/m/Y']],
            'integer' => 'animais_id',
            'lengthMin' => [['peso', 1]],
            'lengthMax' => [['peso', 11]]
        ];
        $v = new Validator($params);
        $v->rules($rules);
        if ($v->validate()) {
            return true;
        } else {
            $data = "";
            foreach ($v->errors() as $key => $value) {
                $data .= implode(',', $value);
            }
            return ["codigo" => 401,
                "mensagem" => $data];
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