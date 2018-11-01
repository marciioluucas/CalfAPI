<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:37
 */

namespace CalfManager\Model;

use Exception;
use CalfManager\Model\Repository\PesagemDAO;
use CalfManager\Utils\Config;

class Pesagem extends Modelo
{

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
    function __construct(Animal $animal = null) {
        $this->animal = $animal != null ? $animal : new Animal();
    }

    /**
     * @return int|null
     * @throws Exception
     */
    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioCadastro = new Usuario();
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
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);

        $this->usuarioAlteracao = new Usuario();
        $this->usuarioAlteracao->setId(1);
        try {
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
            } elseif ($this->getAnimal()->getId()) {
                return (new PesagemDAO())->retreaveByIdAnimal($this->getAnimal()->getId(), $page);
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
        return (new PesagemDAO())->{$whatChart}($params);
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
     * @return float
     */
    public function getPeso(): ?float
    {
        return $this->peso;
    }

    /**
     * @param float $peso
     */
    public function setPeso(?float $peso): void
    {
        $this->peso = $peso;
    }

    /**
     * @return string
     */
    public function getDataPesagem(): ?string
    {
        return $this->dataPesagem;
    }

    /**
     * @param string $dataPesagem
     */
    public function setDataPesagem(?string $dataPesagem): void
    {
//        $dataPesagem = $dataPesagem == null ? date('Y-m-d') : $dataPesagem;
        $this->dataPesagem = date('Y-m-d', strtotime(str_replace("/", "-", $dataPesagem)));
    }

    /**
     * @return Animal
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * @param Animal $animal
     */
    public function setAnimal( $animal): void
    {
        $this->animal = $animal;
    }
}
