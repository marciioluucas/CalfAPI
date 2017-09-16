<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 16/09/17
 * Time: 14:25
 */

namespace controller;


use model\CiclosVida;
use model\validate\CiclosVidaValidate;
use util\DataConversor;

class CiclosVidaController implements IController
{
    public function post()
    {
        $ciclo = new CiclosVida();
        $data = (new DataConversor())->converter();
        $valida = (new CiclosVidaValidate())->validatePost($data);
        if ($valida === true) {
            $ciclo->setEnumFaseVida($data['enumFaseVida']);
            $ciclo->setEnumLocalizacao($data['enumLocalizacao']);
            $ciclo->setFkAnimal($data['fkAnimal']);
            View::render(["message" => $ciclo->cadastrar()]);
        } else {
            View::render($valida);
        }
    }

    public function get($param)
    {
        $ciclo = new CiclosVida();
        if (!empty($param)) {
            foreach ($param as $key => $val) {
                $var = "set" . ucfirst($key);
                if (method_exists($ciclo, 'set' . ucfirst($key))) {
                    $ciclo->$var($val);
                } else {
                    View::render([
                        "status" => 401,
                        "message" => "Parametro invalido " . $key
                    ]);
                }
            }
        }
        View::render($ciclo->pesquisar());
    }

    public function put($param)
    {
        $ciclo = new CiclosVida();
        if (isset($param['idCiclosVida'])) {
            $data = (new DataConversor())->converter();
            $ciclo->setIdCiclosVida($param['idCiclosVida']);
            if (isset($data['enumFaseVida'])) {
                $ciclo->setEnumFaseVida($data['enumFaseVida']);
            }
            if (isset($data['enumLocalizacao'])) {
                $ciclo->setEnumLocalizacao($data['enumLocalizacao']);
            }
            if (isset($data['fkAnimal'])) {
                $ciclo->setFkAnimal($data['fkAnimal']);
            }

            View::render($ciclo->alterar());
        }
    }

    public function delete($param)
    {
        $ciclo = new CiclosVida();
        if (isset($param['idCiclosVida'])) {
            $ciclo->setIdCiclosVida($param['idCiclosVida']);
            View::render($ciclo->deletar());
        }
    }

}