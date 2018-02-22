<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 11:42
 */

namespace src\model;


use Psr\Http\Message\RequestInterface as Request;
use src\model\repository\FazendaDAO;
use src\util\ClassToArray;
use src\util\Config;
use src\util\Data;

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

    public function cadastrar()
    {

        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
    }

    public function alterar()
    {
        // TODO: Implement alterar() method.
    }

    public function pesquisar(Request $request)
    {
        // TODO: Implement pesquisar() method.
    }

    public function deletar()
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