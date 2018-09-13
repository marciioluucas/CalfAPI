<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 06/09/2018
 * Time: 21:13
 */

namespace CalfManager\Model\Repository;

use CalfManager\Model\Modelo;
use CalfManager\Model\Repository\Entity\GrupoEntity;
use CalfManager\Utils\Config;
use Exception;

class GrupoDAO implements IDAO {
    public function create($obj): ?int
    {
        $entity = new GrupoEntity();
        $entity->nome = $obj->getNome();
        $entity->descricao = $obj->getDescricao();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->data_cadastro = $obj->getDataCadastro();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function update($obj): bool
    {
        $entity =  GrupoEntity::find($obj->getId());
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->data_alteracao = $obj->getDataAlteracao();
        if(!is_null($obj->getNome())) {
            $entity->nome = $obj->getNome();
        }
        if(!is_null($obj->getDescricao())){
            $entity->descricao = $obj->getDescricao();
        }
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function retreaveAll(int $page): array
    {
        $entity = GrupoEntity::ativo();
        $grupos = $entity->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page);
        return ["grupos" => $grupos];
    }

    public function retreaveById(int $id): array
    {
        $entity = GrupoEntity::ativo();
        $grupo = $entity->where('id', $id)->first()->toArray();
        return ["grupos" => $grupo];
    }
    public function retreaveByNome(string $nome, int $page){
        $entity = GrupoEntity::ativo();
        $grupo = $entity->where('nome', 'like', $nome)->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page);
        return ["grupos" => $grupo];
    }

    public function delete(int $id): bool
    {
        try{
            $entity = GrupoEntity::ativo();
            $entity->status = 0;
            if($entity->save()){
                return true;
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

}