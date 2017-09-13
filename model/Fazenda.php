<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 11:42
 */

namespace model;


use model\dao\FazendaDAO;
use util\ClassToArray;
use util\Data;

class Fazenda implements IModel
{
    private $idFazenda;
    private $nome;
    private $dataCriacao;
    private $dataAlteracao;
    private $usuarioCadastro;
    private $usuarioAlteracao;

    /**
     * @return mixed
     */
    public function getIdFazenda()
    {
        return $this->idFazenda;
    }

    /**
     * @param mixed $idFazenda
     */
    public function setIdFazenda($idFazenda)
    {
        $this->idFazenda = $idFazenda;
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
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * @param mixed $dataCricao
     */
    public function setDataCriacao($dataCriacao)
    {
        $this->dataCriacao = $dataCriacao;
    }

    /**
     * @return mixed
     */
    public function getDataAlteracao()
    {
        return $this->dataAlteracao;
    }

    /**
     * @param mixed $dataAlteracao
     */
    public function setDataAlteracao($dataAlteracao)
    {
        $this->dataAlteracao = $dataAlteracao;
    }

    /**
     * @return mixed
     */
    public function getUsuarioCadastro()
    {
        return $this->usuarioCadastro;
    }

    /**
     * @param mixed $usuarioCadastro
     */
    public function setUsuarioCadastro($usuarioCadastro)
    {
        $this->usuarioCadastro = $usuarioCadastro;
    }

    /**
     * @return mixed
     */
    public function getUsuarioAlteracao()
    {
        return $this->usuarioAlteracao;
    }

    /**
     * @param mixed $usuarioAlteracao
     */
    public function setUsuarioAlteracao($usuarioAlteracao)
    {
        $this->usuarioAlteracao = $usuarioAlteracao;
    }

    public function cadastrar()
    {
        $this->dataAlteracao = (new Data())->gerarDataHora();
        $this->dataCriacao = (new Data())->gerarDataHora();
        $this->usuarioAlteracao = "Lucas";// vai pegar do token dps de implementar o login;
        $this->usuarioCadastro = "Lucas";
        $array = (new ClassToArray())->classToArray($this);
        return (new FazendaDAO())->create($array);
    }

    public function alterar()
    {
        // TODO: Implement alterar() method.
    }

    public function pesquisar()
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new FazendaDAO())->retrave($array);    }

    public function deletar()
    {
        // TODO: Implement deletar() method.
    }
}