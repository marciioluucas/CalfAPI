<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 28/08/2018
 * Time: 23:02
 */

namespace CalfManager\Controller;


use CalfManager\Model\Medicamento;
use CalfManager\Utils\Validate\MedicamentoValidate;
use CalfManager\View\View;
use Exception;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class MedicamentoController implements IController
{
    public function post(Request $request, Response $response): Response
    {
        try {
            $medicamento = new Medicamento();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new MedicamentoValidate())->validatePost((array)$data);
            if ($valida === true) {
                $medicamento->setNome($data->nome);
                $medicamento->setPrescricao($data->prescricao);
                if($medicamento->cadastrar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Medicamento cadastrado com sucesso!",
                        201,
                        "Sucesso ao cadastrar ");
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao cadastrar medicamento!",
                        500,
                        "Erro ao cadastrar ");
                }
            } else {
                return View::renderMessage($response, "warning", $valida, 400, "Erro ao validar");
            }
        } catch (Exception $e){
            return View::renderException($response, $e);
        }

    }

    public function get(Request $request, Response $response, array $args): Response
    {
        $medicamento = new Medicamento();
        $page = (int) $request->getQueryParam('pagina');
        try {
            if ($request->getAttribute('id')) {
                $medicamento->setId($request->getAttribute('id'));
            } else if ($request->getAttribute('nome')) {
                $medicamento->setNome($request->getAttribute('nome'));
            }
            $search = $medicamento->pesquisar($page);
            return View::render($response, $search);
        } catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

    public function put(Request $request, Response $response): Response
    {
        try {
            $medicamento = new Medicamento();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new MedicamentoValidate())->validatePut((array)$data);
            if ($valida) {
                $medicamento->setId($request->getAttribute('id'));
                $medicamento->setNome($data->nome);
                $medicamento->setPrescricao($data->prescricao);
                if($medicamento->alterar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Medicamento alterado com sucesso!",
                        201,
                        "Sucesso ao alterar ");
                }else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao alterar medicamento!",
                        500,
                        "Erro ao alterar ");
                }
            } else {
                return View::renderMessage($response, "warning", $valida, 400);
            }
        } catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

    public function delete(Request $request, Response $response): Response
    {
        try{
            $medicamento = new Medicamento();
            if($request->getAttribute('id')){
                $medicamento->setId($request->getAttribute('id'));
                if($medicamento->deletar()){
                    return View::renderMessage(
                        $response,
                        "success",
                        "Medicamento excluído com successo!",
                        201
                    );
                }
                else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao excluir medicamento!",
                        500,
                        "Erro ao excluir ");
                }
            }
        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

}