<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/02/2018
 * Time: 19:03
 */

namespace CalfManager\Model;

use CalfManager\Model\Repository\CargoDAO;
use CalfManager\Utils\Config;
use Exception;

class Cargo extends Modelo
{
    private $nome;
    private $descricao;

    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);

        try{
            if($this->getUsuarioCadastro()->getId() == null){
                $this->getUsuarioCadastro()->setId(1);
            }

            return (new CargoDAO())->create($this);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        try{
            if($this->getUsuarioAlteracao()->getId() == null){
                $this->getUsuarioAlteracao()->setId(1);
            }

            return (new CargoDAO())->update($this);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function pesquisar(int $page): array
    {
        if ($this->id) {
            return (new CargoDAO())->retreaveById($this->id);
        } elseif ($this->nome) {
            return (new CargoDAO())->retreaveByNome($this->nome, $page);
        }
        return (new CargoDAO())->retreaveAll($page);
    }

    public function deletar(): bool
    {
        try {
            return (new CargoDAO())->delete($this->id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
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
