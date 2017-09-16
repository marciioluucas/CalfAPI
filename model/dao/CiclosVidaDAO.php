<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 16/09/17
 * Time: 15:56
 */

namespace model\dao;


class CiclosVidaDAO implements IDAO
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
            $query = "INSERT INTO ciclosVida($queryNam) VALUES ($queryVal)";
            $stmt = $db->prepare($query);
            foreach ($obj as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
            $stmt->execute();
            $codigo = 200;
            $messagem = "Cicli de vida adicionado com sucesso";
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
            var_dump($queryVal);
            $query = "UPDATE ciclosVida SET $queryVal WHERE idCiclosVida=:idCiclosVida";
            $stmt = $db->prepare($query);
            foreach ($obj as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
            $stmt->execute();
            $codigo = 200;
            $messagem = "Ciclo de vida alterado com sucesso";
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
            $query = "SELECT * FROM ciclosVida WHERE status = 'ATIVO'";
            if ($limite === null) {
                $queryLimit = " LIMIT 1";
            } else {
                $queryLimit = " LIMIT :limite,10";
            }
            if (!empty($obj)) {
                foreach ($obj as $key => $value) {
                    $query .= " AND " . $key . " LIKE :" . $key;
                }
                $query .= $queryLimit;
                $stmt = $db->prepare($query);
                foreach ($obj as $key => &$val) {
                    $stmt->bindValue($key, "%$val%");
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
            $query = "UPDATE ciclosVida SET status = 'DESATIVADO' WHERE idCiclosVida=:idCiclosVida";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':idCiclosVida', $obj['idCiclosVida'], PDO::PARAM_INT);

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