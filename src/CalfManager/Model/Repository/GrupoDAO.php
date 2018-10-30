<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 06/09/2018
 * Time: 21:13
 */

namespace CalfManager\Model\Repository;

use CalfManager\Model\Grupo;
use CalfManager\Model\Repository\Entity\GrupoEntity;
use CalfManager\Utils\Config;
use Exception;

class GrupoDAO implements IDAO {
    /**
     * @param Grupo $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new GrupoEntity();
        $entity->nome = $obj->getNome();
        $entity->descricao = $obj->getDescricao();
        $entity->permissao_id = $obj->getPermissao()->getId();

        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->status = 1;
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao cadastrar grupo. Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param Grupo $obj
     * @return bool
     * @throws Exception
     */
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
        if(!is_null($obj->getPermissao()->getId())){
            $entity->permissao_id = $obj->getPermissao()->getId();
        }
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao alterar grupo. Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param int $page
     * @return array
     */
    public function retreaveAll(int $page): array
    {
        try {
            $entity = GrupoEntity::ativo();
            $grupos = $entity->with('permissao')
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["grupos" => $grupos];
        }catch(Exception $e){
            throw new Exception("Erro ao pesquisar todos os grupos. Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function retreaveById(int $id): array
    {
        try {
            $entity = GrupoEntity::ativo();
            $grupo = $entity->with('permissao')
                ->where('id', $id)
                ->first()
                ->toArray();
            return ["grupos" => $grupo];
        }catch(Exception $e){
            throw new Exception("Erro ao pesquisar grupo pelo ID ".$id.". Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param string $nome
     * @param int $page
     * @return array
     */
    public function retreaveByNome(string $nome, int $page){
        try {
            $entity = GrupoEntity::ativo();
            $grupo = $entity->with('permissao')->where('nome', 'like', '%'.$nome.'%')
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["grupos" => $grupo];
        }catch(Exception $e){
            throw new Exception("Erro ao pesquisar grupo pelo nome ".$nome. ". Mensagem: ".$e->getMessage());
        }
    }
    public function retreaveIdPermissao(int $idPermissao, int $page){
        try{
            $entity = GrupoEntity::ativo();
            $grupos = $entity->with('permissao')
                ->where('permissao_id', $idPermissao)
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["grupos" => $grupos];
        } catch (Exception $e){
            throw new Exception("Erro ao pesquisar a permissão deste grupo pelo ".$idPermissao. ". Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        try{
            $entity = GrupoEntity::find($id);
            $entity->status = 0;
            if($entity->save()){
                return true;
            }
        }catch(Exception $e){
            throw new Exception("Erro ao excluir grupo. Mensagem: ".$e->getMessage());
        }
    }

}