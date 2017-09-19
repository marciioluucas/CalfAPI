<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:10
 */

namespace model\dao;


use bd\Banco;
use Exception;
use PDO;

class LoteDAO implements IDAO
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
            $query = "INSERT INTO lotes($queryNam) VALUES ($queryVal)";
            $stmt = $db->prepare($query);
            foreach ($obj as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
            $stmt->execute();
            $codigo = 200;
            $messagem = "Lote adicionado com sucesso";
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
            $query = "UPDATE lotes SET $queryVal WHERE idLote=:idLote";
            $stmt = $db->prepare($query);
            foreach ($obj as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
            $stmt->execute();
            $codigo = 200;
            $messagem = "Lote alterado com sucesso";
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
            $query = "SELECT * FROM lotes WHERE status = 'ATIVO'";
            if ($limite === null) {
                $queryLimit = " LIMIT 10";
            } else {
                $queryLimit = " LIMIT :limite,10";
            }
            if (!empty($obj)) {
                if (isset($obj['idLote'])) {
                    $query .= "AND idLote=:idLote";
                    $query .= $queryLimit;
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':idLote', $obj['idLote']);
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
            $query = "UPDATE lotes SET status = 'DESATIVADO' WHERE idLote=:idLote";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':idLote', $obj['idLote'], PDO::PARAM_INT);

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