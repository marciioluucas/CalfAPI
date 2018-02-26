<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 12:59
 */

namespace src\model;


use Exception;
use Psr\Http\Message\RequestInterface as Request;
use src\util\Config;

/**
 * Class Lote
 * @package src\model
 */
class Lote extends Modelo
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int|string
     */
    private $codigo;
    /**
     * @var string;
     */
    private $descricao;


    /**
     * @return boolean
     * @throws Exception
     */
    public function cadastrar(): boolean
    {
        // TODO: Implement cadastrar() method.
    }

    /**
     * @return boolean
     * @throws Exception
     */
    public function alterar(): boolean
    {
        // TODO: Implement alterar() method.
    }

    /**
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function pesquisar(int $page): array
    {
        // TODO: Implement pesquisar() method.
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function deletar(): boolean
    {
        // TODO: Implement deletar() method.
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param int|string $codigo
     */
    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }


}