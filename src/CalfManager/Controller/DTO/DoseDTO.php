<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace CalfManager\Controller\DTO;

class DoseDTO 
{
    public $id;
    public $nomeAnimal;
    public $nomeMedicamento;
    public $quantidadeMg;
    public $quantidadeUnidade;
    public $dataAplicacao;
    public $tipoMovimentacao;
    public $nomeFuncionario;
    
    function __construct($id, 
                         $nomeAnimal,
                         $nomeMedicamento, 
                         $quantidadeMg, 
                         $quantidadeUnidade, 
                         $dataAplicacao, 
                         $tipoMovimentacao, 
                         $nomeFuncionario) 
    {
        $this->id = $id;
        $this->nomeAnimal = $nomeAnimal;
        $this->nomeMedicamento = $nomeMedicamento;
        $this->quantidadeMg = $quantidadeMg;
        $this->quantidadeUnidade = $quantidadeUnidade;
        $this->dataAplicacao = $dataAplicacao;
        $this->tipoMovimentacao = $tipoMovimentacao;
        $this->nomeFuncionario = $nomeFuncionario;
    }

}

