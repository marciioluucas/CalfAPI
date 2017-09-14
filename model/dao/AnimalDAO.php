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
        $messagem = "";
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
            $messagem = "Animal adicionado com sucesso";
        } catch (Exception $e) {
            $messagem = $e->getMessage();
        }
        return $messagem;

    }

    public function update($obj)
    {
        $messagem = "";
        try {
            $db = Banco::conexao();
            $queryText = "";
            foreach ($obj as $key => $value) {
                $queryText .= $key . "=:" . $key . ",";
            }
            $queryVal = substr_replace($queryText, '', -1);
            var_dump($queryVal);
            $query = "UPDATE animais SET $queryVal WHERE idAnimal=:idAnimal";
            $stmt = $db->prepare($query);
            foreach ($obj as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
            $stmt->execute();
            $messagem = "Animal alterado com sucesso";
        } catch (Exception $e) {
            $messagem = $e->getMessage();
        }
        return $messagem;
    }

    public function retrave($obj)
    {
        try {
            $db = Banco::conexao();
            $query = "SELECT * FROM animais WHERE status = 'ATIVO'";
            if (!empty($obj)) {
                foreach ($obj as $key => $value) {
                    $query .= " AND " . $key . "=:" . $key;
                }
                $query .= " LIMIT 0,10";
                var_dump($query);
                $stmt = $db->prepare($query);
                foreach ($obj as $key => &$val) {
                    $stmt->bindParam($key, $val);
                }
            } else {
                $query .= " LIMIT 0,10";
                $stmt = $db->prepare($query);
            }
            $stmt->execute();
            if (!empty($stmt->rowCount())) {
                $messagem = ($stmt->fetchAll(PDO::FETCH_ASSOC));
            } else {
                $messagem = "Não foi possivel realizar a busca";
            }

        } catch (Exception $e) {
            $messagem = $e->getMessage();
        }
        return $messagem;
    }

    public function delete($obj)
    {
        try {
            $db = Banco::conexao();
            $query = "UPDATE animais SET status = 'DESATIVADO' WHERE idAnimal=:idAnimal";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':idAnimal', $obj['idAnimal'], PDO::PARAM_INT);

            $stmt->execute();
            $messagem = "Deletado com sucesso";

        } catch (Exception $e) {
            $messagem = $e->getMessage();
        }
        return $messagem;
    }
}