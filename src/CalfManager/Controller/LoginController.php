<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 05/12/2018
 * Time: 19:30
 */

namespace CalfManager\Controller;


use CalfManager\Model\Repository\UsuarioDAO;
use CalfManager\Model\Usuario;
use CalfManager\Utils\Validate\LoginValidate;
use CalfManager\View\View;
use Exception;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class LoginController implements IController
{
    public function token(Usuario $usuario){
        $id = $usuario->getId();
        $time = time();
        $key = 'bob-esponja';
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];
        $header = json_encode($header);
        $header = base64_encode($header);
        $payload = [
            "iss" => "api.calfmanager.com",
            "id" => $id,
            "iat" => $time,
            "exp" => $time + (86400)
        ];
        $payload = json_encode($payload);
        $payload = base64_encode($payload);
        $signature = hash_hmac('sha256', "$header.$payload", $key, true);
        $signature = base64_encode($signature);

        return ["token" => $token = "$header.$payload.$signature"];
    }
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
                    return View::render($response,$this->token($usuario->login()));
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
                return View::renderMessage($response, 'error' ,"Usuario ou senha inválidos", "400" ,"Erro ao validar");

            }
//            if($valida === true) {
//                $usuario->setLogin($data->login);
//                $usuario->setSenha($data->senha);
//                $user = $usuario->login();
//                if ($usuario) {
//                    if($token = $this->token($usuario)) {
//
//                        return View::render($response, $token);
//                    }
//                }
//                else {
//                    return View::renderMessage(
//                        $response,
//                        "error",
//                        "Usuário ou senha incorretos",
//                        "401",
//                        "Erro ao autenticar"
//                    );
//                }
//            }
//            else {
//                return View::renderMessage(
//                    $response,
//                    "error",
//                    "Usuário ou senha incorretos - else",
//                    "401",
//                    "Erro ao validar"
//                );
//            }

        }
        catch (Exception $e){
            return View::render($response, $e);
        }
    }

    public function get(
        Request $request,
        Response $response,
        array $args
    ): Response
    {
        // TODO: Implement get() method.
    }

    public function put(Request $request, Response $response): Response
    {
        // TODO: Implement put() method.
    }

    public function delete(Request $request, Response $response): Response
    {
        // TODO: Implement delete() method.
    }

}