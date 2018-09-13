<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/02/2018
 * Time: 19:02
 */

namespace CalfManager\Model;

use CalfManager\Model\Repository\GrupoDAO;
use CalfManager\Utils\Config;
use Exception;

class Grupo extends Modelo
{
    private $id;
    private $nome;
    private $descricao;

    private $usuario;
    private $permissao;

    public function __construct()
    {
        $this->usuario = new Usuario();
        $this->permissao = new Permissao();
        $this->usuarioCadastro = new Usuario();
        $this->usuarioAlteracao = new Usuario();
    }


    public function cadastrar(): ?int
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioCadastro->setId(1);
        try{
            $idGrupo = (new GrupoDAO())->create($this);
            return $idGrupo;
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioAlteracao->setId(1);
        try{
           return (new GrupoDAO())->update($this);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function pesquisar(int $page): array
    {
        try {
            $dao = new GrupoDAO();

            if ($this->id and !$this->nome) {
                return $dao->retreaveById($this->id);
            }
            if (!$this->id and $this->nome) {
                return $dao->retreaveByNome($this->nome, $page);
            }
            return $dao->retreaveAll($page);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deletar(): bool
    {
        try{
            return (new GrupoDAO())->delete($this->id);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    public function depoisDeSalvar($idGrupo){
        $this->setId($idGrupo);
        $this->cadastrarPermissao();
    }

    public function cadastrarPermissao(){
        $this->getPermissao()->cadastrar();
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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }


    /**
     * @return Permissao
     */
    public function getPermissao(): Permissao
    {
        return $this->permissao;
    }

    /**
     * @param Permissao $permissao
     */
    public function setPermissao(Permissao $permissao)
    {
        $this->permissao = $permissao;
    }

    /**
     * @return mixed
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }



}
