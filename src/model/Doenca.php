<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 22/02/2018
 * Time: 11:03
 */

namespace src\model;


use Exception;
use src\model\repository\DoencaDAO;
use src\util\Config;

/**
 * Class Doenca
 * @package src\model
 */
class Doenca extends Modelo
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
     * @var string|null
     */
    private $descricao = "SEM DESCRIÇÃO";
    /**
     * @var string
     */
    private $situacao = 'NÃO INFORMADA';

    /**
     * Doenca constructor.
     */
    public function __construct()
    {
        $this->usuarioCadastro = new Usuario();
        $this->usuarioAlteracao = new Usuario();
    }


    /**
     * @return bool
     * @throws Exception
     */
    public function cadastrar()
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioCadastro->setId(1);
        try {
            return (new DoencaDAO())->create($this);
        } catch (Exception $e) {
        }
        return false;
    }

    /**
     * @throws Exception
     * @return boolean
     */
    public function alterar()
    {
        try {
            $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
            return (new DoencaDAO())->update($this);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function pesquisar(int $page)
    {
        if ($this->id) {
            return (new DoencaDAO)->retreaveById($this->id);
        } else if ($this->nome) {
            return (new DoencaDAO())->retreaveByNome($this->nome, $page);
        }
        return (new DoencaDAO())->retreaveAll($page);
    }

    /**
     * @return mixed|void
     */
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
     * @return null|string
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * @param null|string $descricao
     */
    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @return string
     */
    public function getSituacao(): string
    {
        return $this->situacao;
    }

    /**
     * @param string $situacao
     */
    public function setSituacao(string $situacao): void
    {
        $this->situacao = $situacao;
    }


}