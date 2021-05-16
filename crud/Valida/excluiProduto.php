<?php
include ('../../conexao.php');
$id = $_POST['id'];
$SQL = "delete from tb_produto where id_produto = " . $id;
if(!mysqli_query($conexao,$SQL))
{
    $erro["retornado"] = mysqli_error($conexao);
    $erro["codigo"] = 3;
    echo json_encode($erro);
}
?>