<?php
/**
 * Created by PhpStorm.
 * User: Márcio Lucas
 * Date: 12/09/2017
 * Time: 23:50
 */

namespace src\controller;

use Exception;
use src\model\Animal;
use src\model\Doenca;
use src\util\validate\AnimalValidate;
use src\view\View;
use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Tebru\Gson\Gson;

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
    public function post(Request $request, Response $response): Response
    {
        try {
            $animal = new Animal();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new AnimalValidate())->validatePost((array) $data);
            if ($valida === true) {
                $animal->setCodigoBrinco($data->codigo_brinco);
                $animal->setNome($data->codigo_brinco);
                $animal->setCodigoRaca($data->codigo_raca);
                $animal->setDataNascimento($data->data_nascimento);
                $animal->getLote()->setId(1);
                foreach ($data->doencas as $doenca) {
                    $animal->adicionarDoenca($doenca->id, $doenca->situacao);
                }
                $animal->getFazenda()->setId($data->fazenda->id);
                $animal->setVivo($data->is_vivo);
                $animal->getPesagem()->setPeso($data->pesagem->peso);
                $animal->getPesagem()->setDataPesagem($data->pesagem->data);
                $idCadastrado = $animal->cadastrar();
                return View::renderMessage($response,
                    "success", "Animal cadastrado com sucesso! ID cadastrado: " . $idCadastrado,
                    201, "Sucesso ao cadastrar");
            } else {
                return View::renderMessage($response, 'warning', $valida, 400);
            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     * @throws Exception
     */
    public function get(Request $request, Response $response, array $args): Response
    {
        try {
            $animal = new Animal();
            $page = (int) $request->getQueryParam('pagina');

            if ($request->getQueryParam('vivo') == 'false') {
                $animal->setVivo(false);
            }
            if ($request->getQueryParam('vivo') == 'true') {
                $animal->setVivo(true);
            }
            if ($request->getQueryParam('sexo') == 'm'
                || $request->getQueryParam('sexo') == 'M') {
                $animal->setSexo('M');
            }
            if ($request->getQueryParam('sexo') == 'f'
                || $request->getQueryParam('sexo') == 'F') {
                $animal->setSexo('F');
            }

            if ($request->getAttribute('id')) {
                $animal->setId($request->getAttribute('id'));

            } else if ($request->getQueryParam('nome')) {
                $animal->setNome($request->getQueryParam('nome'));

            } else if ($request->getQueryParam('lote')) {
                $animal->getLote()->setId($request->getQueryParam('lote'));
            }
            $search = $animal->pesquisar($page);
            return View::render($response, $search);
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
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
        $animal = new Animal();
        $data = json_decode($request->getBody()->getContents());
        if ($request->getAttribute('id')) {
            $animal->setId($request->getAttribute('id'));
            if (isset($data->codigo_brinco)) {
                $animal->setCodigoBrinco($data->codigo_brinco);
            }
            if (isset($data->codigo_raca)) {
                $animal->setCodigoRaca($data->codigo_raca);
            }
            if (isset($data->nome)) {
                $animal->setNome($data->nome);
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
            try {
                if ($animal->alterar()) {
                    return View::renderMessage($response,
                        "success", "Animal alterado com sucesso! ",
                        202, "Sucesso ao alterar");
                } else {
                    return View::renderMessage($response, 'error', "Erro ao tentar mudar animal", 503);
                }
            } catch (Exception $exception) {
                return View::renderException($response, $exception);
            }
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
        try {
            $animal = new Animal();
            if ($request->getAttribute('id')) {
                $animal->setId($request->getAttribute('id'));
                if ($animal->deletar()) {
                    return View::renderMessage($response, "success", "Animal desativado com sucesso!", 202,
                        "Sucesso ao desativar");
                };
            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }
}
