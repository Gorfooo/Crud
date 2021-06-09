<?php
include ('../../conexao.php');
$cliente = $_POST['cliente'];
$SQLCPF = "select cpf from tb_cliente where cpf like '%" . $cliente . "%' order by id_cliente limit 5";
$RSCPF = mysqli_query($conexao,$SQLCPF);
$pessoa = [];
while($RowCpf = mysqli_fetch_assoc($RSCPF)){
    $RowClienteCpf = $RowCpf['cpf'];
    array_push($pessoa,$RowClienteCpf);
};
$SQLCNPJ = "select cnpj from tb_cliente where cnpj like '%" . $cliente . "%' order by id_cliente limit 5";
$RSCNPJ = mysqli_query($conexao,$SQLCNPJ);
while($RowCnpj = mysqli_fetch_assoc($RSCNPJ)){
    $RowClienteCnpj = $RowCnpj['cnpj'];
    array_push($pessoa,$RowClienteCnpj);
};
$retorno['retorno'] = $pessoa;
echo json_encode($retorno);
?>