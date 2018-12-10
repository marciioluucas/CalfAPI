<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 05/09/2018
 * Time: 21:29
 */

namespace CalfManager\Model\Repository;

use CalfManager\Model\Laboratorio;
use Exception;

class LaboratorioDAO implements IDAO
{
    /**
     * @param Laboratorio $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {

    }

    /**
     * @param Laboratorio $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): bool
    {

    }

    /**
     * @param int $page
     * @return array
     */
    public function retreaveAll(int $page): array
    {

    }

    /**
     * @param int $id
     * @return array
     */
    public function retreaveById(int $id): array
    {

    }

    /**
     * @param int $idAnimal
     * @param int $page
     * @return array
     */
    public function retreaveByIdAnimal(int $idAnimal,int $page): array
    {

    }


    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {

    }

}