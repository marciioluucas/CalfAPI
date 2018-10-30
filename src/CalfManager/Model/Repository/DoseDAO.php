<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 10/09/2018
 * Time: 21:59
 */

namespace CalfManager\Model\Repository;


use CalfManager\Model\Dose;
use CalfManager\Model\Repository\Entity\DoseEntity;
use CalfManager\Model\Repository\Entity\LaboratorioEntity;
use CalfManager\Utils\Config;
use Exception;

class DoseDAO implements IDAO
{
    /* @param Dose $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new DoseEntity();
        $entity->animal_id = $obj->getAnimal()->getId();
        $entity->medicamento_id = $obj->getMedicamento()->getId();
        $entity->funcionario_id = $obj->getFuncionario()->getId();
        $entity->quantidade_mg = $obj->getQuantidadeMg();
        $entity->data = $obj->getData();

        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->status = 1;
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e) {
            throw new Exception("Erro ao cadastrar uma dose. Mensagem: " . $e->getMessage());
        }

    }

    /* @param Dose $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): bool
    {
        $entity = new DoseEntity();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();

        if (!is_null($obj->getQuantidadeMg())){
            $entity->quantidade_mg = $obj->getQuantidadeMg();
        }
        if(!is_null($obj->getData())){
            $entity->data = $obj->getData();
        }
        if(!is_null($obj->getMedicamento()->getId())) {
            $entity->medicamento_id = $obj->getMedicamento()->getId();
        }

        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e) {
            throw new Exception("Erro ao alterar uma dose. Mensagem: " . $e->getMessage());
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
            $entity = DoseEntity::ativo();
            $doses = $entity->with('animal')
                ->with('medicamento')
                ->with('funcionario')
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["doses" => $doses];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar todos os registros de doses. Mensagem: " . $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function retreaveById(int $id): array
    {
        try {
            $entity = DoseEntity::ativo();
            $dose = $entity->with('medicamento')
                ->with('medicamento')
                ->with('funcionario')
                ->where('id', $id)
                ->first()
                ->toArray();
            return ["doses" => $dose];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar a dose pelo ID ".$id. ". Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param int $idMedicamento
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveByIdMedicamento(int $idMedicamento, int $page): array
    {
        try {
            $entity = DoseEntity::ativo();
            $doses = $entity->with('medicamento')
                ->with('medicamento')
                ->with('funcionario')
                ->where('medicamento_id', $idMedicamento)
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["doses" => $doses];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar em dose o medicamento pelo ID ".$idMedicamento.". Mensagem: ".$e->getMessage());
        }
    }
    public function retreaveByIdAnimal(int $idAnimal, int $page): array
    {
        try {
            $entity = DoseEntity::ativo();
            $doses = $entity->with('medicamento')
                ->with('medicamento')
                ->with('funcionario')
                ->where('animal_id', $idAnimal)
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["doses" => $doses];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar em dose o animal pelo ID ".$idAnimal.". Mensagem: ".$e->getMessage());
        }
    }
    public function retreaveByIdFuncionario(int $idFuncionario, int $page): array
    {
        try {
            $entity = DoseEntity::ativo();
            $doses = $entity->with('medicamento')
                ->with('medicamento')
                ->with('funcionario')
                ->where('funcionario_id', $idFuncionario)
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["doses" => $doses];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar em dose o funcionario pelo ID ".$idFuncionario.". Mensagem: ".$e->getMessage());
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
            $entity = DoseEntity::find($id);
            $entity->status = 0;
            if ($entity->save()) {
                return true;
            };
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir uma dose aplicada. Mensagem: " . $e->getMessage());
        }
    }

}