<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * Created by PhpStorm.
 * User: marci
 * Date: 08/02/2018
 * Time: 16:10
 */
class DoctrineORM
{
    private $instancia;
    private $configuracao;
    private $connection;
    private $isDevMode = true;

    public function __construct()
    {
        if ($this->instancia !== null) {
            $this->instancia = new DoctrineORM();
        }
        return $this->instancia;
    }

    /**
     * @return DoctrineORM
     */
    public function getInstancia(): DoctrineORM
    {
        return $this->instancia;
    }

    public function bootstrap()
    {
        $paths = array("./src/App/Entities");
        $isDevMode = false;

        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => '',
            'dbname'   => 'foo',
        );

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $entityManager = EntityManager::create($dbParams, $config);
    }

    public function console()
    {
        // obtaining the entity manager
        try {
            return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(EntityManager::create($this->connection, $this->configuracao));
        } catch (\Doctrine\ORM\ORMException $e) {
        }
    }
}