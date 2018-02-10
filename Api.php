<?php
require 'vendor/autoload.php';
require 'src/util/config.php';

use src\util\Database;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\RequestInterface as Request;

new Database();
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$app->group('/{classname}', function () use ($app) {

    $app->get('', function (Request $request, Response $response, array $args) {
        $class = invokeClass($args['classname'], $request, $response);
        return $class->get($request, $response, $args);
    });

    $app->get('/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
        $class = invokeClass($args['classname'], $request, $response);
        return $class->get($request, $response, $args);
    });
    $app->get('/{nome:[A-Za-z]+}', function (Request $request, Response $response, array $args) {
        $class = invokeClass($args['classname'], $request, $response);
        return $class->get($request, $response, $args);
    });
    $app->get('/{filtro:[A-Za-z]+}/{valor:[A-Za-z0-9_.]+}', function (Request $request, Response $response, array $args) {
        $class = invokeClass($args['classname'], $request, $response);
        return $class->get($request, $response, $args);
    });

    $app->post('', function (Request $request, Response $response, array $args) {
        $name = $args['classname'];
        $response->getBody()->write("Hello, $name");

        return $response;
    });

    $app->put('/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
        $name = $args['classname'];
        $response->getBody()->write("Hello, $name");

        return $response;
    });
    $app->delete('/{id}', function (Request $request, Response $response, array $args) {
        $name = $args['classname'];
        $response->getBody()->write("Hello, $name");

        return $response;
    });
});

/**
 * @param String $classname
 * @param Response $response
 * @param array $args
 * @return src\controller\IController | Response
 */
function invokeClass(String $classname, Request $request, Response $response)
{
    $class = "\\src\\controller\\" . ucfirst($classname) . "Controller";
    if (!class_exists($class)) {
        return $response->withStatus(404, "Modulo nao registrado na API");
    }
    return new $class($request, $response);
}

try {
    $app->run();
} catch (\Slim\Exception\MethodNotAllowedException $e) {
} catch (\Slim\Exception\NotFoundException $e) {
} catch (Exception $e) {
}
