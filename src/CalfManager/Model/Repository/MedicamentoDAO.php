<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 28/08/2018
 * Time: 22:24
 */

namespace CalfManager\Model\Repository;

use CalfManager\Model\Medicamento;
use CalfManager\Model\Repository\Entity\MedicamentoEntity;
use CalfManager\Utils\Config;
use Exception;

class MedicamentoDAO implements IDAO
{
    /**
     * @param Medicamento $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new MedicamentoEntity();
        $entity->nome = $obj->getNome();
        $entity->prescricao = $obj->getPrescricao();

        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->status = 1;
        try{
            if($entity->save()){
                return $entity->id;
            }
        } catch (Exception $e) {
            throw new Exception("Erro ao cadastrar medicamento. Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param Medicamento $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): bool
    {
        $entity = MedicamentoEntity::find($obj->getId());
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->data_alteracao = $obj->getDataAlteracao();
        if(!is_null($obj->getNome())){
            $entity->nome = $obj->getNome();
        }
        if(!is_null($obj->getPrescricao())){
            $entity->prescricao = $obj->getPrescricao();
        }
        try{
            if($entity->save()){
                return $entity->id;
            }
        } catch (Exception $e){
            throw new Exception("Erro ao alterar medicamento. Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveAll(int $page): array
    {
        try {
            $medicamentos = MedicamentoEntity::ativo()
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["medicamentos" => $medicamentos];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar todos os medicamentos. Mensagem: ".$e->getMessage());
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
            $medicamento = MedicamentoEntity::ativo()
                ->where('id', $id)
                ->first()
                ->toArray();
            return ["medicamentos" => $medicamento];
        } catch (Exception $e) {
            throw new Exception("Erro ao pesquisar medicamento pelo ID ".$id.". Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param string $nome
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveByNome(string $nome, int $page){
        try {
            $medicamentos = MedicamentoEntity::ativo()
                ->where('nome', 'like', '%'.$nome.'%')
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["medicamentos" => $medicamentos];

        } catch (Exception $e){
            throw new Exception("Erro ao pesquisar medicamento pelo nome ".$nome . ". Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        $entity = MedicamentoEntity::find($id);
        $entity->status = 0;
        try{
            if($entity->save()){
                return true;
            }
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir medicamento. Mensagem: ".$e->getMessage());
        }
    }

}