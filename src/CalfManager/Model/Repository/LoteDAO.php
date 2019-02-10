<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:10
 */

namespace CalfManager\Model\Repository;


use CalfManager\Model\Repository\Entity\AnimalEntity;
use Exception;
use CalfManager\Model\Lote;
use CalfManager\Model\Repository\Entity\LoteEntity;
use CalfManager\Utils\Config;
use Illuminate\Support\Facades\DB;

/**
 * Class LoteDAO
 * @package CalfManager\Model\Repository
 */
class LoteDAO implements IDAO
{
    /**
     * @param Lote $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new LoteEntity();
        $entity->codigo = $obj->getCodigo();
        $entity->fazenda_id = $obj->getFazenda()->getId();

        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
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
     * @param Lote $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): bool
    {
        $entity = LoteEntity::find($obj->getId());
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->data_alteracao = $obj->getDataAlteracao();
        if (!is_null($obj->getCodigo())) {
            $entity->codigo = $obj->getCodigo();
        }
        if (!is_null($obj->getFazenda()->getId())) {
            $entity->fazenda_id = $obj->getFazenda()->getId();
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
        return ["lotes" => LoteEntity::ativo()
            ->with('fazenda')
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
                "lotes" => LoteEntity::ativo()
                    ->with('fazenda')
                    ->where('id', $id)
                    ->get()
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por ID" . $e->getMessage());
        }
    }

    /**
     * @param $codigo
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveByCodigo($codigo, int $page): array
    {
        try {
            return [
                "lotes" => LoteEntity::ativo()
                    ->with('fazenda')
                    ->where('codigo', 'like', $codigo . '%')
                    ->paginate
                    (
                        Config::QUANTIDADE_ITENS_POR_PAGINA,
                        ['*'],
                        'pagina',
                        $page
                    )
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por nome" . $e->getMessage());
        }
    }

    public function retreaveByIdFazenda($idFazenda, int $page): array
    {
        try {
            return [
                "lotes" => LoteEntity::ativo()
                    ->with('fazenda')
                    ->where('fazenda_id', $idFazenda)
                    ->paginate
                    (
                        Config::QUANTIDADE_ITENS_POR_PAGINA,
                        ['*'],
                        'pagina',
                        $page
                    )
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao pesquisar fazenda pelo ID" . $e->getMessage());
        }
    }

    public function retreaveQuantidadeLotes()
    {
        try {
            $entity = LoteEntity::ativo()->get()->count();
            return ['lotes' => $entity];
        } catch (Exception $e) {
            throw new Exception("Erro ao contar lotes " . $e->getMessage());
        }
    }

    /**
     * Passando o loteId como parametro, consultara na tabela de Animais todos os animais que tenha este id no lote_id
     * e apos isso, ira contar.
     * @param int $loteId
     * @param bool $considerarMortos
     * @return array
     * @throws Exception
     */
    public function retreaveQtdAnimaisPorLote($loteId, $considerarMortos = false)
    {
        try {
            $entity = AnimalEntity::ativo();
            if (!$considerarMortos) $entity = $entity->vivo();

            return ['lotes_amount' => $entity->where('lotes_id', $loteId)->get()->count()];
        } catch (Exception $e) {
            throw new Exception("Erro ao contar os animais por lote " . $e);
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
            $entity = LoteEntity::find($id);
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