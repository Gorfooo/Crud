<?php
include ('../../conexao.php');
$cliente = $_POST['cliente'];
$data = $_POST['data'];

$SQLCliente = "select id_cliente from tb_cliente where nome = '" . $cliente . "'";
if(!($RSCliente = mysqli_query($conexao,$SQLCliente)))
{
    $erro = mysqli_error($conexao);
    echo $erro;
    echo ("<br>");
    echo $SQL;
    echo ("<br>");
    return false;//testar
}
$row = mysqli_fetch_assoc($RSCliente);
$id_cliente = $row['id_cliente'];

$SQL = "insert into tb_venda(data,id_cliente)values('" . $data . "'," . $id_cliente . ")";
if(!(mysqli_query($conexao,$SQL)))
{
    $erro = mysqli_error($conexao);
    echo $erro;
    echo ("<br>");
    echo $SQL;
    echo ("<br>");
}
?>