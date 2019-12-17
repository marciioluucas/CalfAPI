<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 12/09/2018
 * Time: 17:43
 */

namespace CalfManager\Controller;


use CalfManager\Model\Dose;
use CalfManager\Controller\DTO\DoseDTO;
use CalfManager\Utils\TokenApp;
use CalfManager\Utils\Validate\DoseValidate;
use CalfManager\Utils\TipoMovimentacao;
use CalfManager\View\View;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class DoseController implements IController
{
    public function post(Request $request, Response $response): Response
    {  
        try{
//            if(TokenApp::validaToken()){
                $data = json_decode($request->getBody()->getContents());
                $valida = (new DoseValidate())->validatePost((array)$data);

                $dose = new Dose();
                if ($valida === true) 
                {
                    $dose->setQuantidadeMg($data->quantidade_mg);
                    $dose->getFuncionario()->setId($data->funcionario_id);
                    $dose->getMedicamento()->setId($data->medicamento_id);

                    if($data->tipo_movimentacao == 'saida')
                    {
                        $dose->setTipoMovimentacao(TipoMovimentacao::SAIDA);
                        $dose->getAnimal()->setId($data->animal_id);
                    }
                    else
                    {
                        $dose->setTipoMovimentacao(TipoMovimentacao::ENTRADA);
                        $dose->setQuantidadeUnidade($data->quantidade_unidade);
                    }

                    $dose->getUsuarioCadastro()->setId($data->usuario_cadastro);
                    if ($dose->cadastrar()) {
                        if($data->tipo_movimentacao == 'saida')
                        {
                            return View::renderMessage($response,
                                                        "success",
                                                        "Dose aplicada com sucesso!",
                                                        201,
                                                        "Sucesso ao cadastrar");
                        }
                        else
                        {
                             return View::renderMessage($response,
                                                        "success",
                                                        "Entrada registrada com sucesso!",
                                                        201,
                                                        "Sucesso ao cadastrar");                             
                        }
                    } 
                    else
                    {
                        return View::renderMessage($response,
                                                    "error",
                                                    "Erro ao cadastrar dose aplicada",
                                                    500,
                                                    "Erro ao cadastrar");
                    }
                }
            }
//            else
//            {
//                return View::renderMessage($response, 
//                                            "Error", 
//                                            "Sem autorização", 
//                                            401);
//            }
        
        catch (Exception $e)
        {
           return View::renderMessage($response, 
                                        'error',
                                        $e->getMessage(),
                                        $e->getCode() == null? 500 
                                        : $e->getCode());
        }
    }
    
    public function get(Request $request, Response $response, array $args): Response
    {
        try {
//                if(TokenApp::validaToken()) {
                $page = (int)$request->getQueryParam('pagina');
                $dose = new Dose();

                if ($request->getAttribute('id')) {
                    $dose->setId($request->getAttribute('id'));
                }
                if ($request->getQueryParam('medicamento_id')) {
                    $dose->getMedicamento()->setId($request->getQueryParam('medicamento_id'));
                }
                if ($request->getQueryParam('animal_id')) {
                    $dose->getAnimal()->setId($request->getQueryParam('animal_id'));
                }
                if($request->getQueryParam("tipo_movimentacao")){
                    $dose->setTipoMovimentacao(TipoMovimentacao::SAIDA);
                }
                if($request->getQueryParam("saldo_medicamento_id")){
                    $result = $dose->pesquisarSaldoEstoque($request->getQueryParam("saldo_medicamento_id"));
                    return View::render($response, $result);
                }
//            if ($request>getQueryParam('funcionario_id')){
//                $dose->getFuncionario()->setId($request>getQueryParam('funcionario_id'));
//            }
                $search = $dose->pesquisar($page);
                return View::render($response, $search);
//            }
        } catch (Exception $e) {
            return View::renderMessage($response, 
                                        'error',
                                        $e->getMessage(),
                                        $e->getCode() == null? 500 
                                        : $e->getCode());
        }

    }

    public function put(Request $request, Response $response): Response
    {
        if(TokenApp::validaToken()) {
            $data = json_decode($request->getBody()->getContents());
            $valida = (new DoseValidate())->validatePut((array)$data);
            try {
                $dose = new Dose();
                if ($valida === true) {
                    $dose->setId($request->getAttribute('id'));
                    if (!is_null($data->quantidade_mg)) {
                        $dose->setQuantidadeMg($data->quantidade_mg);
                    }
                    if (!is_null($data->medicamento_id)) {
                        $dose->getMedicamento()->setId($data->medicamento_id);
                    }
                    
                    if($data->tipo_movimentacao == 'saida')
                    {
                        $dose->setTipoMovimentacao(TipoMovimentacao::SAIDA);
                        $dose->getAnimal()->setId($data->animal_id);
                    }
                    else
                    {
                        $dose->setTipoMovimentacao(TipoMovimentacao::ENTRADA);
                        $dose->setQuantidadeUnidade($data->unidade_quantidade);
                    }
                    
                    if (!is_null($data->funcionario_id)) {
                        $dose->getFuncionario()->setId($data->funcionario_id);
                    }

                    $dose->getUsuarioAlteracao()->setId($data->usuario_cadastro);
                    if ($dose->alterar()) {
                        return View::renderMessage(
                            $response,
                            "success",
                            "Dose aplicada alterada com sucesso!",
                            200,
                            "sucesso ao alterar"
                        );
                    } else {
                        return View::renderMessage(
                            $response,
                            "error",
                            "Erro ao alterar dose aplicada",
                            500,
                            "erro ao alterar"
                        );
                    }
                } else {
                    return View::renderMessage(
                        $response,
                        "warning",
                        $valida,
                        400,
                        "Erro ao validar"
                    );
                }
            } catch (Exception $e) {
                return View::renderMessage($response, 
                                            'error', 
                                            $e->getMessage(), 
                                            $e->getCode() == null? 500 
                                            : $e->getCode());
            }
        }
    }

    public function delete(Request $request, Response $response): Response
    {
        if (TokenApp::validaToken()) {
            try {
                $dose = new Dose();
                if ($request->getAttribute('id')) {
                    $dose->setId($request->getAttribute('id'));

                    if ($dose->deletar()) {
                        return View::renderMessage(
                            $response,
                            "success",
                            "Dose aplicada excluída com sucesso!",
                            201,
                            "Sucesso ao excluir"
                        );
                    } else {
                        return View::renderMessage(
                            $response,
                            "error",
                            "Erro ao excluir dose aplicada",
                            400,
                            "Erro ao excluir"
                        );
                    }
                }
            } catch (Exception $e) {
                return View::renderMessage($response, 
                                            'error', 
                                            $e->getMessage(), 
                                            $e->getCode() == null? 500 
                                            : $e->getCode());
            }
        }
    }

}