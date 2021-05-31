<?php
include ('../../conexao.php');
$cpf = $_POST['cpf'];
$cnpj = $_POST['cnpj'];

if(empty($cpf)){
    $cpf = 'vazio';
}else if(empty($cnpj)){
    $cnpj = 'vazio';
}

$SQLCPF = "select id_cliente from tb_cliente where cpf = '" . $cpf . "'";
$SQLCNPJ = "select id_cliente from tb_cliente where cnpj = '" . $cnpj . "'";
$RSCPF = mysqli_query($conexao,$SQLCPF);
$RSCNPJ = mysqli_query($conexao,$SQLCNPJ);

if((mysqli_num_rows($RSCPF) >= 1) || (mysqli_num_rows($RSCNPJ) >= 1)){
    $retorno = 1;
    echo json_encode($retorno);
}else{
    $retorno = 2;
    echo json_encode($retorno);
}
?>