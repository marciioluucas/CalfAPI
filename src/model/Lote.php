<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 12:59
 */

namespace src\model;


use Psr\Http\Message\RequestInterface as Request;
use src\util\Config;

class Lote extends Modelo
{
    private $id;
    private $codigo;
    private $descricao;

    public function cadastrar()
    {
       $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
       $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
    }

    public function alterar()
    {
        // TODO: Implement alterar() method.
    }

    public function pesquisar(int $page)
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
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }
}