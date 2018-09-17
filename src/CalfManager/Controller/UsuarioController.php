<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 12/09/2018
 * Time: 22:05
 */

namespace CalfManager\Controller;


use CalfManager\Model\Usuario;
use CalfManager\Utils\Validate\UsuarioValidate;
use CalfManager\View\View;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class UsuarioController implements IController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function post(Request $request, Response $response): Response
    {
        try {
            $usuario = new Usuario();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new UsuarioValidate())->validatePost((array)$data);
            if ($valida) {
                $usuario->setLogin($data->login);
                $usuario->setSenha($data->senha);
                $usuario->setGrupo($data->grupo->id);

                if($usuario->cadastrar()){
                    return View::renderMessage(
                        $response,
                        "success",
                        "Usuário cadastrado com sucesso!",
                        201,
                        "Sucesso ao cadastra"
                    );
                }
                else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao cadastrar usuário!",
                        500,
                        "Erro ao cadastrar"
                    );

                }
            }else{
                return View::renderMessage($response, "warning", $valida, 400, "erro ao validar");
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
            $usuario = new Usuario();
            $page =(int) $request->getQueryParam('pagina');
            if($request->getAttribute('id')){
                $usuario->setId($request->getAttribute('id'));
            }
            if($request->getQueryParam('login')){
                $usuario->setLogin($request->getQueryParam('login'));
            }if($request->getQueryParam('senha')){
                $usuario->setSenha($request->getQueryParam('senha'));
            }if($request->getQueryParam('grupo')){
                $usuario->getGrupo()->setId($request->getQueryParam('grupo'));
            }
            $search = $usuario->pesquisar($page);
            return View::render($response, $search);
        } catch (Exception $exception) {
            return View::renderException($response, $exception);
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
            $usuario = new Usuario();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new UsuarioValidate())->validatePost((array)$data);
            if ($valida) {
                $usuario->setId($request->getAttribute('id'));
                if(!is_null($data->login)) {
                    $usuario->setLogin($data->login);
                }
                if(!is_null($data->senha)) {
                    $usuario->setSenha($data->senha);
                }
                if(!is_null($data->grupo_id)) {
                    $usuario->setGrupo($data->grupo->id);
                }
                if ($usuario->alterar()) {
                    return View::renderMessage(
                        $response,
                        "success",
                        "Usuário alterado com sucesso!",
                        201,
                        "Sucesso ao alterar"
                    );
                }
                else {
                    return View::renderMessage(
                        $response,
                        "error",
                        "Erro ao alterar usuário",
                        500,
                        "Erro ao alterar"
                    );

                }
            } else {
                return View::renderMessage($response, "warning", $valida, 400, "erro ao validar");
            }
        } catch (Exception $e) {
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
        try{
            $usuario = new Usuario();
            $usuario->setId($request->getAttribute('id'));
            if($usuario->deletar()){
                return View::renderMessage(
                    $response,
                    "success",
                    "Usuário excluído com sucesso!",
                    201,
                    "Sucesso ao excluir"
                );

            }
            else {
                return View::renderMessage(
                    $response,
                    "error",
                    "Erro ao excluir usuário",
                    500,
                    "Erro ao excluir"
                );

            }
        }
        catch (Exception $e) {
            return View::renderException($response, $e);
        }
    }

}