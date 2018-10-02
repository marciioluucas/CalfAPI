<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 12:59
 */

namespace CalfManager\Model;

use Exception;
use CalfManager\Model\Repository\LoteDAO;
use CalfManager\Utils\Config;

/**
 * Class Lote
 * @package CalfManager\Model
 */
class Lote extends Modelo
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int|string
     */
    private $codigo;
    /**
     * @var string|null;
     */
    private $descricao;


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
            return (new LoteDAO())->create($this);
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
        $this->usuarioAlteracao = new Usuario();
        $this->usuarioAlteracao->setId(1);
        try {

            return (new LoteDAO())->update($this);
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
                return (new LoteDAO())->retreaveById($this->id);
            } elseif ($this->codigo) {
                return (new LoteDAO())->retreaveByCodigo($this->codigo, $page);
            }
            return (new LoteDAO())->retreaveAll($page);
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
            return (new LoteDAO())->delete($this->id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param int|string $codigo
     */
    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }

    /**
     * @return string|null
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }
}
