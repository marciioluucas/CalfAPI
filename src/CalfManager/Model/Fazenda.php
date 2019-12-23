<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 11:42
 */

namespace CalfManager\Model;

use Exception;
use CalfManager\Model\Repository\FazendaDAO;
use CalfManager\Utils\Config;

/**
 * Class Fazenda
 * @package CalfManager\Model
 */
class Fazenda extends Modelo
{
    /**
     * @var string
     */
    private $nome;

    /**
     * @var mixed
     */
    private $limite = 0;

    /**
     * Fazenda constructor.
     * @param $lote
     */



    /**
     * @return int|null
     * @throws Exception
     */
    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);

        try {
            if($this->getUsuarioCadastro()->getId() == null){
                $this->getUsuarioCadastro()->setId(1);
            }

            return (new FazendaDAO())->create($this);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        try {
            if($this->getUsuarioAlteracao()->getId() == null){
                $this->getUsuarioAlteracao()->setId(1);
            }

            return (new FazendaDAO())->update($this);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function pesquisar(int $page): array
    {
        try {
            if ($this->id and !$this->nome) {
                return (new FazendaDAO())->retreaveById($this->id);
            }
            elseif (!$this->id and $this->nome) {
                return (new FazendaDAO())->retreaveByNome($this->nome, $page);
            }

            return (new FazendaDAO())->retreaveAll($page);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function deletar(): bool
    {
        try {
            $dao = new FazendaDAO();
            if($dao->possuiReferencias($this->id))
            {
                throw new Exception("Não é possível excluir a fazenda, pois existe referência em animais, funcionários ou lotes", 400);
            }
            return $dao->delete($this->id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode() != null ? $e->getCode() : 500);
        }
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getLimite()
    {
        return $this->limite;
    }

    /**
     * @param mixed $limite
     */
    public function setLimite($limite): void
    {
        $this->limite = $limite;
    }

}
