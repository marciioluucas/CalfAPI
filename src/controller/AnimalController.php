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
    public function post($request, $response)
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
    public function get($request, $response, $args)
    {
        $animal = new Animal();
        try{
            return View::render($response, $animal->pesquisar($request));
        }catch (Exception $exception) {
            $response->getBody()->write($exception);
            $response->withStatus(500, $exception);
            return $response;
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function put($request, $response)
    {

        $animal = new Animal();
        if (isset($param['idAnimal'])) {
            $data = (new DataConversor())->converter();
            $animal->setIdAnimal($param['idAnimal']);
            if (isset($data['codigoBrinco'])) {
                $animal->setCodigoBrinco($data['codigoBrinco']);
            }
            if (isset($data['codigoRaca'])) {
                $animal->setCodigoRaca($data['codigoRaca']);
            }
            if (isset($data['nomeAnimal'])) {
                $animal->setNomeAnimal($data['nomeAnimal']);
            }
            if (isset($data['dataNascimento'])) {
                $animal->setDataNascimento($data['dataNascimento']);
            }
            if (isset($data['fkPesagem'])) {
                $animal->setFkPesagem($data['fkPesagem']);
            }
            if (isset($data['fkMae'])) {
                $animal->setFkMae($data['fkMae']);
            }
            if (isset($data['fkPai'])) {
                $animal->setFkPai($data['fkPai']);
            }
            if (isset($data['fkLote'])) {
                $animal->setFkLote($data['fkLote']);
            }
            if (isset($data['fkFazenda'])) {
                $animal->setFkFazenda($data['fkFazenda']);
            }
            View::render($animal->alterar());
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function delete(Request $request, Response $response)
    {
        $animal = new Animal();
        if (isset($param['idAnimal'])) {
            $animal->setIdAnimal($param['idAnimal']);
            View::render($animal->deletar());
        }
    }
}