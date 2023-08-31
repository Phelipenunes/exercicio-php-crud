<?php
// conecta.php
/* Script de conexão ao servidor de banco de dados */
// parâmetros
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "crud_escola_phelipe";

/* Configurações para conexão (APi/drivers de conexão: PDO (PHP data object)) */

try{

// instancia/objeto PDO para conexão
$conexao = new PDO(
    "mysql:host=$servidor;dbname=$banco;charset=utf8",
    $usuario, $senha
);

// habilitar a verificação de sinalização de erros (exceções)
$conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(exception $erro){
    // exception é uma classe/tipo de dados voltado para tratamento de
    //exceções (erros)
    die("deu ruim!: ".$erro->getMessage());  
}
?>