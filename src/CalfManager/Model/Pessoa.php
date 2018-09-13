<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 15:13
 */

namespace CalfManager\Model;


use CalfManager\Model\Repository\PessoaDAO;
use CalfManager\Utils\Config;
use Exception;

class Pessoa extends Modelo
{
    private $id;
    private $nome;
    private $rg;
    private $cpf;
    private $sexo;
    private $numero_telefone;
    private $data_nascimento;
    private $endereco;
    private $funcionario;

    public function __construct()
    {
        $this->funcionario = new Funcionario();
        $this->endereco = new Endereco();
        $this->usuarioCadastro = new Usuario();
        $this->usuarioAlteracao = new Usuario();

    }

    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioCadastro = $this->setId(1);
        try{
           $idFuncionario = (new PessoaDAO())->create($this);
           $this->registarFuncionario($idFuncionario);
           return $idFuncionario;
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioAlteracao = $this->setId(1);
        try{
            return (new PessoaDAO())->update($this);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function pesquisar(int $page): array
    {
        $dao = new PessoaDAO();
        if($this->id and !$this->nome and !$this->$this->getEndereco()->getId()){
            return $dao->retreaveById($this->id);
        }
        if (!$this->id and $this->nome and !$this->getEndereco()->getId()){
            return $dao->retreaveByNome($this->nome, $page);
        }
        if (!$this->id and !$this->nome and $this->getEndereco()->getId()) {
            return $dao->reatreaveByEnderecoId($this->getEndereco()->getId(), $page);
        }
        else {
            return $dao->retreaveAll($page);
        }
    }

    public function deletar(): bool
    {
        try {
            return (new PessoaDAO())->delete($this->id);
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    public function registarFuncionario($idFuncionario){

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param mixed $rg
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return mixed
     */
    public function getNumeroTelefone()
    {
        return $this->numero_telefone;
    }

    /**
     * @param mixed $numero_telefone
     */
    public function setNumeroTelefone($numero_telefone)
    {
        $this->numero_telefone = $numero_telefone;
    }

    /**
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    /**
     * @param mixed $data_nascimento
     */
    public function setDataNascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
    }

    /**
     * @return Endereco
     */
    public function getEndereco(): Endereco
    {
        return $this->endereco;
    }

    /**
     * @param Endereco $endereco
     */
    public function setEndereco(Endereco $endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @return mixed
     */
    public function getFuncionario(): Funcionario
    {
        return $this->funcionario;
    }

    /**
     * @param mixed $funcionario
     */
    public function setFuncionario(Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
    }




}