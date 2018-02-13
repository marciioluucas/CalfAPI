<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 00:03
 */

namespace src\model\dao;


use Psr\Http\Message\RequestInterface as Request;

interface IDAO
{
    public static function create(Request $request);

    public static function update(Request $request);

    public static function retreaveAll($page);

    public static function delete(Request $request);
}