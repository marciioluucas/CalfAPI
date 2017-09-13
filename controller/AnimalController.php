<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 12/09/2017
 * Time: 23:50
 */

namespace controller;


use model\Animal;
use model\validate\AnimalValidate;
use util\DataConversor;
use view\View;

class AnimalController implements IController
{

    public function post()
    {
        $animal = new Animal();
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
            View::render(["message"=>$animal->cadastrar()]);
        } else {
            View::render($valida);
        }
    }

    public function get($param)
    {
        $animal = new Animal();
        $animal->setIdAnimal($param);
        View::render(["message" => $animal->pesquisar()]);
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