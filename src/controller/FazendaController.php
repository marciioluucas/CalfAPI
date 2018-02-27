<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 11:46
 */

namespace src\controller;


use Exception;
use src\model\Fazenda;
use src\util\validate\FazendaValidate;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\RequestInterface as Request;
use src\view\View;

class FazendaController implements IController
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
            $fazenda = new Fazenda();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new FazendaValidate())->validatePost((array)$data);
            if ($valida) {
                $fazenda->setNome($data->nome);
                if (isset($data->limite)) {
                    $fazenda->setLimite($data->limite);
                }
                if ($fazenda->cadastrar()) {
                    return View::renderMessage($response,
                        "success", "Fazenda cadastrada com sucesso!",
                        201, "Sucesso ao cadastrar");
                }
                return View::renderMessage($response,
                    "error", "Fazenda não cadastrada",
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
     */
    public function get(Request $request, Response $response, array $args): Response
    {
        try {
            $fazenda = new Fazenda();
            $page = (int)$request->getQueryParam('pagina');

            if ($request->getAttribute('id')) {
                $fazenda->setId($request->getAttribute('id'));

            } else if ($request->getAttribute('nome')) {
                $fazenda->setNome($request->getAttribute('nome'));
            }
            return View::render($response, $fazenda->pesquisar($page));
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

            $fazenda = new Fazenda();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new FazendaValidate())->validatePut((array)$data);
            if ($valida) {
                $fazenda->setId($request->getAttribute('id'));
                if (isset($data->nome)) {
                    $fazenda->setNome($data->nome);
                }
                if (isset($data->limite)) {
                    $fazenda->setLimite($data->limite);
                }
                if ($fazenda->cadastrar()) {
                    return View::renderMessage($response,
                        "success", "Fazenda alterada com sucesso!",
                        202, "Sucesso ao alterar");
                }
                return View::renderMessage($response,
                    "error", "Fazenda não cadastrada",
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
     * @return Response
     */
    public function delete(Request $request, Response $response): Response
    {
        try {
            $fazenda = new Fazenda();
            if ($request->getAttribute('id')) {
                $fazenda->setId($request->getAttribute('id'));
                if ($fazenda->deletar()) {
                    return View::renderMessage($response, "success", "Fazenda desativada com sucesso!",
                        202,
                        "Sucesso ao desativar");
                };
            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }
}