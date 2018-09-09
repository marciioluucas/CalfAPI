<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 15:19
 */

namespace CalfManager\Model;


use CalfManager\Model\Repository\FuncionarioDAO;
use Exception;
use Symfony\Component\Cache\Tests\CacheItemTest;

class Funcionario extends Pessoa
{
    private $id;
    private $salario;

    private $cargo;
    private $usuario;
    private $fazenda;


    /**
     * Funcionario constructor.
     */
    public function __construct()
    {
        $this->cargo = new Cargo();
        $this->usuario = new Usuario();
        $this->fazenda = new Fazenda();
        $this->usuarioCadastro = new Usuario();
        $this->usuarioAlteracao = new Usuario();
    }


    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioCadastro = $this->setId(1);
        try{
            $idFuncionario = (new FuncionarioDAO())->create($this);
            $this->depoisDeSalvar($idFuncionario);
            return $idFuncionario;
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }

    }

    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioAlteracao = $this->setId(1);
        try{
            return (new FuncionarioDAO())->update($this);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function pesquisar(int $page): array
    {
        $dao = new FuncionarioDAO();
        try{
            if($this->id and !$this->getCargo()->getId() and !$this->getUsuario()->getId() and !$this->getFazenda()->getId()){
                return $dao->retreaveById($this->id);
            }
            if(!$this->id and $this->getCargo()->getId() and !$this->getUsuario()->getId() and !$this->getFazenda()->getId()){
                return $dao->retreaveByIdCargo($this->getCargo()->getId(), $page);
            }
            if(!$this->id and !$this->getCargo()->getId() and $this->getUsuario()->getId() and !$this->getFazenda()->getId()){
                return $dao->retreaveByIdUsuario($this->getUsuario()->getId(), $page);
            }
            if(!$this->id and !$this->getCargo()->getId() and !$this->getUsuario()->getId() and $this->getFazenda()->getId()){
                return $dao->retreaveByIdFazenda($this->getFazenda()->getId(), $page);
            }
            else{
                return $dao->retreaveAll($page);
            }
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }


    }

    public function deletar(): bool
    {
        try{
            return (new FuncionarioDAO())->delete($this->id);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    public function depoisDeSalvar($idFuncionario){
        $this->setId($idFuncionario);
        $this->cadastrarCargo();
        $this->cadastrarUsuario();
        $this->cadastrarFazenda();
    }
    public function cadastrarCargo(){
        $this->getCargo()->cadastrar();
    }
    public function cadastrarUsuario(){
        $this->getUsuario()->cadastrar();
    }
    public function cadastrarFazenda(){
        $this->getFazenda()->cadastrar();
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
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * @param mixed $cargo
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * @param mixed $salario
     */
    public function setSalario($salario)
    {
        $this->salario = $salario;
    }

    /**
     * @return Fazenda
     */
    public function getFazenda(): Fazenda
    {
        return $this->fazenda;
    }

    /**
     * @param Fazenda $fazenda
     */
    public function setFazenda(Fazenda $fazenda)
    {
        $this->fazenda = $fazenda;
    }



}