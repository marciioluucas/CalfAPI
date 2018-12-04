<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 11:49
 */

namespace CalfManager\Utils\Validate;

use Valitron\Validator;
class FazendaValidate extends Validate
{

    public function validatePost($params)
    {
        $rules = [
            'required'=> ['nome'],
            'lengthMin' => [['nome',4]],
            'lengthMax' => [['nome',30]]
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
            'required'=> ['nome'],
            'lengthMin' => [['nome',4]],
            'lengthMax' => [['nome',30]]
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