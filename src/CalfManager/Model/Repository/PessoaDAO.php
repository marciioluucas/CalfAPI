<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 27/08/2018
 * Time: 21:19
 */

namespace CalfManager\Model\Repository;

use CalfManager\Model\Repository\Entity\PessoaEntity;
use CalfManager\Utils\Config;
use Couchbase\Exception;

class PessoaDAO implements IDAO
{
    public function create($obj): ?int
    {
        $entity = new PessoaEntity();
        $entity->nome = $obj->getNome();
        $entity->rg = $obj->getRg();
        $entity->cpf = $obj->getCpf();
        $entity->sexo = $obj->getSexo();
        $entity->numero_telefone = $obj->getNumeroTelefone();
        $entity->data_nascimento = $obj->getDataNascimento();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->data_cadastro = $obj->getDataCadastro();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro();

        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e){
            throw new Exception( "Erro ao cadastrar pessoa ".$e->getMessage());
        }
    }

    public function update($obj): bool
    {
        $entity = PessoaEntity::find($obj->getId());
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        $entity->data_alteracao = $obj->getDataAlteracao();
        if(!is_null($obj->getNome())){
            $entity->nome = $obj->getNome();
        }
        if(!is_null($obj->getRg())){
            $entity->rg = $obj->getRg();
        }
        if(!is_null($obj->getCpf())){
            $entity->cpf = $obj->getCpf();
        }if(!is_null($obj->getSexo())){
            $entity->sexo = $obj->getSexo();
        }if(!is_null($entity->getNumeroTelefone())){
            $entity->numero_telefone = $obj->getNumeroTelefone();
        }
        if(!is_null($obj->getDataNascimento())){
            $entity->data_nascimento = $obj->getDataNascimento();
        }
        try{
        if($entity->save()){
            return $entity->id;
        }
            }catch (Exception $e){
            throw new Exception("Erro ao alterar pessoa ". $e->getMessage());
        }
        return false;

    }

    public function retreaveAll(int $page): array
    {
        $entity = PessoaEntity::ativo();
        $pessoas = $entity->with('endereco')
            ->with('funcionario')
            ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
        return ["pessoas" => $pessoas];
    }

    public function retreaveById(int $id): array
    {
        $entity = PessoaEntity::ativo();
        try{
            $pessoa = $entity
                ->with('endereco')
                ->with('funcionario')
                ->where('id', $id)
                ->first()
                ->toArray();

           return["pessoas" => $pessoa];
        } catch (Exception $e){
            throw new Exception("Erro ao pesquisar pessoa pelo ID ".$id . ". Mensagem: " . $e->getMessage());
        }
    }

    public function retreaveByNome($nome, $page){
        $entity = PessoaEntity::ativo();
        $pessoas = $entity->with('endereco')
            ->with('funcionario')
            ->where('nome', 'like', '%'. $nome . '%')
            ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
        try {
            return ["pessoas" => $pessoas];
        } catch (Exception $e){
            throw new Exception("Erro ao pesquisar pessoa pelo nome ". $nome . '. Mensagem: ' . $e->getMessage());
        }

    }
    public function reatreaveByEnderecoId($idEndereco, $page){
        try {
            $entity = PessoaEntity::ativo();
            $pessoa = $entity->with('endereco')
                ->with('funcionario')
                ->where('endereco_id', $idEndereco)
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
                );
            return ["pessoas" => $pessoa];
        } catch (Exception $e) {
            throw new Exception("Erro ao pesquisar endereço pelo ID ".$idEndereco. ". Mensagem: " .$e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        $entity = PessoaEntity::find($id);
        $entity->status = 0;
        try{
            if($entity->save){
                return true;
            }
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir pessoa" . $e->getMessage());
        }
    }

}