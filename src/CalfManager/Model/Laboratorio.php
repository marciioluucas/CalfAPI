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
//TODO tirar o extends do Modelo
class Laboratorio extends Modelo
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

    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);

        $this->usuarioCadastro = new Usuario();
        $this->usuarioCadastro->setId(1);

        try{
            $idLaboratorio = (new LaboratorioDao())->create($this);

            return $idLaboratorio;
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);

        $this->usuarioAlteracao = new Usuario();
        $this->usuarioAlteracao->setId(1);
        try{
            return (new LaboratorioDAO())->update($this);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
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
            return $dao->retreaveAll($page);

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
        //TODO instanciar a dose, colocar os dados que precisam e salvar a dose.
    }
    public function realizarHemograma(){

    }
    public function registrarExameRotina(){

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
        return $this->dose;
    }

    /**
     * @param mixed $dose
     */
    public function setDoseAplicada($dose)
    {
        $this->dose = $dose;
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