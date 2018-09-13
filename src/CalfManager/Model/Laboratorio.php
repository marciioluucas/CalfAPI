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

class Laboratorio extends Modelo
{
    private $id;
    private $dataEntrada;
    private $dataSaida;

    private $animal;
    private $doseAplicada;
    private $hemograma;


    public function __construct()
    {
        $this->animal = new Animal();
        $this->doseAplicada = new
        $this->hemograma = new Hemograma();
        $this->usuarioCadastro = new Usuario();
        $this->usuarioAlteracao = new Usuario();
    }


    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioCadastro = $this->setId(1);

        try{
            $idLaboratorio = (new LaboratorioDao())->create($this);
            $this->depoisDeSalvar($idLaboratorio);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }

    }

    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioAlteracao = $this->setId(1);
    }

    public function pesquisar(int $page): array
    {
        $dao = new LaboratorioDAO();
        try {
            if ($this->id and !$this->getAnimal()->getId() and !$this->getDoseAplicada()->getId() and !$this->getHemograma()->getId()){
                return $dao->retreaveById($this->id);
            }
            if (!$this->id and $this->getAnimal()->getId() and !$this->getDoseAplicada()->getId() and !$this->getHemograma()->getId()){
                return $dao->retreaveByIdAnimal($this->getAnimal()->getId(), $page);
            }
            if (!$this->id and !$this->getAnimal()->getId() and $this->getDoseAplicada()->getId() and !$this->getHemograma()->getId()){
                return $dao->retreaveByIdDoseAplicada($this->getDoseAplicada()->getId(), $page);
            }
            if (!$this->id and !$this->getAnimal()->getId() and !$this->getDoseAplicada()->getId() and $this->getHemograma()->getId()){
                return $dao->retreaveByIdHemograma($this->getHemograma()->getId(), $page);
            }
            else {
                $dao->retreaveAll($page);
            }
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deletar(): bool
    {
        try{
            return (new LaboratorioDAO())->delete($this->id);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    public function depoisDeSalvar($idLaboratorio){
        $this->setId($idLaboratorio);
    }
    public function aplicarMedicamento(){

    }
    public function realizarHemograma(){

    }
    public function registrarExameRotina(){

    }
    public function adoecerAnimal($idAnimal = null) {
        foreach ($this->doenca as $doenca) {
            (new DoencaDAO())->adoecer(
                $this->id == null ? $idAnimal : $this->id,
                $doenca->getSituacao(),
                $doenca->getId()
            );
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDataEntrada()
    {
        return $this->dataEntrada;
    }

    /**
     * @param mixed $dataEntrada
     */
    public function setDataEntrada($dataEntrada)
    {
        $this->dataEntrada = $dataEntrada;
    }

    /**
     * @return mixed
     */
    public function getDataSaida()
    {
        return $this->dataSaida;
    }

    /**
     * @param mixed $dataSaida
     */
    public function setDataSaida($dataSaida)
    {
        $this->dataSaida = $dataSaida;
    }

    /**
     * @return mixed
     */
    public function getDoseAplicada()
    {
        return $this->doseAplicada;
    }

    /**
     * @param mixed $doseAplicada
     */
    public function setDoseAplicada($doseAplicada)
    {
        $this->doseAplicada = $doseAplicada;
    }

    /**
     * @return Doenca
     */
    public function getDoenca(): Doenca
    {
        return $this->doenca;
    }

    /**
     * @param Doenca $doenca
     */
    public function setDoenca(Doenca $doenca)
    {
        $this->doenca = $doenca;
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
     * @return Medicamento
     */
    public function getMedicamento(): Medicamento
    {
        return $this->medicamento;
    }

    /**
     * @param Medicamento $medicamento
     */
    public function setMedicamento(Medicamento $medicamento)
    {
        $this->medicamento = $medicamento;
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

}