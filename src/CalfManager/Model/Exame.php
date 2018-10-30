<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 02/10/18
 * Time: 08:54
 */

namespace CalfManager\Model;


abstract class Exame extends Modelo
{
    protected $data;
    protected $animal;
    protected $funcionario;

    abstract function gerarResultado(int $idExame);
    abstract function enviarResultadoPorEmail(int $idExame);
    abstract function imprimirResultado(int $idExame);

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
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
    public function setAnimal($animal)
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
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;
    }


}