<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 12/09/2017
 * Time: 23:50
 */

namespace src\controller;


use Exception;
use src\model\Animal;
use src\model\validate\AnimalValidate;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\RequestInterface as Request;
use src\util\Migration;
use src\util\DataConversor;
use src\view\View;

/**
 * Class AnimalController
 * @package controller
 */
class AnimalController implements IController
{

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function post($request, $response): Response
    {
        $animal = new Animal();
        $data = json_decode($request->getBody()->getContents());
//        $valida = (new AnimalValidate())->validatePost($data);
        $valida = true;
        if ($valida === true) {
            $animal->setCodigoBrinco($data->codigo_brinco);
            $animal->setNomeAnimal($data->nome_animal);
            $animal->setPrimogenito($data->primogenito);
            $animal->setCodigoRaca($data->codigo_raca);
            $animal->setDataNascimento($data->data_nascimento);
            $animal->setFkPesagem($data->id_pesagem);
            $animal->setFkLote($data->id_lote);
            $animal->setFkFazenda($data->id_fazenda);

            return View::render($response, $animal->cadastrar($request), 201, "Cadastro efetuado com sucesso!");
        } else {
            return View::render($response, $valida, 400, "Parametros invalidos.");
        }
//        return View::render($response, [$request->getBody()->getContents()]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     * @throws \Exception
     */
    public function get(Request $request, Response $response, $args): Response
    {
        $animal = new Animal();

        try{
            $page = (int)$request->getQueryParam('pagina');
            if ($request->getAttribute('id')) {
                $animal->setId($request->getAttribute('id'));
            } else if ($request->getAttribute('nome')) {
                $animal->setNomeAnimal($request->getAttribute('nome'));
            }
            return View::render($response, $animal->pesquisar($page));
        }catch (Exception $exception) {
            $response->getBody()->write($exception);
            $response->withStatus(500, $exception);
            return $response;
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function put(Request $request, Response $response): Response
    {
        $animal = new Animal();
        $data = json_encode($request->getBody()->getContents());
        if (isset($data->id)) {
            $data = (new DataConversor())->converter();
            $animal->setIdAnimal($data->id);
            if (isset($data->codigo_brinco)) {
                $animal->setCodigoBrinco($data->codigo_brinco);
            }
            if (isset($data->codigo_raca)) {
                $animal->setCodigoRaca($data->codigo_raca);
            }
            if (isset($data->nome)) {
                $animal->setNomeAnimal($data->nome);
            }
            if (isset($data->data_nascimento)) {
                $animal->setDataNascimento($data->data_nascimento);
            }
            if (isset($data->id_pesagem)) {
                $animal->setFkPesagem($data->id_pesagem);
            }

            if (isset($data->id_lote)) {
                $animal->setFkLote($data->id_lote);
            }
            if (isset($data->id_fazenda)) {
                $animal->setFkFazenda($data->id_fazenda);
            }
           return View::render($response, $animal->alterar());
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function delete(Request $request, Response $response): Response
    {
        $animal = new Animal();
        if (isset($param['idAnimal'])) {
            $animal->setIdAnimal($param['idAnimal']);
            View::render($animal->deletar());
        }
    }
}