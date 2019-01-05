<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 12/09/2018
 * Time: 17:43
 */

namespace CalfManager\Controller;


use CalfManager\Model\Dose;
use CalfManager\Utils\Validate\DoseValidate;
use CalfManager\View\View;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class DoseController implements IController
{
    public function post(Request $request, Response $response): Response
    {
        $data = json_decode($request->getBody()->getContents());
        $valida = (new DoseValidate())->validatePost((array)$data);
        try {
            $dose = new Dose();
            if ($valida === true) {
                $dose->setQuantidadeMg($data->quantidade_mg);
                $dose->getMedicamento()->setId($data->medicamento_id);
                $dose->getAnimal()->setId($data->animal_id);
                $dose->setData($data->data);
                if ($dose->cadastrar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Dose aplicada cadastrada com sucesso!",
                        201,
                        "Sucesso ao cadastrar"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao cadastrar dose aplicada",
                        500,
                        "Erro ao cadastrar");
                }
            } else {
                return View::renderMessage($response, "warning", $valida, 400, "Erro ao validar");
            }
        } catch (Exception $e) {
            return View::renderException($response, $e);
        }
    }

    public function get(Request $request, Response $response, array $args): Response
    {
        $page = (int)$request->getQueryParam('pagina');
        try {
            $dose = new Dose();

            if ($request->getAttribute('id')) {
                $dose->setId($request->getAttribute('id'));
            }
            if ($request->getQueryParam('medicamento')) {
                $dose->getMedicamento()->setId($request->getQueryParam('medicamento'));
            }
            if ($request->getQueryParam('animal')) {
                $dose->getAnimal()->setId($request->getQueryParam('animal'));
            }
            $search = $dose->pesquisar($page);
            return View::render($response, $search);

        } catch (Exception $e) {
            return View::renderException($response, $e);
        }
    }

    public function put(Request $request, Response $response): Response
    {

        $data = json_decode($request->getBody()->getContents());
        $valida = (new DoseValidate())->validatePut((array)$data);
        try {
            $dose = new Dose();
            if ($valida === true) {
                $dose->setId($request->getAttribute('id'));
                if (!is_null($data->quantidade_mg)) {
                    $dose->setQuantidadeMg($data->quantidade_mg);
                }
                if (!is_null($data->medicamento->id)) {
                    $dose->getMedicamento()->setId($data->medicamento->id);
                }
                if (!is_null($data->animal->id)) {
                    $dose->getAnimal()->setId($data->animal->id);
                }
                if (!is_null($data->data)) {
                    $dose->setData($data->data);
                }
                if ($dose->alterar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Dose aplicada alterada com sucesso!",
                        201,
                        "sucesso ao alterar"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao alterar dose aplicada",
                        500,
                        "erro ao alterar"
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
        } catch (Exception $e) {
            return View::renderException($response, $e);
        }
    }

    public function delete(Request $request, Response $response): Response
    {
        try {
            $dose = new Dose();
            if ($request->getAttribute('id')) {
                $dose->setId($request->getAttribute('id'));

                if ($dose->deletar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Dose aplicada excluída com sucesso!",
                        201,
                        "Sucesso ao excluir"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao excluir dose aplicada",
                        400,
                        "Erro ao excluir"
                    );
                }
            }
        } catch (Exception $e) {
            return View::renderException($response, $e);
        }
    }

}