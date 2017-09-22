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
            $pai->setNomePai($data['nomePai']);
            View::render($pai->cadastrar());
        } else {
            View::render($valida);
        }
    }

    public function get($param)
    {
        $pai = new Pai();
        if (!empty($param)) {
            foreach ($param as $key => $val) {
                $var = "set" . ucfirst($key);
                if (method_exists($pai, 'set' . ucfirst($key))) {
                    $pai->$var($val);
                } else {
                    View::render([
                        "status"=> 401,
                        "message" => "Parametro invalido " . $key
                    ]);
                }
            }
        }
        View::render($pai->pesquisar());
    }

    public function put($param)
    {

        $pai = new Pai();
        if (isset($param['idPai'])) {
            $data = (new DataConversor())->converter();
            $pai->setIdPai($param['idPai']);
            if (isset($data['nomePai'])) {
                $pai->setNomePai($data['nomePai']);
            }
            View::render($pai->alterar());
        }
    }

    public function delete($param)
    {
        $pai = new Pai();
        if (isset($param['idPai'])) {
            $pai->setIdPai($param['idPai']);
            View::render($pai->deletar());
        }
    }
}