<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 12/09/2017
 * Time: 23:56
 */

namespace src\model;

use \Psr\Http\Message\RequestInterface as Request;

interface IModel
{
    public function cadastrar(Request $request);

    public function alterar(Request $request);

    public function pesquisar(Request $request);

    public function deletar(Request $request);
}