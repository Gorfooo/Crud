<?php
include ('../../conexao.php');
$cliente = $_POST['cliente'];
$data = $_POST['data'];

$SQLCliente = "select id_cliente from tb_cliente where nome = '" . $cliente . "'";
if(!mysqli_query($conexao,$SQLCliente))
{
    $erro["retornado"] = mysqli_error($conexao);
    $erro["codigo"] = 1;
    echo json_encode($erro);
}
$row = mysqli_fetch_assoc($RSCliente);
$id_cliente = $row['id_cliente'];

$SQL = "insert into tb_venda(data,id_cliente)values('" . $data . "'," . $id_cliente . ")";
if(!mysqli_query($conexao,$SQL))
{
    $erro["retornado"] = mysqli_error($conexao);
    $erro["codigo"] = 2;
    echo json_encode($erro);
}
?>