<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 10/09/2018
 * Time: 21:59
 */

namespace CalfManager\Model\Repository;


use CalfManager\Model\DoseAplicada;
use CalfManager\Model\Repository\Entity\DoseAplicadaEntity;
use CalfManager\Model\Repository\Entity\LaboratorioEntity;
use CalfManager\Utils\Config;
use Exception;

class DoseAplicadaDAO implements IDAO
{
    /* @param DoseAplicada $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new DoseAplicadaEntity();
        $entity->dose = $obj->getDose();
        $entity->medicamento_id = $obj->getMedicamento()->getId();
        $entity->data_aplicacao = $obj->getDataAplicacao();

        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->status = 1;
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e) {
            throw new Exception("Erro ao cadastrar uma dose aplicada. Mensagem: " . $e->getMessage());
        }

    }

    /* @param DoseAplicada $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): bool
    {
        $entity = new DoseAplicadaEntity();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();

        if (!is_null($obj->getDose())){
            $entity->dose = $obj->getDose();
        }
        if(!is_null($obj->getDataAplicacao())){
            $entity->data_aplicacao = $obj->getDataAplicacao();
        }
        if(!is_null($obj->getMedicamento()->getId())) {
            $entity->medicamento_id = $obj->getMedicamento()->getId();
        }

        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e) {
            throw new Exception("Erro ao alterar uma dose aplicada. Mensagem: " . $e->getMessage());
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
            $entity = DoseAplicadaEntity::ativo();
            $doses = $entity->with('medicamento')
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["doses_aplicadas" => $doses];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar todos os registros de doses aplicadas. Mensagem: " . $e->getMessage());
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
            $entity = DoseAplicadaEntity::ativo();
            $dose = $entity->with('medicamento')
                ->where('id', $id)
                ->first()
                ->toArray();
            return ["doses_aplicadas" => $dose];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar a dose aplicada pelo ID ".$id. ". Mensagem: ".$e->getMessage());
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
            $entity = DoseAplicadaEntity::ativo();
            $doses = $entity->with('medicamento')
                ->where('medicamento_id', $idMedicamento)
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["doses_aplicadas" => $doses];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar em dose aplicada o medicamento pelo ID ".$idMedicamento.". Mensagem: ".$e->getMessage());
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
            $entity = DoseAplicadaEntity::find($id);
            $entity->status = 0;
            if ($entity->save()) {
                return true;
            };
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir uma dose aplicada. Mensagem: " . $e->getMessage());
        }
    }

}