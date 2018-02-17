<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 12:04
 */

namespace src\model\repository;

use Exception;
use PDO;
use src\model\Fazenda;
use src\model\repository\entities\FazendaEntity;

class FazendaDAO implements IDAO
{

    /**
     * @param Fazenda $obj
     */
    public function create($obj)
    {
        $entity = new FazendaEntity();
        $entity->nome = $obj->getNome();
//        TODO : Terminar de fazer as parada aqui
    }

    /**
     * @param Fazenda $obj
     */
    public function update($obj)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param int $page
     */
    public function retreaveAll($page)
    {
        // TODO: Implement retreaveAll() method.
    }

    /**
     * @param int $id
     */
    public function retreaveById(int $id)
    {
        // TODO: Implement retreaveById() method.
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }


}