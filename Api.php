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
        return $arrayUrl[3];
    }

    public function retornaCamposeValoresFormatados()
    {
        $arrayUrl = explode("/", self::$url);
        if (isset($arrayUrl[4])) {
            if ($arrayUrl[4] === "") {
                return 0;
            } else {
                return $arrayUrl[4];
            }
        } else {
            return 0;
        }
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
