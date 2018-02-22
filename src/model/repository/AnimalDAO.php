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
use src\util\Config;

class AnimalDAO implements IDAO
{

    /**
     * @param Animal $obj
     * @return bool
     */
    public function create($obj)
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
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e) {
            throw new Exception("Erro ao tentar salvar um novo Animal. ". $e->getMessage());
        }
        return false;
    }

    /**
     * @param Animal $obj
     */
    public function update($obj)
    {
        $entity = AnimalEntity::find($obj->getId());

        if (!is_null($obj->getNomeAnimal())) {
            $entity->nome = $obj->getNomeAnimal();
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
        if (!is_null($obj->getFkFazenda())) {
            $entity->fazendas_id = $obj->getFkFazenda();
        }
        if (!is_null($obj->getFkLote())) {
            $entity->lotes_id = $obj->getFkLote();
        }
        if ($entity->save()) {
            return $entity->id;
        };
        return false;
    }

    /**
     * @param $page
     * @return array
     */
    public function retreaveAll($page)
    {
        $animais = AnimalEntity
            ::ativo()->with('fazenda')
            ->with('pesagens')
            ->with('doencas')
            ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
        return ["animais" => $animais];
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function retreaveById($id)
    {
        try {
            return [
                "animais" => AnimalEntity
                    ::ativo()
                    ->with('fazenda')
                    ->with('doencas')
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
    public function retreaveByNome($nome, $page)
    {
        try {
            return [
                "animais" => AnimalEntity
                    ::ativo()
                    ->with('fazenda')
                    ->with('doencas')
                    ->where('nome', 'like', $nome . "%")
                    ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA, ['*'], 'pagina', $page)
            ];
        } catch (Exception $e) {
            throw new Exception("Algo de errado aconteceu ao tentar pesquisar por nome" . $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        $entity = AnimalEntity::find($id);
        $entity->status = 0;
        if ($entity->save()) {
            return $entity->id;
        };
    }
}