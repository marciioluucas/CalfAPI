<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 12:59
 */

namespace src\model;


use src\model\dao\LoteDAO;
use src\util\ClassToArray;
use src\util\Data;

class Lote implements IModel
{
    private $idLote;
    private $codigoLote;
    private $dataAlteracao;
    private $dataCriacao;
    private $usuarioCadastro;
    private $usuarioAlteracao;
    protected $limite;

    /**
     * @return mixed
     */
    public function getIdLote()
    {
        return $this->idLote;
    }

    /**
     * @param mixed $idLote
     */
    public function setIdLote($idLote)
    {
        $this->idLote = $idLote;
    }

    /**
     * @return mixed
     */
    public function getCodigoLote()
    {
        return $this->codigoLote;
    }

    /**
     * @param mixed $codigoLote
     */
    public function setCodigoLote($codigoLote)
    {
        $this->codigoLote = $codigoLote;
    }

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

    public function cadastrar()
    {
        $this->dataAlteracao = (new Data())->gerarDataHora();
        $this->dataCriacao = (new Data())->gerarDataHora();
        $this->usuarioAlteracao = "Lucas";// vai pegar do token dps de implementar o login;
        $this->usuarioCadastro = "Lucas";
        $array = (new ClassToArray())->classToArray($this);
        return (new LoteDAO())->create($array);
    }

    public function alterar()
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new LoteDAO())->update($array);
    }

    public function pesquisar()
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new LoteDAO())->retrave($array,$this->limite);
    }

    public function deletar()
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new LoteDAO())->delete($array);
    }
}