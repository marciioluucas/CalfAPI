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
            View::render(["message" => $animal->cadastrar()]);
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
        $animal = new Animal();
        if ($param !== 0) {
            $data = (new DataConversor())->converter();
            $animal->setIdAnimal($param);
            if (isset($data['codigoBrinco'])) {
                $animal->setCodigoBrinco($data['codigoBrinco']);
            }
            if (isset($data['codigoRaca'])) {
                $animal->setCodigoRaca($data['codigoRaca']);
            }
            if (isset($data['dataNascimento'])) {
                $animal->setDataNascimento($data['dataNascimento']);
            }
            if (isset($data['fkPesagem'])) {
                $animal->setFkPesagem($data['fkPesagem']);
            }
            if (isset($data['fkMae'])) {
                $animal->setFkMae($data['fkMae']);
            }
            if (isset($data['fkPai'])) {
                $animal->setFkPai($data['fkPai']);
            }
            if (isset($data['fkLote'])) {
                $animal->setFkLote($data['fkLote']);
            }
            if (isset($data['fkFazenda'])) {
                $animal->setFkFazenda($data['fkFazenda']);
            }
            View::render(["message" => $animal->alterar()]);
        }
    }

    public function delete($param)
    {
        $animal = new Animal();
        if ($param !== 0) {
            $animal->setIdAnimal($param);
            View::render(["message" => $animal->deletar()]);
        }
    }
}