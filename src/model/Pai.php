<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 14:25
 */

namespace src\model;


use src\model\dao\PaiDAO;
use src\util\ClassToArray;
use src\util\Data;

class Pai implements IModel
{
    private $idPai;
    private $nomePai;
    private $dataCriacao;
    private $dataAlteracao;
    private $usuarioCadastro;
    private $usuarioAlteracao;
    protected $limite;

    /**
     * @return mixed
     */
    public function getLimite()
    {
        return $this->limite;
    }

    /**
     * @param mixed $limite
     */
    public function setLimite($limite)
    {
        $this->limite = $limite;
    }

    /**
     * @return mixed
     */
    public function getIdPai()
    {
        return $this->idPai;
    }

    /**
     * @param mixed $idPai
     */
    public function setIdPai($idPai)
    {
        $this->idPai = $idPai;
    }

    /**
     * @return mixed
     */
    public function getNomePai()
    {
        return $this->nomePai;
    }

    /**
     * @param mixed $nomePai
     */
    public function setNomePai($nomePai)
    {
        $this->nomePai = $nomePai;
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
        return (new PaiDAO())->create($array);
    }

    public function alterar()
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new PaiDAO())->update($array);
    }

    public function pesquisar()
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new PaiDAO())->retrave($array,$this->limite);
    }

    public function deletar()
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new PaiDAO())->delete($array);
    }
}