<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 03/10/2018
 * Time: 20:59
 */

namespace CalfManager\Model;


use ArrayObject;
use Exception;

class Receita extends Modelo
{

    private $animal;
    private $funcionario;
    private $medicamentos;
    private $prescricao;

    /**
     * Receita constructor.
     * @param $animal
     * @param $funcionario
     */
    public function __construct(Animal $animal, Funcionario $funcionario)
    {
        $this->animal = $animal;
        $this->funcionario = $funcionario;
        $this->medicamentos = new ArrayObject();
    }


    public function addMedicamento(Medicamento $medicamento)
    {
        $this->medicamentos->append($medicamento);
    }

    /**
     * @return int|null
     */
    public function cadastrar(): ?int
    {
        // TODO: Implement cadastrar() method.
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function alterar(): bool
    {
        // TODO: Implement alterar() method.
    }

    /**
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function pesquisar(int $page): array
    {
        // TODO: Implement pesquisar() method.
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function deletar(): bool
    {
        // TODO: Implement deletar() method.
    }

    /**
     * @return mixed
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * @param mixed $animal
     */
    public function setAnimal($animal): void
    {
        $this->animal = $animal;
    }

    /**
     * @return mixed
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }

    /**
     * @param mixed $funcionario
     */
    public function setFuncionario($funcionario): void
    {
        $this->funcionario = $funcionario;
    }

    /**
     * @return mixed
     */
    public function getMedicamentos()
    {
        return $this->medicamentos;
    }

    /**
     * @param mixed $medicamentos
     */
    public function setMedicamentos($medicamentos): void
    {
        $this->medicamentos = $medicamentos;
    }

    /**
     * @return mixed
     */
    public function getPrescricao()
    {
        return $this->prescricao;
    }

    /**
     * @param mixed $prescricao
     */
    public function setPrescricao($prescricao): void
    {
        $this->prescricao = $prescricao;
    }


}