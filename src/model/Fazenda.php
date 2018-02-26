<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 11:42
 */

namespace src\model;


use Exception;
use src\model\repository\FazendaDAO;
use src\util\Config;

/**
 * Class Fazenda
 * @package src\model
 */
class Fazenda extends Modelo
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nome;

    /**
     * @var
     */
    private $limite;

    /**
     * @return int
     * @throws Exception
     */
    public function cadastrar(): int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        try {
            return (new FazendaDAO())->create($this);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return bool
     */
    public function alterar(): boolean
    {
        // TODO: Implement alterar() method.
    }

    /**
     * @param int $page
     * @return array
     */
    public function pesquisar(int $page): array
    {
        // TODO: Implement pesquisar() method.
    }

    /**
     * @return bool
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
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
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
    public function setLimite($limite): void
    {
        $this->limite = $limite;
    }


}