<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:37
 */

namespace src\model;

use Psr\Http\Message\RequestInterface as Request;

class Pesagem extends Modelo
{
    private $id;
    private $peso;
    private $animal;

    public function __construct()
    {
            $this->animal = new Animal();
    }

    public function cadastrar()
    {
    }

    public function alterar()
    {
        // TODO: Implement alterar() method.
    }

    public function pesquisar(Request $request)
    {
        // TODO: Implement pesquisar() method.
    }

    public function deletar()
    {
        // TODO: Implement deletar() method.
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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * @param mixed $peso
     */
    public function setPeso($peso): void
    {
        $this->peso = $peso;
    }



}