<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/02/2018
 * Time: 12:36
 */

namespace view;


use Exception;
use Slim\App;

class Router
{
    private $app;

    /**
     * Router constructor.
     * @throws Exception
     */
    function __construct()
    {
        try {
            return $this->getApp();
        } catch (Exception $e) {
            throw new Exception("Não foi possível pegar o App" . $e->getMessage());
        }
    }

    /**
     * @param App $app
     */
    public function setApp(App $app): void
    {
        $this->app = $app;
    }

    /**
     * @return App
     * @throws Exception
     */
    public function getApp(): App
    {
        try {
            return $this->app;
        } catch (\Exception $exception) {
            throw new Exception("O slim app está nulo. " . $exception->getMessage());
        }
    }
}