<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/03/2018
 * Time: 18:37
 */

namespace src\model\repository;


use src\model\repository\entities\FamiliaEntity;
use src\model\repository\entities\MaeEntity;
use src\model\repository\entities\PaiEntity;

class FamiliaDAO implements IDAO
{

    /**
     * @param $obj
     * @return bool
     */
    public function create($obj): bool
    {
        // TODO: Implement create() method.
    }

    /**
     * @param $obj
     * @return bool
     */
    public function update($obj): bool
    {
        // TODO: Implement update() method.
    }

    /**
     * @param int $page
     * @return array
     */
    public function retreaveAll(int $page): array
    {
        // TODO: Implement retreaveAll() method.
    }

    /**
     * @param int $id
     * @return array
     */
    public function retreaveById(int $id): array
    {
        // TODO: Implement retreaveById() method.
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }

    public function retreaveFamiliaByIdAnimal(int $animalId): ?object
    {
        return FamiliaEntity
            ::ativo()
            ->with('pai')
            ->with('mae')
            ->with('filho')
            ->where('filho_id', $animalId)
            ->first();
    }

}