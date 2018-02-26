<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 22/02/2018
 * Time: 11:04
 */

namespace src\controller;


use Exception;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use src\model\Doenca;
use src\model\validate\DoencaValidate;
use src\view\View;

class DoencaController implements IController
{

    public function post(Request $request, Response $response)
    {
        try {
            $doenca = new Doenca();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new DoencaValidate())->validatePost((array)$data);
            if ($valida) {
                $doenca->setNome($data->nome);
                if (isset($data->descricao)) {
                    $doenca->setDescricao($data->descricao);
                }
                if($id = $doenca->cadastrar()){
                    return View::renderMessage($response,
                        "success", "Doença cadastrado com sucesso! ID cadastrado: " . $id,
                        201, "Sucesso ao cadastrar");
                }
                return View::renderMessage($response,
                    "error", "Doença não cadastrada",
                    500);
            } else {
                return View::renderMessage($response, 'warning', $valida, 400);
            }
        } catch (Exception $e) {
            return View::renderException($response, $e);
        }
    }

    public function get(Request $request, Response $response, array $args)
    {
        try {
            $doenca = new Doenca();
            $page = (int)$request->getQueryParam('pagina');

            if ($request->getAttribute('id')) {
                $doenca->setId($request->getAttribute('id'));

            } else if ($request->getAttribute('nome')) {
                $doenca->setNome($request->getAttribute('nome'));
            }
            return View::render($response, $doenca->pesquisar($page));
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }

    public function put(Request $request, Response $response)
    {
        try {

            $doenca = new Doenca();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new DoencaValidate())->validatePut((array)$data);
            if ($valida) {
                $doenca->setId($request->getAttribute('id'));
                $doenca->setNome($data->nome);
                if ($data->descricao) {
                    $doenca->setDescricao($data->descricao);
                }
                if ($doenca->alterar()) {
                    return View::renderMessage($response,
                        "success", "Doença alterada com sucesso!",
                        202, "Sucesso ao alterar");
                };
            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }

    public function delete(Request $request, Response $response)
    {
       try{
           $doenca = new Doenca();
           if ($request->getAttribute('id')) {
               $doenca->setId($request->getAttribute('id'));
               if ($doenca->deletar()) {
                   return View::renderMessage($response, "success", "Doenca desativada com sucesso!",
                       202,
                       "Sucesso ao desativar");
               };
           }
       } catch (Exception $exception) {
           return View::renderException($response, $exception);
       }
    }
}