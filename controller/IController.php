<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2017
 * Time: 18:02
 */

namespace controller;


interface IController
{
    public function post();

    public function get($param);

    public function put($param);

    public function delete($param);
}