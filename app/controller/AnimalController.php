<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 12/09/2017
 * Time: 23:50
 */

namespace controller;


use model\Animal;
use model\validate\AnimalValidate;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\RequestInterface as Request;
use util\Database;
use util\DataConversor;
use view\View;

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
        $data = (new DataConversor())->converter();
        $valida = (new AnimalValidate())->validatePost($data);
        if ($valida === true) {
            $animal->setCodigoBrinco($data['codigoBrinco']);
            $animal->setNomeAnimal($data['nomeAnimal']);
            $animal->setCodigoRaca($data['codigoRaca']);
            $animal->setDataNascimento($data['dataNascimento']);
            $animal->setFkPesagem($data['fkPesagem']);
            $animal->setFkMae($data['fkMae']);
            $animal->setFkPai($data['fkPai']);
            $animal->setFkLote($data['fkLote']);
            $animal->setFkFazenda($data['fkFazenda']);
            return View::render($response, $animal->cadastrar(), 201, "Cadastro efetuado com sucesso!");
        } else {
            return View::render($response, $valida, 400, "Parametros invalidos.");
        }
//        return View::render($response, [$request->getBody()->getContents()]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function get($request, $response)
    {

        $animal = new Animal();
        if (!empty($param)) {
            foreach ($param as $key => $val) {
                $var = "set" . ucfirst($key);
                if (method_exists($animal, 'set' . ucfirst($key))) {
                    $animal->$var($val);
                } else {
                    return View::render($response, [
                        "status" => 400,
                        "message" => "Parametro invalido " . $key
                    ], 400, "Parametro invalido " . $key);
                }
            }
        }
        return View::render($response, $request->getBody());
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
     * @param Response $response
     * @param Response $param
     */
    public function delete(Response $response, $param)
    {
        $animal = new Animal();
        if (isset($param['idAnimal'])) {
            $animal->setIdAnimal($param['idAnimal']);
            View::render($animal->deletar());
        }
    }
}