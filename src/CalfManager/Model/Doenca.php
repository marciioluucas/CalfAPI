<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 22/02/2018
 * Time: 11:03
 */

namespace CalfManager\Model;

use Exception;
use CalfManager\Model\Repository\DoencaDAO;
use CalfManager\Utils\Config;

/**
 * Class Doenca
 * @package CalfManager\Model
 */
class Doenca extends Modelo
{
    /**
     * @var string
     */
    private $nome;
    /**
     * @var string
     */
    private $descricao = "Sem descrição";
    private $situacao = 'CURADO';
    private $dataAdoecimento;
    private $dataCura;
    private $animal;

    /**
     * Doenca constructor.
     * @throws Exception
     */

    public function __construct()
    {
        $this->animal = new Animal();
    }


    /**
     * @return int|null
     */
    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);

        $this->usuarioCadastro = new Usuario();
        $this->usuarioCadastro->setId(1);

        $this->nome = ucfirst($this->nome);
        try {
            return (new DoencaDAO())->create($this);
        } catch (Exception $e) {

        }
        return false;
    }

    /**
     * @throws Exception
     * @return bool
     */
    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);

        $this->usuarioAlteracao = new Usuario();
        $this->usuarioAlteracao->setId(1);
        try {
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
    public function pesquisar(int $page): array
    {
        if ($this->id) {
            return (new DoencaDAO())->retreaveById($this->id);
        } elseif ($this->nome) {
            return (new DoencaDAO())->retreaveByNome($this->nome, $page);
        }
        return (new DoencaDAO())->retreaveAll($page);
    }

    /**
     * @return bool|mixed
     * @throws Exception
     */
    public function deletar(): bool
    {
        try {
            return (new DoencaDAO())->delete($this->id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
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
    public function getDescricao(): string
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

    /**
     * @return Animal
     */
    public function getAnimal(): Animal
    {
        return $this->animal;
    }

    /**
     * @param Animal $animal
     */
    public function setAnimal(Animal $animal): void
    {
        $this->animal = $animal;
    }

    /**
     * @return mixed
     */
    public function getDataAdoecimento()
    {
        return $this->dataAdoecimento;
    }

    /**
     * @param mixed $dataAdoecimento
     */
    public function setDataAdoecimento($dataAdoecimento): void
    {
        $this->dataAdoecimento = $dataAdoecimento;
    }

    /**
     * @return mixed
     */
    public function getDataCura()
    {
        return $this->dataCura;
    }

    /**
     * @param mixed $dataCura
     */
    public function setDataCura($dataCura): void
    {
        $this->dataCura = $dataCura;
    }
}
