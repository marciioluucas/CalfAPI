<?php

/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 00:01
 */

namespace src\model\repository;


use Exception;
use Illuminate\Support\Facades\Validator;
use PDO;
use src\model\Animal;
use src\model\repository\entities\AnimalEntity;
use Psr\Http\Message\RequestInterface as Request;
use src\model\IModel;
use src\model\repository\entities\DoencaEntity;
use src\util\Config;

/**
 * Class AnimalDAO
 * @package src\model\repository
 */
class AnimalDAO implements IDAO
{

    /**
     * @param Animal $obj
     * @return bool
     * @throws Exception
     */
    public function create($obj):boolean
    {
        $entity = new AnimalEntity();
        $entity->nome = $obj->getNome();
        $entity->data_nascimento = $obj->getDataNascimento();
        $entity->primogenito = $obj->isPrimogenito();
        $entity->codigo_brinco = $obj->getCodigoBrinco();
        $entity->codigo_raca = $obj->getCodigoRaca();
        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->fazendas_id = $obj->getFazenda()->getId();
        $entity->lotes_id = $obj->getLote()->getId();
        try {
            if ($entity->save()) {
                return true;
            }

        } catch (Exception $e) {
            throw new Exception("Erro ao tentar salvar um novo Animal. " . $e->getMessage());
        }
        return false;
    }

    public function createAdoecimento(int $idAnimal, int $idDoenca, string $situacao = 'NÃO INFORMADO')
    {
        $animal = AnimalEntity::find($idAnimal);
        DoencaEntity::find($idDoenca)->animais()->attach($animal, ['situacao' => $situacao]);
    }

    /**
     * @param Animal $obj
     * @return boolean
     */
    public function update($obj): boolean
    {
        $entity = AnimalEntity::find($obj->getId());
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        if (!is_null($obj->getNome())) {
            $entity->nome = $obj->getNome();
        }
        if (!is_null($obj->getDataNascimento())) {
            $entity->data_nascimento = $obj->getDataNascimento();
        }
        if (!is_null($obj->getPrimogenito())) {
            $entity->primogenito = $obj->getPrimogenito();
        }
        if (!is_null($obj->getCodigoBrinco())) {
            $entity->codigo_brinco = $obj->getCodigoBrinco();
        }
        if (!is_null($obj->getCodigoRaca())) {
            $entity->codigo_raca = $obj->getCodigoRaca();
        }
        if (!is_null($obj->getDataAlteracao())) {
            $entity->data_alteracao = $obj->getDataAlteracao();
        }
        if (!is_null($obj->getFazenda()->getId())) {
            $entity->fazendas_id = $obj->getFazenda()->getId();
        }
        if (!is_null($obj->getLote()->getId())) {
            $entity->lotes_id = $obj->getLote()->getId();
        }
        if ($entity->save()) {
            return $entity->id;
        };
        return false;
    }

    /**
     * @param int $page
     * @return array
     */
    public function retreaveAll(int $page): array
    {
        $animais = AnimalEntity
            ::ativo()->with('fazenda')
            ->with('pesagens')
            ->with('doencas')
            ->with('lote')
            ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
        return ["animais" => $animais];
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
                "animais" => AnimalEntity
                    ::ativo()
                    ->with('fazenda')
                    ->with('pesagens')
                    ->with('doencas')
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
                "animais" => AnimalEntity
                    ::ativo()
                    ->with('fazenda')
                    ->with('pesagens')
                    ->with('doencas')
                    ->where('nome', 'like', $nome . "%")
                    ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por nome" . $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return boolean
     * @throws Exception
     */
    public function delete(int $id): boolean
    {
        try {
            $entity = AnimalEntity::find($id);
            $entity->status = 0;
            if ($entity->save()) {
                return true;
            };
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar desativar um animal" . $e->getMessage());
        }
        return false;
    }
}