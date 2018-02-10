<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2017
 * Time: 18:02
 */

namespace src\controller;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\RequestInterface as Request;


interface IController
{
    public function post(Request $request, Response $response);

    public function get(Request $request, Response $response, array $args);

    public function put(Request $request, Response $response);

    public function delete(Request $request, Response $response);
}