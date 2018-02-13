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

   public function __construct()
   {
       $capsule = new Capsule();
       $capsule->addConnection(array(
           'driver'    => DBDRIVER,
           'host'      => DBHOST,
           'database'  => DBNAME,
           'username'  => DBUSER,
           'password'  => DBPASS,
           'charset'   => 'utf8',
           'collation' => 'utf8_unicode_ci',
           'prefix'    => ''
       ));
       $capsule->setAsGlobal();
       $capsule->bootEloquent();
   }
}