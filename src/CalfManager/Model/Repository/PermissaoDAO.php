<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 01/09/2018
 * Time: 21:45
 */

namespace CalfManager\Model\Repository;


use CalfManager\Model\Permissao;
use CalfManager\Model\Repository\Entity\PermissaoEntity;
use CalfManager\Utils\Config;
use Exception;

class PermissaoDAO implements IDAO
{
    /**
     * @param Permissao $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new PermissaoEntity();
        $entity->nome_modulo = $obj->getNomeModulo();
        $entity->create = $obj->getCreate();
        $entity->read = $obj->getRead();
        $entity->update = $obj->getUpdate();
        $entity->delete = $obj->getDelete();

        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->status = 1;
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao cadastrar nova permissão! ".$e->getMessage());
        }


    }

    /**
     * @param Permissao $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): bool
    {
        $entity = PermissaoEntity::find($obj->getId());
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->data_alteracao = $obj->getDataAlteracao();

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
            if ($entity->save()) {
                return true;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao alterar esta permissão! ".$e->getMessage());
        }
    }

    /**
     * @param int $page
     * @return array
     */
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

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
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

    /**
     * @param string $nome
     * @param int $page
     * @return array
     * @throws Exception
     */
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

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        try {
            $entity = PermissaoEntity::find($id);
            $entity->status = 0;
            if ($entity->save()) {
                return true;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao excluir esta permissão! ".$e->getMessage());
        }
    }

}