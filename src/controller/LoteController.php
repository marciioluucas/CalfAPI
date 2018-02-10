<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:15
 */

namespace src\controller;


use src\model\Lote;
use src\model\validate\LoteValidate;
use src\util\DataConversor;
use view\View;

class LoteController implements IController
{

    public function post()
    {
        $lote = new Lote();
        $data = (new DataConversor())->converter();
        $valida = (new LoteValidate())->validatePost($data);
        if ($valida === true) {
            $lote->setCodigoLote($data['codigoLote']);
            View::render($lote->cadastrar());
        } else {
            View::render($valida);
        }
    }

    public function get($param)
    {
        $lote = new Lote();
        if (!empty($param)) {
            foreach ($param as $key => $val) {
                $var = "set" . ucfirst($key);
                if (method_exists($lote, 'set' . ucfirst($key))) {
                    $lote->$var($val);
                } else {
                    View::render([
                        "status" => 401,
                        "message" => "Parametro invalido " . $key
                    ]);
                }
            }
        }
        View::render($lote->pesquisar());

    }

    public
    function put($param)
    {
        $lote = new Lote();
        if (isset($param['idLote'])) {
            $data = (new DataConversor())->converter();
            $lote->setIdLote($param['idLote']);
            if (isset($data['codigoLote'])) {
                $lote->setCodigoLote($data['codigoLote']);
            }
            View::render($lote->alterar());
        }
    }

    public
    function delete($param)
    {
        $lote = new Lote();
        if (isset($param['idLote'])) {
            $lote->setIdLote($param['idLote']);
            View::render($lote->deletar());
        }
    }
}