<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:35
 */

namespace src\model\validate;


use Valitron\Validator;

class PesagemValidate implements IValidate
{

    public function validatePost($params)
    {
        $v = new Validator($params);
        $v->rule('required', ['peso', 'dataPesagem']);
        $v->rule('integer', 'peso');
        $v->rule('date', 'dataPesagem');
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