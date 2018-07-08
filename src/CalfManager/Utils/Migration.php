<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 07/02/2018
 * Time: 10:18
 */
namespace CalfManager\Utils;

require_once 'vendor/autoload.php';
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
        $this->capsule = new Capsule();
        $this->capsule->addConnection(array(
            'driver' => Database::DBDRIVER,
            'host' => Database::DBHOST,
            'database' => Database::DBNAME,
            'username' => Database::DBUSER,
            'password' => Database::DBPASS,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ));
        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema();
    }
}
