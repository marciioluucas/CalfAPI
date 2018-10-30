<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 15:59
 */

namespace CalfManager\Model;

use ArrayObject;
use CalfManager\Model\Repository\LaboratorioDAO;
use CalfManager\Utils\Config;
use Exception;
class Laboratorio
{

    private $animal;
    private $dose;
    private $hemograma;
    private $funcionario;


    /**
     * Laboratorio constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->animal = new Animal();
        $this->dose = new Dose();
        $this->hemograma = new Hemograma();
        $this->funcionario = new Funcionario();
    }

    public function aplicarMedicamento()
    {
        //TODO instanciar a dose, colocar os dados que precisam e salvar a dose.
    }

    public function realizarHemograma()
    {

    }

    public function registrarExameRotina()
    {

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
    public function setAnimal(Animal $animal)
    {
        $this->animal = $animal;
    }

    /**
     * @return Dose
     */
    public function getDose(): Dose
    {
        return $this->dose;
    }

    /**
     * @param Dose $dose
     */
    public function setDose(Dose $dose)
    {
        $this->dose = $dose;
    }

    /**
     * @return Hemograma
     */
    public function getHemograma(): Hemograma
    {
        return $this->hemograma;
    }

    /**
     * @param Hemograma $hemograma
     */
    public function setHemograma(Hemograma $hemograma)
    {
        $this->hemograma = $hemograma;
    }

    /**
     * @return Funcionario
     */
    public function getFuncionario(): Funcionario
    {
        return $this->funcionario;
    }

    /**
     * @param Funcionario $funcionario
     */
    public function setFuncionario(Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
    }

}
