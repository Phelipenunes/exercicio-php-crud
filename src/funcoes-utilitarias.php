<?php
function formatarpreco(float $preco) : string {
    $preco = number_format($preco,2,",",".");
    return $preco;
};

function somaquantidade(float $preco, int $quantidade){
    $somaquantidade = $preco * $quantidade;
    return $somaquantidade;
};


function situacao(float $media){
    if ($media >= 7 ){
        echo "Aprovado!";
    } elseif($media >= 5){
        echo "recuperação!";
    }else{
        echo "Reprovado!";
    }
};
?>