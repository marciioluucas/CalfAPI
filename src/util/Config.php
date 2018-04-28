<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 09/02/2018
 * Time: 18:55
 */

namespace src\util;
//Configuração de tempo
class Config
{

    const PADRAO_DATA = 'Y-m-d';
    const PADRAO_DATA_HORA = 'Y-m-d H:i:s';

    //Configuração do banco
    const DBDRIVER = 'mysql';
    const DBHOST = 'sql53.main-hosting.eu';
    const DBNAME = 'u806284756_calf';
    const DBUSER = 'u806284756_calf';
    const DBPASS = 'ifgoiano123';
    const DBPORT = '3306';

    //Configuração do Slim
    const SLIM_CONTAINER = [
        'settings' => [
            'displayErrorDetails' => true
        ]
    ];


    //Configuração consultas
    const QUANTIDADE_ITENS_POR_PAGINA = 10;


    public static function loadTimezone(): void
    {
        date_default_timezone_set('America/Sao_paulo');
    }
}