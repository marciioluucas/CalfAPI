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
    public function post(Request $request, Response $response): Response
    {
        $laboratorio = new Laboratorio();
        $data = json_decode($request->getBody()->getContents());
        $valida = (new LaboratorioValidate())->validatePost((array) $data);
        try {
            if ($valida) {
                $laboratorio->setDataEntrada($data->data_entrada);
                $laboratorio->getAnimal()->getId($data->animal->id);
                $laboratorio->getHemograma()->getId($data->hemograma->id);
                $laboratorio->getDoseAplicada()->getId($data->dose_aplicada->id);
                if ($laboratorio->cadastrar()) {
                    return View::renderMessage($response, "success", "Registro cadastrado com sucesso em laboratório", 201, "Sucesso ao cadastrar");
                } else {
                    return View::renderMessage($response, "error", "Erro ao cadastrar registro em laboratório", 300, "Erro ao cadastrar");
                }
            } else {
                return View::renderMessage($response, "warning", $valida, 400);

            }
        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

    public function get(Request $request, Response $response, array $args): Response
    {
        try{
            $laboratorio = new Laboratorio();
            $page = (int) $request->getQueryParam('pagina');
            if($request->getAttribute('id')){
                $laboratorio->setId($request->getAttribute('id'));
            }
            if($request->getQueryParam('animal')){
                $laboratorio->getAnimal()->setId($request->getQueryParam('animal'));
            }
            if($request->getQueryParam('hemograma')){
                $laboratorio->getHemograma()->setId($request->getQueryParam('hemograma'));
            }
            if($request->getQueryParam('dose_aplicada')){
                $laboratorio->getDoseAplicada()->setId($request->getQueryParam('dose_aplicada'));
            }

            if($search = $laboratorio->pesquisar($page)){
                return View::render($response, $search);
            }else{
                return View::renderMessage($response, "error", "Registro não encontrado em laboratório", 400, "Erro ao pesquisar");
            }
        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

    public function put(Request $request, Response $response): Response
    {
        $laboratorio = new Laboratorio();
        $data = json_decode($request->getBody()->getContents());
        $valida = (new LaboratorioValidate())->validatePost((array) $data);
        try {
            if ($valida) {

                $laboratorio->setId($request->getAttribute('id'));
                if(!is_null($data->data_entrada)) {
                    $laboratorio->setDataEntrada($data->data_entrada);
                }
                if(!is_null($data->animal->id)) {
                    $laboratorio->getAnimal()->getId($data->animal->id);
                }
                if(!is_null($data->hemograma->id)) {
                    $laboratorio->getHemograma()->getId($data->hemograma->id);
                }
                if(!is_null($data->dose_aplicada->id)) {
                    $laboratorio->getDoseAplicada()->getId($data->dose_aplicada->id);
                }
                if ($laboratorio->cadastrar()) {
                    return View::renderMessage($response, "success", "Registro cadastrado com sucesso em laboratório", 201, "Sucesso ao cadastrar");
                } else {
                    return View::renderMessage($response, "error", "Erro ao cadastrar registro em laboratório", 300, "Erro ao cadastrar");
                }
            } else {
                return View::renderMessage($response, "warning", $valida, 400);

            }
        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

    public function delete(Request $request, Response $response): Response
    {
        $laboratorio = new Laboratorio();
        try {
            if ($request->getAttribute('id')) {
                $laboratorio->setId($request->getAttribute('id'));
            }
            if ($laboratorio->deletar()) {
                return View::renderMessage($response, "success", "Registro em laboratório excluído com sucesso", 201, "Sucesso ao excluir");
            } else {
                return View::renderMessage($response, "error", "Erro ao excluir registro em laboratório", 400, "erro ao excluir");
            }
        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

}