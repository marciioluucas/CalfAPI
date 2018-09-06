<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 30/08/2018
 * Time: 06:52
 */

namespace CalfManager\Controller;


use CalfManager\Model\Hemograma;
use CalfManager\Utils\Validate\HemogramaValidate;
use CalfManager\View\View;
use Exception;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HemogramaController implements IController
{
    public function post(Request $request, Response $response): Response
    {
        try{
            $hemograma = new Hemograma();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new HemogramaValidate())->validatePost((array)$data);
            if($valida) {
                $hemograma->setDataExame($data->data_exame);
                $hemograma->setPpt($data->ppt);
                $hemograma->setHematocrito($data->hematocrito);
                $hemograma->cadastrar();
                return View::renderMessage($response,"success", "Hemograma cadastrado com sucesso!", 201, "Sucesso ao cadastrar");
            }
        } catch (Exception $e){
            throw new Exception(View::renderException($e, $response));
        }
    }

    public function get(Request $request, Response $response, array $args): Response
    {
        try{
            $hemograma = new Hemograma();
            $page = (int)$request->getQueryParam('pagina');
            if($request->getAttribute('id')){
                $hemograma->setId($request->getAttribute('id'));
            }
           $search = $hemograma->pesquisar($page);
            return View::render($response, $search);
        } catch (Exception $e){
            throw new Exception(View::renderException($e, $response));
        }
    }

    public function put(Request $request, Response $response): Response
    {
        try{
            $hemograma = new Hemograma();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new HemogramaValidate())->validatePost((array)$data);
            if($valida) {
                $hemograma->setId($request->getAttribute('id'));
                $hemograma->setDataExame($data->data_exame);
                $hemograma->setPpt($data->ppt);
                $hemograma->setHematocrito($data->hematocrito);
                $hemograma->alterar();
                return View::renderMessage(
                    $response,
                    "success",
                    "Hemograma alterado com sucesso!",
                    201,
                    "Sucesso ao alterar"
                );
            }

        } catch (Exception $e){
            throw new Exception(View::renderException($e, $response));
        }
    }

    public function delete(Request $request, Response $response): Response
    {
        try{
            $hemograma = new Hemograma();
            if($request->getAttribute('id')){
                $hemograma->setId($request->getAttribute('id'));
            }
            if($hemograma->deletar()) {
                return View::renderMessage(
                    $response,
                    "success",
                    "Hemograma excluído com sucesso!",
                    201,
                    "Sucesso ao deletar"
                );
            }

        } catch (Exception $e){
            throw new Exception(View::renderException($e, $response));
        }
    }

}