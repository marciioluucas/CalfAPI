<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 16:01
 */

namespace CalfManager\Model;


use CalfManager\Model\Repository\MedicamentoDAO;
use CalfManager\Utils\Config;
use Exception;

class Medicamento extends Modelo
{
    private $id;
    private $nome;
    private $prescricao;

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
            return (new MedicamentoDAO())->create($this);
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioAlteracao = $this->setId(1);
        try{
            return (new MedicamentoDAO())->update($this);
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function pesquisar(int $page): array
    {
        try{
            if ($this->id) {
                return (new MedicamentoDAO())->retreaveById($this->id);
            } elseif ($this->nome) {
                return (new MedicamentoDAO())->retreaveByNome($this->nome, $page);
            }
            return (new LoteDAO())->retreaveAll($page);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function deletar(): bool
    {
        try{
            return (new MedicamentoDAO())->delete($this->id);
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
    public function getPrescricao()
    {
        return $this->prescricao;
    }

    /**
     * @param mixed $prescricao
     */
    public function setPrescricao($prescricao)
    {
        $this->prescricao = $prescricao;
    }

}