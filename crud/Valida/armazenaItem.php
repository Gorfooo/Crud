<?php
include ('../../conexao.php');
$produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];
$preco = $_POST['preco'];

// $SQLProduto = "select id_produto from tb_produto where descricao = '" . $produto . "')";
// $RSProduto = mysqli_query($conexao,$SQLProduto);

$SQL = "insert into tb_produto_venda(id_produto,id_venda,valor_unit,quantidade)values(" . 5 . "," . 1 . "," . $preco . "," . $quantidade . ")";
?>