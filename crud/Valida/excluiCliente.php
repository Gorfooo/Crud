<?php
include ('../../conexao.php');
$id = $_POST['id'];
$SQL = "delete from tb_cliente where id_cliente = " . $id;

if(!(mysqli_query($conexao,$SQL)))
{
    $erro = mysqli_error($conexao);
    echo $erro;
    echo ("<br>");
    echo $SQL;
    echo ("<br>");
}

?>