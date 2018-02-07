<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [

        'displayErrorDetails' => true,

        'db' => [

            'driver' => 'mysql',

            'host' => 'localhost',

            'database' => 'test',

            'username' => 'root',

            'password' => '',

            'charset' => 'utf8',

            'collation' => 'utf8_unicode_ci',
        ]
    ],
]);
$app->get('/', '\\controller\\AnimalController:get');
//$app->group('/{classname}', function () use ($app) {
//
//
//
//    $app->get('/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
//        $name = $args['classname'];
//
//        $response->getBody()->write("Hello, $name, seu id é " . $request->getAttribute("id"));
//
//        return $response;
//    });
//
//    $app->post('/', function (Request $request, Response $response, array $args) {
//        $name = $args['classname'];
//        $response->getBody()->write("Hello, $name");
//
//        return $response;
//    });
//
//    $app->put('/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
//        $name = $args['classname'];
//        $response->getBody()->write("Hello, $name");
//
//        return $response;
//    });
//    $app->delete('/{id}', function (Request $request, Response $response, array $args) {
//        $name = $args['classname'];
//        $response->getBody()->write("Hello, $name");
//
//        return $response;
//    });
//});
//
///**
// * @param String $classname
// * @param Response $response
// * @param array $args
// * @return \controller\IController | Response
// */
//function invokeClass(String $classname, Response $response, array $args = []) {
//    $class = "\\controller\\" . ucfirst($classname) . "Controller";
//    if (!class_exists($class)) {
//        return $response->withStatus(404,"Modulo nao registrado na API");
//    }
//    return new $class($response, $args);
//}
try {
    $app->run();
} catch (\Slim\Exception\MethodNotAllowedException $e) {
} catch (\Slim\Exception\NotFoundException $e) {
} catch (Exception $e) {
}
