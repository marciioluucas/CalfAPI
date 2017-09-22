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
            $animal->setNomeAnimal($data['nomeAnimal']);
            $animal->setCodigoRaca($data['codigoRaca']);
            $animal->setDataNascimento($data['dataNascimento']);
            $animal->setFkPesagem($data['fkPesagem']);
            $animal->setFkMae($data['fkMae']);
            $animal->setFkPai($data['fkPai']);
            $animal->setFkLote($data['fkLote']);
            $animal->setFkFazenda($data['fkFazenda']);
            View::render($animal->cadastrar());
        } else {
            View::render($valida);
        }
    }

    public function get($param)
    {
        $animal = new Animal();
        if (!empty($param)) {
            foreach ($param as $key => $val) {
                $var = "set" . ucfirst($key);
                if (method_exists($animal, 'set' . ucfirst($key))) {
                    $animal->$var($val);
                } else {
                    View::render([
                        "status" => 400,
                        "message" => "Parametro invalido " . $key
                    ]);
                }
            }
        }
        View::render($animal->pesquisar());
    }

    public function put($param)
    {
        $animal = new Animal();
        if (isset($param['idAnimal'])) {
            $data = (new DataConversor())->converter();
            $animal->setIdAnimal($param['idAnimal']);
            if (isset($data['codigoBrinco'])) {
                $animal->setCodigoBrinco($data['codigoBrinco']);
            }
            if (isset($data['codigoRaca'])) {
                $animal->setCodigoRaca($data['codigoRaca']);
            }
            if (isset($data['nomeAnimal'])) {
                $animal->setNomeAnimal($data['nomeAnimal']);
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
            View::render($animal->alterar());
        }
    }

    public function delete($param)
    {
        $animal = new Animal();
        if (isset($param['idAnimal'])) {
            $animal->setIdAnimal($param['idAnimal']);
            View::render($animal->deletar());
        }
    }
}