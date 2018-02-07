<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2017
 * Time: 18:02
 */

namespace controller;
use \Psr\Http\Message\ResponseInterface as Response;


interface IController
{
    public function post(Response $response);

    public function get($request, $response);

    public function put(Response $response,$param);

    public function delete(Response $response,$param);
}