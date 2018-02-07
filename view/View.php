<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:06
 */

namespace view;

use util\HeaderWriter;
use \Psr\Http\Message\ResponseInterface as Response;

class View extends HeaderWriter
{

    private static $headers;

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return self::$headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers)
    {
        self::$headers = $headers;
    }


    /**
     * @param Response $response
     * @param array $data
     * @param string $codigo
     * @param string $razao
     * @return Response
     */
    public static final function render(Response $response, array $data = [], $codigo = "", $razao = "")
    {
        if ($codigo != "" and $razao == "") {
            return $response
                ->withStatus($codigo)
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($data));
        } else if ($codigo != "" and $razao != "") {
            return $response
                ->withStatus($codigo, $razao)
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($data));
        } else {
            return $response
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($data));
        }

    }


}