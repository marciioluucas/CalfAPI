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
            $data = json_decode($response->getBody()->getContents());
            $valida = (new PessoaValidate())->validatePost((array)$data);
            if($valida){
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
                        "Sucesso ao cadastrar!"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Pessoa não cadastrada!",
                        500
                    );
                }
            } else {
                return View::renderMessage($response, 'warning', $valida, 400);
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
            } elseif ($request->getQueryParam('nome')) {
                $pessoa->setNome($request->getQueryParam('nome'));
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
            $data = json_decode($response->getBody()->getContents());
            $valida = (new PessoaValidate())->validatePost((array)$data);
            if($valida){
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
                        "Sucesso ao cadastrar!"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Pessoa não cadastrada!",
                        500
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
                }
            }
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
        }
    }

}