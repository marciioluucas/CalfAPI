<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 12/09/2017
 * Time: 23:52
 */

namespace src\model;


use src\model\dao\AnimalDAO;
use src\util\ClassToArray;
use src\util\FaseDaVida;

class Animal implements IModel
{

    private $id;
    private $nomeAnimal;
    private $primogenito;
    private $faseDaVida = FaseDaVida::BEZERRO;
    private $dataAlteracao;
    private $dataCriacao;
    private $usuarioCadastro;
    private $usuarioAlteracao;
    private $dataNascimento;
    private $codigoBrinco;
    private $codigoRaca;
    private $fkPesagem;
    private $fkMae;
    private $fkPai;
    private $fkLote;
    private $fkFazenda;
    protected $limite;

    /**
     * @return array
     */
    public function cadastrar()
    {
        $this->dataAlteracao = date('Y-m-d');
        $this->dataCriacao = date('Y-m-d');
//        $this->usuarioAlteracao = "Lucas";// vai pegar do token dps de implementar o login;
        $this->usuarioCadastro = 1;
//        $array = (new ClassToArray())->classToArray($this);
        $cadastro = (new AnimalDAO())->create($this);
        if ($this->primogenito == 1) {
            $this->faseDaVida = FaseDaVida::ADULTO;
        }
        return ["animal" => "Cadastrou, id é: " . $cadastro];


    }

    public function alterar()
    {
        $array = (new ClassToArray())->classToArray($this);
        return new AnimalDAO();
    }

    /**
     * @param int $page
     * @return array
     * @throws \Exception
     */
    public function pesquisar($page)
    {
        if ($this->id) {
            return AnimalDAO::retreaveById($this->id);
        } else if ($this->nomeAnimal) {
            return AnimalDAO::retreaveByNome($this->nomeAnimal, $page);
        }
        return AnimalDAO::retreaveAll($page);

    }

    public function deletar()
    {

        return (new AnimalDAO())->delete($this->id);
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
    public function setId($id): void
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getNomeAnimal()
    {
        return $this->nomeAnimal;
    }

    /**
     * @param mixed $nomeAnimal
     */
    public function setNomeAnimal($nomeAnimal)
    {
        $this->nomeAnimal = $nomeAnimal;
    }

    /**
     * @return mixed
     */
    public function getPrimogenito()
    {
        return $this->primogenito;
    }

    /**
     * @param mixed $primogenito
     */
    public function setPrimogenito($primogenito): void
    {
        $this->primogenito = $primogenito;
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
    public function setLimite($limite)
    {
        $this->limite = $limite;
    }

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
    public function setDataAlteracao($dataAlteracao)
    {
        $this->dataAlteracao = $dataAlteracao;
    }

    /**
     * @return mixed
     */
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * @param mixed $dataCriacao
     */
    public function setDataCriacao($dataCriacao)
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
    public function setUsuarioCadastro($usuarioCadastro)
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
    public function setUsuarioAlteracao($usuarioAlteracao)
    {
        $this->usuarioAlteracao = $usuarioAlteracao;
    }

    /**
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * @param mixed $dataNascimento
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    /**
     * @return mixed
     */
    public function getCodigoBrinco()
    {
        return $this->codigoBrinco;
    }

    /**
     * @param mixed $codigoBrinco
     */
    public function setCodigoBrinco($codigoBrinco)
    {
        $this->codigoBrinco = $codigoBrinco;
    }

    /**
     * @return mixed
     */
    public function getCodigoRaca()
    {
        return $this->codigoRaca;
    }

    /**
     * @param mixed $codigoRaca
     */
    public function setCodigoRaca($codigoRaca)
    {
        $this->codigoRaca = $codigoRaca;
    }

    /**
     * @return mixed
     */
    public function getFkPesagem()
    {
        return $this->fkPesagem;
    }

    /**
     * @param mixed $fkPesagem
     */
    public function setFkPesagem($fkPesagem)
    {
        $this->fkPesagem = $fkPesagem;
    }

    /**
     * @return mixed
     */
    public function getFkMae()
    {
        return $this->fkMae;
    }

    /**
     * @param mixed $fkMae
     */
    public function setFkMae($fkMae)
    {
        $this->fkMae = $fkMae;
    }

    /**
     * @return mixed
     */
    public function getFkPai()
    {
        return $this->fkPai;
    }

    /**
     * @param mixed $fkPai
     */
    public function setFkPai($fkPai)
    {
        $this->fkPai = $fkPai;
    }

    /**
     * @return mixed
     */
    public function getFkLote()
    {
        return $this->fkLote;
    }

    /**
     * @param mixed $fkLote
     */
    public function setFkLote($fkLote)
    {
        $this->fkLote = $fkLote;
    }

    /**
     * @return mixed
     */
    public function getFkFazenda()
    {
        return $this->fkFazenda;
    }

    /**
     * @param mixed $fkFazenda
     */
    public function setFkFazenda($fkFazenda)
    {
        $this->fkFazenda = $fkFazenda;
    }

    /**
     * @return mixed
     */
    public function getFaseDaVida()
    {
        return $this->faseDaVida;
    }

    /**
     * @param mixed $faseDaVida
     */
    public function setFaseDaVida($faseDaVida): void
    {
        $this->faseDaVida = $faseDaVida;
    }


}