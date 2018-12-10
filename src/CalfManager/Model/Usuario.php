<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 22/02/2018
 * Time: 15:12
 */

namespace CalfManager\Model;

use CalfManager\Model\Repository\GrupoDAO;
use CalfManager\Model\Repository\UsuarioDAO;
use CalfManager\Utils\Config;
use Exception;
use Tebru\Gson\Element\JsonObject;

/**
 * Class Usuario
 * @package CalfManager\Model
 */
class Usuario extends Modelo
{
    /**
     * @var string
     */
    private $login;
    /**
     * @var string
     */
    private $senha;

    private $grupo;

    public function __construct()
    {
        $this->grupo = new Grupo();
    }

    public function login(){
        try {
            $usuario = (new UsuarioDAO())->retreaveByLoginSenha($this->login, $this->senha);
            if($usuario !== false){
                $this->setId($usuario->id);
                $this->setLogin($usuario->login);
                $this->setSenha($usuario->senha);
                $this->getGrupo()->setId($usuario->grupo->id);
                $this->getGrupo()->setNome($usuario->grupo->nome);
                $this->getGrupo()->getPermissao()->setId($usuario->grupo->permissao_id);
                return $usuario;
            }else {
                return false;
            }

        } catch (Exception $e){
            throw new Exception("Erro ao efetuar o login");
        }
    }

    /**
     * @return int|null
     */
    public function cadastrar(): ?int
    {
        $this->dataCriacao = date(Config::PADRAO_DATA_HORA);

        $this->usuarioCadastro = new Usuario();
        $this->usuarioCadastro->setId(1);
        try{
            $idUsuario = (new UsuarioDAO())->create($this);
            return $idUsuario;
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function alterar(): bool
    {
        $this->dataAlteracao = date(Config::PADRAO_DATA_HORA);

        $this->usuarioAlteracao = new Usuario();
        $this->usuarioAlteracao->setId(1);
        try{
            return (new UsuarioDAO())->update($this);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function pesquisar(int $page): array
    {
        $dao = new UsuarioDAO();
        try{
            if($this->id and !$this->login and !$this->senha and !$this->getGrupo()->getId()){
                return $dao->retreaveById($this->id);
            }else if (!$this->id and $this->login and !$this->senha and !$this->getGrupo()->getId()){
                return $dao->retreaveByLogin($this->login, $page);
            }
            else if (!$this->id and $this->login and $this->senha and !$this->getGrupo()->getId()){
                return $dao->retreaveByLoginSenha($this->login, $this->senha);
            }
            else if(!$this->id and !$this->login and !$this->senha and $this->getGrupo()->getId()){
                return $dao->retreaveByGrupo($this->getGrupo()->getId(), $page);
            }
            else {
                return $dao->retreaveAll($page);
            }
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function deletar(): bool
    {
        try{
            return (new UsuarioDAO())->delete($this->id);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function antesDeSalvar(){
        $this->cadastrarGrupo();
    }
    public function cadastrarGrupo(){
       $this->getGrupo()->cadastrar();
    }

    /**
     * @return string
     */
    public function getLogin():? string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getSenha():? string
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     */
    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return Grupo
     */
    public function getGrupo(): Grupo
    {
        return $this->grupo;
    }

    /**
     * @param Grupo $grupo
     */
    public function setGrupo(Grupo $grupo)
    {
        $this->grupo = $grupo;
    }

}
