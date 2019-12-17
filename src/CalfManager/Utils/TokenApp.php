<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 09/12/2018
 * Time: 14:43
 */

namespace CalfManager\Utils;


use CalfManager\Model\Usuario;
use Exception;
use Firebase\JWT\JWT;

class TokenApp
{
    public $frontToken = '';
    public static function gerarToken(Usuario $usuario){
        $id = $usuario->getId();
        $time = time();
        $key = 'p';

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
            "exp" => $time + (86400 )
        ];
        $payload = json_encode($payload);
        $payload = base64_encode($payload);
        $signature = hash_hmac('sha256', "$header.$payload", $key, true);
        $signature = base64_encode($signature);
        $token = "$header.$payload.$signature";
        return ["token" => $token];
    }
    public static function validaToken()
    {
       try
       {
            $key = 'p';
            $tokenHeader = apache_request_headers()["Authorization"];

            $token = substr($tokenHeader, 1, -1);
            //        Retirando o cabeçalho 'Bearer'
//                    $token = substr($tokenHeader, 7);
            if (!is_null($token) && JWT::decode($token, $key, array('HS256'))) {
                return true;
            }
            else {
                return false;
            }
        }
        catch (Exception $e){
            throw new Exception("Token inválido", 401);
        }
    }
}