<?php

namespace CalfManager\Controller;

use CalfManager\Utils\TokenApp;
use Exception;
use CalfManager\Model\Animal as Animal;
use CalfManager\Utils\Validate\AnimalValidate;
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
                if($data->codigo_brinco) {
                    $animal->setCodigoBrinco($data->codigo_brinco);
                }else{
                    $animal->setCodigoBrinco("não informado");
                }
                if ($data->codigo_raca != null) {
                    $animal->setCodigoRaca($data->codigo_raca);
                }else{
                    $animal->setCodigoRaca("não informado");
                }
                $animal->setDataNascimento($data->data_nascimento);
                $animal->setFaseDaVida($data->fase_vida);
                $animal->getLote()->setId($data->lotes_id);
                if ($data->doencas) {
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
                $animal->getFazenda()->setId($data->fazendas_id);
                $animal->setVivo($data->is_vivo);
                $animal->setPrimogenito($data->is_primogenito);
                $animal->getPesagem()->setPeso($data->pesagens->peso);
                $animal->getPesagem()->setDataPesagem($data->pesagens->data_pesagem);
                $animal->getHemograma()->setPpt($data->hemogramas->ppt);
                $animal->getHemograma()->setHematocrito($data->hemogramas->hematocrito);
                $animal->getHemograma()->getFuncionario()->setId($data->hemogramas->funcionario_id);
                $animal->getHemograma()->setData($data->hemogramas->data);

//                Adicionando id de usuario logado
                $animal->getHemograma()->getUsuarioCadastro()->setId($data->usuario_cadastro);
                $animal->getPesagem()->getUsuarioCadastro()->setId($data->usuario_cadastro);
                $animal->getUsuarioCadastro()->setId($data->usuario_cadastro);
                if ($animal->cadastrar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Animal cadastrado com sucesso!",
                        201,
                        "Sucesso ao cadastrar",
                        $animal->getId()
                    );
                }

                return View::renderMessage(
                    $response,
                    "error",
                    "Erro ao cadastrar animal!",
                    500,
                    "Erro ao cadastrar"
                );

            }
//
            return View::renderMessage($response, 'warning', $valida, 400);
//
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
//        if(TokenApp::validaToken()) {
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
                } elseif ($request->getQueryParam('nome')) {
                    $animal->setNome($request->getQueryParam('nome'));
                } elseif ($request->getQueryParam('lote')) {
                    $animal->getLote()->setId($request->getQueryParam('lote'));
                }
                if ($request->getQueryParam('doente') == 'true') {
                    $animal->setDoente(true);
                }
                if($request->getQueryParam('contagem') == 'true'){
                    $animal->setContagem(true);
                }
                if($request->getQueryParam('contagemDoente') == 'true'){
                    $animal->setContagemDoentes(true);
                }
                if($request->getQueryParam('contagemMortos') == 'true') {
                    $animal->setContagemMortos(true);
                }
                if($request->getQueryParam('lotes_id')){
                    $animal->getLote()->setId($request->getQueryParam('lotes_id'));
                }
                $search = $animal->pesquisar($page);
                return View::render($response, $search);
            } catch (Exception $exception) {
                return View::renderException($response, $exception);
            }
//        }else {
//            return View::renderMessage($response, 'error','Sem Autorização!','404', 'sem autorizacao');
//        }
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
        $valida = (new AnimalValidate())->validatePut((array)$data);
        $animal->setId($request->getAttribute('id'));
        if ($data->is_vivo == false) {
            $animal->setVivo($data->is_vivo);
            if($animal->alterar()) {
                return View::renderMessage(
                    $response,
                    "success",
                    "Morte registrada com sucesso! ",
                    203,
                    "Sucesso ao cadastrar morte"
                );
            }
            return View::renderMessage(
                $response,
                "error",
                "Erro ao registrar morte!",
                500,
                "Erro ao cadastrar morte"
            );
        }
        if ($valida === true) {
            $animal->setId($request->getAttribute('id'));
            if (!is_null($data->nome)) {
                $animal->setNome($data->nome);
            }
            if (!is_null($data->sexo)) {
                $animal->setSexo($data->sexo);
            }
            if (!is_null($data->codigo_brinco)) {
                $animal->setCodigoBrinco($data->codigo_brinco);
            }
            if (!is_null($data->codigo_raca)) {
                $animal->setCodigoRaca($data->codigo_raca);
            }
            if (!is_null($data->data_nascimento)) {
                $animal->setDataNascimento($data->data_nascimento);
            }
            if (!is_null($data->lotes_id)) {
                $animal->getLote()->setId($data->lotes_id);
            }
            if (!is_null($data->doencas)) {
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
            if (!is_null($data->fazendas_id)) {
                $animal->getFazenda()->setId($data->fazendas_id);
            }
            if (!is_null($data->fase_vida)) {
                $animal->setFaseDaVida($data->fase_vida);
            }
            if (!is_null($data->is_primogenito)) {
                $animal->setPrimogenito($data->is_primogenito);
            }
            if (!is_null($data->is_vivo)) {
                $animal->setVivo($data->is_vivo);
            }
            if (!is_null($data->pesagens->peso)) {
                $animal->getPesagem()->setPeso($data->pesagens->peso);
            }
            if (!is_null($data->pesagens->data)) {
                $animal->getPesagem()->setDataPesagem($data->pesagens->data);
            }
            if (!is_null($data->hemogramas->ppt)) {
                $animal->getHemograma()->setPpt($data->hemogramas->ppt);
            }
            if (!is_null($data->hemogramas->hematocrito)) {
                $animal->getHemograma()->setHematocrito($data->hemogramas->hematocrito);
            }
            if (!is_null($data->hemogramas->data)) {
                $animal->getHemograma()->setData($data->hemogramas->data);
            }
            if(!is_null($data->hemogramas->funcionario_id)){
                $animal->getHemograma()->getFuncionario()->setId($data->hemogramas->funcionario_id);
            }
//            Adicionando id de usuário logado
            $animal->getHemograma()->getUsuarioAlteracao()->setId($data->usuario_cadastro);
            $animal->getPesagem()->getUsuarioAlteracao()->setId($data->usuario_cadastro);
            $animal->getUsuarioAlteracao()->setId($data->usuario_cadastro);
            if($animal->alterar()) {
                return View::renderMessage(
                    $response,
                    "success",
                    "Animal alterado com sucesso! ",
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
