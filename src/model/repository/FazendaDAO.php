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
     * @return bool|mixed
     * @throws Exception
     */
    public function create($obj)
    {
        $entity = new FazendaEntity();
        $entity->nome = $obj->getNome();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro();
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e) {
            throw new Exception("Erro ao tentar salvar uma nova fazenda.");
        }
        return false;
    }

    /**
     * @param Fazenda $obj
     */
    public function update($obj)
    {
        $entity = FazendaEntity::find($obj->getId());
        if (!is_null($obj->getNome())) {
            $entity->nome = $obj->getNomeAnimal();
        }

        if (!is_null($obj->getDataAlteracao())) {
            $entity->data_alteracao = $obj->getDataAlteracao();
        }
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