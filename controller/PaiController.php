<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 14:30
 */

namespace controller;


use model\Pai;
use model\validate\PaiValidate;
use util\DataConversor;
use view\View;

class PaiController implements IController
{

    public function post()
    {
        $pai = new Pai();
        $data = (new DataConversor())->converter();
        $valida = (new PaiValidate())->validatePost($data);
        if ($valida === true) {
            $pai->setNome($data['nome']);
            View::render(["Messagem"=>$pai->cadastrar()]);
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