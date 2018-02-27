<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 22/02/2018
 * Time: 11:21
 */

namespace src\model\repository;


use Exception;
use src\model\Doenca;
use src\model\repository\entities\DoencaEntity;
use src\util\Config;

class DoencaDAO implements IDAO
{

    /**
     * @param Doenca $obj
     * @return bool
     * @throws Exception
     */
    public function create($obj): bool
    {
        try {
            $entity = new DoencaEntity();
            $entity->nome = $obj->getNome();
            $entity->descricao = $obj->getDescricao();
            $entity->data_cadastro = $obj->getDataCriacao();
            $entity->data_alteracao = $obj->getDataAlteracao();
            $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();

            if ($entity->save()) {
                return true;
            }

        } catch (Exception $e) {
            throw new Exception("Erro ao tentar salvar uma nova Doença. " . $e->getMessage());
        }
        return false;
    }

    /**
     * @param Doenca $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): bool
    {
        $entity = DoencaEntity::find($obj->getId());
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        if (!is_null($obj->getNome())) {
            $entity->nome = $obj->getNome();
        }
        if (!is_null($obj->getDescricao())) {
            $entity->descricao = $obj->getDescricao();
        }
        if (!is_null($obj->getSituacao())) {
            $entity->situacao = $obj->getSituacao();
        }
        try {
            if ($entity->save()) {
                return true;
            }
        } catch (Exception $e) {
            throw new Exception("Erro ao tentar alterar uma doença. " . $e->getMessage());
        }
        return false;
    }

    /**
     * @param int $page
     * @return array
     */
    public function retreaveAll(int $page): array
    {
        return [
            "doencas" => DoencaEntity
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
                "animais" => DoencaEntity
                    ::ativo()
                    ->where('id', $id)
                    ->get()
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por ID" . $e->getMessage());
        }
    }

    /**
     * @param string $nome
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveByNome(string $nome, int $page): array
    {
        try {
            return [
                "animais" => DoencaEntity
                    ::ativo()
                    ->where('nome', 'like', $nome . "%")
                    ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por nome" . $e->getMessage());
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
            $entity = DoencaEntity::find($id);
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