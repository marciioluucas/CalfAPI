<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:06
 */

namespace src\view;

use Exception;
use src\util\HeaderWriter;
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

    public static final function renderException(Response $response, Exception $exception, $additionalMessage = "none", $utf8 = false)
    {
        $arrayReturn = [
            "exception" => [
                "message" => utf8_encode($exception->getMessage()),
                "code" => $exception->getCode(),
                "additional_message" => $additionalMessage
            ]
        ];

        $json = json_encode($arrayReturn);
        return $response
            ->withStatus(500, "Oops, uma excessao parece ter acontecido!")
            ->withHeader("Content-Type", "application/json; charset=iso-8859-1")
            ->write($json);
    }

    public static final function renderError(Response $response, Exception $exception, $additionalMessage = "none")
    {

    }


}