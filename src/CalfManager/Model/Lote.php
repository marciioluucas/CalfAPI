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
     * @var int|string
     */
    private $codigo;
    /**
     * @var string|null;
     */
    private $descricao;

    private $fazenda;

    private $contagem;

    private $contagemAnimais;
    
    private $lotesQtdAnimais;

    /**
     * Lote constructor.
     */
    public function __construct()
    {
        $this->fazenda = new Fazenda();
    }

    /**
     * @return int|null
     * @throws Exception
     */
    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);

        try {
            if ($this->getUsuarioCadastro()->getId() == null) {
                $this->getUsuarioCadastro()->setId(1);
            }

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

        try {
            if ($this->getUsuarioAlteracao()->getId() == null) {
                $this->getUsuarioAlteracao()->setId(1);
            }

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
            if ($this->id and !$this->codigo and !$this->getFazenda()->getId()) {
                if($this->id and $this->contagemAnimais){
                    return (new LoteDAO())->retreaveQtdAnimaisPorLote($this->id);
                }
                return (new LoteDAO())->retreaveById($this->id);
            }
            if (!$this->id and $this->codigo and !$this->getFazenda()->getId()) {
                return (new LoteDAO())->retreaveByCodigo($this->codigo, $page);
            }
            if (!$this->id and !$this->codigo and $this->getFazenda()->getId()) {
                return (new LoteDAO())->retreaveByIdFazenda($this->getFazenda()->getId(), $page);
            }
            if ($this->contagem) {
                return (new LoteDAO())->retreaveQuantidadeLotes();
            }
            if($this->lotesQtdAnimais){
                return (new LoteDAO())->retreaveQtdAnimaisByLote();
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
            $dao = new LoteDAO();
            if($dao->PossuiAnimais($this->id)){
                throw new Exception("Não é possível excluir o lote, pois existe referencia em animais", 400);
            } 
            
            return $dao->delete($this->id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode() != null ? $e->getCode() : 500);
        }
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

    /**
     * @return mixed
     */
    public function getContagem()
    {
        return $this->contagem;
    }

    /**
     * @param mixed $contagem
     */
    public function setContagem($contagem)
    {
        $this->contagem = $contagem;
    }

    /**
     * @return mixed
     */
    public function getContagemAnimais()
    {
        return $this->contagemAnimais;
    }

    /**
     * @param mixed $contagemAnimais
     */
    public function setContagemAnimais($contagemAnimais)
    {
        $this->contagemAnimais = $contagemAnimais;
    }
    
    function getLotesQtdAnimais() {
        return $this->lotesQtdAnimais;
    }

    function setLotesQtdAnimais($lotesQtdAnimais): void {
        $this->lotesQtdAnimais = $lotesQtdAnimais;
    }


}
