<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 26/08/2018
 * Time: 09:23
 */

namespace CalfManager\Model\Repository;


use CalfManager\Model\Modelo;
use CalfManager\Model\Repository\Entity\CargoEntity;
use CalfManager\Utils\Config;
use Symfony\Component\Config\Definition\Exception\Exception;

class CargoDAO implements IDAO
{
    public function create($obj): ?int
    {
        try{
            $entity = new CargoEntity();
            $entity->nome = $obj->getNome();
            $entity->descricao = $obj->getDescricao();
            $entity->data_cadatro = $obj->getDataCadastro();
            $entity->data_alteracao = $obj->getDataAlteracao();
            $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
            if(!is_null($entity->save())){
                return true;
            }
        }catch (Exception $e) {
            throw new Exception("Erro ao cadastrar novo cargo");
        }
    }

    public function update($obj): bool
    {
        try{
            $entity = CargoEntity::find($obj->getId());
            $entity->data_alteracao = $obj->getDataAlteracao();
            $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
            if(!is_null($obj->getNome())){
                $entity->nome = $obj->getNome();
            }
            if(!is_null($obj->getDescricao())){
                $entity->descricao = $obj->getDescricao();
            }
            if($entity->save()){
                return true;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao alterar o cargo");
        }
    }

    public function retreaveAll(int $page): array
    {
        return [
            "cargos" => CargoEntity::ativo()->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            )];

    }

    public function retreaveById(int $id): array
    {
        try{
            return [
                "cargos" => CargoEntity::ativo()->where('id', $id)->get()
            ];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar cargo pelo ID". $id. "Mensagen: " .$e->getMessage());
        }
    }
    public function retreaveByNome(string $nome, int $page){
        try{
            return [
                "cargos" => CargoEntity::ativo()->where('nome', 'like', "%" . $nome . '%')->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page
                    )
            ];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar doença pelo nome ". $nome . ". Mensagem :" . $e->getMessage());
        }

    }

    public function delete(int $id): bool
    {
        try{
            $entity = CargoEntity::find($id);
            $entity->status = 0;
            if($entity->save()){ return true; }
        }catch (Exception $e){
            throw new Exception("Erro ao excluir cargo. ". $e->getMessage());
        }
    }

}