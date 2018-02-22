<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 12/09/2017
 * Time: 23:56
 */

namespace src\model;

use \Psr\Http\Message\RequestInterface as Request;

/**
 * Class Modelo
 * @package src\model
 */
abstract class Modelo
{
    /**
     * @var string
     */
    protected $dataAlteracao;
    /**
     * @var string
     */
    protected $dataCriacao;
    /**
     * @var Usuario
     */
    protected $usuarioCadastro;
    /**
     * @var Usuario
     */
    protected $usuarioAlteracao;

    /**
     * @var boolean
     */
    protected $status;

    /**
     * @return mixed
     */
    public abstract function cadastrar();

    /**
     * @return mixed
     */
    public abstract function alterar();

    /**
     * @param Request $request
     * @return array
     */
    public abstract function pesquisar(Request $request);

    /**
     * @return mixed
     */
    public abstract function deletar();

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
    public function setDataAlteracao(string $dataAlteracao): void
    {
        $this->dataAlteracao = $dataAlteracao;
    }

    /**
     * @return string
     */
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * @param string $dataCriacao
     */
    public function setDataCriacao(string $dataCriacao): void
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
    public function setUsuarioCadastro($usuarioCadastro): void
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
    public function setUsuarioAlteracao($usuarioAlteracao): void
    {
        $this->usuarioAlteracao = $usuarioAlteracao;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

}