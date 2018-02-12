<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/02/2018
 * Time: 12:34
 */

namespace src\util;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
   const DBDRIVER = 'mysql';
   const DBHOST = 'localhost';
   const DBNAME = 'teste_eloquent';
   const DBUSER = 'root';
   const DBPASS= '';

   public function __construct()
   {
       $capsule = new \Illuminate\Database\Capsule\Manager;

       $capsule->addConnection(array(
           'driver'    => Database::DBDRIVER,
           'host'      => Database::DBHOST,
           'database'  => Database::DBNAME,
           'username'  => Database::DBUSER,
           'password'  => Database::DBPASS,
           'charset'   => 'utf8',
           'collation' => 'utf8_unicode_ci',
           'prefix'    => ''
       ));
       $capsule->setAsGlobal();
       $capsule->bootEloquent();
   }
}