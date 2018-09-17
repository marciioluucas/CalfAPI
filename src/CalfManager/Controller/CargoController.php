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
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function post(Request $request, Response $response): Response
    {
        try{
            $cargo = new Cargo();
            $data = json_decode($response->getBody()->getContents());
            $valida = (new CargoValidate())->validatePost((array)$data);
            if($valida){
                $cargo->setNome($data->nome);
                $cargo->setDescricao($data->descricao);

                if($cargo->cadastrar()){
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
                        "Erro ao cadastrar cargo!",
                        500,
                        "Erro ao cadastrar!"
                    );
                }
            }
            else {
                return View::renderMessage(
                    $response,
                    'warning',
                    $valida,
                    400,
                    "Erro ao validar"
                );
            }
        }
        catch (Exception $e) {
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
        try{
            $cargo = new Cargo();
            $page = (int) $request->getQueryParam('pagina');
            if ($request->getAttribute('id')) {
                $cargo->setId($request->getAttribute('id'));
            }
            if ($request->getQueryParam('nome')) {
                $cargo->setNome($request->getQueryParam('nome'));
            }
            $search = $cargo->pesquisar($page);
            return View::render($response, $search);
        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function put(Request $request, Response $response): Response
    {
        try{
            $cargo = new Cargo();
            $data = json_decode($response->getBody()->getContents());
            $valida = (new CargoValidate())->validatePut((array)$data);
            if($valida){
                $cargo->setId($request->getAttribute('id'));
                if(!is_null($data->nome)){
                    $cargo->setNome($data->nome);
                }
                if(!is_null($data->descricao)){
                    $cargo->setDescricao($data->descricao);
                }
                if($cargo->alterar()){
                    return View::renderMessage(
                        $response,
                        "success",
                        "Cargo alterado com sucesso!",
                        200,
                        "Sucesso ao alterar"
                    );
                }else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao alterar cargo!",
                        500,
                        "Erro ao alterar"
                    );
                }
            }
            else {
                return View::renderMessage(
                    $response,
                    "warning",
                    $valida,
                    400,
                    "Erro ao validar"
                );
            }

        }catch (Exception $e) {
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
        try{
            $cargo = new Cargo();
            if($request->getAttribute('id')) {
                $cargo->setId($request->getAttribute('id'));

                if ($cargo->deletar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Cargo excluído com sucesso!",
                        200,
                        "Sucesso ao excluir"
                    );
                }
            }
        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

}