<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 22/02/2018
 * Time: 11:04
 */

namespace CalfManager\Controller;

use Exception;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use CalfManager\Model\Doenca;
use CalfManager\Utils\validate\DoencaValidate;
use CalfManager\View\View;

class DoencaController implements IController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function post(Request $request, Response $response): Response
    {
        try {
            $doenca = new Doenca();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new DoencaValidate())->validatePost((array) $data);
            if ($valida === true) {
                $doenca->setNome($data->nome);
                if (isset($data->descricao)) {
                    $doenca->setDescricao($data->descricao);
                }
                if ($id = $doenca->cadastrar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Doença cadastrada com sucesso! ID cadastrado: " . $id,
                        201,
                        "Sucesso ao cadastrar"
                    );
                }
                return View::renderMessage(
                    $response,
                    "error",
                    "Erro ao cadastrar doença!",
                    500,
                    "Erro ao cadastrar"
                );
            } else {
                return View::renderMessage(
                    $response,
                    'warning',
                    $valida,
                    400,
                    "Erro ao validar"
                );
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
    public function get(Request $request, Response $response, array $args): Response {
        try {
            $doenca = new Doenca();
            $page = (int) $request->getQueryParam('pagina');

            if ($request->getAttribute('id')) {
                $doenca->setId($request->getAttribute('id'));
            } elseif ($request->getQueryParam('nome')) {
                $doenca->setNome($request->getQueryParam('nome'));
            }
            return View::render($response, $doenca->pesquisar($page));
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
            $doenca = new Doenca();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new DoencaValidate())->validatePut((array) $data);
            if ($valida) {
                $doenca->setId($request->getAttribute('id'));
                if (isset($data->nome)) {
                    $doenca->setNome($data->nome);
                }
                if (isset($data->descricao)) {
                    $doenca->setDescricao($data->descricao);
                }
                if ($doenca->alterar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Doença alterada com sucesso!",
                        200,
                        "Sucesso ao alterar"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao alterar doença!",
                        500,
                        "Erro ao alterar"
                    );
                }
            } else {
                return View::renderMessage(
                    $response,
                    "warning",
                    $valida,
                    400,
                    "Erro ao validar"
                );
            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
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
            $doenca = new Doenca();
            if ($request->getAttribute('id')) {
                $doenca->setId($request->getAttribute('id'));
                if ($doenca->deletar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Doenca excluída com sucesso!",
                        202,
                        "Sucesso ao excluir"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao excluir doença!",
                        200,
                        "Erro ao excluir"
                    );
                }

            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }
}
