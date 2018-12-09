<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 09/12/2018
 * Time: 14:43
 */

namespace CalfManager\Utils;


class TokenApp {



    function gerarToken($id){
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
    function tokenVazio(){
        $headers = apache_request_headers();
        if(isset($headers['Authorization'])){
            return true;
        } else{
            return false;
        }
    }

    function token($id){
        if($this->tokenVazio()){
            $this->gerarToken($id);
        }
        else{

        }
    }
}