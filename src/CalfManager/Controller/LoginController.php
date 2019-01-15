<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 05/12/2018
 * Time: 19:30
 */

namespace CalfManager\Controller;


use CalfManager\Model\Usuario;
use CalfManager\Utils\TokenApp;
use CalfManager\Utils\Validate\LoginValidate;
use CalfManager\View\View;
use Exception;
use Firebase\JWT\JWT;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class LoginController implements IController
{

    public function post(Request $request, Response $response): Response
    {
        Try{
            $usuario = new Usuario();
            $data = json_decode($request->getBody()->getContents());
            $valida = (new LoginValidate())->validatePost((array)$data);

            if($valida){
                $usuario->setLogin($data->login);
                $usuario->setSenha($data->senha);
                if($usuario->login()){
                    $token = TokenApp::gerarToken($usuario);
                    return View::render($response, $token);
                }
                else {
                    return View::renderMessage($response,
                        'error',
                    'Usuário ou senha incorretos!',
                    401,
                    'erro ao autenticar'
                    );
                }
            }
            else {
                return View::renderMessage($response,
                    'error' ,
                    "Usuario ou senha inválidos",
                    "400" ,
                    "Erro ao validar"
                );

            }
//
        } catch (Exception $e){
            return View::render($response, $e);
        }
    }

    public function get(
        Request $request,
        Response $response,
        array $args
    ): Response
    {
        View::renderMessage($response, "warning", "Módulo não implementado!", 300);
    }

    public function put(Request $request, Response $response): Response
    {
        View::renderMessage($response, "warning", "Módulo não implementado!", 300);

    }

    public function delete(Request $request, Response $response): Response
    {
        View::renderMessage($response, "warning", "Módulo não implementado!", 300);

    }

}