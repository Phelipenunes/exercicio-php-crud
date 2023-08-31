<?php
require_once "conecta.php";
//informaçao de uma tabela
//$sql = "SELECT nome,preco, quantidade FROM produtos ORDER BY nome";
function lerprodutos(PDO $conexao){
    $sql = "SELECT
     produtos.id,
     produtos.nome AS produto,
     produtos.preco,
     produtos.quantidade,
     produtos.descricao,
     fabricantes.nome AS fabricante 
     FROM produtos INNER JOIN fabricantes ON produtos.fabricantes_id = fabricantes.id
     ORDER BY produto";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->execute();
        $resultado = $consulta->fetchALL(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("ERRO ao carregar produtos:".$erro->getMessage());
    }
    return $resultado;
};

function inserirProduto(
    PDO $conexao, string $nome, float $preco, 
    int $quantidade, int $fabricanteId, string $descricao ):void {

    $sql = "INSERT INTO produtos(
        nome, preco, quantidade, descricao, fabricantes_id
    ) VALUES(
        :nome, :preco, :quantidade, :descricao, :fabricantesId
    )";    

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);

        /* No PDO, ao trabalhar com valores "quebrados" para
        os parâmetros nomeados, você deve usar a constante
        PARAM_STR. No momento, não há outra forma no PDO de lidar
        com valores deste tipo devido aos diferentes tipos de
        dados que cada Banco de Dados suporta. */
        $consulta->bindValue(":preco", $preco, PDO::PARAM_STR);
        
        $consulta->bindValue(":quantidade", $quantidade, PDO::PARAM_INT);
        $consulta->bindValue(":descricao", $descricao, PDO::PARAM_STR);
        $consulta->bindValue(":fabricantesId", $fabricanteId, PDO::PARAM_INT);
        
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao inserir: ".$erro->getMessage());
    }
};

function lerUmProduto(PDO $conexao, int $id):array {
    $sql = "SELECT * FROM produtos WHERE id = :id";
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

function atualizarproduto( $conexao, int $id, string $nome, float $preco,int $quantidade,string $descricao,int $fabricanteId):void {
    $sql = " UPDATE produtos set 
    nome = :nome,
    preco = :preco,
    quantidade = :quantidade,
    descricao = :descricao,
    fabricantes_id = :fabricantesId 
    WHERE id = :id";

    try {
        $consulta =  $conexao->prepare($sql);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
        $consulta->bindValue(":preco", $preco, PDO::PARAM_STR);
        $consulta->bindValue(":quantidade", $quantidade, PDO::PARAM_INT);
        $consulta->bindValue(":descricao", $descricao, PDO::PARAM_STR);
        $consulta->bindValue(":fabricantesId", $fabricanteId, PDO::PARAM_INT);
        $consulta->execute();
        
     } catch (Exception $erro) {
          die("Erro ao atualizar!!!".$erro ->getMessage());     
     };
}; 

function excluirproduto($conexao,int $id):void{
    $sql = "DELETE FROM produtos where id = :id";
    try {
        $consulta =  $conexao->prepare($sql);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->execute();
        
     } catch (Exception $erro) {
          die("Erro ao Excluir!!!".$erro ->getMessage());     
     };
};
?>