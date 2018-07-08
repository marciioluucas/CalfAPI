<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:26
 */

namespace CalfManager\Model\Repository;


use bd\Banco;
use Carbon\Carbon;
use Exception;
use InvalidArgumentException;
use PDO;
use CalfManager\Model\Pesagem;
use CalfManager\Model\Repository\entities\PesagemEntity;
use CalfManager\Utils\Config;

/**
 * Class PesagemDAO
 * @package CalfManager\Model\Repository
 */
class PesagemDAO implements IDAO
{
    /**
     * @param Pesagem $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new PesagemEntity();
        $entity->data_pesagem = $obj->getDataPesagem();
        $entity->peso = $obj->getPeso();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->animais_id = $obj->getAnimal()->getId();
        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->save();
        return $entity->id;
    }

    /**
     * @param Pesagem $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): bool
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
        return [
            "pesagens" => PesagemEntity
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
                "pesagens" => PesagemEntity
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
    public function retreaveByIdAnimal(int $id, $page): array
    {
        try {
            return [
                "pesagens" => PesagemEntity
                    ::ativo()
                    ->where('pesagens_id', $id)
                    ->paginate(
                        Config::QUANTIDADE_ITENS_POR_PAGINA,
                        ['*'],
                        'pagina',
                        $page
                    )];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar pelo animal" . $e->getMessage());
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

    /**
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function graphGanhoDePeso($params = []): array
    {
        if (!isset($params['animal'])) {
            throw new InvalidArgumentException('Argumento animal e requirido');
        }
        return [
            PesagemEntity
                ::ativo()
                ->where('animais_id', $params['animal'])
                ->whereDate('data_pesagem', '>=', Carbon::now()->subDays(30)->toDateString())
                ->get(['peso', 'data_pesagem'])
        ];
    }
}