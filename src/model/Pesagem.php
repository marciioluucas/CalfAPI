<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:37
 */

namespace src\model;

use Psr\Http\Message\RequestInterface as Request;
use src\util\Config;

class Pesagem extends Modelo
{
    private $id;
    private $peso;

    public function cadastrar()
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
    }

    public function alterar()
    {
        // TODO: Implement alterar() method.
    }

    public function pesquisar(Request $request)
    {
        // TODO: Implement pesquisar() method.
    }

    public function deletar()
    {
        // TODO: Implement deletar() method.
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * @param mixed $peso
     */
    public function setPeso($peso): void
    {
        $this->peso = $peso;
    }



}