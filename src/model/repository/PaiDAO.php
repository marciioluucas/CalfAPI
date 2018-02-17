<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 14:15
 */

namespace src\model\repository;


use bd\Banco;
use Exception;
use PDO;

class PaiDAO implements IDAO
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
            $query = "INSERT INTO pais($queryNam) VALUES ($queryVal)";
            $stmt = $db->prepare($query);
            foreach ($obj as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
            $stmt->execute();
            $codigo = 200;
            $messagem = "Pai adicionado com sucesso";
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
                $queryText .= $key . "=:" . $key . ",";
            }
            $queryVal = substr_replace($queryText, '', -1);
            $query = "UPDATE pais SET $queryVal WHERE idPai=:idPai";
            $stmt = $db->prepare($query);
            foreach ($obj as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
            $stmt->execute();
            $codigo = 200;
            $messagem = "Pai alterado com sucesso";
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
            $query = "SELECT * FROM pais WHERE status = 'ATIVO'";
            if ($limite === null) {
                $queryLimit = " LIMIT 10";
            } else {
                $queryLimit = " LIMIT :limite,10";
            }
            if (!empty($obj)) {
                if (isset($obj['idPai'])){
                    $query .= "AND idPai=:idPai";
                    $query .= $queryLimit;
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':idPai',$obj['idPai']);
                }
                else{
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
            $query = "UPDATE pais SET status = 'DESATIVADO' WHERE idPai=:idPai";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':idPai', $obj['idPai'], PDO::PARAM_INT);

            $stmt->execute();
            $codigo = 200;
            $messagem = "Deletado com sucesso";

        } catch (Exception $e) {
            $codigo = 400;
            $messagem = $e->getMessage();
        }
        return [
            "codigo" => $codigo,
            "mensagem" => $messagem
        ];
    }
}