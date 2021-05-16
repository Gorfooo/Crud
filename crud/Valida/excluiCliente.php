<?php
header('Content-Type: application/json');
include ('../../conexao.php');
$id = $_POST['id'];
$SQL = "delete from tb_cliente where id_cliente = " . $id;
if(!mysqli_query($conexao,$SQL))
{
    $erro["retornado"] = mysqli_error($conexao);
    $erro["codigo"] = 6;
    echo json_encode($erro);
}
?>