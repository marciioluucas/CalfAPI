<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 00:03
 */

namespace src\model\repository;



interface IDAO
{
    public function create($obj);

    public function update($obj);

    public function retreaveAll(int $page);

    public function retreaveById(int $id);

    public function delete(int $id);
}