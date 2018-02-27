<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:15
 */

namespace src\controller;


use Exception;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use src\model\Lote;
use src\model\validate\LoteValidate;
use src\view\View;

/**
 * Class LoteController
 * @package src\controller
 */
class LoteController implements IController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public function post(Request $request, Response $response): Response
    {
        try {
            $lote = new Lote();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new LoteValidate())->validatePost((array)$data);
            if ($valida) {
                $lote->setCodigo($data->codigo);

                if (isset($data->descricao)) {
                    $lote->setDescricao($data->descricao);
                }
                if ($lote->cadastrar()) {
                    return View::renderMessage($response,
                        "success", "Lote cadastrado com sucesso! ",
                        201, "Sucesso ao cadastrar");
                }
                return View::renderMessage($response,
                    "error", "Lote não cadastrado",
                    500);
            } else {
                return View::renderMessage($response, 'warning', $valida, 400);
            }
        } catch (Exception $e) {
            return View::renderException($response, $e);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws Exception
     */
    public function get(Request $request, Response $response, array $args): Response
    {
        try {
            $lote = new Lote();
            $page = (int) $request->getQueryParam('pagina');

            if ($request->getAttribute('id')) {
                $lote->setId($request->getAttribute('id'));

            } else if ($request->getQueryParam('codigo')) {
                $lote->setCodigo($request->getQueryParam('codigo'));
            }
            return View::render($response, $lote->pesquisar($page));
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function put(Request $request, Response $response): Response
    {
        try {

            $lote = new Lote();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new LoteValidate())->validatePut((array)$data);
            if ($valida) {
                $lote->setId($request->getAttribute('id'));
                if (isset($data->codigo)) {
                    $lote->setCodigo($data->codigo);
                }
                if (isset($data->descricao)) {
                    $lote->setDescricao($data->descricao);
                }
                if ($lote->alterar()) {
                    return View::renderMessage($response,
                        "success", "Lote alterado com sucesso!",
                        202, "Sucesso ao alterar");
                };
            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
        return $response;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function delete(Request $request, Response $response): Response
    {
        try {
            $lote = new Lote();
            if ($request->getAttribute('id')) {
                $lote->setId($request->getAttribute('id'));
                if ($lote->deletar()) {
                    return View::renderMessage($response, "success", "Lote desativado com sucesso!",
                        202,
                        "Sucesso ao desativar");
                };
            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }

}