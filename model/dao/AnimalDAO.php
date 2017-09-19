<?php

/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 00:01
 */

namespace model\dao;


use bd\Banco;
use Exception;
use PDO;

class AnimalDAO implements IDAO
{

    public function create($obj)
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

    public function update($obj)
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

    public function retrave($obj, $limite)
    {
        $codigo = 400;
        $messagem = "Erro inesperado";
        try {
            $db = Banco::conexao();
            $query = "SELECT * FROM animais WHERE status = 'ATIVO'";
            if ($limite === null) {
                $queryLimit = " LIMIT 10";
            } else {
                $queryLimit = " LIMIT :limite,10";
            }
            if (!empty($obj)) {
                if (isset($obj['idAnimal'])) {
                    $query .= "AND idAnimal=:idAnimal";
                    $query .= $queryLimit;
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':idAnimal', $obj['idAnimal']);
                } else {
                    foreach ($obj as $key => $value) {
                        $query .= " AND " . $key . " LIKE :" . $key;
                    }
                    $query .= $queryLimit;
                    $stmt = $db->prepare($query);
                    foreach ($obj as $key => &$val) {
                        $stmt->bindValue($key, "%$val%");
                    }
                }
            } else {
                $query .= $queryLimit;
                $stmt = $db->prepare($query);
            }
            if ($limite !== null) {
                $stmt->bindValue(':limite', (int)trim($limite), PDO::PARAM_INT);
            }
            $stmt->execute();
            if (!empty($stmt->rowCount())) {
                $codigo = 200;
                $messagem = ($stmt->fetchAll(PDO::FETCH_ASSOC));
            } else {
                $codigo = 400;
                $messagem = "Não foi possivel realizar a busca";
            }

        } catch (Exception $e) {
            $codigo = 400;
            $messagem = $e->getMessage();
        }
        return [
            "codigo" => $codigo,
            "mensagem" => $messagem
        ];
    }

    public function delete($obj)
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