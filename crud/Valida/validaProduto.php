<?php
include ('../../conexao.php');
$produto = $_POST['produto'];

$SQL = "select id_produto from tb_produto where descricao = '" . $produto . "'";
$RS = mysqli_query($conexao,$SQL);
if(mysqli_num_rows($RS) >= 1){
    $retorno["retorno"] = 1;//produto encontrado
    echo json_encode($retorno);
}else{
    $retorno["retorno"] = 2;//produto não encontrado
    echo json_encode($retorno);
}
?>