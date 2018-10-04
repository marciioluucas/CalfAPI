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


    /**
     * Laboratorio constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->animal = new Animal();
        $this->dose = new Dose();
        $this->hemograma = new Hemograma();
    }

//    public function pesquisar(int $page): array
//    {
//        $dao = new LaboratorioDAO();
//        try {
//            if ($this->id and !$this->getAnimal()->getId() and !$this->getDoseAplicada()->getId() and !$this->getHemograma()->getId()) {
//                return $dao->retreaveById($this->id);
//            }
//            if (!$this->id and $this->getAnimal()->getId() and !$this->getDoseAplicada()->getId() and !$this->getHemograma()->getId()) {
//                return $dao->retreaveByIdAnimal($this->getAnimal()->getId(), $page);
//            }
//            if (!$this->id and !$this->getAnimal()->getId() and $this->getDoseAplicada()->getId() and !$this->getHemograma()->getId()) {
//                return $dao->retreaveByIdDoseAplicada($this->getDoseAplicada()->getId(), $page);
//            }
//            if (!$this->id and !$this->getAnimal()->getId() and !$this->getDoseAplicada()->getId() and $this->getHemograma()->getId()) {
//                return $dao->retreaveByIdHemograma($this->getHemograma()->getId(), $page);
//            }
//            return $dao->retreaveAll($page);
//
//        } catch (Exception $e) {
//            throw new Exception($e->getMessage());
//        }
//    }

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
//    public function adoecerAnimal($idAnimal = null) {
//        foreach ($this->doenca as $doenca) {
//            (new DoencaDAO())->adoecer(
//                $this->id == null ? $idAnimal : $this->id,
//                $doenca->getSituacao(),
//                $doenca->getId()
//            );
//        }
//    }

}