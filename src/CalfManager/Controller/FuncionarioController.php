<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 08/09/2018
 * Time: 21:36
 */

namespace CalfManager\Controller;


use CalfManager\Model\Funcionario;
use CalfManager\Utils\TokenApp;
use CalfManager\Utils\Validate\FuncionarioValidate;
use CalfManager\View\View;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class FuncionarioController implements IController
{
    public function post(Request $request, Response $response): Response
    {
        if(TokenApp::validaToken()) {
            try {
                $funcionario = new Funcionario();
                $data = json_decode($request->getBody()->getContents());
                $valida = (new FuncionarioValidate())->validatePost((array)$data);
                if ($valida === true) {
                    $funcionario->setSalario($data->salario);
                    $funcionario->getCargo()->setId($data->cargo_id);
                    $funcionario->getFazenda()->setId($data->fazenda_id);
                    $funcionario->getPessoa()->setId($data->pessoa_id);

                    $funcionario->getUsuarioCadastro()->setId($data->usuario_cadastro);
                    if ($funcionario->cadastrar()) {
                        return View::renderMessage(
                            $response,
                            "success",
                            "Funcionário cadastrado com sucesso!",
                            201,
                            "Sucesso ao cadastrar"
                        );
                    } else {
                        return View::renderMessage(
                            $response,
                            "error",
                            "Erro ao cadastrar funcionário",
                            500,
                            "Erro ao cadastrar"
                        );
                    }
                } else {
                    return View::renderMessage(
                        $response,
                        'warning',
                        $valida,
                        400,
                        "Erro ao validar"
                    );
                }
            } catch (Exception $e) {
                return View::renderException($response, $e);
            }
        }
    }

    public function get(Request $request, Response $response, array $args): Response
    {
        if(TokenApp::validaToken()) {
            try {
                $funcionario = new Funcionario();
                $page = (int)$request->getQueryParam('pagina');
                if ($request->getAttribute('id')) {
                    $funcionario->setId($request->getAttribute('id'));
                }
                if ($request->getQueryParam('cargo_id')) {
                    $funcionario->getCargo()->setId($request->getQueryParam('cargo_id'));
                }
                if ($request->getQueryParam('fazenda_id')) {
                    $funcionario->getFazenda()->setId($request->getQueryParam('fazenda_id'));
                }
                if ($request->getQueryParam('pessoa_id')) {
                    $funcionario->getPessoa()->setId($request->getQueryParam('pessoa_id'));
                }
                if ($request->getQueryParam('nome')) {
                    $funcionario->getPessoa()->setNome($request->getQueryParam('nome'));
                }
                $search = $funcionario->pesquisar($page);
                return View::render($response, $search);
            } catch (Exception $e) {
                return View::renderException($response, $e);
            }
        }
    }

    public function put(Request $request, Response $response): Response
    {
        if(TokenApp::validaToken()) {
            try {
                $funcionario = new Funcionario();
                $data = json_decode($request->getBody()->getContents());
                $valida = (new FuncionarioValidate())->validatePut((array)$data);
                if ($valida === true) {
                    $funcionario->setId($request->getAttribute('id'));
                    if (!is_null($data->salario)) {
                        $funcionario->setSalario($data->salario);
                    }
                    if (!is_null($data->cargo_id)) {
                        $funcionario->getCargo()->setId($data->cargo_id);
                    }
                    if (!is_null($data->fazenda_id)) {
                        $funcionario->getFazenda()->setId($data->fazenda_id);
                    }
                    if (!is_null($data->pessoa_id)) {
                        $funcionario->getPessoa()->setId($data->pessoa_id);
                    }

                    $funcionario->getUsuarioAlteracao()->setId($data->usuario_cadastro);
                    if ($funcionario->alterar()) {
                        return View::renderMessage(
                            $response,
                            "success",
                            "Funcionario alterado com sucesso!",
                            202,
                            "Sucesso ao alterar"
                        );
                    } else {
                        return View::renderMessage(
                            $response,
                            "error",
                            "Erro ao alterar cadastro de funcionário",
                            500,
                            "Erro ao alterar"
                        );
                    }
                } else {
                    return View::renderMessage(
                        $response,
                        'warning',
                        $valida,
                        400,
                        "Erro ao validar"
                    );
                }
            } catch (Exception $e) {
                return View::renderException($response, $e);
            }
        }
    }

    public function delete(Request $request, Response $response): Response
    {
        if(TokenApp::validaToken()) {
            try {
                $funcionario = new Funcionario();
                if ($request->getAttribute('id')) {
                    $funcionario->setId($request->getAttribute('id'));

                    if ($funcionario->deletar()) {
                        return View::renderMessage(
                            $response,
                            "success",
                            "Funcionario excluído com sucesso!",
                            202,
                            "Sucesso ao excluir"
                        );
                    } else {
                        return View::renderMessage(
                            $response,
                            "error",
                            "Erro ao excluir funcionário",
                            500,
                            "Erro ao excluir"
                        );
                    }
                }
            } catch (Exception $e) {
                return View::renderException($response, $e);
            }
        }
    }

}