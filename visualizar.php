<?php
require_once "src/funcoes.php";

$alunos = calcularmedia($conexao, $id, $nota1, $nota2)

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lista de alunos - Exercício CRUD com PHP e MySQL</title>
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Lista de alunos</h1>
    <hr>
    <p><a href="inserir.php">Inserir novo aluno</a></p>

    <div class="produtos">
        <?php foreach($alunos as $aluno){?>
        <article class="produto">
        <h3>Nome: <?=$aluno['nome']?></h3>
        <p>Nota1: <?=$aluno['nota1']?></p>
        <p>Nota2: <?=$aluno['nota2']?></p>
        <p>média: <?=$aluno['media']?></p>
        <p>Situação: <?=?></p>
        </article>
        <?php } ?>
    </div>
    <p><a href="index.php">Voltar ao início</a></p>
</div>

</body>
</html>