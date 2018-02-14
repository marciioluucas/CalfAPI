<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 00:03
 */

namespace src\model\dao;


use Psr\Http\Message\RequestInterface as Request;
use src\model\IModel;

interface IDAO
{
    public static function create(IModel $obj);

    public static function update(IModel $obj);

    public static function retreaveAll($page);

    public static function delete(IModel $obj);
}