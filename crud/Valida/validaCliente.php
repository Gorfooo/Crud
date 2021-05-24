<?php
include ('../../conexao.php');
$cliente = $_POST['cliente'];
$SQLCPF = "select id_cliente from tb_cliente where cpf = '" . $cliente . "'";
$SQLCNPJ = "select id_cliente from tb_cliente where cnpj = '" . $cliente . "'"; 
$RSCPF = mysqli_query($conexao,$SQLCPF);
$RSCNPJ = mysqli_query($conexao,$SQLCNPJ);

if((mysqli_num_rows($RSCPF) == 0) && (mysqli_num_rows($RSCNPJ) == 0)){
    $retorno["retorno"] = 1;//deixa campo do cliente em vermelho
    echo json_encode($retorno);
}
$retorno["retorno"] = 2;//deu boa
echo json_encode($retorno);
?>