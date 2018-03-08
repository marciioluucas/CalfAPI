<?php

namespace src\util;

use Exception;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\RequestInterface as Request;
use Slim\App;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use src\controller\IController;
use src\view\View;

class Api
{

    private $app;

    /**
     * Api constructor.
     */
    public function __construct()
    {
        $this->app = new App(Config::SLIM_CONTAINER);

        //Carregar o timezone da aplicação.
        Config::loadTimezone();
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
        header('Access-Control-Allow-Origin: *');
        $this->groupAuth();
        $this->groupModules();
    }

    public function groupModules()
    {
        $app = $this->app;

        $app->group('/{classname}', function () use ($app) {

            $app->get('', function (Request $request, Response $response, array $args) {
                try {
                    $class = Api::invokeClass($args['classname'], $request, $response);
                } catch (Exception $e) {
                    return View::renderException($response, $e);
                }
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
                $class = Api::invokeClass($args['classname'], $request, $response);
                return $class->post($request, $response, $args);
            });

            $app->put('/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
                $class = Api::invokeClass($args['classname'], $request, $response);
                return $class->put($request, $response, $args);

            });
            $app->delete('/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
                $class = Api::invokeClass($args['classname'], $request, $response);
                return $class->delete($request, $response);
            });
        });
    }

    public function groupAuth()
    {
        $app = $this->app;

        $app->group('/auth', function () use ($app) {
            $app->post('/in', function (Request $request, Response $response, array $args) {
//                $class = Api::invokeClass($args['classname'], $request, $response);
//                return $class->post($request, $response, $args);
            });
            $app->delete('/out', function (Request $request, Response $response, array $args) {
//                $class = Api::invokeClass($args['classname'], $request, $response);
//                return $class->delete($request, $response);
            });
        });
    }

    /**
     * @param String $classname
     * @param Request $request
     * @param Response $response
     * @return IController | Response
     * @throws Exception
     */
    public static function invokeClass(String $classname, Request $request, Response $response)
    {
        $class = "\\src\\controller\\" . ucfirst($classname) . "Controller";
        if (!class_exists($class)) {
            throw new Exception("Módulo não cadastrado na API");
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
