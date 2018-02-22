<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:37
 */

namespace src\model;

use Psr\Http\Message\RequestInterface as Request;
use src\util\Config;

class Pesagem extends Modelo
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var float
     */
    private $peso;
    /**
     * @var string
     */
    private $dataPesagem;

    /**
     * @return mixed|void
     */
    public function cadastrar()
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);
    }

    /**
     * @return mixed|void
     */
    public function alterar()
    {
        // TODO: Implement alterar() method.
    }

    /**
     * @param Request $request
     * @return array|void
     */
    public function pesquisar(Request $request)
    {
        // TODO: Implement pesquisar() method.
    }

    /**
     * @return mixed|void
     */
    public function deletar()
    {
        // TODO: Implement deletar() method.
    }

    /**
     * @return int
     */
    public function getId(): int
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
     * @return float
     */
    public function getPeso(): float
    {
        return $this->peso;
    }

    /**
     * @param float $peso
     */
    public function setPeso(float $peso): void
    {
        $this->peso = $peso;
    }

    /**
     * @return string
     */
    public function getDataPesagem(): string
    {
        return $this->dataPesagem;
    }

    /**
     * @param string $dataPesagem
     */
    public function setDataPesagem(string $dataPesagem): void
    {
        $this->dataPesagem = $dataPesagem;
    }


}