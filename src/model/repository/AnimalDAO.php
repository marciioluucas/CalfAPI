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
use src\model\repository\entities\FamiliaEntity;
use src\model\repository\entities\MaeEntity;
use src\model\repository\entities\PaiEntity;
use src\util\Config;

/**
 * Class AnimalDAO
 * @package src\model\repository
 */
class AnimalDAO implements IDAO
{

    /**
     * @var bool
     */
    private $vivo;

    /**
     * @param Animal $obj
     * @return bool
     * @throws Exception
     */
    public function create($obj): bool
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
     * @return bool
     */
    public function update($obj): bool
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
            ->where('is_vivo', $this->vivo)
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
            if(!is_null($this->vivo)){
                return [
                    "animais" => AnimalEntity
                        ::ativo()
                        ->with('fazenda')
                        ->with('pesagens')
                        ->with('doencas')
                        ->with('lote')
                        ->where('nome',  $id)
                        ->where('is_vivo', $this->vivo)
                        ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
                ];
            }
            return [
                "animais" => AnimalEntity
                    ::ativo()
                    ->with('fazenda')
                    ->with('pesagens')
                    ->with('doencas')
                    ->with('lote')
                    ->where('nome', $id)
                    ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por ID" . $e->getMessage());
        }
    }

    /**
     * @param int $animalId
     * @return array
     */


    /**
     * @param string $nome
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveByNome(string $nome, int $page): array
    {
        try {
            if(!is_null($this->vivo)){
                return [
                    "animais" => AnimalEntity
                        ::ativo()
                        ->with('fazenda')
                        ->with('pesagens')
                        ->with('doencas')
                        ->with('lote')
                        ->where('nome', 'like', $nome . "%")
                        ->where('is_vivo', $this->vivo)
                        ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
                ];
            }
            return [
                "animais" => AnimalEntity
                    ::ativo()
                    ->with('fazenda')
                    ->with('pesagens')
                    ->with('doencas')
                    ->with('lote')
                    ->where('nome', 'like', $nome . "%")
                    ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por nome" . $e->getMessage());
        }
    }


    /**
     * @param int $idLote
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveByIdLote(int $idLote, int $page)
    {
        try {
            return [
                "animais" => AnimalEntity
                    ::ativo()
                    ->with('fazenda')
                    ->with('pesagens')
                    ->with('doencas')
                    ->with('lote')
                    ->where('lotes_id', $idLote)
                    ->where('is_vivo', $this->vivo)
                    ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por ID" . $e->getMessage());
        }
    }


    /**
     * @param int $idLote
     * @param string $nome
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveByIdLoteAndName(int $idLote, string $nome, int $page)
    {
        try {
            return [
                "animais" => AnimalEntity
                    ::ativo()
                    ->with('fazenda')
                    ->with('pesagens')
                    ->with('doencas')
                    ->with('lote')
                    ->where('nome', 'like', $nome . "%")
                    ->where('lotes_id', $idLote)
                    ->where('is_vivo', $this->vivo)
                    ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por por nome e lote" . $e->getMessage());
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

    /**
     * @param bool $vivo
     * @return void
     */
    public function setVivo(?bool $vivo): void
    {
        $this->vivo = $vivo;
    }


}