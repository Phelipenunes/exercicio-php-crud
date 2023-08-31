<?php
require_once "conecta.php";

function inseriraluno(
    PDO $conexao, string $nome, float $nota1, float $nota2):void {

    $sql = "INSERT INTO alunos(
        nome, nota1, nota2
    ) VALUES(
        :nome, :nota1, :nota2
    )";    

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
        $consulta->bindValue(":nota1", $nota1, PDO::PARAM_STR);
        $consulta->bindValue(":nota2", $nota2, PDO::PARAM_STR);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao inserir: ".$erro->getMessage());
    }
};

function calcularmedia(PDO $conexao,int $id, float $nota1, float $nota2){
    $sql = "SELECT alunos.nome, alunos.nota1, alunos.nota2, ROUND((nota1 + nota2)/2 , 2) as Media
    FROM alunos;";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao calcular a média: ".$erro->getMessage());
    };
    return $resultado;
};

?>
