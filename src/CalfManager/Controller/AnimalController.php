<?php

namespace CalfManager\Controller;

use CalfManager\Model\Dose;
use Exception;
use CalfManager\Model\Animal as Animal;
use CalfManager\Utils\validate\AnimalValidate;
use CalfManager\View\View;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

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
            $valida = (new AnimalValidate())->validatePost((array)$data);
            if ($valida === true) {
                $animal->setNome($data->nome);
                $animal->setSexo($data->sexo);
                $animal->setCodigoBrinco($data->codigo_brinco);
                if($data->codigo_raca != null){
                    $animal->setCodigoRaca($data->codigo_raca);
                }
                $animal->setDataNascimento($data->data_nascimento);
                $animal->setFaseDaVida($data->fase_vida);
                $animal->getLote()->setId($data->lote->id);
                if($data->doencas) {
                    foreach ($data->doencas as $doenca) {
                        $animal->adicionarDoenca($doenca->id, $doenca->situacao);
                    }
                }
                if ($data->pai != null) {
                    $animal->setPai(new Animal());
                    $animal->getPai()->setId($data->pai);
                };
                if ($data->mae != null) {
                    $animal->setMae(new Animal());
                    $animal->getMae()->setId($data->mae);
                }
                $animal->setVivo($data->is_vivo);
                $animal->setPrimogenito($data->is_primogenito);
                $animal->getPesagem()->setPeso($data->pesagem->peso);
                $animal->getPesagem()->setDataPesagem($data->pesagem->data);
                $animal->getHemograma()->setPpt($data->hemograma->ppt);
                $animal->getHemograma()->setHematocrito($data->hemograma->hematocrito);
                $animal->getHemograma()->setData($data->hemograma->data);
                if($animal->cadastrar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Animal cadastrado com sucesso! ID cadastrado: ",
                        201,
                        "Sucesso ao cadastrar"
                    );
                }
                else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao cadastrar animal!",
                        500,
                        "Erro ao cadastrar"
                    );
                }
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
    public function get(
        Request $request,
        Response $response,
        array $args
    ): Response
    {
        try {
            $animal = new Animal();
            $page = (int)$request->getQueryParam('pagina');

            if ($request->getQueryParam('vivo') == 'false') {
                $animal->setVivo(false);
            }
            if ($request->getQueryParam('vivo') == 'true') {
                $animal->setVivo(true);
            }
            if ($request->getQueryParam('sexo') == 'm' || $request->getQueryParam('sexo') == 'M') {
                $animal->setSexo('M');
            }
            if ($request->getQueryParam('sexo') == 'f' || $request->getQueryParam('sexo') == 'F') {
                $animal->setSexo('F');
            }
            if ($request->getAttribute('id')) {
                $animal->setId($request->getAttribute('id'));
            }
            elseif ($request->getQueryParam('nome')) {
                $animal->setNome($request->getQueryParam('nome'));
            }
            elseif ($request->getQueryParam('lote')) {
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
        $valida = (new AnimalValidate())->validatePost((array)$data);
        if ($valida === true) {
            $animal->setId($request->getAttribute('id'));
            $animal->setNome($data->nome);
            $animal->setSexo($data->sexo);
            $animal->setCodigoBrinco($data->codigo_brinco);
            $animal->setCodigoRaca($data->codigo_raca);
            $animal->setDataNascimento($data->data_nascimento);
            $animal->getLote()->setId($data->lote->id);
            if($data->doencas) {
                foreach ($data->doencas as $doenca) {
                    $animal->adicionarDoenca($doenca->id, $doenca->situacao);
                }
            }
            if ($data->pai != null) {
                $animal->setPai(new Animal());
                $animal->getPai()->setId($data->pai->id);
            };
            if ($data->mae != null) {
                $animal->setMae(new Animal());
                $animal->getMae()->setId($data->mae->id);
            }
            $animal->setFaseDaVida($data->fase_vida);
            $animal->setPrimogenito($data->is_primogenito);
            $animal->setVivo($data->is_vivo);
            $animal->getPesagem()->setPeso($data->pesagem->peso);
            $animal->getPesagem()->setDataPesagem($data->pesagem->data);
            $animal->getHemograma()->setPpt($data->hemograma->ppt);
            $animal->getHemograma()->setHematocrito($data->hemograma->hematocrito);
            $animal->getHemograma()->setData($data->hemograma->data);
            if($animal->alterar()) {
                return View::renderMessage(
                    $response,
                    "success",
                    "Animal alterado com sucesso! ID cadastrado: ",
                    201,
                    "Sucesso ao cadastrar"
                );
            }
            else {
                return View::renderMessage(
                    $response,
                    "error",
                    "Erro ao alterar animal!",
                    500,
                    "Erro ao alterar"
                );
            }
        } else {
            return View::renderMessage($response, 'warning', $valida, 400);
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
                    return View::renderMessage(
                        $response,
                        "success",
                        "Animal excluído com sucesso!",
                        202,
                        "Sucesso ao excluir"
                    );
                }
            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }
}
