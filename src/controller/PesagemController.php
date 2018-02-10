<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 13:41
 */

namespace src\controller;


use src\model\Pesagem;
use src\model\validate\PesagemValidate;
use src\util\DataConversor;
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
            $pesagem->setDataPesagem($data['dataPesagem']);
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
            if (isset($data['dataPesagem'])) {
                $pesagem->setDataPesagem($data['dataPesagem']);
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