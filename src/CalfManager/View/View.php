<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:06
 */

namespace CalfManager\View;

use Exception;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class View
 * @package CalfManager\view
 */
class View
{
    /**
     * @param Response $response
     * @param mixed $data
     * @param string $codigo
     * @param string $razao
     * @return Response
     */
    final public static function render(
        Response $response,
        $data,
        $codigo = "",
        $razao = ""
    ): Response {
        if ($codigo != "" and $razao == "") {
            return $response->withStatus($codigo)->withJson($data);
        } elseif ($codigo != "" and $razao != "") {
            return $response->withStatus($codigo, $razao)->withJson($data);
        } else {
            return $response->withJson($data);
        }
    }

    /**
     * @param Response $response
     * @param Exception $exception
     * @param string $additionalMessage
     * @return Response
     */
    final public static function renderException(
        Response $response,
        Exception $exception,
        $additionalMessage = "none"
    ): Response {
        $response->withStatus(500, 'Erro interno no servidor');
        $arrayReturn = [
            "exception" => [
                "message" => $exception->getMessage(),
                "code" => $exception->getCode(),
                "additional_message" => $additionalMessage
            ]
        ];

        return $response->withJson($arrayReturn);
    }

    /**
     * @param Response $response
     * @param string $type
     * @param $description
     * @param int $codigo
     * @param string $razao
     * @return Response
     */
    final public static function renderMessage(
        Response $response,
        string $type,
        $description,
        int $codigo = 0,
        string $razao = ""
    ): Response {
        if ($type != 'error' && $type != 'success' && $type != 'warning') {
            throw new InvalidArgumentException(
                "O argumento de tipo deve ser somente: error, success ou warning."
            );
        }

        $json = ["message" => ["type" => $type, "description" => $description]];

        if ($codigo != 0 and $razao == "") {
            return $response->withStatus($codigo)->withJson($json);
        } elseif ($codigo != 0 and $razao != "") {
            return $response->withStatus($codigo, $razao)->withJson($json);
        } else {
            return $response->withJson($json);
        }
    }
}
