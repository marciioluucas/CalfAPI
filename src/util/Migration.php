<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 07/02/2018
 * Time: 10:18
 */

namespace src\util;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration
{
    /** @var \Illuminate\Database\Capsule\Manager $capsule */
    public $capsule;
    /** @var \Illuminate\Database\Schema\Builder $capsule */
    public $schema;


    public function init()
    {
        $this->capsule = new Capsule;

        $this->capsule->addConnection(array(
            'driver'    => DBDRIVER,
            'host'      => DBHOST,
            'database'  => DBNAME,
            'username'  => DBUSER,
            'password'  => DBPASS,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ));
        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema();
    }
}