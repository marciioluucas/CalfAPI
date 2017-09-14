<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 11:46
 */

namespace controller;


use model\Fazenda;
use model\validate\FazendaValidate;
use util\DataConversor;
use view\View;

class FazendaController implements IController
{

    public function post()
    {
        $fazenda = new Fazenda();
        $data = (new DataConversor())->converter();
        $valida = (new FazendaValidate())->validatePost($data);
        if ($valida === true) {
            $fazenda->setNome($data['nome']);
            View::render(["Message"=>$fazenda->cadastrar()]);
        } else {
            View::render($valida);
        }
    }

    public function get($param)
    {
        $fazenda = new Fazenda();
        $fazenda->setIdFazenda($param);
        View::render(["message" => $fazenda->pesquisar()]);
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