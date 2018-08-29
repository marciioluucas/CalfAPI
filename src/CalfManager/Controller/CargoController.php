<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 26/08/2018
 * Time: 10:31
 */

namespace CalfManager\Controller;


use CalfManager\Model\Cargo;
use CalfManager\Utils\Validate\CargoValidate;
use CalfManager\View\View;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Symfony\Component\Config\Definition\Exception\Exception;

class CargoController implements IController
{
    public function post(Request $request, Response $response): Response
    {
        try{
            $cargo = new Cargo();
            $data = json_decode($response->getBody()->getContents());
            $valida = (new CargoValidate())->validatePost((array)$data);
            if($valida){
                $cargo->setNome($data->nome);
                if(isset($data->descricao)){
                    $cargo->setDescricao($data->descricao);
                }
                if($id = $cargo->cadastrar()){
                    return View::renderMessage(
                        $response,
                        "success",
                        "Cargo cadastrado com sucesso!",
                        201,
                        "Sucesso ao cadastrar!"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Cargo não cadastrado!",
                        500
                    );
                }
            } else {
                return View::renderMessage($response, 'warning', $valida, 400);
            }
        }catch (Exception $e) {
            return View::renderException($response, $e);
        }
    }

    public function get(Request $request, Response $response, array $args): Response
    {
        try{
            $cargo = new Cargo();
            $page = (int) $request->getQueryParam('pagina');
            if ($request->getAttribute('id')) {
                $cargo->setId($request->getAttribute('id'));
            } elseif ($request->getQueryParam('nome')) {
                $cargo->setNome($request->getQueryParam('nome'));
            }
            return View::render($response, $cargo->pesquisar($page));
        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

    public function put(Request $request, Response $response): Response
    {
        try{
            $cargo = new Cargo();
            $data = json_decode($response->getBody()->getContents());
            $valida = (new CargoValidate())->validatePut((array)$data);

            if($valida){
                $cargo->setId($request->getAttribute('id'));
                if(isset($data->nome)){
                    $cargo->setNome($data->nome);
                }
                if(isset($data->descricao)){
                    $cargo->setDescricao($data->descricao);
                }
                if($cargo->alterar()){
                    return View::renderMessage($response, "success","Cargo alterado com sucesso!", 200, "Sucesso ao alterar");
                }

            }

        }catch (Exception $e) {
            return View::renderException($response, $e);
        }
        return $response;
    }

    public function delete(Request $request, Response $response): Response
    {
        try{
            $cargo = new Cargo();
            if($request->getAttribute('id')){
                $cargo->setId($request->getAttribute('id'));
            }
            if($cargo->deletar()){
                return View::renderMessage(
                    $response,
                    "success",
                    "Cargo desativado com sucesso!",
                    200, "Sucesso ao desativar"
                );
            }

        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

}