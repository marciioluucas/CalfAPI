<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:26
 */

namespace model\dao;


use bd\Banco;
use Exception;

class PesagemDAO implements IDAO
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
            $query = "INSERT INTO pesagens($queryNam) VALUES ($queryVal)";
            $stmt = $db->prepare($query);
            foreach ($obj as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
            $stmt->execute();
            $messagem = "Pesagem adicionada com sucesso";
        }
        catch (Exception $e){
            $messagem = $e->getMessage();
        }
        return $messagem;
    }

    public function update($obj,$id = 0)
    {
        // TODO: Implement update() method.
    }

    public function retrave($obj,$id = 0)
    {
        // TODO: Implement read() method.
    }

    public function delete($obj,$id = 0)
    {
        // TODO: Implement delete() method.
    }
}