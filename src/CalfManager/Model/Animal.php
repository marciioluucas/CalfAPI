<?php

namespace CalfManager\Model;

use ArrayObject;
use Exception;
use CalfManager\Model\Repository\AnimalDAO;
use CalfManager\Model\Repository\DoencaDAO;
use CalfManager\Utils\Config;
use CalfManager\Utils\FaseDaVida;

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
     * @var bool
     */
    private $primogenito;

    /**
     * @var bool
     */
    private $vivo;

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
     * @var Pesagem
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
     * @var ArrayObject
     */
    private $doencas;

    /**
     * Animal constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->fazenda = new Fazenda();
        $this->lote = new Lote();
        $this->pesagem = new Pesagem($this);
        $this->doencas = new ArrayObject();
    }

    /**
     * @return int|null
     * @throws Exception
     */
    public function cadastrar(): ?int
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->faseDaVida = FaseDaVida::RECEM_NASCIDO;
        $this->usuarioCadastro = new Usuario();
        $this->usuarioAlteracao = new Usuario();
        //        $this->usuarioAlteracao = "Lucas";// vai pegar do token dps de implementar o login;
        $this->usuarioCadastro->setId(1);
        //        $array = (new ClassToArray())->classToArray($this);
        if (empty($this->vivo)) {
            $this->vivo = true;
        }
        if ($this->primogenito == 1) {
            $this->faseDaVida = FaseDaVida::ADULTO;
        }
        try {
            $idAnimal = (new AnimalDAO())->create($this);
            $this->depoisDeSalvar($idAnimal);
            return $idAnimal;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function alterar(): bool
    {
        try {
            $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
            return (new AnimalDAO())->update($this);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function pesquisar(int $page): array
    {
        $dao = new AnimalDAO();
        $dao->setVivo($this->vivo);
        $dao->setSexo($this->sexo);
        if ($this->id and !$this->nome and !$this->getLote()->getId()) {
            return $dao->retreaveById($this->id);
        } elseif ($this->nome and !$this->id and !$this->getLote()->getId()) {
            return $dao->retreaveByNome($this->nome, $page);
        } elseif ($this->getLote()->getId() and !$this->nome and !$this->id) {
            return $dao->retreaveByIdLote($this->getLote()->getId(), $page);
        } elseif ($this->nome and $this->getLote()->getId() and !$this->id) {
            return $dao->retreaveByIdLoteAndName(
                $this->getLote()->getId(),
                $this->getNome(),
                $page
            );
        }

        return $dao->retreaveAll($page);
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function deletar(): bool
    {
        try {
            return (new AnimalDAO())->delete($this->id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function mudarLocalizacao()
    {

    }

    public function adicionarDoenca(
        int $doencaId,
        string $situacao = 'CURADO',
        int $animalId = null
    ) : void
    {
//        foreach ($this->doencas as $d) {
//            if ($this->doencas->count() > 0)
//                if ($doencaId == $d->getId()) continue;
            $doenca = new Doenca();
            $doenca->setId($doencaId);
            $doenca->setSituacao($situacao);
            if ($animalId != null) {
                $doenca->getAnimal()->setId($animalId);
            }
            $this->doencas->append($doenca);
//        }

    }

    /**
     * @param null $idAnimal
     * @throws Exception
     */
    public function adoecerAnimal($idAnimal = null)
    {

        foreach ($this->doencas as $doenca) {
            (new DoencaDAO())->adoecer(
                $this->id == null ? $idAnimal : $this->id,
                $doenca->getSituacao(),
                $doenca->getId()
            );
        }
    }

    /**
     * @param $idAnimal
     * @throws Exception
     */
    public function depoisDeSalvar($idAnimal)
    {
        $this->setId($idAnimal);
        $this->cadastrarFamilia();
        $this->cadastrarPesagens();
        $this->adoecerAnimal($idAnimal);
    }

    /**
     * @throws Exception
     */
    public function cadastrarPesagens()
    {
        $this->getPesagem()->cadastrar();
    }

    /**
     * @throws Exception
     */
    public function cadastrarFamilia()
    {
        if ($this->getPai()->getId() != null && $this->getMae()->getId() != null) {
            $familia = new Familia($this->getPai(), $this->getMae(), $this);
            $familia->cadastrar();
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome(): ?string
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
    public function isVivo(): bool
    {
        return $this->vivo;
    }

    /**
     * @param bool $vivo
     */
    public function setVivo(bool $vivo): void
    {
        $this->vivo = $vivo;
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
        $this->dataNascimento = date('Y-m-d', strtotime($dataNascimento));
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
     * @return Pesagem
     */
    public function getPesagem(): Pesagem
    {
        return $this->pesagem;
    }

    /**
     * @param Pesagem|null $pesagem
     */
    public function setPesagem(?Pesagem $pesagem): void
    {
        $this->pesagem = $pesagem;
    }

    /**
     * @return Animal
     */
    public function getPai(): ?Animal
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
    public function getMae(): ?Animal
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

    /**
     * @return ArrayObject
     */
    public function getDoencas(): ArrayObject
    {
        return $this->doencas;
    }

    /**
     * @param ArrayObject $doencas
     */
    public function setDoencas(ArrayObject $doencas): void
    {
        $this->doencas = $doencas;
    }
}
