<?php
include ('../../conexao.php');
$id = $_POST['id'];
$SQLVendaItem = "delete from tb_produto_venda where id_venda = " . $id;
if(!mysqli_query($conexao,$SQLVendaItem))
{
    $erro["retornado"] = mysqli_error($conexao);
    $erro["codigo"] = 5;
    echo json_encode($erro);
}
$SQLVenda = "delete from tb_venda where id_venda = " . $id;
if(!mysqli_query($conexao,$SQLVenda))
{
    $erro["retornado"] = mysqli_error($conexao);
    $erro["codigo"] = 6;
    echo json_encode($erro);
}
?>