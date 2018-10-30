<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 28/08/2018
 * Time: 06:36
 */

namespace CalfManager\Controller;


use CalfManager\Model\Pessoa;
use CalfManager\Utils\Validate\PessoaValidate;
use CalfManager\View\View;
use Exception;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PessoaController implements IController
{
    public function post(Request $request, Response $response): Response
    {
        try{
            $pessoa = new Pessoa();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new PessoaValidate())->validatePost((array)$data);
            if($valida === true){
                $pessoa->setNome($data->nome);
                $pessoa->setRg($data->rg);
                $pessoa->setCpf($data->cpf);
                $pessoa->setSexo($data->sexo);
                $pessoa->setNumeroTelefone($data->numero_telefone);
                $pessoa->setDataNascimento($data->data_nascimento);
                $pessoa->getEndereco()->setId($data->endereco->id);

                if($id = $pessoa->cadastrar()){
                    return View::renderMessage(
                        $response,
                        "success",
                        "Pessoa cadastrado com sucesso!",
                        201,
                        "Sucesso ao cadastrar"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao cadastrar pessoa!",
                        500,
                        "Erro ao cadastrar"
                    );
                }
            } else {
                return View::renderMessage($response, 'warning', $valida, 400, "Erro ao validar");
            }
        }catch (Exception $e) {
            return View::renderException($response, $e);
        }

    }

    public function get(Request $request, Response $response, array $args): Response
    {
        try{
            $pessoa = new Pessoa();
            $page = (int) $request->getQueryParam('pagina');
            if ($request->getAttribute('id')) {
                $pessoa->setId($request->getAttribute('id'));
            }
            if ($request->getQueryParam('nome')) {
                $pessoa->setNome($request->getQueryParam('nome'));
            }
            if ($request->getQueryParam('endereco->id')) {
                $pessoa->getEndereco()->setId($request->getQueryParam('endereco->id'));
            }
            return View::render($response, $pessoa->pesquisar($page));
        }catch (Exception $e){
            return View::renderException($response, $e);
        }

    }

    public function put(Request $request, Response $response): Response
    {
        try{
            $pessoa = new Pessoa();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new PessoaValidate())->validatePost((array)$data);
            if($valida === true){
                $pessoa->setId($request->getAttribute('id'));
                if($data->nome) {
                    $pessoa->setNome($data->nome);
                }
                if($data->rg) {
                    $pessoa->setRg($data->rg);
                }
                if($data->cpf) {
                    $pessoa->setCpf($data->cpf);
                }
                if($data->sexo) {
                    $pessoa->setSexo($data->sexo);
                }
                if($data->numero_telefone) {
                    $pessoa->setNumeroTelefone($data->numero_telefone);
                }
                if($data->data_nascimento) {
                    $pessoa->setDataNascimento($data->data_nascimento);
                }
                if($data->endereco->id) {
                    $pessoa->getEndereco()->setId($data->endereco->id);
                }

                if($id = $pessoa->alterar()){
                    return View::renderMessage(
                        $response,
                        "success",
                        "Pessoa alterada com sucesso!",
                        201,
                        "Sucesso ao alterar!"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao alterar pessoa!",
                        500,
                        "Erro ao alterar"
                    );
                }
            } else {
                return View::renderMessage($response, 'warning', $valida, 400);
            }
        }catch (Exception $e) {
            return View::renderException($response, $e);
        }


    }

    public function delete(Request $request, Response $response): Response
    {
        try {
            $pessoa = new Pessoa();
            if ($request->getAttribute('id')) {
                $pessoa->setId($request->getAttribute('id'));
                if ($pessoa->deletar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Pessoa excluída com sucesso!",
                        202,
                        "Sucesso ao excluir"
                    );
                }else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao excluir pessoa!",
                        500,
                        "Erro ao excluir"
                    );
                }
            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }

}