<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 29/08/2018
 * Time: 17:12
 */

namespace CalfManager\Model\Repository;


use CalfManager\Model\Modelo;
use CalfManager\Model\Repository\Entity\HemogramaEntity;
use CalfManager\Utils\Config;
use Exception;

class HemogramaDAO implements IDAO
{
    public function create($obj): ?int
    {
        $entity = new HemogramaEntity();
        $entity->data_exame = $obj->getDataExame();
        $entity->ppt = $obj->getPpt();
        $entity->hematocrito = $obj->getHematocrito();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->data_cadastro = $obj->getDataCadastro();
        $entity->usuario_cadastro = $obj->usuarioCadatro();
        try {
            if ($entity->save()){
                return true;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao cadastrar hemograma! Mensagem: ".$e->getMessage());
        }
    }

    public function update($obj): bool
    {
        $entity = HemogramaEntity::find($obj->getId());
        $entity->data_exame = $obj->getDataExame();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao();
        if(!is_null($obj->getPpt())){
            $entity->ppt = $obj->getPpt();
        }
        if(!is_null($obj->getTesteHematocrito())){
            $entity->hematocrito = $obj->getHematocrito();
        }
        try{
            if ($entity->update()){
                return true;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao alterar hemograma! Mensagem: ".$e->getMessage());
        }
    }

    public function retreaveAll(int $page): array
    {
        $entity = HemogramaEntity::ativo();
        try {
            $hemogramas = $entity->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page);
            return ["hemogramas" => $hemogramas];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar todos os hemogramas! Mensagem: ".$e->getMessage());
        }
    }

    public function retreaveById(int $id): array
    {
        $entity = HemogramaEntity::ativo();
        try {
            $hemogramas = $entity->where('id', $id)->first()->toArray();
            return ["hemogramas" => $hemogramas];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar hemograma pelo ID! Mensagem: ".$e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        $entity = HemogramaEntity::find($id);
        try{
            $entity->status = 0;
            if($entity->save()){return true;}
        }catch (Exception $e){
            throw new Exception("Erro ao excluir hemograma! Mensagem: ".$e->getMessage());
        }
    }

}