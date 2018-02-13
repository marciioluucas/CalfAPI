<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 12/09/2017
 * Time: 23:52
 */

namespace src\model;


use Exception;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Support\Facades\Input;
use src\model\dao\AnimalDAO;
use src\model\entities\AnimalEntity;
use src\model\entities\FazendaEntity;
use src\util\ClassToArray;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\RequestInterface as Request;

class Animal implements IModel
{

    private $idAnimal;
    private $nomeAnimal;
    private $dataAlteracao;
    private $dataCriacao;
    private $usuarioCadastro;
    private $usuarioAlteracao;
    private $dataNascimento;
    private $codigoBrinco;
    private $codigoRaca;
    private $fkPesagem;
    private $fkMae;
    private $fkPai;
    private $fkLote;
    private $fkFazenda;
    protected $limite;


    /**
     * @return mixed
     */
    public function getNomeAnimal()
    {
        return $this->nomeAnimal;
    }

    /**
     * @param mixed $nomeAnimal
     */
    public function setNomeAnimal($nomeAnimal)
    {
        $this->nomeAnimal = $nomeAnimal;
    }

    /**
     * @return mixed
     */
    public function getLimite()
    {
        return $this->limite;
    }

    /**
     * @param mixed $limite
     */
    public function setLimite($limite)
    {
        $this->limite = $limite;
    }


    /**
     * @return mixed
     */
    public function getIdAnimal()
    {
        return $this->idAnimal;
    }

    /**
     * @param mixed $idAnimal
     */
    public function setIdAnimal($idAnimal)
    {
        $this->idAnimal = $idAnimal;
    }

    /**
     * @return mixed
     */
    public function getDataAlteracao()
    {
        return $this->dataAlteracao;
    }

    /**
     * @param mixed $dataAlteracao
     */
    public function setDataAlteracao($dataAlteracao)
    {
        $this->dataAlteracao = $dataAlteracao;
    }

    /**
     * @return mixed
     */
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * @param mixed $dataCriacao
     */
    public function setDataCriacao($dataCriacao)
    {
        $this->dataCriacao = $dataCriacao;
    }

    /**
     * @return mixed
     */
    public function getUsuarioCadastro()
    {
        return $this->usuarioCadastro;
    }

    /**
     * @param mixed $usuarioCadastro
     */
    public function setUsuarioCadastro($usuarioCadastro)
    {
        $this->usuarioCadastro = $usuarioCadastro;
    }

    /**
     * @return mixed
     */
    public function getUsuarioAlteracao()
    {
        return $this->usuarioAlteracao;
    }

    /**
     * @param mixed $usuarioAlteracao
     */
    public function setUsuarioAlteracao($usuarioAlteracao)
    {
        $this->usuarioAlteracao = $usuarioAlteracao;
    }

    /**
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * @param mixed $dataNascimento
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    /**
     * @return mixed
     */
    public function getCodigoBrinco()
    {
        return $this->codigoBrinco;
    }

    /**
     * @param mixed $codigoBrinco
     */
    public function setCodigoBrinco($codigoBrinco)
    {
        $this->codigoBrinco = $codigoBrinco;
    }

    /**
     * @return mixed
     */
    public function getCodigoRaca()
    {
        return $this->codigoRaca;
    }

    /**
     * @param mixed $codigoRaca
     */
    public function setCodigoRaca($codigoRaca)
    {
        $this->codigoRaca = $codigoRaca;
    }

    /**
     * @return mixed
     */
    public function getFkPesagem()
    {
        return $this->fkPesagem;
    }

    /**
     * @param mixed $fkPesagem
     */
    public function setFkPesagem($fkPesagem)
    {
        $this->fkPesagem = $fkPesagem;
    }

    /**
     * @return mixed
     */
    public function getFkMae()
    {
        return $this->fkMae;
    }

    /**
     * @param mixed $fkMae
     */
    public function setFkMae($fkMae)
    {
        $this->fkMae = $fkMae;
    }

    /**
     * @return mixed
     */
    public function getFkPai()
    {
        return $this->fkPai;
    }

    /**
     * @param mixed $fkPai
     */
    public function setFkPai($fkPai)
    {
        $this->fkPai = $fkPai;
    }

    /**
     * @return mixed
     */
    public function getFkLote()
    {
        return $this->fkLote;
    }

    /**
     * @param mixed $fkLote
     */
    public function setFkLote($fkLote)
    {
        $this->fkLote = $fkLote;
    }

    /**
     * @return mixed
     */
    public function getFkFazenda()
    {
        return $this->fkFazenda;
    }

    /**
     * @param mixed $fkFazenda
     */
    public function setFkFazenda($fkFazenda)
    {
        $this->fkFazenda = $fkFazenda;
    }

    public function cadastrar(Request $request)
    {
//        $this->dataAlteracao = (new Data())->gerarDataHora();
//        $this->dataCriacao = (new Data())->gerarDataHora();
//        $this->usuarioAlteracao = "Lucas";// vai pegar do token dps de implementar o login;
//        $this->usuarioCadastro = "Lucas";
//        $array = (new ClassToArray())->classToArray($this);
//        return (new AnimalDAO())->create($array);

        $entity = new AnimalEntity();

        return ["users" => $entity->save()];


    }

    public function alterar(Request $request)
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new AnimalDAO())->update($array);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function pesquisar(Request $request)
    {
        $page = $request->getQueryParam('pagina');
        if ($request->getAttribute('id')) {
            return AnimalDAO::retreaveById($request->getAttribute('id'),$page);
        } else if ($request->getAttribute('nome')) {
            return AnimalDAO::retreaveByNome($request->getAttribute('nome'),$page);
        } else if ($request->getAttribute('filtro') && $request->getAttribute('valor')) {
            return AnimalDAO::retreaveByPersonalizado($request->getAttribute('filtro'), $request->getAttribute('valor'),$page);
        }

        return AnimalDAO::retreaveAll($page);

    }

    public function deletar(Request $request)
    {
        $array = (new ClassToArray())->classToArray($this);
        return (new AnimalDAO())->delete($array);
    }
}