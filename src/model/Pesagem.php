<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:37
 */

namespace src\model;

use Exception;
use src\model\repository\PesagemDAO;
use src\util\Config;

class Pesagem extends Modelo
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var float
     */
    private $peso;
    /**
     * @var string
     */
    private $dataPesagem;

    /**
     * @var Animal
     */
    private $animal;

    /**
     * Pesagem constructor.
     * @param Animal $animal
     * @throws Exception
     */
    public function __construct(Animal $animal)
    {

        $this->usuarioCadastro = new Usuario();
        $this->usuarioAlteracao = new Usuario();
        if($animal->getId() == null) throw new Exception("O ID do não pode ser nulo");
        $this->animal = $animal;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function cadastrar(): bool
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioCadastro->setId(1);
        try {
            return (new PesagemDAO())->create($this);
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
            return (new PesagemDAO())->update($this);
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
        try {
            if ($this->id) {
                return (new PesagemDAO())->retreaveById($this->id);
            } else if ($this->animal->getId()) {
                return (new PesagemDAO())->retreaveByIdAnimal($this->animal->getId(), $page);
            }
            return (new PesagemDAO())->retreaveAll($page);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param string $whatChart
     * @param array $params
     * @return mixed
     */
    public function graph(string $whatChart, array $params)
    {
        return (new PesagemDAO())->$whatChart($params);
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function deletar(): bool
    {
        try {
            return (new PesagemDAO())->delete($this->id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
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
     * @return float
     */
    public function getPeso(): float
    {
        return $this->peso;
    }

    /**
     * @param float $peso
     */
    public function setPeso(float $peso): void
    {
        $this->peso = $peso;
    }

    /**
     * @return string
     */
    public function getDataPesagem(): string
    {
        return $this->dataPesagem;
    }

    /**
     * @param string $dataPesagem
     */
    public function setDataPesagem(string $dataPesagem): void
    {
        $this->dataPesagem = $dataPesagem;
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

}
