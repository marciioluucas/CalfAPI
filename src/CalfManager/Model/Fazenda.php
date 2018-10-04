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
     * @return int|null
     * @throws Exception
     */
    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->usuarioCadastro = new Usuario();
        $this->usuarioCadastro->setId(1);
        try {
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
        $this->usuarioAlteracao = new Usuario();
        $this->usuarioAlteracao->setId(1);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
        try {
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
            if ($this->id) {
                return (new FazendaDAO())->retreaveById($this->id);
            } elseif ($this->nome) {
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
            return (new FazendaDAO())->delete($this->id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
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
