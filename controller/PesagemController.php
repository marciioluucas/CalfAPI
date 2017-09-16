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
            View::render($pesagem->cadastrar());
        } else {
            View::render($valida);
        }
    }

    public function get($param)
    {
        $pesagem = new Pesagem();
        if (!empty($param)) {
            foreach ($param as $key => $val) {
                $var = "set" . ucfirst($key);
                if (method_exists($pesagem, 'set' . ucfirst($key))) {
                    $pesagem->$var($val);
                } else {
                    View::render([
                        "status" => 401,
                        "message" => "Parametro invalido " . $key
                    ]);
                }
            }
        }
        View::render($pesagem->pesquisar());
    }

    public function put($param)
    {

        $pesagem = new Pesagem();
        if (isset($param['idPesagem'])) {
            $data = (new DataConversor())->converter();
            $pesagem->setIdPesagem($param['idPesagem']);
            if (isset($data['peso'])) {
                $pesagem->setPeso($data['peso']);
            }
            if (isset($data['data'])) {
                $pesagem->setData($data['data']);
            }
            View::render($pesagem->alterar());
        }
    }

    public function delete($param)
    {
        $pesagem = new Pesagem();
        if (isset($param['idPesagem'])) {
            $pesagem->setIdPesagem($param['idPesagem']);
            View::render($pesagem->deletar());
        }
    }
}