<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 11:42
 */

namespace src\model;


use Psr\Http\Message\RequestInterface as Request;
use src\model\dao\FazendaDAO;
use src\util\ClassToArray;
use src\util\Data;

class Fazenda implements IModel
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
    private $dataCriacao;
    /**
     * @var string
     */
    private $dataAlteracao;
    /**
     * @var string
     */
    private $usuarioCadastro;
    /**
     * @var int
     */
    private $usuarioAlteracao;
    /**
     * @var
     */
    private $limite;

    /**
     * @return array
     */
    public function cadastrar()
    {
        $this->dataAlteracao = (new Data())->gerarDataHora();
        $this->dataCriacao = (new Data())->gerarDataHora();
        $this->usuarioAlteracao = "Lucas";// vai pegar do token dps de implementar o login;
        $this->usuarioCadastro = "Lucas";
        $array = (new ClassToArray())->classToArray($this);
        return (new FazendaDAO())->create($array);
    }

    /**
     * @return array
     */
    public function alterar()
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new FazendaDAO())->update($array);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function pesquisar(Request $request)
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new FazendaDAO())->retrave($array, $this->limite);
    }

    /**
     * @return array
     */
    public function deletar()
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new FazendaDAO())->delete($array);
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
     * @return string
     */
    public function getDataCriacao(): string
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
     * @return string
     */
    public function getDataAlteracao(): string
    {
        return $this->dataAlteracao;
    }

    /**
     * @param string $dataAlteracao
     */
    public function setDataAlteracao(string $dataAlteracao): void
    {
        $this->dataAlteracao = $dataAlteracao;
    }

    /**
     * @return string
     */
    public function getUsuarioCadastro(): string
    {
        return $this->usuarioCadastro;
    }

    /**
     * @param string $usuarioCadastro
     */
    public function setUsuarioCadastro(string $usuarioCadastro): void
    {
        $this->usuarioCadastro = $usuarioCadastro;
    }

    /**
     * @return int
     */
    public function getUsuarioAlteracao(): int
    {
        return $this->usuarioAlteracao;
    }

    /**
     * @param int $usuarioAlteracao
     */
    public function setUsuarioAlteracao(int $usuarioAlteracao): void
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
    public function setLimite($limite): void
    {
        $this->limite = $limite;
    }


}