<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/03/2018
 * Time: 18:37
 */

namespace CalfManager\Model\Repository;


use CalfManager\Model\Familia;
use CalfManager\Model\Repository\Entity\FamiliaEntity;

class FamiliaDAO implements IDAO
{

    /**
     * @param Familia $obj
     * @return int|null
     */
    public function create($obj): ?int
    {
        $entity = new FamiliaEntity();
        $entity->pai_id = $obj->getPai()->getId();
        $entity->mae_id = $obj->getMae()->getId();
        $entity->filho_id = $obj->getFilho()->getId();
        $entity->save();
        return $entity->id;
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
        return FamiliaEntity::find($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $entity = FamiliaEntity::find($id);
        $entity->status = 0;
        if ($entity->save()) {
            return true;
        };
        return false;
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