<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 07/09/2018
 * Time: 21:39
 */

namespace CalfManager\Model\Repository;


use CalfManager\Model\Usuario;
use CalfManager\Model\Repository\Entity\UsuarioEntity;
use CalfManager\Utils\Config;
use Exception;

class UsuarioDAO implements IDAO
{
    /**
     * @param Usuario $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new UsuarioEntity();
        $entity->login = $obj->getLogin();
        $entity->senha = $obj->getSenha();
        $entity->grupo_id = $obj->getGrupo()->getId();

        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->status = 1;

        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao cadastar usuario. Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param Usuario $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): bool
    {
         $entity = UsuarioEntity::find($obj->getId());
         $entity->data_alteracao = $obj->getDataAlteracao();
         $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();

         if(!is_null($obj->getLogin())){
             $entity->login = $obj->getLogin();
         }if(!is_null($obj->getSenha())){
             $entity->senha = $obj->getSenha();
         }if(!is_null($obj->getGrupo()->getId())){
             $entity->grupo_id = $obj->getGrupo()->getId();
         }
         try{
             if($entity->save()){
                 return $entity->id;
             }
         }catch (Exception $e){
             throw new Exception("Erro ao alterar usuario. Mensagem: ".$e->getMessage());
         }
    }

    /**
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveAll(int $page): array
    {
        try {
            $usuarios = UsuarioEntity::ativo()->with('grupo')->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
            return ["usuarios" => $usuarios];

        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar todos os usuários. Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function retreaveById(int $id): array
    {
         try{
             $usuario = UsuarioEntity::ativo()->with('grupo')
                 ->where('id', $id)
                 ->first()
                 ->toArray();
             return ["usuarios" => $usuario];
         }catch (Exception $e){
            throw new Exception("Erro ao pesquisar usuario pelo ID ".$id. ". Mensagem: ". $e->getMessage());
         }
    }
    public function retreaveByLogin(string $login, int $page ){
        try{
            $usuario = UsuarioEntity::ativo()->with('grupo')
                ->where('login','like', '%'.$login.'%')
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["usuarios" => $usuario];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar usuario pelo Login: ".$login.". Mensagem: ". $e->getMessage());
        }
    }

    /**
     * @param int $idGrupo
     * @param $page
     * @return array
     * @throws Exception
     */
    public function retreaveByGrupo(int $idGrupo, $page){
        try{
            $usuarios = UsuarioEntity::ativo()
                ->with('grupo')
                ->where('grupo_id', $idGrupo)
                ->paginate(Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["usuarios" => $usuarios];
        }
        catch (Exception $e){
            throw new Exception("Erro ao pesquisar grupo de usuario pelo ID ".$idGrupo. ". Mensagem: ". $e->getMessage());
        }
    }
    public function retreaveByLoginSenha(string $login, string $senha ){
        try{
            if(!is_null($login) && !is_null($senha)) {
                $usuario = UsuarioEntity::ativo()->with('grupo')
                    ->where('login', $login)
                    ->where('senha', $senha)
                    ->with('funcionario')
//                    ->with('funcionario.pessoa')
                    ->get();
                if(count($usuario)){
                    return $usuario[0];
                }else{
                    return false;
                }
            }
            else {
                return false;
            }
        }
        catch (Exception $e){
            throw new Exception("Erro ao pesquisar usuario pelo Login: ".$login. " e Senha: ".$senha. ". Mensagem: ". $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        $entity = UsuarioEntity::find($id);
        $entity->status = 0;
        try {
            if ($entity->save()) {
                return true;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao excluir usuario. Mensagem: ". $e->getMessage());
        }
    }

}