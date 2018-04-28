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
    const DBDRIVER = 'postgres';
    const DBHOST = 'ec2-54-83-1-94.compute-1.amazonaws.com';
    const DBNAME = 'd2f41c3barm383';
    const DBUSER = 'zgkxpfnderrfhi';
    const DBPASS = 'c295dd949738eb3e9adf405bd4e755cd36463795f7b5a5d5f01f3e47c1d6a98a';
    const DBPORT = '5432';

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