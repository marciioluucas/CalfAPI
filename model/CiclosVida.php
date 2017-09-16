<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 16/09/17
 * Time: 14:34
 */

namespace model;


use util\ClassToArray;
use util\Data;

class CiclosVida implements IModel
{
    private $idCiclosVida;
    private $enumFaseVida;
    private $enumLocalizacao;
    private $fkAnimal;
    private $dataAlteracao;
    private $dataCriacao;
    private $usuarioCadastro;
    private $usuarioAlteracao;
    private $limite;

    /**
     * @return mixed
     */
    public function getIdCiclosVida()
    {
        return $this->idCiclosVida;
    }

    /**
     * @param mixed $idCiclosVida
     */
    public function setIdCiclosVida($idCiclosVida)
    {
        $this->idCiclosVida = $idCiclosVida;
    }

    /**
     * @return mixed
     */
    public function getEnumFaseVida()
    {
        return $this->enumFaseVida;
    }

    /**
     * @param mixed $enumFaseVida
     */
    public function setEnumFaseVida($enumFaseVida)
    {
        $this->enumFaseVida = $enumFaseVida;
    }

    /**
     * @return mixed
     */
    public function getEnumLocalizacao()
    {
        return $this->enumLocalizacao;
    }

    /**
     * @param mixed $enumLocalizacao
     */
    public function setEnumLocalizacao($enumLocalizacao)
    {
        $this->enumLocalizacao = $enumLocalizacao;
    }

    /**
     * @return mixed
     */
    public function getFkAnimal()
    {
        return $this->fkAnimal;
    }

    /**
     * @param mixed $fkAnimal
     */
    public function setFkAnimal($fkAnimal)
    {
        $this->fkAnimal = $fkAnimal;
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
        $array = (new ClassToArray())->classToArray($this);
        return (new AnimalDAO())->update($array);
    }

    public function pesquisar()
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new AnimalDAO())->retrave($array, $this->limite);
    }

    public function deletar()
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new AnimalDAO())->delete($array);
    }
}