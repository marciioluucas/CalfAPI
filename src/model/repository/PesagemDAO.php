<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:26
 */

namespace src\model\repository;


use bd\Banco;
use Exception;
use PDO;
use src\model\Pesagem;
use src\model\repository\entities\PesagemEntity;

/**
 * Class PesagemDAO
 * @package src\model\repository
 */
class PesagemDAO implements IDAO
{
    /**
     * @param Pesagem $obj
     * @return bool
     */
    public function create($obj): boolean
    {
        $entity = new PesagemEntity();
        $entity->data_pesagem = $obj->getDataPesagem();
        $entity->peso = $obj->getPeso();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->data_cadastro = $obj->getDataCriacao();
    }

    /**
     * @param Pesagem $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): boolean
    {
        $entity = PesagemEntity::find($obj->getId());
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->data_alteracao = $obj->getDataAlteracao();
        if (!is_null($obj->getPeso())) {
            $entity->peso = $obj->getPeso();
        }
        try {
            if ($entity->save()) {
                return true;
            }
        } catch (Exception $e) {
            throw new Exception("Erro ao tentar salvar uma nova fazenda.");
        }
        return false;
    }

    /**
     * @param int $page
     * @return array
     */
    public function retreaveAll(int $page): array
    {
        return ["pesagens" => PesagemEntity
            ::ativo()
            ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            )];
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function retreaveById(int $id): array
    {
        try {
            return [
                "animais" => PesagemEntity
                    ::ativo()
                    ->where('id', $id)
                    ->get()
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por ID" . $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function retreaveByIdAnimal(int $id): array
    {
        try {
            return [
                "animais" => PesagemEntity
                    ::ativo()
                    ->where('animais_id', $id)
                    ->get()
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por ID" . $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): boolean
    {
        try {
            $entity = PesagemEntity::find($id);
            $entity->status = 0;
            if ($entity->save()) {
                return true;
            };
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar desativar uma fazenda" . $e->getMessage());
        }
        return false;
    }


}