<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 00:12
 */

namespace CalfManager\Utils\Validate;

use Valitron\Validator;

abstract class Validate implements IValidate
{
    public function filtrarValidacao(Validator $validator)
    {
        $data = [];
        foreach ($validator->errors() as $key => $value) {
            array_push($data, $value);
        }
        $toReturn = [];
        $conn = 0;
        for ($i = 0; $i < count($data); $i++) {
            for ($j = 0; $j < count($data[$i]); $j++) {
                $toReturn[$conn] = $data[$i][$j];
                $conn++;
            }
        }
        return $toReturn;
    }
}
