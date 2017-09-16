<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 16/09/17
 * Time: 14:25
 */

namespace controller;


use model\CiclosVida;
use util\DataConversor;

class CiclosVidaController implements IController
{
    public function post()
    {
        $ciclo = new CiclosVida();
        $data = (new DataConversor())->converter();
        $valida = (new AnimalValidate())->validatePost($data);
        if ($valida === true) {
            $animal->setCodigoBrinco($data['codigoBrinco']);
            $animal->setCodigoRaca($data['codigoRaca']);
            $animal->setDataNascimento($data['dataNascimento']);
            $animal->setFkPesagem($data['fkPesagem']);
            $animal->setFkMae($data['fkMae']);
            $animal->setFkPai($data['fkPai']);
            $animal->setFkLote($data['fkLote']);
            $animal->setFkFazenda($data['fkFazenda']);
            View::render(["message" => $animal->cadastrar()]);
        } else {
            View::render($valida);
        }
    }

    public function get($param)
    {
        // TODO: Implement get() method.
    }

    public function put($param)
    {
        // TODO: Implement put() method.
    }

    public function delete($param)
    {
        // TODO: Implement delete() method.
    }

}