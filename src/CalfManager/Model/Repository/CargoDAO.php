<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 26/08/2018
 * Time: 09:23
 */

namespace CalfManager\Model\Repository;

use CalfManager\Model\Cargo;
use CalfManager\Model\Repository\Entity\CargoEntity;
use CalfManager\Utils\Config;
use Exception;

class CargoDAO implements IDAO
{
    /* @param Cargo $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {

        $entity = new CargoEntity();
        $entity->nome = $obj->getNome();
        $entity->descricao = $obj->getDescricao();

        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->status = 1;
        try{
            if($entity->save()){
                return true;
            }
        }catch (Exception $e) {
            throw new Exception("Erro ao cadastrar novo cargo. Mensagem:" . $e->getMessage());
        }
    }

    /* @param Cargo $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): bool
    {
        $entity = CargoEntity::find($obj->getId());
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        if(!is_null($obj->getNome())){
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
            throw new Exception("Erro ao alterar o cargo. Mensagem: ". $e->getMessage());
        }
    }

    /* @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveAll(int $page): array
    {
        try {
            $entity = CargoEntity::ativo();
            $cargos = $entity->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
            return ["cargos" => $cargos];
        }
        catch (Exception $e){
            throw new Exception("Erro ao pesquisar todos os registros. Mensagen: " .$e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function retreaveById(int $id): array
    {
        try{
            $entity = CargoEntity::ativo();
            $cargo = $entity->where('id', $id)->first()->toArray();
            return [ "cargos" => $cargo ];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar cargo pelo ID". $id. "Mensagen: " .$e->getMessage());
        }
    }

    /**
     * @param string $nome
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveByNome(string $nome, int $page){
        try{
            $entity = CargoEntity::ativo();
            $cargosNome = $entity->where('nome', 'like', "%" . $nome . '%')->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
            return [ "cargos" => $cargosNome ];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar doença pelo nome ". $nome . ". Mensagem :" . $e->getMessage());
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
            $entity = CargoEntity::find($id);
            $entity->status = 0;
            if($entity->save()){ return true; }
        }catch (Exception $e){
            throw new Exception("Erro ao excluir cargo. Mensagem: ". $e->getMessage());
        }
    }

}