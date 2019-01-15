<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 02/09/2018
 * Time: 21:44
 */

namespace CalfManager\Controller;

use CalfManager\Model\Permissao;
use CalfManager\Utils\Validate\PermissaoValidade;
use CalfManager\View\View;
use Exception;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PermissaoController implements IController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function post(Request $request, Response $response): Response
    {
        try {
            $permissao = new Permissao();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new PermissaoValidade())->validatePost((array)$data);
            if ($valida === true) {
                $permissao->setNomeModulo($data->nome_modulo);
                $permissao->setCreate($data->create);
                $permissao->setRead($data->read);
                $permissao->setUpdate($data->update);
                $permissao->setDelete($data->delete);

                $permissao->getGrupo()->setId($data->grupo_id);

                if ($permissao->cadastrar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Permissão cadastrada com sucesso!",
                        201,
                        "Sucesso ao cadastrar"
                    );
                } else {
                    return View::renderMessage($response,
                        "error",
                        "Erro ao cadastrar permissão!",
                        500,
                        "Erro ao cadastrar"
                );
                }

            }
            else {
                return View::renderMessage(
                $response,
                'warning',
                $valida,
                400,
                "Erro ao validar"
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
        try{
            $permissao = new Permissao();
            $page = (int) $request->getQueryParam('pagina');
            if($request->getAttribute('id')){
                $permissao->setId($request->getAttribute('id'));
            }
            if($request->getQueryParam('nome_modulo')){
                $permissao->setNomeModulo($request->getQueryParam('nome_modulo'));
            }
            if($request->getQueryParam('grupo_id')){
                $permissao->getGrupo()->setId($request->getQueryParam('grupo_id'));
            }
            return View::render($response, $permissao->pesquisar($page));
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
        try {
            $permissao = new Permissao();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new PermissaoValidade())->validatePut((array)$data);
            if ($valida === true) {
                $permissao->setId($request->getAttribute('id'));
                if($data->nome_modulo){
                    $permissao->setNomeModulo($data->nome_modulo);
                }
                if($data->create){
                    $permissao->setCreate($data->create);
                }
                if($data->read){
                    $permissao->setRead($data->read);
                }
                if($data->update){
                    $permissao->setUpdate($data->update);
                }
                if($data->delete){
                    $permissao->setDelete($data->delete);
                }
                if($data->grupo_id){
                    $permissao->getGrupo()->setId($data->grupo_id);
                }
                if ($permissao->alterar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                         "Permissão alterada com sucesso!",
                        201,
                        "Sucesso ao alterar"
                    );
                } else {
                    return View::renderMessage($response,
                        "error",
                        "Erro ao alterar permissão!",
                        500,
                        "Erro ao alterar"
                    );
                }

            }
            else {
                return View::renderMessage($response, 'warning', $valida, 400);
            }
        }catch (Exception $e){

            return View::renderException($response, $e);

        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function delete(Request $request, Response $response): Response
    {
        try {
            $permissao = new Permissao();
            if ($request->getAttribute('id')) {
                $permissao->setId($request->getAttribute('id'));

                if ($permissao->deletar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Permissão excluída com sucesso!",
                        202,
                        "Sucesso ao excluir");
                }
                else {
                    return View::renderMessage($response,
                        "error",
                        "Erro ao excluir permissão!",
                        500,
                        "Erro ao excluir"
                    );
                }
            }
        }catch (Exception $e){
            return View::renderException($response, $e);
        }
    }

}