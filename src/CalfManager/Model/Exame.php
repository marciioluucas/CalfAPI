<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 02/10/18
 * Time: 08:54
 */

namespace CalfManager\Model;


abstract class Exame extends Modelo
{
    protected $id;
    protected $data;
    protected $animal;
    protected $funcionario;

    abstract function gerarResultado(int $idExame);
    abstract function enviarResultadoPorEmail(int $idExame);
    abstract function imprimirResultado(int $idExame);
}