<?php

/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 00:01
 */

namespace CalfManager\Model\Repository;


use Exception;
use CalfManager\Model\Animal;
use CalfManager\Model\Repository\Entity\AnimalEntity;
use CalfManager\Model\Repository\Entity\DoencaEntity;
use CalfManager\Utils\Config;

/**
 * Class AnimalDAO
 * @package CalfManager\Model\Repository
 */
class AnimalDAO implements IDAO
{


    /**
     * @var bool
     */
    private $vivo;
    /**
     * @var string
     */
    private $sexo;
    /**
     * @var bool
     */
    private $ativo;

    /**
     * @param Animal $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new AnimalEntity();
        $entity->nome = $obj->getNome();
        $entity->sexo = $obj->getSexo();
        $entity->data_nascimento = $obj->getDataNascimento();
        $entity->codigo_brinco = $obj->getCodigoBrinco();
        $entity->codigo_raca = $obj->getCodigoRaca();
        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->fase_vida = $obj->getFaseDaVida();
        $entity->lotes_id = $obj->getLote()->getId();
        $entity->is_vivo = $obj->isVivo();
        try {
            if ($entity->save()) {
                return $entity->id;
            }

        } catch (Exception $e) {
            throw new Exception("Erro ao tentar salvar um novo Animal. " . $e->getMessage());
        }
        return false;
    }

    /**
     * @param int $idAnimal
     * @param int $idDoenca
     * @param string $situacao
     */
    public function createAdoecimento(int $idAnimal, int $idDoenca, string $situacao = 'CURADO')
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
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        if (!is_null($obj->getNome())) {
            $entity->nome = $obj->getNome();
        }
        if(!is_null($obj->getSexo())){
            $entity->sexo = $obj->getSexo();
        }
        if (!is_null($obj->getDataNascimento())) {
            $entity->data_nascimento = $obj->getDataNascimento();
        }
        if (!is_null($obj->getPrimogenito())) {
            $entity->primogenito = $obj->getPrimogenito();
        }
        if (!is_null($obj->getFaseDaVida())) {
            $entity->fase_vida = $obj->getFaseDaVida();
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
        $entity = AnimalEntity::ativo();
        if (!is_null($this->vivo)) {
            $entity->where('is_vivo', $this->vivo);
        }
        if (!is_null($this->sexo)) {
            $entity->where('sexo', $this->sexo);
        }

        $animais = $entity->with('hemogramas')
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
            $entity = AnimalEntity::ativo();
            if (!is_null($this->vivo)) {
                $entity->where('is_vivo', $this->vivo);
            }
            if (!is_null($this->sexo)) {
                $entity->where('sexo', $this->sexo);
            }
            $animal = $entity->with('hemogramas')
                ->with('pesagens')
                ->with('doencas')
                ->with('fazenda')
                ->with('lote')
                ->where('id', $id)
                ->first()
                ->toArray();
            return ["animais" => $animal];
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
            $entity = AnimalEntity::ativo();
            if (!is_null($this->vivo)) {
                $entity->where('is_vivo', $this->vivo);
            }
            if (!is_null($this->sexo)) {
                $entity->where('sexo', $this->sexo);
            }
            $animais = $entity->with('hemogramas')
                ->with('pesagens')
                ->with('doencas')
                ->with('lote')
                ->where('nome', 'like', $nome . "%")
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["animais" => $animais];
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
            $entity = AnimalEntity::ativo();
            $animaisLote = $entity->with('hemogramas')
                ->with('pesagens')
                ->with('doencas')
                ->with('lote')
                ->where('lotes_id', $idLote)
                ->where('is_vivo', $this->vivo)
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["animais" => $animaisLote];
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
            $entity = AnimalEntity::ativo();
            $animais = $entity->with('hemogramas')
                ->with('pesagens')
                ->with('doencas')
                ->with('lote')
                ->where('nome', 'like', $nome . "%")
                ->where('lotes_id', $idLote)
                ->where('is_vivo', $this->vivo)
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["animais" => $animais];
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

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo): void
    {
        $this->sexo = $sexo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo): void
    {
        $this->ativo = $ativo;
    }

    /**
     * @return bool
     */
    public function isVivo(): bool
    {
        return $this->vivo;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }


}