<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 01/09/2018
 * Time: 21:45
 */

namespace CalfManager\Model\Repository;


use CalfManager\Model\Modelo;
use CalfManager\Model\Repository\Entity\PermissaoEntity;
use CalfManager\Utils\Config;
use Exception;

class PermissaoDAO implements IDAO
{
    public function create($obj): ?int
    {
        $entity = new PermissaoEntity();
        $entity->nome_modulo = $obj->getNomeModulo();
        $entity->create = $obj->getCreate();
        $entity->read = $obj->getRead();
        $entity->update = $obj->getUpdate();
        $entity->delete = $obj->getDelete();
        $entity->grupo_id = $obj->getGrupo()->getId();
        try{
            if($entity->save()){ return $entity->id; }
        }catch (Exception $e){
            throw new Exception("Erro ao cadastrar nova permissão! ".$e->getMessage());
        }


    }

    public function update($obj): bool
    {
        $entity = PermissaoEntity::find($obj->getId());
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        if(!is_null($obj->getNomeModulo())){
            $entity->nome_modulo = $obj->getNomeModulo();
        }
        if(!is_null($obj->getCreate())){
            $entity->create = $obj->getCreate();
        }
        if(!is_null($obj->getRead())){
            $entity->read = $obj->getRead();
        }
        if(!is_null($obj->getUpdate())){
            $entity->update = $obj->getUpdate();
        }
        if(!is_null($obj->getDelete())){
            $entity->delete = $obj->getDelete();
        }
        try {
            if ($entity->save()) {return true;}
        }catch (Exception $e){
            throw new Exception("Erro ao alterar esta permissão! ".$e->getMessage());
        }
    }

    public function retreaveAll(int $page): array
    {
        $permissoes = PermissaoEntity::ativo()
            ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
        return ["permissoes" => $permissoes];
    }

    public function retreaveById(int $id): array
    {
        try{
            $permissoes = PermissaoEntity::ativo()
                ->where('id', $id)
                ->first()
                ->toArray();
            return ["permissoes" => $permissoes];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar a permissão pelo ID ".$id.". Mensagem: ".$e->getMessage());
        }
    }

    public function retreaveByIdGrupo(int $id, $page): array
    {
        try{
            $permissoes = PermissaoEntity::ativo()
                ->where('permissoes_id', $id)
                ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
            return ["permissoes" => $permissoes];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar o grupo pelo ID ".$id.". Mensagem: ".$e->getMessage());
        }
    }

    public function retreaveByNomeModulo(string $nome,int $page): array
    {
        try {
            $permissoes = PermissaoEntity::ativo()
                ->where('nome_modulo', 'like', '%' . $nome . "%")
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["permissoes" => $permissoes];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar a permissão pelo nome ".$nome.". Mensagem: ".$e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        try {
            $entity = PermissaoEntity::find($id);
            $entity->status = 0;
            if ($entity->save()) {
                return true;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao excluir esta permissão".$e->getMessage());
        }
    }

}