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
            $query = "INSERT INTO lotes($queryNam) VALUES ($queryVal)";
            $stmt = $db->prepare($query);
            foreach ($obj as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
            $stmt->execute();
            $messagem = "Lote adicionado com sucesso";
        } catch (Exception $e) {
            $messagem = $e->getMessage();
        }
        return $messagem;
    }

    public function update($obj)
    {
        // TODO: Implement update() method.
    }

    public function retrave($obj)
    {
        try {
            $db = Banco::conexao();
            $query = "SELECT * FROM lotes";
            if ($obj['idLote'] !== 0) {
                $query .= " WHERE idLote = :idLote";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':idLote', $obj['idLote'], PDO::PARAM_INT);
            } else {
                $stmt = $db->prepare($query);
            }
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $messagem[] = $row;
            }

        } catch (Exception $e) {
            $messagem = $e->getMessage();
        }
        return $messagem;
    }

    public function delete($obj)
    {
        // TODO: Implement delete() method.
    }
}