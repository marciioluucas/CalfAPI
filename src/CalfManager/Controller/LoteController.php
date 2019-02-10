<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:15
 */

namespace CalfManager\Controller;

use Exception;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use CalfManager\Model\Lote;
use CalfManager\Utils\Validate\LoteValidate;
use CalfManager\View\View;

/**
 * Class LoteController
 * @package CalfManager\controller
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
            if ($valida === true) {
                $lote->setCodigo($data->codigo);
                $lote->getFazenda()->setId($data->fazenda_id);
                if (isset($data->descricao)) {
                    $lote->setDescricao($data->descricao);
                }

                $lote->getUsuarioCadastro()->setId($data->usuario_cadastro);
                if ($lote->cadastrar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Lote cadastrado com sucesso! ",
                        201,
                        "Sucesso ao cadastrar"
                    );
                }
                return View::renderMessage(
                    $response,
                    "error",
                    "Lote não cadastrado",
                    500
                );
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
            $page = (int)$request->getQueryParam('pagina');

            if ($request->getAttribute('id')) {
                $lote->setId($request->getAttribute('id'));
            }
            if ($request->getQueryParam('codigo')) {
                $lote->setCodigo($request->getQueryParam('codigo'));
            }
            if ($request->getQueryParam('fazenda_id')) {
                $lote->getFazenda()->setId($request->getQueryParam('fazenda_id'));
            }
            if ($request->getQueryParam('contagem') == 'true') {
                $lote->setContagem(true);
            }
            if ($request->getQueryParam('contagemAnimais') == 'true') {
                $lote->setContagemAnimais(true);

                /*
                    Aqui eu atribuo uma variavel o valor do attribute ID, se caso nao passar o
                    attribute ex: /lote/13233 ele tenta procurar no query param
                    ex: /lote?id=13233 mas se caso nao conseguir assim tambem, lança a excessao
                */
                $id = null;
                if ($request->getAttribute('id')) $id = $request->getAttribute('id');
                if ($id == null && $request->getQueryParam('id')) $id = $request->getQueryParam('id');

                if ($id == null) throw new Exception('O parametro ID nao esta definido nem na URL nem nos parametros da mesma');

                $lote->setId($id);
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
            if ($valida === true) {
                $lote->setId($request->getAttribute('id'));
                if (isset($data->codigo)) {
                    $lote->setCodigo($data->codigo);
                }
                if (isset($data->fazenda_id)) {
                    $lote->getFazenda()->setId($data->fazenda_id);
                }
                if (isset($data->descricao)) {
                    $lote->setDescricao($data->descricao);
                }


                $lote->getUsuarioAlteracao()->setId($data->usuario_cadastro);
                if ($lote->alterar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Lote alterado com sucesso!",
                        202,
                        "Sucesso ao alterar"
                    );
                }
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
                    return View::renderMessage(
                        $response,
                        "success",
                        "Lote desativado com sucesso!",
                        202,
                        "Sucesso ao desativar"
                    );
                }
            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }
}
