<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 05/09/2018
 * Time: 21:29
 */

namespace CalfManager\Model\Repository;

use CalfManager\Model\Laboratorio;
use CalfManager\Model\Modelo;
use CalfManager\Model\Repository\Entity\LaboratorioEntity;
use Exception;

class LaboratorioDAO implements IDAO
{
    /**
     * @param Laboratorio $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new LaboratorioEntity();
        $entity->data_entrada = $obj->getDataEntrada();
        $entity->animal_id = $obj->getAnimal()->getId();
        $entity->dose_aplicada_id = $obj->getDoseAplicada()->getId();
        $entity->hemograma_id = $obj->getHemograma()->getId();
        $entity->data_saida =$obj->getDataSaida();

        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e) {
            throw new Exception("Erro ao cadastrar um novo registro em laboratório. Mensagem: " . $e->getMessage());
        }

    }

    /**
     * @param Laboratorio $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): bool
    {
        $entity = LaboratorioEntity::find($obj->getId());
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        if(!is_null($obj->getDataEntrada())) {
            $entity->data_entrada = $obj->getDataEntrada();
        }
        if(!is_null($obj->getDoenca()->getId())) {
            $entity->doenca_id = $obj->getDoenca()->getId();
        }
        if(!is_null($obj->getAnimal()->getId())) {
            $entity->animal_id = $obj->getAnimal()->getId();
        }
        if(!is_null($obj->getMedicamento()->getId())) {
            $entity->medicamento_id = $obj->getMedicamento()->getId();
        }
        if(!is_null($obj->getHemograma()->getId())) {
            $entity->hemograma_id = $obj->getHemograma()->getId();
        }
        if(!is_null($obj->getDataSaida())) {
            $entity->data_saida = $obj->getDataSaida();
        }
        try{
            if($entity->save()){
                return $entity->id;
        }
        }catch (Exception $e) {
            throw new Exception("Erro ao alterar um novo registro em laboratório. Mensagem: " . $e->getMessage());
        }
    }

    /**
     * @param int $page
     * @return array
     */
    public function retreaveAll(int $page): array
    {
        $entity = LaboratorioEntity::ativo();
        $registros = $entity->with('animal')
            ->with('doseAplicada')
            ->with('hemograma')
            ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
        return ["laboratorios" => $registros];
    }

    /**
     * @param int $id
     * @return array
     */
    public function retreaveById(int $id): array
    {
        $entity = LaboratorioEntity::ativo();
        $registros = $entity->with('animal')
            ->with('doseAplicada')
            ->with('hemograma')
            ->where('id', $id)
            ->first()
            ->toArray();
        return ["laboratorios" => $registros];
    }

    /**
     * @param int $idAnimal
     * @param int $page
     * @return array
     */
    public function retreaveByIdAnimal(int $idAnimal,int $page): array
    {
        $entity = LaboratorioEntity::ativo();
        $registros = $entity->with('animal')
            ->with('doseAplicada')
            ->with('hemograma')
            ->where('animal_id', $idAnimal)
            ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
        return ["laboratorios" => $registros];
    }

    /**
     * @param int $idHemograma
     * @param int $page
     * @return array
     */
    public function retreaveByIdHemograma(int $idHemograma,int $page): array
    {
        $entity = LaboratorioEntity::ativo();
        $registros = $entity->with('animal')
            ->with('doseAplicada')
            ->with('hemograma')
            ->where('hemograma_id', $idHemograma)
            ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
        return ["laboratorios" => $registros];
    }

    /**
     * @param int $idDoseAplicada
     * @param int $page
     * @return array
     */
    public function retreaveByIdDoseAplicada(int $idDoseAplicada,int $page): array
    {
        $entity = LaboratorioEntity::ativo();
        $registros = $entity->with('animal')
            ->with('doseAplicada')
            ->with('hemograma')
            ->where('dose_aplicada_id', $idDoseAplicada)
            ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
        return ["laboratorios" => $registros];
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        try {
            $entity = LaboratorioEntity::find($id);
            $entity->status = 0;
            if ($entity->save()) {
                return true;
            };
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir um registro do laboratório. Mensagem: " . $e->getMessage());
        }
    }

}