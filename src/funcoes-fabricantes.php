<?php
//Importando o script de conexão
//require_once garante que a importação é feita somente uma vez.
require_once "conecta.php";

//Usando em fabricantes/visualizar.php

function lerfabricantes( PDO $conexao ){
    $sql = "SELECT * FROM fabricantes ORDER BY nome";
   try {
    // método prepare(); faz uma preparação do comando sql
    $consulta =  $conexao->prepare($sql);

    // método execute():
    // executa o comando sql no banco de dados
    $consulta->execute();

    //método fetchALL()
    //buscar tudos os dados da consulta como um array associativo.
    $resultado = $consulta->fetchALL(PDO::FETCH_ASSOC);

   } catch (Exception $erro) {
    die("deu ruim!: ".$erro->getMessage());
   }
    return $resultado;
};//fim de lerfabricantes


function inserirfabricantes(PDO $conexao, string $nomedofabricantes){
    // :qualquer coisa -> isso indica um "named parameter(parametro nomeado)"
    $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";

    try {
        $consulta =  $conexao->prepare($sql);

        /* binvalue() -> permite vincular um valor existente no parametro nomeado (:nome) a consulta que sera executada. é nescessario indicar qual é o parametro (:nome), de onde vem o valor ($nomedofabricante) e de que tipo ele é (PDO::PARAM_STR) */

        $consulta->bindValue(":nome", $nomedofabricantes, PDO::PARAM_STR);
        $consulta->execute();
   
    } catch (Exception $erro) {
        die("Erro ao inserir!!!".$erro ->getMessage());     
    }
};// fim de inserirfabricantes


function lerumfabricantes(PDO $conexao, int $id){
    $sql = "SELECT * FROM fabricantes WHERE id = :id";
    
    try {
        $consulta =  $conexao->prepare($sql);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
     } catch (Exception $erro) {
          die("Erro ao carregar!!!".$erro ->getMessage());     
     };
     return $resultado;

};// fim de lerumfabricantes

function atualizarfabricante(PDO $conexao, int $id, string $nome) : void{
    $sql = "UPDATE fabricantes set nome = :nome WHERE id = :id";
    
    try {
        $consulta =  $conexao->prepare($sql);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
        $consulta->execute();
        
     } catch (Exception $erro) {
          die("Erro ao atualizar!!!".$erro ->getMessage());     
     };
};// fim de atualizarfabricante

function excluirfabricantes(PDO $conexao,int $id){
    $sql = "DELETE FROM fabricantes where id = :id";
    try {
        $consulta =  $conexao->prepare($sql);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->execute();
        
     } catch (Exception $erro) {
          die("Erro ao Excluir!!!".$erro ->getMessage());     
     };
};// fim de excluirfabricantes