<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:41
 */

namespace src\controller;


use Exception;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use src\model\Pesagem;
use src\model\validate\PesagemValidate;
use src\view\View;

class PesagemController implements IController
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
            $pesagem = new Pesagem();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new PesagemValidate())->validatePost((array)$data);
            if ($valida) {
                $pesagem->setPeso($data->peso);
                $pesagem->getAnimal()->setId($data->animal_id);

                if ($pesagem->cadastrar()) {
                    return View::renderMessage($response,
                        "success", "Pesagem cadastrada com sucesso! ",
                        201, "Sucesso ao cadastrar");
                }
                return View::renderMessage($response,
                    "error", "Pesagem não cadastrada",
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
            $pesagem = new Pesagem();
            $page = (int) $request->getQueryParam('pagina');

            if ($request->getAttribute('id')) {
                $pesagem->setId($request->getAttribute('id'));

            } else if ($request->getQueryParam('animal')) {
                $pesagem->getAnimal()->setId($request->getQueryParam('animal'));
            }
            return View::render($response, $pesagem->pesquisar($page));
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
        // TODO: Implement put() method.
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function delete(Request $request, Response $response): Response
    {
        try {
            $pesagem = new Pesagem();
            if ($request->getAttribute('id')) {
                $pesagem->setId($request->getAttribute('id'));
                if ($pesagem->deletar()) {
                    return View::renderMessage($response, "success", "Pesagem desativada com sucesso!",
                        202,
                        "Sucesso ao desativar");
                };
            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }
}