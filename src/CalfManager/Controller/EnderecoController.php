<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 05/09/2018
 * Time: 13:32
 */

namespace CalfManager\Controller;


use CalfManager\Model\Endereco;
use CalfManager\Utils\Validate\EnderecoValidate;
use CalfManager\View\View;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class EnderecoController implements IController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function post(Request $request, Response $response): Response
    {
        try{
           $endereco = new Endereco();
           $data = json_decode($request->getBody()->getContents());
           $valida = (new EnderecoValidate())->validatePost((array)$data);
           if($valida === true){
               $endereco->setLogradouro($data->logradouro);
               $endereco->setNumero($data->numero);
               $endereco->setBairro($data->bairro);
               $endereco->setCidade($data->cidade);
               $endereco->setEstado($data->estado);
               $endereco->setPais($data->pais);
               $endereco->setCep($data->cep);

               if($id = $endereco->cadastrar()) {
                   return View::renderMessage(
                       $response,
                       "success",
                       "Endereço cadastrado com sucesso!",
                       201,
                       "Sucesso ao cadastrar",
                       $id
                   );
               } else {
                   return View::renderMessage(
                       $response,
                       "error",
                       "Erro ao cadastrar endereço!",
                       500,
                       "Erro ao cadastrar"
                   );
               }
           }else{
               return View::renderMessage(
                   $response,
                   "warning",
                   $valida,
                   400,
                   "Erro ao Validar"
               );
           }
        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function get(Request $request, Response $response, array $args): Response
    {
        try {
            $endereco = new Endereco();
            $page = (int) $request->getQueryParam('pagina');

            if ($request->getAttribute('id')) {
                $endereco->setId($request->getAttribute('id'));
            }
            if($request->getQueryParam('logradouro')){
                $endereco->setLogradouro($request->getQueryParam('logradouro'));
            }
            $search = $endereco->pesquisar($page);
            return View::render($response, $search);
        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function put(Request $request, Response $response): Response
    {
        try{
            $endereco = new Endereco();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new EnderecoValidate())->validatePost((array)$data);
            if($valida){
                $endereco->setId($request->getAttribute('id'));
                if(!is_null($data->logradouro)){
                    $endereco->setLogradouro($data->lograouro);
                }
                if(!is_null($data->numero)){
                    $endereco->setNumero($data->numero);
                }
                if(!is_null($data->bairro)) {
                    $endereco->setBairro($data->bairro);
                }
                if(!is_null($data->cidade)) {
                    $endereco->setCidade($data->cidade);
                }
                if(!is_null($data->estado)) {
                    $endereco->setEstado($data->estado);
                }
                if(!is_null($data->pais)) {
                    $endereco->setPais($data->pais);
                }
                if(!is_null($data->cep)) {
                    $endereco->setCep($data->cep);
                }
                if($endereco->alterar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Endereço alterado com sucesso!",
                        201,
                        "Sucesso ao alterar"
                    );
                } else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao alterar endereço!",
                        500,
                        "Erro ao alterar"
                    );
                }
            }else{
                return View::renderMessage($response, "warning", $valida, 400, "Erro ao validar");
            }
        }catch (Exception $e){
            return View::renderException($response, $e);
        }    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function delete(Request $request, Response $response): Response
    {
        try{
            $endereco = new Endereco();
            if($request->getAttribute('id')) {
                $endereco->setId($request->getAttribute('id'));
                if ($endereco->deletar()) {
                    return View::renderMessage($response,
                        "success",
                        "Endereço excluído com sucesso!",
                        201,
                        "Sucesso ao excluir");
                }
                else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao excluir endereço!",
                        500,
                        "Erro ao excluir"
                    );
                }
            }
        }catch (Exception $e) {
            return View::renderException($response, $e);
        }
    }

}