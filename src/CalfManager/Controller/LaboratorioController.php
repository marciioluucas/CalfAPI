<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 05/09/2018
 * Time: 21:30
 */

namespace CalfManager\Controller;


use CalfManager\Model\Laboratorio;
use CalfManager\Utils\Validate\LaboratorioValidate;
use CalfManager\View\View;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class LaboratorioController implements IController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function post(Request $request, Response $response): Response
    {
        $laboratorio = new Laboratorio();
        $data = json_decode($request->getBody()->getContents());
        $valida = (new LaboratorioValidate())->validatePost((array) $data);
        try {
            if ($valida === true) {
                $laboratorio->setDataEntrada($data->data_entrada);
                $laboratorio->getAnimal()->setId($data->animal_id);
                $laboratorio->getHemograma()->setId($data->hemograma_id);
                $laboratorio->getDoseAplicada()->setId($data->dose_aplicada_id);
                if ($laboratorio->cadastrar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Registro em laboratório cadastrado com sucesso!",
                        201,
                        "Sucesso ao cadastrar"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao cadastrar registro em laboratório",
                        500,
                        "Erro ao cadastrar"
                    );
                }
            } else {
                return View::renderMessage($response, "warning", $valida, 400, "Erro ao validar");

            }
        }catch (Exception $e){
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
            $laboratorio = new Laboratorio();
            $page = (int) $request->getQueryParam('pagina');
            if($request->getAttribute('id')){
                $laboratorio->setId($request->getAttribute('id'));
            }
            if($request->getQueryParam('animal')){
                $laboratorio->getAnimal()->setId($request->getQueryParam('animal_id'));
            }
            if($request->getQueryParam('hemograma')){
                $laboratorio->getHemograma()->setId($request->getQueryParam('hemograma_id'));
            }
            if($request->getQueryParam('dose_aplicada')){
                $laboratorio->getDoseAplicada()->setId($request->getQueryParam('dose_aplicada_id'));
            }

            $search = $laboratorio->pesquisar($page);
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
        try {
            $laboratorio = new Laboratorio();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new LaboratorioValidate())->validatePut((array) $data);

            if ($valida === true) {

                $laboratorio->setId($request->getAttribute('id'));
                if(!is_null($data->data_entrada)) {
                    $laboratorio->setDataEntrada($data->data_entrada);
                }
                if(!is_null($data->animal_id)) {
                    $laboratorio->getAnimal()->setId($data->animal_id);
                }
                if(!is_null($data->hemograma_id)) {
                    $laboratorio->getHemograma()->setId($data->hemograma_id);
                }
                if(!is_null($data->dose_aplicada_id)) {
                    $laboratorio->getDoseAplicada()->setId($data->dose_aplicada_id);
                }
                if ($laboratorio->alterar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Registro alterado com sucesso!",
                        201,
                        "Sucesso ao alterar"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao alterar registro em laboratório",
                        300,
                        "Erro ao alterar"
                    );
                }
            } else {
                return View::renderMessage($response, "warning", $valida, 400, "Erro ao validar");

            }
        }catch (Exception $e){
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
        try {
            $laboratorio = new Laboratorio();

            if ($request->getAttribute('id')) {
                $laboratorio->setId($request->getAttribute('id'));

                if ($laboratorio->deletar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Registro em laboratório excluído com sucesso",
                        201,
                        "Sucesso ao excluir"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao excluir registro em laboratório",
                        500,
                        "erro ao excluir"
                    );
                }
            }
        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

}