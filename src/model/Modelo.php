<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 12/09/2017
 * Time: 23:56
 */

namespace src\model;
use Exception;


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
     * @return boolean
     * @throws Exception
     */
    public abstract function cadastrar(): boolean;

    /**
     * @return boolean
     * @throws Exception
     */
    public abstract function alterar(): boolean;


    /**
     * @param int $page
     * @return array
     * @throws Exception
     */
    public abstract function pesquisar(int $page): array;


    /**
     * @return bool
     * @throws Exception
     */
    public abstract function deletar(): boolean;



}