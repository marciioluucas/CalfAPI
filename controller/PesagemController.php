<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:41
 */

namespace controller;



use model\Pesagem;
use model\validate\PesagemValidate;
use util\DataConversor;
use view\View;

class PesagemController implements IController
{

    public function post()
    {
        $pesagem = new Pesagem();
        $data = (new DataConversor())->converter();
        $valida = (new PesagemValidate())->validatePost($data);
        if ($valida === true) {
            $pesagem->setPeso($data['peso']);
            $pesagem->setData($data['data']);
            View::render(["Messagem"=>$pesagem->cadastrar()]);
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