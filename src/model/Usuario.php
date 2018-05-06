<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 22/02/2018
 * Time: 15:12
 */

namespace src\model;


use Exception;

/**
 * Class Usuario
 * @package src\model
 */
class Usuario extends Modelo
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
     * @var string
     */
    private $login;
    /**
     * @var string
     */
    private $senha;
    /**
     * @var Cargo
     */
    private $cargo;
    /**
     * @var Grupo
     */
    private $grupo;

    /**
     * @return bool
     * @throws Exception
     */
    public function cadastrar(): bool
    {
        // TODO: Implement cadastrar() method.
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function alterar(): bool
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
    public function deletar(): bool
    {
        // TODO: Implement deletar() method.
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return 1;
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
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     */
    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    /**
     * @return Cargo
     */
    public function getCargo(): Cargo
    {
        return $this->cargo;
    }

    /**
     * @param Cargo $cargo
     */
    public function setCargo(Cargo $cargo): void
    {
        $this->cargo = $cargo;
    }

    /**
     * @return Grupo
     */
    public function getGrupo(): Grupo
    {
        return $this->grupo;
    }

    /**
     * @param Grupo $grupo
     */
    public function setGrupo(Grupo $grupo): void
    {
        $this->grupo = $grupo;
    }


}