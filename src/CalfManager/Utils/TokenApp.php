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
        $key = '/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
                bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
                Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
                cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
                5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
                ZkcvY3SK2iRIL4c9yY6hlIhs+';
        $payload = array(
            "iss" => "api.calfmanager.org",
            "aud" => "api.calfmanager.com",
            "time" => $time,
            "exp" => $time + (86400),
            "id" => $id
        );

//        $token = JWT::encode($payload, $key, 'RS256');
//        return $token;
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
            "exp" => $time + (3600)
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

        try{

            $key = '/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
                bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
                Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
                cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
                5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
                ZkcvY3SK2iRIL4c9yY6hlIhs+';
            $tokenHeader = apache_request_headers()["Authorization"];
//        Retirando o cabeçalho 'Bearer'
            $token = substr($tokenHeader, 1, -1);
            if ($token) {
                $data = JWT::decode($token, $key, array('HS256'));
                if ($data) {
                    return true;
                } else {
                    return false;
                }
            }
        }catch (Exception $e){
            throw new Exception("Erro ao solicitar autorização!", $e);
        }

    }
}