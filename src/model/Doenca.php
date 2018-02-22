<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 22/02/2018
 * Time: 11:03
 */

namespace src\model;


use Psr\Http\Message\RequestInterface as Request;
use src\util\Config;

class Doenca extends Modelo
{
    private $id;
    private $nome;
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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
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