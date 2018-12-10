<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/02/2018
 * Time: 12:34
 */

namespace CalfManager\Utils;

use Illuminate\Database\Capsule\Manager as Capsule;
use PDOException;

class Database
{


    public function __construct()
    {
        $capsule = new Capsule();
        try {
            $capsule->addConnection(array(
                'driver' => Config::DBDRIVER,
                'host' => Config::DBHOST,
                'database' => Config::DBNAME,
                'username' => Config::DBUSER,
                'password' => Config::DBPASS,
                'port' => Config::DBPORT,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
                'strict' => 'false',
                'unix_socket'   => '/Applications/MAMP/tmp/mysql/mysql.sock'
            ));
        } catch (PDOException $e) {
            throw new PDOException(
                "A framework não pôde fazer a conexao com o banco"
            );
        }

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
