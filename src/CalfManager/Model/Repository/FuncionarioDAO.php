<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 25/08/2018
 * Time: 19:48
 */

namespace CalfManager\Model\Repository;


use CalfManager\Model\Modelo;
use CalfManager\Model\Repository\Entity\FuncionarioEntity;
use CalfManager\Utils\Validate\FuncionarioValidate;
use Symfony\Component\Config\Definition\Exception\Exception;

class FuncionarioDAO implements IDAO
{
    public function create($obj): ?int
    {

        $entity = new FuncionarioEntity();
        $entity->cargo_id = $obj->getCargo()->getId();
        $entity->pessoa_id = $obj->getPessoa()->getId();
        $entity->usuario_id = $obj->getUsuario()->getId();
        $entity->fazenda_id = $obj->getFazenda()->getId();
        $entity->salario = $obj->getSalario();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->data_cadastro = $obj->getDataCadastro();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e) {
            throw new Exception("Erro ao cadastrar de funcionário. Mensagem: ", $e->getMessage());
        }
    }

    public function update($obj): bool
    {
        $entity = FuncionarioEntity::find($obj->getId());
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->data_alteracao = $obj->getDataAlteracao();
        if(!is_null($obj->getCargo())) {
            $entity->cargo = $obj->getCargo()->getId();
        }
        if(!is_null($obj->getSalario())) {
            $entity->salario = $obj->getSalario();
        }
        try{
            if($entity->save()){
                return true;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao alterar funcionário. Mensagem: ", $e->getMessage());
        }
    }

    public function retreaveAll(int $page): array
    {
        $entity = FuncionarioEntity::ativo();
        $funcionarios = $entity->with('cargo')
            ->with('pessoa')
            ->with('usuario')
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

    public function retreaveById(int $id): array
    {
        try{
            $entity = FuncionarioEntity::ativo();
            $funcionario = $entity->with('cargo')
                ->with('pessoa')
                ->with('usuario')
                ->with('fazenda')
                ->where('id', $id)
                ->first()
                ->toArray();
            return [
                "funcionarios" => $funcionario
            ];
        }catch (Exception $e) {
            throw new Exception("Erro ao pesquisar funcionário por ID ".$id. ". Mensagem: " ,  $e->getMessage());
        }
    }
    public function retreaveByIdCargo(int $idCargo, int $page){
       try {
           $entity = FuncionarioEntity::ativo();
           $funcionarios = $entity->with('cargo')
               ->with('pessoa')
               ->with('usuario')
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
           throw new Exception("Erro ao pesquisar o cargo deste funcionário pelo ID ".$idCargo. ". Mensagem: " ,  $e->getMessage());
       }
    }
    public function retreaveByIdUsuario(int $idUsuario, int $page){
        try{
            $entity = FuncionarioEntity::ativo();
            $funcionarios = $entity->with('cargo')
                ->with('pessoa')
                ->with('usuario')
                ->with('fazenda')
                ->where('usuario_id', $idUsuario)
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["funcionarios" => $funcionarios];
        }catch (Exception $e) {
            throw new Exception("Erro ao pesquisar o usuário deste funcionário pelo ID ".$idUsuario. ". Mensagem: " ,  $e->getMessage());
        }
    }
    public function retreaveByIdFazenda(int $idFazenda, int $page){
        try{
            $entity = FuncionarioEntity::ativo();
            $funcionarios = $entity->with('cargo')
                ->with('pessoa')
                ->with('usuario')
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
            throw new Exception("Erro ao pesquisar a fazenda que este funcionário trabalha pelo ID ".$idFazenda. ". Mensagem: " ,  $e->getMessage());
        }
    }
    public function retreaveByIdPessoa(int $idPessoa, int $page){
        try{
            $entity = FuncionarioEntity::ativo();
            $funcionarios = $entity->with('cargo')
                ->with('pessoa')
                ->with('usuario')
                ->with('fazenda')
                ->where('pessoa_id', $idPessoa)
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["funcionarios" => $funcionarios];
        }catch (Exception $e) {
            throw new Exception("Erro ao pesquisar os dados deste funcionário pelo ID ".$idPessoa. ". Mensagem: " ,  $e->getMessage());
        }
    }

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