<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 12/09/2017
 * Time: 23:52
 */

namespace src\model;


use Exception;
use src\model\repository\AnimalDAO;
use src\util\FaseDaVida;
use const src\util\PADRAO_DATA_HORA;

class Animal extends Modelo
{

    private $id;
    private $nome;
    private $sexo;
    private $primogenito;
    private $faseDaVida;
    private $dataNascimento;
    private $codigoBrinco;
    private $codigoRaca;
    private $pesagem;
    private $pai;
    private $mae;
    private $lote;
    private $fazenda;

    /**
     * Animal constructor.
     */
    public function __construct()
    {
        $this->pai = new Animal();
        $this->mae = new Animal();
        $this->pesagem = new Pesagem();
    }


    /**
     * @return bool
     * @throws Exception
     */
    public function cadastrar()
    {
        $this->dataAlteracao = date(PADRAO_DATA_HORA);
        $this->dataCriacao = date(PADRAO_DATA_HORA);
        $this->faseDaVida = FaseDaVida::BEZERRO;
//        $this->usuarioAlteracao = "Lucas";// vai pegar do token dps de implementar o login;
        $this->usuarioCadastro = 1;
//        $array = (new ClassToArray())->classToArray($this);
        if ($this->primogenito == 1) {
            $this->faseDaVida = FaseDaVida::ADULTO;
        }
        $cadastro = (new AnimalDAO())->create($this);
        return $cadastro;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function alterar()
    {
        try {
            $this->dataAlteracao = date('Y-m-d H:i:s');
            return (new AnimalDAO())->update($this);
        } catch (Exception $e) {
            throw new Exception("Erro ao tentar atualizar um animal: " . $e->getMessage());
        }
    }

    /**
     * @param int $page
     * @return array
     * @throws \Exception
     */
    public function pesquisar($page)
    {
        if ($this->id) {
            return (new AnimalDAO)->retreaveById($this->id);
        } else if ($this->nome) {
            return (new AnimalDAO)->retreaveByNome($this->nome, $page);
        }
        return (new AnimalDAO)->retreaveAll($page);

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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
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
    public function setSexo($sexo): void
    {
        $this->sexo = $sexo;
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
    public function setDataNascimento($dataNascimento): void
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
    public function setCodigoBrinco($codigoBrinco): void
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
    public function setCodigoRaca($codigoRaca): void
    {
        $this->codigoRaca = $codigoRaca;
    }

    /**
     * @return mixed
     */
    public function getPesagem()
    {
        return $this->pesagem;
    }

    /**
     * @param mixed $pesagem
     */
    public function setPesagem($pesagem): void
    {
        $this->pesagem = $pesagem;
    }

    /**
     * @return mixed
     */
    public function getPai()
    {
        return $this->pai;
    }

    /**
     * @param mixed $pai
     */
    public function setPai($pai): void
    {
        $this->pai = $pai;
    }

    /**
     * @return mixed
     */
    public function getMae()
    {
        return $this->mae;
    }

    /**
     * @param mixed $mae
     */
    public function setMae($mae): void
    {
        $this->mae = $mae;
    }

    /**
     * @return mixed
     */
    public function getLote()
    {
        return $this->lote;
    }

    /**
     * @param mixed $lote
     */
    public function setLote($lote): void
    {
        $this->lote = $lote;
    }

    /**
     * @return mixed
     */
    public function getFazenda()
    {
        return $this->fazenda;
    }

    /**
     * @param mixed $fazenda
     */
    public function setFazenda($fazenda): void
    {
        $this->fazenda = $fazenda;
    }


}