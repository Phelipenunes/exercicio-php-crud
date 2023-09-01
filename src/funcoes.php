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

function leralunos(PDO $conexao){
    $sql = "SELECT * , ROUND((nota1 + nota2)/2 , 2) as media
    FROM alunos ORDER BY nome";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao calcular a média: ".$erro->getMessage());
    };
    return $resultado;
};

function lerumaluno(PDO $conexao, int $id):array {
    $sql = "SELECT * , ROUND((nota1 + nota2)/2 , 2) as media FROM alunos WHERE id = :id";
    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao carregar dados: ".$erro->getMessage());
    }    
    return $resultado;
};

function atualizaraluno( $conexao, int $id, string $nome, float $nota1 , float $nota2):void {
    $sql = " UPDATE alunos set 
    nome = :nome,
    nota1 = :nota1,
    nota2 = :nota2 
    WHERE id = :id";

    try {
        $consulta =  $conexao->prepare($sql);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
        $consulta->bindValue(":nota1", $nota1, PDO::PARAM_STR);
        $consulta->bindValue(":nota2", $nota2, PDO::PARAM_STR);
        $consulta->execute();
        
     } catch (Exception $erro) {
          die("Erro ao atualizar!!!".$erro ->getMessage());     
     };
};

function excluirproduto($conexao,int $id):void{
    $sql = "DELETE FROM alunos where id = :id";
    try {
        $consulta =  $conexao->prepare($sql);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->execute();
        
     } catch (Exception $erro) {
          die("Erro ao Excluir!!!".$erro ->getMessage());     
     };
};

?>

</html>