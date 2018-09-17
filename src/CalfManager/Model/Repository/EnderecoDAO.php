<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 28/08/2018
 * Time: 10:16
 */

namespace CalfManager\Model\Repository;

use CalfManager\Model\Endereco;
use CalfManager\Model\Repository\Entity\EnderecoEntity;
use CalfManager\Utils\Config;
use Exception;

class EnderecoDAO implements IDAO
{
    /**
     * @param Endereco $obj
     * @return int|null
     * @throws Exception
     */
    public function create($obj): ?int
    {
        $entity = new EnderecoEntity();
        $entity->logradouro = $obj->getLogradouro();
        $entity->numero = $obj->getNumero();
        $entity->bairro = $obj->getBairro();
        $entity->cidade = $obj->getCidade();
        $entity->estado = $obj->getEstado();
        $entity->pais = $obj->getPais();
        $entity->cep = $obj->getCep();
        $entity->data_cadastro = $obj->getDataCriacao();
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_cadastro = $obj->getUsuarioCadastro()->getId();
        try{
            if($entity->save()) {return $entity->id;}
        }catch (Exception $e){
            throw new Exception("Erro ao cadastrar endereço. Mensagem: ".$e->getMessage());
        }

    }

    /**
     * @param Endereco $obj
     * @return bool
     * @throws Exception
     */
    public function update($obj): bool
    {
        $entity = EnderecoEntity::find($obj->getId());
        $entity->data_alteracao = $obj->getDataAlteracao();
        $entity->usuario_alteracao = $obj->getUsuarioAlteracao()->getId();
        if(!is_null($obj->getLogradouro())){
            $entity->logradouro = $obj->getLogradouro();
        }
        if(!is_null($obj->getNumero())){
            $entity->numero = $obj->getNumero();
        }
        if(!is_null($obj->getBairro())){
            $entity->bairro = $obj->getBairro();
        }
        if(!is_null($obj->getCidade())){
            $entity->cidade = $obj->getCidade();
        }
        if(!is_null($obj->getEstado())){
            $entity->estado = $obj->getEstado();
        }
        if(!is_null($obj->getPais())){
            $entity->pais = $obj->getPais();
        }
        if(!is_null($obj->getCep())){
            $entity->cep = $obj->getCep();
        }
        try{
            if($entity->save()){
                return true;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao alterar endereço. Mensagem".$e->getMessage());
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
            $enderecos = EnderecoEntity::ativo()->paginate(
                Config::QUANTIDADE_ITENS_POR_PAGINA,
                ['*'],
                'pagina',
                $page
            );
            return ["enderecos" => $enderecos];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar todos os endereços. Mensagem".$e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function retreaveById(int $id): array
    {
        try {
            $endereco = EnderecoEntity::ativo()->where('id', $id)->first()->toArray();
            return ["enderecos" => $endereco];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar endereço pelo ID ".$id ." .Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param string $logradouro
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function retreaveByLogradouro(string $logradouro, int $page): array
    {
        try {
            $endereco = EnderecoEntity::ativo()
                ->where('lograroudo','like',"%".$logradouro."%")
                ->paginate(
                    Config::QUANTIDADE_ITENS_POR_PAGINA,
                    ['*'],
                    'pagina',
                    $page
            );
            return ["enderecos" => $endereco];
        }catch (Exception $e){
            throw new Exception("Erro ao pesquisar endereço pelo logradouro ".$logradouro. " .Mensagem: ".$e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        $entity = EnderecoDAO::ativo();
        $entity->status = 0;
        try {
            if ($entity->save()) {
                return true;
            }
        }catch (Exception $e){
            throw new Exception("Erro ao excluir endereço. Mensagem: ".$e->getMessage());
        }
    }

}