<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 12/09/2017
 * Time: 23:56
 */

namespace model;


interface IModel
{
    public function cadastrar();

    public function alterar();

    public function pesquisar();

    public function deletar();
}