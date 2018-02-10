<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:07
 */

namespace src\model\validate;


use Valitron\Validator;

class LoteValidate implements IValidate
{

    public function validatePost($params)
    {
        $v = new Validator($params);
        $v->rule('required', ['codigoLote']);
        $v->rule('integer','codigoLote');
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
        $v = new Validator($params);
        $v->rule('required', ['idLote']);
        $v->rule('integer','idLote');
        if ($v->validate()) {
            return true;
        } else {
            // Errors
            return $v->errors();
        }
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