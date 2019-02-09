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
    private $nome;
    private $rg;
    private $cpf;
    private $sexo;
    private $numero_telefone;
    private $data_nascimento;
    private $endereco;


    public function __construct()
    {
        $this->endereco = new Endereco();
    }

    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);

        try{
            if($this->getUsuarioCadastro()->getId() == null){
                $this->getUsuarioCadastro()->setId(1);
            }

            $idPessoa = (new PessoaDAO())->create($this);
            return $idPessoa;
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);

        try{
            if($this->getUsuarioAlteracao()->getId() == null){
                $this->getUsuarioAlteracao()->setId(1);
            }

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
            return $dao->reatreaveByIdEndereco($this->getEndereco()->getId(), $page);
        }

        return $dao->retreaveAll($page);

    }

    public function deletar(): bool
    {
        try {
            return (new PessoaDAO())->delete($this->id);
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    public function antesDeSalvar(){
        try {
            $this->getEndereco()->cadastrar();
        } catch (Exception $e) {
        }
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
        $this->data_nascimento = date('Y-m-d', strtotime(str_replace("/", "-", $data_nascimento)));
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
}