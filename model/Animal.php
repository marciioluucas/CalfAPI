<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 12/09/2017
 * Time: 23:52
 */

namespace model;


use model\dao\AnimalDAO;
use util\ClassToArray;
use util\Data;

class Animal implements IModel
{
    private $idAnimal;
    private $dataAlteracao;
    private $dataCriacao;
    private $usuarioCadastro;
    private $usuarioAlteracao;
    private $dataNascimento;
    private $codigoBrinco;
    private $codigoRaca;
    private $fkPesagem;
    private $fkMae;
    private $fkPai;
    private $fkLote;
    private $fkFazenda;

    /**
     * @return mixed
     */
    public function getIdAnimal()
    {
        return $this->idAnimal;
    }

    /**
     * @param mixed $idAnimal
     */
    public function setIdAnimal($idAnimal)
    {
        $this->idAnimal = $idAnimal;
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
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * @param mixed $dataCriacao
     */
    public function setDataCriacao($dataCriacao)
    {
        $this->dataCriacao = $dataCriacao;
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

    /**
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * @param mixed $dataNascimento
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    /**
     * @return mixed
     */
    public function getCodigoBrinco()
    {
        return $this->codigoBrinco;
    }

    /**
     * @param mixed $codigoBrinco
     */
    public function setCodigoBrinco($codigoBrinco)
    {
        $this->codigoBrinco = $codigoBrinco;
    }

    /**
     * @return mixed
     */
    public function getCodigoRaca()
    {
        return $this->codigoRaca;
    }

    /**
     * @param mixed $codigoRaca
     */
    public function setCodigoRaca($codigoRaca)
    {
        $this->codigoRaca = $codigoRaca;
    }

    /**
     * @return mixed
     */
    public function getFkPesagem()
    {
        return $this->fkPesagem;
    }

    /**
     * @param mixed $fkPesagem
     */
    public function setFkPesagem($fkPesagem)
    {
        $this->fkPesagem = $fkPesagem;
    }

    /**
     * @return mixed
     */
    public function getFkMae()
    {
        return $this->fkMae;
    }

    /**
     * @param mixed $fkMae
     */
    public function setFkMae($fkMae)
    {
        $this->fkMae = $fkMae;
    }

    /**
     * @return mixed
     */
    public function getFkPai()
    {
        return $this->fkPai;
    }

    /**
     * @param mixed $fkPai
     */
    public function setFkPai($fkPai)
    {
        $this->fkPai = $fkPai;
    }

    /**
     * @return mixed
     */
    public function getFkLote()
    {
        return $this->fkLote;
    }

    /**
     * @param mixed $fkLote
     */
    public function setFkLote($fkLote)
    {
        $this->fkLote = $fkLote;
    }

    /**
     * @return mixed
     */
    public function getFkFazenda()
    {
        return $this->fkFazenda;
    }

    /**
     * @param mixed $fkFazenda
     */
    public function setFkFazenda($fkFazenda)
    {
        $this->fkFazenda = $fkFazenda;
    }

    public function cadastrar()
    {
        $this->dataAlteracao = (new Data())->gerarDataHora();
        $this->dataCriacao = (new Data())->gerarDataHora();
        $this->usuarioAlteracao = "Lucas";// vai pegar do token dps de implementar o login;
        $this->usuarioCadastro = "Lucas";
        $array = (new ClassToArray())->classToArray($this);
        return (new AnimalDAO())->create($array);

    }

    public function alterar()
    {
        // TODO: Implement alterar() method.
    }

    public function pesquisar()
    {
        // TODO: Implement pesquisar() method.
    }

    public function deletar()
    {
        // TODO: Implement deletar() method.
    }
}