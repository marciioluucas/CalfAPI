<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 16:01
 */

namespace CalfManager\Model;


use CalfManager\Model\Repository\HemogramaDAO;
use CalfManager\Utils\Config;
use Exception;


class Hemograma extends Exame
{
    private $ppt;
    private $hematocrito;

    /**
     * Hemograma constructor.
     * @param Animal|null $animal
     * @throws Exception
     */
    function __construct(Animal $animal = null)
    {
        $this->animal = $animal != null ? $animal : new Animal();
        $this->funcionario = new Funcionario();
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
            $id = (new HemogramaDAO())->create($this);
            return $id;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioAlteracao = new Usuario();
        $this->usuarioAlteracao->setId(1);
        try {
            return (new HemogramaDAO())->update($this);
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
            if ($this->id != null) {
                return (new HemogramaDAO())->retreaveById($this->id);
            }
            if ($this->getAnimal()->getId() != null ) {
                return (new HemogramaDAO())->retreaveByAnimalId($this->getAnimal()->getId(), $page);
            }
            if ($this->getFuncionario()->getId() != null) {
                return (new HemogramaDAO())->retreaveByFuncionarioId($this->getFuncionario()->getId(), $page);
            } else {
                return (new HemogramaDAO())->retreaveAll($page);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deletar(): bool
    {
        try {
            return (new HemogramaDAO())->delete($this->id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function graph(string $whatChart, array $params)
    {
        return (new HemogramaDAO())->{$whatChart}($params);
    }

    /**
     * @return mixed
     */
    public function getPpt()
    {
        return $this->ppt;
    }

    /**
     * @param mixed $ppt
     */
    public function setPpt($ppt)
    {
        $this->ppt = $ppt;
    }

    /**
     * @return mixed
     */
    public function getHematocrito()
    {
        return $this->hematocrito;
    }

    /**
     * @param mixed $hematocrito
     */
    public function setHematocrito($hematocrito)
    {
        $this->hematocrito = $hematocrito;
    }

    function gerarResultado(int $idExame)
    {
        // TODO: Implement gerarResultado() method.
    }

    function enviarResultadoPorEmail(int $idExame)
    {
        // TODO: Implement enviarResultadoPorEmail() method.
    }

    function imprimirResultado(int $idExame)
    {
        // TODO: Implement imprimirResultado() method.
    }
}