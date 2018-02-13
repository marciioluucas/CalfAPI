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
use src\model\entities\AnimalEntity;
use Psr\Http\Message\RequestInterface as Request;

class AnimalDAO implements IDAO
{

    public static function create($obj)
    {
        $codigo = 400;
        $messagem = "Erro inesperado";
        try {
            $db = Banco::conexao();
            $queryVal = "";
            $queryNam = "";
            foreach ($obj as $key => $value) {
                $queryVal .= ":" . $key . ",";
                $queryNam .= $key . ",";
            }
            $queryVal = substr_replace($queryVal, '', -1);
            $queryNam = substr_replace($queryNam, '', -1);
            $query = "INSERT INTO animais($queryNam) VALUES ($queryVal)";
            $stmt = $db->prepare($query);
            foreach ($obj as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
            $stmt->execute();
            $codigo = 200;
            $messagem = "Animal adicionado com sucesso";
        } catch (Exception $e) {
            $codigo = 400;
            $messagem = $e->getMessage();
        }
        return [
            "codigo" => $codigo,
            "mensagem" => $messagem
        ];

    }

    public static function update($obj)
    {
        $codigo = 400;
        $messagem = "Erro inesperado";
        try {
            $db = Banco::conexao();
            $queryText = "";
            foreach ($obj as $key => $value) {
                if ($key !== 'idAnimal')
                    $queryText .= $key . "=:" . $key . ",";
            }
            $queryVal = substr_replace($queryText, '', -1);

            $query = "UPDATE animais SET $queryVal WHERE idAnimal=:idAnimal";
            $stmt = $db->prepare($query);
            foreach ($obj as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
            $stmt->execute();
            $codigo = 200;
            $messagem = "Animal alterado com sucesso";
        } catch (Exception $e) {
            $codigo = 400;
            $messagem = $e->getMessage();
        }
        return [
            "codigo" => $codigo,
            "mensagem" => $messagem
        ];
    }

    /**
     * @return array
     * @throws Exception
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

    public static function delete($obj)
    {
        $codigo = 400;
        $messagem = "Erro inesperado";
        try {
            $db = Banco::conexao();
            $query = "UPDATE animais SET status = 'DESATIVADO' WHERE idAnimal=:idAnimal";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':idAnimal', $obj['idAnimal'], PDO::PARAM_INT);

            $stmt->execute();
            $messagem = "Deletado com sucesso";

        } catch (Exception $e) {
            $codigo = 200;
            $messagem = $e->getMessage();
        }
        return [
            "codigo" => $codigo,
            "mensagem" => $messagem
        ];
    }
}