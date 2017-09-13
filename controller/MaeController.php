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
            View::render(["Messagem"=>$mae->cadastrar()]);
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