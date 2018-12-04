<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 27/08/2018
 * Time: 21:19
 */

namespace CalfManager\Model\Repository;

use CalfManager\Model\Repository\Entity\PessoaEntity;
use CalfManager\Model\Pessoa;
use CalfManager\Utils\Config;
use Exception;

class PessoaDAO implements IDAO
{
    /**
     * @param Pessoa $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new PessoaEntity();
        $entity->nome = $obj->getNome();
        $entity->rg = $obj->getRg();
        $entity->cpf = $obj->getCpf();
        $entity->sexo = $obj->getSexo();
        $entity->numero_telefone = $obj->getNumeroTelefone();
        $entity->data_nascimento = $obj->getDataNascimento();
        $entity->endereco_id = $obj->getEndereco()->getId();


        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        $entity->status = 1;
        try{
            if($entity->save()){
                return $entity->id;
            }
        }catch (Exception $e){
            throw new Exception( "Erro ao cadastrar pessoa. Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param Pessoa $obj
     * @return int|null
     * @throws Exception
     */
    public function update($obj): bool
    {
        $entity = PessoaEntity::find($obj->getId());

        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();

        if(!is_null($obj->getNome())){
            $entity->nome = $obj->getNome();
        }
        if(!is_null($obj->getRg())){
            $entity->rg = $obj->getRg();
        }
        if(!is_null($obj->getCpf())){
            $entity->cpf = $obj->getCpf();
        }
        if(!is_null($obj->getSexo())){
            $entity->sexo = $obj->getSexo();
        }
        if(!is_null($obj->getNumeroTelefone())){
            $entity->numero_telefone = $obj->getNumeroTelefone();
        }
        if(!is_null($obj->getDataNascimento())){
            $entity->data_nascimento = $obj->getDataNascimento();
        }
        if(!is_null($obj->getEndereco()->getId())){
            $entity->endereco_id = $obj->getEndereco()->getId();
        }
        try{
        if($entity->save()){
            return $entity->id;
        }
            }catch (Exception $e){
            throw new Exception("Erro ao alterar pessoa. Mensagem: ". $e->getMessage());
        }
        return false;

    }

    /**
     * @param int $page
     * @return array
     */
    public function retreaveAll(int $page): array
    {
        $entity = PessoaEntity::ativo();
        $pessoas = $entity->with('endereco')
            ->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
        return ["pessoas" => $pessoas];
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function retreaveById(int $id): array
    {
        try{
        $pessoa = PessoaEntity::ativo()->with('endereco')
            ->where('id', $id)
                ->first()
                ->toArray();

           return["pessoas" => $pessoa];
        } catch (Exception $e){
            throw new Exception("Erro ao pesquisar pessoa pelo ID ".$id . ". Mensagem: " . $e->getMessage());
        }
    }

    /**
     * @param $nome
     * @param $page
     * @return array
     * @throws Exception
     */
    public function retreaveByNome($nome, $page){
        $entity = PessoaEntity::ativo();
        $pessoas = $entity->with('endereco')
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

    /**
     * @param $idEndereco
     * @param $page
     * @return array
     * @throws Exception
     */
    public function reatreaveByIdEndereco($idEndereco, $page){
        try {
            $entity = PessoaEntity::ativo();
            $pessoa = $entity->with('endereco')
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

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        $entity = PessoaEntity::find($id);
        $entity->status = 0;
        try{
            if($entity->save()){
                return true;
            }
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir pessoa. Mensagem: " . $e->getMessage());
        }
    }

}