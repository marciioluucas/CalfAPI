<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 30/08/2018
 * Time: 06:52
 */

namespace CalfManager\Controller;


use CalfManager\Model\Doenca;
use CalfManager\Model\Hemograma;
use CalfManager\Utils\Validate\HemogramaValidate;
use CalfManager\View\View;
use Exception;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HemogramaController implements IController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public function post(Request $request, Response $response): Response
    {
        try{
            $hemograma = new Hemograma();
            $doenca = new Doenca();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new HemogramaValidate())->validatePost((array)$data);
            if($valida === true) {

                $hemograma->setData($data->data);
                $hemograma->setPpt($data->ppt);
                $hemograma->setHematocrito($data->hematocrito);
                $hemograma->getAnimal()->setId($data->animal_id);
                $hemograma->getFuncionario()->setId($data->funcionario_id);

                $hemograma->getUsuarioCadastro()->setId($data->usuario_cadastro);
                if($hemograma->cadastrar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Hemograma cadastrado com sucesso!",
                        201,
                        "Sucesso ao cadastrar"
                    );
                }else{
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao cadastrar de hemograma!",
                        500,
                        "Erro ao alterar"
                    );
                }
            } else {
                return View::renderMessage($response, 'warning', $valida, 400, "Erro ao validar");
            }
        } catch (Exception $e){
            throw new Exception(View::renderException($response, $e ));
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
        try{
            $hemograma = new Hemograma();
            $page = (int) $request->getQueryParam('pagina');
            if($request->getAttribute('id')){
                $hemograma->setId($request->getAttribute('id'));
            }
            if($request->getQueryParam('animal_id')){
                $hemograma->getAnimal()->setId($request->getQueryParam('animal_id'));
            }
            if($request->getQueryParam('funcionario_id')){
                $hemograma->getFuncionario()->setId($request->getQueryParam('funcionario_id'));
            }
            $search = $hemograma->pesquisar($page);
            return View::render($response, $search);
        } catch (Exception $e){
            throw new Exception(View::renderException( $response, $e));
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public function put(Request $request, Response $response): Response
    {
        try{
            $hemograma = new Hemograma();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new HemogramaValidate())->validatePost((array)$data);
            if($valida === true) {
                $hemograma->setId($request->getAttribute('id'));
                if(!is_null($data->data)) {
                    $hemograma->setData($data->data);
                }
                if(!is_null($data->ppt)) {
                    $hemograma->setPpt($data->ppt);
                }
                if(!is_null($data->hematocrito)) {
                    $hemograma->setHematocrito($data->hematocrito);
                }
                if(!is_null($data->animal_id)){
                    $hemograma->getAnimal()->setId($data->animal_id);
                }
                if(!is_null($data->funcionario_id)){
                    $hemograma->getFuncionario()->setId($data->funcionario_id);
                }

                $hemograma->getUsuarioAlteracao()->setId($data->usuario_cadastro);
                if($hemograma->alterar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Hemograma alterado com sucesso!",
                        201,
                        "Sucesso ao alterar"
                    );
                }else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao alterar hemograma!",
                        500,
                        "Erro ao alterar"
                    );
                }
            }
            else {
                return View::renderMessage($response, 'warning', $valida, 400, "Erro ao validar");
            }

        } catch (Exception $e){
            throw new Exception(View::renderException($response, $e));
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public function delete(Request $request, Response $response): Response
    {
        try{
            $hemograma = new Hemograma();
            if($request->getAttribute('id')) {
                $hemograma->setId($request->getAttribute('id'));

                if ($hemograma->deletar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Hemograma excluído com sucesso!",
                        201,
                        "Sucesso ao excluir"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao excluir hemograma!",
                        500,
                        "Erro ao excluir"
                    );
                }
            }

        } catch (Exception $e){
            throw new Exception(View::renderException($response, $e));
        }
    }

}