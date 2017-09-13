<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:15
 */

namespace controller;


use model\Lote;
use model\validate\LoteValidate;
use util\DataConversor;
use view\View;

class LoteController implements IController
{

    public function post()
    {
        $lote = new Lote();
        $data = (new DataConversor())->converter();
        $valida = (new LoteValidate())->validatePost($data);
        if ($valida === true) {
            $lote->setCodigo($data['codigo']);
            View::render(["Messagem" => $lote->cadastrar()]);
        } else {
            View::render($valida);
        }
    }

    public function get($param)
    {
        $lote = new Lote();
        $data = (new DataConversor())->converter();
        $valida = (new LoteValidate())->validateGet($data);
        if (isset($param)) {
            $lote->setIdLote($param);
            View::render(["message"=>$lote->pesquisar()]);
        } else if ($valida === true) {
            $lote->setIdLote($data['idLote']);
            View::render(["message"=>$lote->pesquisar()]);
        } else {
            View::render($valida);
        }
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