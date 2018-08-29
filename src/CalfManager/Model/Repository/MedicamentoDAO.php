<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 28/08/2018
 * Time: 22:24
 */

namespace CalfManager\Model\Repository;

use CalfManager\Model\Repository\Entity\MedicamentoEntity;
use CalfManager\Utils\Config;
use Exception;

class MedicamentoDAO implements IDAO
{
    public function create($obj): ?int
    {
        $entity = new MedicamentoEntity();
        $entity->nome = $obj->getNome();
        $entity->prescricao = $obj->getPrescricao();
        $entity->data_cadastro = $obj->getDataCadatro();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao();
        try{
            if($entity->save()){
                return true;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update($obj): bool
    {
        $entity = MedicamentoEntity::find($obj->getId());
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->data_alteracao = $obj->getDataAlteracao();
        if(!is_null($obj->getNome())){
            $entity->nome = $obj->getNome();
        }
        if(!is_null($obj->getPrescricao())){
            $entity->prescricao = $obj->getPrescricao;
        }
        try{
            if($entity->save()){
                return true;
            }
        } catch (Exception $e){
            throw new Exception("Erro ao cadastrar medicamento! Mensagem: ",$e->getMessage());
        }
    }

    public function retreaveAll(int $page): array
    {
        return ["medicamentos" => MedicamentoEntity::ativo()
            ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
        ];
    }

    public function retreaveById(int $id): array
    {
        try{
            return [
                "medicamentos" => MedicamentoEntity::ativo()
                ->where('id', $id)
                ->first()
                ->toArray()
            ];
        } catch (Exception $e) {
            throw new Exception("Erro ao pesquisar medicamento pelo ID! Mensagem: ".$e->getMessage());
        }
    }
    public function retreaveByNome(string $nome, int $page){
        try {
            return [
                "medicamentos" => MedicamentoEntity::ativo()
                ->where('nome', 'like', '%'.$nome.'%')
                ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
            ];

        } catch (Exception $e){
            throw new Exception("Erro ao pesquisar medicamento pelo nome ".$nome . "! Mensagem: ".$e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        $entity = MedicamentoEntity::find($id);
        $entity->status = 0;
        try{
            if($entity->save()){
                return true;
            }
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir medicamento! Mensagem: ".$e->getMessage());
        }
    }

}