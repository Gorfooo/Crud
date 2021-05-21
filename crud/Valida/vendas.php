<?php
include ('../../conexao.php');
$cliente = $_POST['cliente'];
$data = $_POST['data'];
$itens = $_POST['itens'];

$SQLCPF = "select nome,id_cliente from tb_cliente where cpf = '" . $cliente . "'";
$SQLCNPJ = "select nome,id_cliente from tb_cliente where cnpj = '" . $cliente . "'"; 
if(!($RSCPF = mysqli_query($conexao,$SQLCPF)) || !($RSCNPJ = mysqli_query($conexao,$SQLCNPJ)))
{
    $erro["retornado"] = mysqli_error($conexao);
    $erro["codigo"] = 1;
    echo json_encode($erro);
    exit;//testar
}
$RowCpf = mysqli_fetch_assoc($RSCPF);
$id_cpf = $RowCpf['id_cliente'];
$nome_cpf = 

$SQL = "insert into tb_venda(data,id_cliente)values('" . $data . "'," . $id_cliente . ")";
if(!mysqli_query($conexao,$SQL))
{
    $erro["retornado"] = mysqli_error($conexao);
    $erro["codigo"] = 2;
    echo json_encode($erro);
}
?>