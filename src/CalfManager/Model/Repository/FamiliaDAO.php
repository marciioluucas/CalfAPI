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
use CalfManager\Utils\Config;
use Exception;

class FamiliaDAO implements IDAO
{

    /**
     * @param Familia $obj
     * @return int|null
     * @throws Exception
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new FamiliaEntity();
        $entity->pai_id = $obj->getPai()->getId();
        $entity->mae_id = $obj->getMae()->getId();
        $entity->filho_id = $obj->getFilho()->getId();
        try {
            if($entity->save()) {
                return $entity->id;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao cadastrar família. Mensagem: ".$e->getMessage());
        }
        return false;
    }

    /**
     * @param Familia $obj
     * @return bool
     * @throws Exception
     * @throws Exception
     */
    public function update($obj): bool
    {
        $entity = FamiliaEntity::find($obj->getId());

        if(!is_null($obj->getPai()->getId())) {
            $entity->pai_id = $obj->getPai()->getId();
        }
        if(!is_null($obj->getMae()->getId())){
            $entity->mae_id = $obj->getMae()->getId();
        }
        if(!is_null($obj->getFilho()->getId())){
            $entity->filho_id = $obj->getFilho()->getId();
        }
        try {
            if ($entity->save()) {
                return $entity->id;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao alterar família. Mensagem: ".$e->getMessage());
        }
        return false;
    }

    /**
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveAll(int $page): array
    {
        try {
            $familias = FamiliaEntity::ativo()->with('pai')
                ->with('mae')
                ->with('filho')
                ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["familias" => $familias];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar todas as famílias. Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function retreaveById(int $id): array
    {
        try {
            $familia = FamiliaEntity::find($id)
                ->with('pai')
                ->with('mae')
                ->with('filho')
                ->where('id', $id)
                ->first()
                ->toAray();
            return ["familias" => $familia];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar familia pelo ID ".$id.". Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        try {
            $entity = FamiliaEntity::find($id);

            $entity->status = 0;
            if ($entity->save()) {
                return true;
            };
        }catch (Exception $e){
            throw new Exception("Erro ao excluir familia. Mensagem".$e->getMessage());
        }
        return false;
    }

    /**
     * @param int $animalId
     * @return array|null|object
     * @throws Exception
     */
    public function retreaveFamiliaByIdAnimal(int $animalId)
    {
        try {
            $familias = FamiliaEntity::ativo()
                ->with('pai')
                ->with('mae')
                ->with('filho')
                ->where('filho_id', $animalId)
                ->first()
                ->toArray();
            return ["familias" => $familias];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar animal em família pelo ID ".$animalId.". Mensagem: ".$e->getMessage());
        }
    }

}