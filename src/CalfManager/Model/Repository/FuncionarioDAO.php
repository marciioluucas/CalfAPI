<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 19:48
 */

namespace CalfManager\Model\Repository;


use CalfManager\Model\Funcionario;
use CalfManager\Model\Repository\Entity\FuncionarioEntity;
use CalfManager\Utils\Config;

use Exception;

class FuncionarioDAO implements IDAO
{
    /**
     * @param Funcionario $obj
     * @return int|null
     * @throws Exception
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new FuncionarioEntity();
        $entity->cargo_id = $obj->getCargo()->getId();
        $entity->usuario_id = $obj->getUsuario()->getId();
        $entity->fazenda_id = $obj->getFazenda()->getId();
        $entity->pessoa_id = $obj->getPessoa()->getId();
        $entity->salario = $obj->getSalario();

        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->status = 1;
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e) {
            throw new Exception("Erro ao cadastrar funcionário. Mensagem: ". $e->getMessage());
        }
    }

    /**
     * @param Funcionario $obj
     * @return bool
     * @throws Exception
     * @throws Exception
     */
    public function update($obj): bool
    {
        $entity = FuncionarioEntity::find($obj->getId());
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->data_alteracao = $obj->getDataAlteracao();

        if(!is_null($obj->getCargo()->getId())) {
            $entity->cargo_id = $obj->getCargo()->getId();
        }
        if(!is_null($obj->getUsuario()->getId())){
            $entity->usuario_id = $obj->getUsuario()->getId();
        }
        if(!is_null($obj->getFazenda()->getId())){
            $entity->fazenda_id = $obj->getFazenda()->getId();
        }
        if(!is_null($obj->getSalario())) {
            $entity->salario = $obj->getSalario();
        }
        try{
            if($entity->save()){
                return true;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao alterar funcionário. Mensagem: ". $e->getMessage());
        }
    }

    /**
     * @param int $page
     * @return array
     */
    public function retreaveAll(int $page): array
    {
        $entity = FuncionarioEntity::ativo();
        $funcionarios = $entity->with('cargo')
            ->with('pessoa')
            ->with('fazenda')
            ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
        return [
            "funcionarios" => $funcionarios
        ];
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     * @throws Exception
     */
    public function retreaveById(int $id): array
    {
        try{
            $entity = FuncionarioEntity::ativo();
            $funcionario = $entity->with('cargo')
                ->with('pessoa')
                ->with('fazenda')
                ->where('id', $id)
                ->first()
                ->toArray();
            return [
                "funcionarios" => $funcionario
            ];
        }catch (Exception $e) {
            throw new Exception("Erro ao pesquisar funcionário por ID ".$id. ". Mensagem: " .  $e->getMessage());
        }
    }

    /**
     * @param int $idCargo
     * @param int $page
     * @return array
     * @throws Exception
     * @throws Exception
     */
    public function retreaveByIdCargo(int $idCargo, int $page){
       try {
           $entity = FuncionarioEntity::ativo();
           $funcionarios = $entity->with('cargo')
               ->with('pessoa')
               ->with('fazenda')
               ->where('cargo_id', $idCargo)
               ->paginate(
                   Config::QUANTIDADE_ITENS_POR_PAGINA,
                   ['*'],
                   'pagina',
                   $page
               );
           return ["funcionarios" => $funcionarios];
       }catch (Exception $e) {
           throw new Exception("Erro ao pesquisar o cargo deste funcionário pelo ID ".$idCargo. ". Mensagem: " .  $e->getMessage());
       }
    }

    /**
     * @param int $idFazenda
     * @param int $page
     * @return array
     * @throws Exception
     * @throws Exception
     */
    public function retreaveByIdFazenda(int $idFazenda, int $page){
        try{
            $entity = FuncionarioEntity::ativo();
            $funcionarios = $entity->with('cargo')
                ->with('pessoa')
                ->with('fazenda')
                ->where('fazenda_id', $idFazenda)
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["funcionarios" => $funcionarios];
        }catch (Exception $e) {
            throw new Exception("Erro ao pesquisar a fazenda que este funcionário trabalha pelo ID ".$idFazenda. ". Mensagem: " .  $e->getMessage());
        }
    }
    public function retreaveByIdPessoa (int $idPessoa){
        try{
            $entity = FuncionarioEntity::ativo();
            $funcionario = $entity->with('cargo')
                ->with('pessoa')
                ->with('fazenda')
                ->where('pessoa_id', $idPessoa)
                ->first()
                ->toArray();

            return["funcionarios" => $funcionario];

        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar este funcionário pelo ID pessoa: ".$idPessoa.". Mensagem: ".$e->getMessage());
        }
    }


    /**
     * @param int $id
     * @return bool
     * @throws Exception
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        try {
            $entity = FuncionarioEntity::find($id);
            $entity->status = 0;
            if($entity->save()) {
                return true;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao excluir funcionário");
        }
    }

}