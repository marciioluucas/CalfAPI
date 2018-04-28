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
    const DBHOST = 'mysql8.db4free.net';
    const DBNAME = 'controleanimal';
    const DBUSER = 'marcin';
    const DBPASS = 'ifgoiano123';
    const DBPORT = '3307';

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