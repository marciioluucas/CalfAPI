<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 15:57
 */
namespace CalfManager\Model;

use CalfManager\Model\Repository\PermissaoDAO;
use CalfManager\Utils\Config;
use Exception;

class Permissao extends Modelo
{
    private $id;
    private $nomeModulo;
    private $create;
    private $read;
    private $update;
    private $delete;

    private $grupo;


    public function __construct()
    {
        $this->grupo = new Grupo();
        $this->usuarioCadastro = new Usuario();
        $this->usuarioAlteracao = new Usuario();
    }


    public function cadastrar(): ?int
    {
        $this->usuarioCadastro->setId(1);
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        try{
            return (new PermissaoDAO())->create($this);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function alterar(): bool
    {
        $this->usuarioAlteracao->setId(1);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        try{
            return (new PermissaoDAO())->update($this);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }

    }

    public function pesquisar(int $page): array
    {
        try{
            if($this->id){
                return (new PermissaoDAO())->retreaveById($this->id);
            } else if($this->nomeModulo){
                return (new PermissaoDAO())->retreaveByNomeModulo($this->nomeModulo, $page);
            }
            else if($this->getGrupo()->getId()){
                return (new PermissaoDAO())->retreaveByIdGrupo($this->getGrupo()->getId(), $page);
            }
            return (new PermissaoDAO())->retreaveAll($page);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deletar(): bool
    {
        try{
            return (new PermissaoDAO())->delete($this->id);
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
    public function getNomeModulo()
    {
        return $this->nomeModulo;
    }

    /**
     * @param mixed $nomeModulo
     */
    public function setNomeModulo($nomeModulo)
    {
        $this->nomeModulo = $nomeModulo;
    }

    /**
     * @return mixed
     */
    public function getCreate()
    {
        return $this->create;
    }

    /**
     * @param mixed $create
     */
    public function setCreate($create)
    {
        $this->create = $create;
    }

    /**
     * @return mixed
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * @param mixed $read
     */
    public function setRead($read)
    {
        $this->read = $read;
    }

    /**
     * @return mixed
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * @param mixed $update
     */
    public function setUpdate($update)
    {
        $this->update = $update;
    }

    /**
     * @return mixed
     */
    public function getDelete()
    {
        return $this->delete;
    }

    /**
     * @param mixed $delete
     */
    public function setDelete($delete)
    {
        $this->delete = $delete;
    }

    /**
     * @return mixed
     */
    public function getGrupo(): Grupo
    {
        return $this->grupo;
    }

    /**
     * @param mixed $grupo
     */
    public function setGrupo(Grupo $grupo): void
    {
        $this->grupo = $grupo;
    }




}