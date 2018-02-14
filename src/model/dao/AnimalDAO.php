<?php

/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 00:01
 */

namespace src\model\dao;


use Exception;
use PDO;
use src\model\Animal;
use src\model\entities\AnimalEntity;
use Psr\Http\Message\RequestInterface as Request;
use src\model\IModel;

class AnimalDAO implements IDAO
{

    /**
     * @param Animal $obj
     * @return bool
     */
    public static function create($obj)
    {
        $entity = new AnimalEntity();
        $entity->nome = $obj->getNomeAnimal();
        $entity->data_nascimento = $obj->getDataNascimento();
        $entity->primogenito = $obj->getPrimogenito();
        $entity->codigo_brinco = $obj->getCodigoBrinco();
        $entity->codigo_raca = $obj->getCodigoRaca();
        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->fazendas_id = $obj->getFkFazenda();
        $entity->lotes_id = $obj->getFkLote();
        if ($entity->save()) {
            return $entity->id;
        };
        return false;
    }

    /**
     * @param Animal $obj
     */
    public static function update($obj)
    {
        AnimalEntity::find($obj->getId())
            ->update([

            ]);
    }

    /**
     * @param $page
     * @return array
     */
    public static function retreaveAll($page)
    {
        $animais = AnimalEntity::with('fazenda')->paginate(QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page);
        return ["animais" => $animais];
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public static function retreaveById($id)
    {
        try {
            return [
                "animais" => AnimalEntity
                    ::with('fazenda')
                    ->where('id', $id)
                    ->get()
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por ID" . $e->getMessage());
        }
    }

    /**
     * @param $nome
     * @return array
     * @throws Exception
     */
    public static function retreaveByNome($nome, $page)
    {
        try {
            return [
                "animais" => AnimalEntity
                    ::with('fazenda')
                    ->where('nome', 'like', $nome . "%")
                    ->paginate(QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por nome" . $e->getMessage());
        }
    }

    /**
     * @param $filtro
     * @param $valor
     * @return array
     * @throws Exception
     */
    public static function retreaveByPersonalizado($filtro, $valor, $page)
    {
        try {
            return ["animals" => "TODO FILTRO E VALOR: by " . $filtro . " = " . $valor];
//            ->paginate(QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por um filtro personalizado" . $e->getMessage());
        }
    }

    public static function delete(int $id)
    {
       $entity = AnimalEntity::find($id);
       $entity->status = 0;
       $entity->save();
    }
}