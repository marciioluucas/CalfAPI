<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 10/09/2018
 * Time: 22:28
 */

namespace CalfManager\Model;


use CalfManager\Model\Repository\DoseDAO;
use CalfManager\Model\Repository\MedicamentoDAO;
use CalfManager\Utils\Config;
use Exception;

class Dose extends Modelo
{
    private $quantidadeMg;
    private $data;
    private $medicamento;
    private $animal;
    private $funcionario;

    /**
     * Dose constructor.
     */
    public function __construct()
    {
        $this->medicamento = new Medicamento();
        $this->animal = new Animal();
        $this->funcionario = new Funcionario();
    }


    public function cadastrar(): ?int
    {

        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);

        $this->usuarioCadastro = new Usuario();
        $this->usuarioCadastro->setId(1);
        $this->funcionario->setId(1);
        try{
            return (new DoseDAO())->create($this);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function alterar(): bool
    {
         $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);

        $this->usuarioAlteracao = new Usuario();
         $this->usuarioAlteracao->setId(1);
        $this->funcionario->setId(1);
         try{
             return (new DoseDAO())->update($this);
         }catch (Exception $e){
             throw new Exception($e->getMessage());
         }
    }

    public function pesquisar(int $page): array
    {
        $dao = new DoseDAO();
        try{
            if($this->id and !$this->getMedicamento()->getId() and !$this->getAnimal()->getId() and !$this->getFuncionario()->getId()){
                return $dao->retreaveById($this->id);
            }
            if($this->id and !$this->getMedicamento()->getId() and !$this->getAnimal()->getId() and !$this->getFuncionario()->getId()){
                return $dao->retreaveByIdMedicamento($this->getMedicamento()->getId(), $page);
            }
            if ($this->id and !$this->getMedicamento()->getId() and !$this->getAnimal()->getId() and !$this->getFuncionario()->getId()){
                return $dao->retreaveByIdAnimal($this->getAnimal()->getId(), $page);
            }
            if ($this->id and !$this->getMedicamento()->getId() and !$this->getAnimal()->getId() and !$this->getFuncionario()->getId()){
                return $dao->retreaveByIdFuncionario($this->getFuncionario()->getId(), $page);
            }
            return $dao->retreaveAll($page);

        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deletar(): bool
    {
         try{
             return (new DoseDAO())->delete($this->id);
         }catch (Exception $e){
             throw new Exception($e->getMessage());
         }
    }
    public function antesDeSalvar(){
        $this->cadastrarMedicamento();
    }
    public function cadastrarMedicamento(){
        $this->getMedicamento()->cadastrar();
    }

    /**
     * @return mixed
     */
    public function getQuantidadeMg()
    {
        return $this->quantidadeMg;
    }

    /**
     * @param mixed $quantidadeMg
     */
    public function setQuantidadeMg($quantidadeMg)
    {
        $this->quantidadeMg = $quantidadeMg;
    }

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