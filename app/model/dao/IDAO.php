<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 00:03
 */

namespace model\dao;


interface IDAO
{
    public function create($obj);

    public function update($obj);

    public function retrave($obj,$limite);

    public function delete($obj);
}