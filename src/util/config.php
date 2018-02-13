<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 09/02/2018
 * Time: 18:55
 */
namespace src\util;
date_default_timezone_set('America/Sao_paulo');


//Configuração do banco
define('DBDRIVER','mysql');
define('DBHOST','localhost');
define('DBNAME','teste_eloquent');
define('DBUSER','root');
define('DBPASS','');

//Configuração do Slim
define('SLIM_CONTAINER', [
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

//Configuração consultas
define('QUANTIDADE_ITENS_POR_PAGINA',20);