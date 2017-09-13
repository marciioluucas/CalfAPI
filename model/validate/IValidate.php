<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 00:12
 */

namespace model\validate;


interface IValidate
{
    public function validatePost($params);
    public function validateGet($params);
    public function validatePut($params);
    public function validateDelete($params);
}