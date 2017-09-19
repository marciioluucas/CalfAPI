<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 17:46
 */

include 'vendor/autoload.php';

use view\View;

class Api
{
    public static $url;

    function __construct($url = "")
    {
        // Allow from any origin
        if (isset($_SERVER["HTTP_ORIGIN"])) {
            // You can decide if the origin in $_SERVER['HTTP_ORIGIN'] is something you want to allow, or as we do here, just allow all
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        } else {
            //No HTTP_ORIGIN set, so we allow any. You can disallow if needed here
            header("Access-Control-Allow-Origin: *");
        }

        if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
            if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"]))
                header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT"); //Make sure you remove those you do not want to support
            if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"]))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            //Just exit with 200 OK with the above headers for OPTIONS method
            exit(0);
        }

        //--------Responsável pelo REST--------\\
        self::$url = $url;
        if (isset($_SERVER['HTTP_HOST']) and isset($_SERVER['REQUEST_URI'])) {
            self::$url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        }

        $class = "\\controller\\" . ucfirst($this->retornaClasseURL()) . "Controller";
        if (!class_exists($class)) {
            View::render(["Message" => "Classe Nao encontrada"]);
            return false;
        }

        return $this->selecionaMetodo(new $class);
    }


    private function retornaClasseURL()
    {
        $arrayUrl = explode("/", self::$url);
        for ($i = count($arrayUrl) - 1; $i > 0; $i--) {
            if ($arrayUrl[$i] === "api") {
                return $arrayUrl[$i + 1];
            }
        }
    }

    public function retornaCamposeValoresFormatados()
    {
        $arrayUrl = explode("/", self::$url);
        for ($i = count($arrayUrl) - 1; $i > 0; $i--) {
            if ($arrayUrl[$i] === "api") {
                $comeca = $i + 2;
                break;
            }
        }
        if (isset($arrayUrl[$comeca + 1])) {
            $inc = $comeca;
            $inc2 = $comeca + 1;
            for ($i = $comeca; $i < count($arrayUrl); $i = $inc2) {
                $array[$arrayUrl[$inc]] = $arrayUrl[$inc2];
                $inc = $inc + 2;
                $inc2 = $inc2 + 2;
            }
            return $array;
        }
        return 0;
    }

    /**
     * @param Controller $classe
     * @return mixed
     */
    public
    function selecionaMetodo($classe)
    {

        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {

            case 'GET':
                return $classe->get($this->retornaCamposeValoresFormatados());
                break;
            case 'POST':

                return $classe->post();
                break;
            case 'PUT':

                return $classe->put($this->retornaCamposeValoresFormatados());
                break;
            case 'DELETE':
                return $classe->delete($this->retornaCamposeValoresFormatados());
                break;
            default:
                return View::render();
        }
    }
}

new Api();
