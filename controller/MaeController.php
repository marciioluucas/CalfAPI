<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 14:30
 */

namespace controller;


use model\Mae;
use model\validate\MaeValidate;
use util\DataConversor;
use view\View;

class MaeController implements IController
{

    public function post()
    {
        $mae = new Mae();
        $data = (new DataConversor())->converter();
        $valida = (new MaeValidate())->validatePost($data);
        if ($valida === true) {
            $mae->setNome($data['nome']);
            View::render($mae->cadastrar());
        } else {
            View::render($valida);
        }
    }

    public function get($param)
    {
        $mae = new Mae();
        if (!empty($param)) {
            foreach ($param as $key => $val) {
                $var = "set" . ucfirst($key);
                if (method_exists($mae, 'set' . ucfirst($key))) {
                    $mae->$var($val);
                } else {
                    View::render([
                        "status" => 401,
                        "message" => "Parametro invalido " . $key
                    ]);
                }
            }
        }
        View::render($mae->pesquisar());
    }

    public function put($param)
    {

        $mae = new Mae();
        if (isset($param['idMae'])) {
            $data = (new DataConversor())->converter();
            $mae->setIdMae($param['idMae']);
            if (isset($data['nome'])) {
                $mae->setNome($data['nome']);
            }
            View::render($mae->alterar());
        }
    }

    public function delete($param)
    {
        $mae = new Mae();
        if (isset($param['idMae'])) {
            $mae->setIdMae($param['idMae']);
            View::render($mae->deletar());
        }
    }
}