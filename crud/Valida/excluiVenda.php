<?php
include ('../../conexao.php');
$id = $_POST['id'];
$SQLVendaItem = "delete from tb_produto_venda where id_venda = " . $id;
mysqli_query($conexao, $SQLVendaItem) or die (mysqli_error($conexao));//erro

$SQLVenda = "delete from tb_venda where id_venda = " . $id;
mysqli_query($conexao, $SQLVenda) or die (mysqli_error($conexao));//erro
?>