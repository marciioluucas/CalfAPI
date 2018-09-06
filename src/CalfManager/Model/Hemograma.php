<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 16:01
 */

namespace CalfManager\Model;


use CalfManager\Model\Repository\HemogramaDAO;
use Exception;

class Hemograma extends Modelo
{
    private $id;
    private $dataExame;
    private $ppt;
    private $hematocrito;

    public function __construct()
    {
        $this->usuarioCadastro = new Usuario();
        $this->usuarioAlteracao = new Usuario();
    }


    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioCadastro = $this->setId(1);
        try{
            return (new HemogramaDAO())->create($this);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioAlteracao = $this->setId(1);
        try{
            return (new HemogramaDAO())->update($this);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function pesquisar(int $page): array
    {
        try{
            if($this->id){
                return (new HemogramaDAO())->retreaveById($this->id);
            }
            return (new HemogramaDAO())->retreaveAll($page);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deletar(): bool
    {
        try{
            return (new HemogramaDAO())->delete($this->id);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
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
    public function getDataExame()
    {
        return $this->dataExame;
    }

    /**
     * @param mixed $dataExame
     */
    public function setDataExame($dataExame)
    {
        $this->dataExame = $dataExame;
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

}