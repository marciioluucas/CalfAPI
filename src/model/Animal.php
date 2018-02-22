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
use src\util\Config;
use src\util\FaseDaVida;

class Animal extends Modelo
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
    private $sexo;

    /**
     * @var boolean
     */
    private $primogenito;

    /**
     * @var boolean
     */
    private $morto;

    /**
     * @var string
     */
    private $dataNascimento;

    /**
     * @var string
     */
    private $faseDaVida;

    /**
     * @var string
     */
    private $codigoBrinco;

    /**
     * @var string
     */
    private $codigoRaca;

    /**
     * @var float
     */
    private $pesagem;
    /**
     * @var Animal
     */
    private $pai;
    /**
     * @var Animal
     */
    private $mae;
    /**
     * @var Lote
     */
    private $lote;

    /**
     * @var Fazenda
     */
    private $fazenda;

    /**
     * Animal constructor.
     */
    public function __construct()
    {

        $this->fazenda = new Fazenda();
        $this->lote = new Lote();
        $this->usuarioCadastro = new Usuario();
        $this->usuarioAlteracao = new Usuario();

    }


    /**
     * @return bool
     * @throws Exception
     */
    public function cadastrar()
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->faseDaVida = FaseDaVida::RECEM_NASCIDO;
//        $this->usuarioAlteracao = "Lucas";// vai pegar do token dps de implementar o login;
        $this->usuarioCadastro->setId(1);
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
            $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
            return (new AnimalDAO())->update($this);
        } catch (Exception $e) {
            throw new Exception("Erro ao tentar atualizar um animal: " . $e->getMessage());
        }
    }

    /**
     * @param int $page
     * @return array
     * @throws Exception
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

    public function mudarLocalizacao()
    {

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
    public function getSexo(): string
    {
        return $this->sexo;
    }

    /**
     * @param string $sexo
     */
    public function setSexo(string $sexo): void
    {
        $this->sexo = $sexo;
    }

    /**
     * @return bool
     */
    public function isMorto(): bool
    {
        return $this->morto;
    }

    /**
     * @param bool $morto
     */
    public function setMorto(bool $morto): void
    {
        $this->morto = $morto;
    }

    /**
     * @return bool
     */
    public function isPrimogenito(): bool
    {
        return $this->primogenito;
    }

    /**
     * @param bool $primogenito
     */
    public function setPrimogenito(bool $primogenito): void
    {
        $this->primogenito = $primogenito;
    }

    /**
     * @return string
     */
    public function getFaseDaVida(): string
    {
        return $this->faseDaVida;
    }

    /**
     * @param string $faseDaVida
     */
    public function setFaseDaVida(string $faseDaVida): void
    {
        $this->faseDaVida = $faseDaVida;
    }

    /**
     * @return string
     */
    public function getDataNascimento(): string
    {
        return $this->dataNascimento;
    }

    /**
     * @param string $dataNascimento
     */
    public function setDataNascimento(string $dataNascimento): void
    {
        $this->dataNascimento = $dataNascimento;
    }

    /**
     * @return string
     */
    public function getCodigoBrinco(): string
    {
        return $this->codigoBrinco;
    }

    /**
     * @param string $codigoBrinco
     */
    public function setCodigoBrinco(string $codigoBrinco): void
    {
        $this->codigoBrinco = $codigoBrinco;
    }

    /**
     * @return string
     */
    public function getCodigoRaca(): string
    {
        return $this->codigoRaca;
    }

    /**
     * @param string $codigoRaca
     */
    public function setCodigoRaca(string $codigoRaca): void
    {
        $this->codigoRaca = $codigoRaca;
    }

    /**
     * @return float
     */
    public function getPesagem(): float
    {
        return $this->pesagem;
    }

    /**
     * @param float $pesagem
     */
    public function setPesagem(float $pesagem): void
    {
        $this->pesagem = $pesagem;
    }

    /**
     * @return Animal
     */
    public function getPai(): Animal
    {
        return $this->pai;
    }

    /**
     * @param Animal $pai
     */
    public function setPai(Animal $pai): void
    {
        $this->pai = $pai;
    }

    /**
     * @return Animal
     */
    public function getMae(): Animal
    {
        return $this->mae;
    }

    /**
     * @param Animal $mae
     */
    public function setMae(Animal $mae): void
    {
        $this->mae = $mae;
    }

    /**
     * @return Lote
     */
    public function getLote(): Lote
    {
        return $this->lote;
    }

    /**
     * @param Lote $lote
     */
    public function setLote(Lote $lote): void
    {
        $this->lote = $lote;
    }

    /**
     * @return Fazenda
     */
    public function getFazenda(): Fazenda
    {
        return $this->fazenda;
    }

    /**
     * @param Fazenda $fazenda
     */
    public function setFazenda(Fazenda $fazenda): void
    {
        $this->fazenda = $fazenda;
    }

}