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
    private $nome;
    private $descricao;

    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);

        $this->usuarioCadastro = new Usuario();
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

        $this->usuarioAlteracao = new Usuario();
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
    public function antesDeSalvar(){
        $this->cadastrarPermissao();
    }

    public function cadastrarPermissao(){
        try {
            $this->getPermissao()->cadastrar();
        } catch (Exception $e) {
        }
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

}
