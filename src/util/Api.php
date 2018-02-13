<?php

namespace src\util;

use Exception;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\RequestInterface as Request;
use Slim\App;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use src\controller\IController;

class Api
{

    private $app;

    /**
     * Api constructor.
     */
    public function __construct()
    {
        $this->app = new App(SLIM_CONTAINER);
    }

    public function getDatabase()
    {
        new Database();
    }

    /**
     * return IController
     */
    public function groupRoutes()
    {
        $app = $this->app;

        $app->group('/{classname}', function () use ($app) {
            $app->get('', function (Request $request, Response $response, array $args) {
                $class = Api::invokeClass($args['classname'], $request, $response);
                return $class->get($request, $response, $args);
            });

            $app->get('/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
                $class = Api::invokeClass($args['classname'], $request, $response);
                return $class->get($request, $response, $args);
            });
            $app->get('/{nome:[A-Za-z]+}', function (Request $request, Response $response, array $args) {
                $class = Api::invokeClass($args['classname'], $request, $response);
                return $class->get($request, $response, $args);
            });
            $app->get('/{filtro:[A-Za-z]+}/{valor:[A-Za-z0-9_.]+}', function (Request $request, Response $response, array $args) {
                $class = Api::invokeClass($args['classname'], $request, $response);
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
            $app->delete('/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
                $name = $args['classname'];
                $response->getBody()->write("Hello, $name");

                return $response;
            });
        });
    }

    /**
     * @param String $classname
     * @param Request $request
     * @param Response $response
     * @return IController | Response
     */
    public static function invokeClass(String $classname, Request $request, Response $response)
    {
        $class = "\\src\\controller\\" . ucfirst($classname) . "Controller";
        if (!class_exists($class)) {
            return $response->withStatus(404, "Modulo nao registrado na API");
        }
        return new $class($request, $response);
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function runApp()
    {
        try {
            return $this->app->run();
        } catch (MethodNotAllowedException $e) {
        } catch (NotFoundException $e) {
        } catch (Exception $e) {
        }
    }
}
