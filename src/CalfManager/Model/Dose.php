<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 10/09/2018
 * Time: 22:28
 */

namespace CalfManager\Model;


use CalfManager\Model\Repository\DoseAplicadaDAO;
use CalfManager\Model\Repository\MedicamentoDAO;
use CalfManager\Utils\Config;
use Exception;

class Dose extends Modelo
{
    private $quantidadeMg;
    private $data;
    private $medicamento;

    /**
     * Dose constructor.
     */
    public function __construct()
    {
        $this->medicamento = new Medicamento();
    }


    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);

        $this->usuarioCadastro = new Usuario();
        $this->usuarioCadastro->setId(1);
        try{
            return (new DoseAplicadaDAO())->create($this);
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
             return (new DoseAplicadaDAO())->update($this);
         }catch (Exception $e){
             throw new Exception($e->getMessage());
         }
    }

    public function pesquisar(int $page): array
    {
        $dao = new DoseAplicadaDAO();
        try{
            if($this->id and !$this->getMedicamento()->getId()){
                return $dao->retreaveById($this->id);
            }
            if(!$this->id and $this->getMedicamento()->getId()){
                return $dao->retreaveByIdMedicamento($this->getMedicamento()->getId(), $page);
            }
            return $dao->retreaveAll($page);

        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deletar(): bool
    {
         try{
             return (new DoseAplicadaDAO())->delete($this->id);
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
    public function getQuantidadeMg()
    {
        return $this->quantidadeMg;
    }

    /**
     * @param mixed $quantidadeMg
     */
    public function setQuantidadeMg($quantidadeMg): void
    {
        $this->quantidadeMg = $quantidadeMg;
    }



}