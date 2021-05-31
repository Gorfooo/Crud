<?php
include ('../../conexao.php');
$id = $_POST['id'];

$SQL = "select * from tb_cliente where id_cliente = " . $id;

$RS = mysqli_query($conexao,$SQL);
$row = mysqli_fetch_assoc($RS);
$cep = $row['cep'];
$cidade = $row['cidade'];
$cnpj = $row['cnpj'];
$cpf = $row['cpf'];
$limite_credito = $row['limite_credito'];
$logradouro = $row['logradouro'];
$nome = $row['nome'];
$numero = $row['numero'];
$UF = $row['UF'];

$status = $row['status'];
if ($status == 'A'){
    $status = 'checked';
} else {
    $status = '';
}
    
    $retorno['cep'] = $cep;
    $retorno['cidade'] = $cidade;
    $retorno['cnpj'] = $cnpj;
    $retorno['cpf'] = $cpf;
    $retorno['limite_credito'] = $limite_credito;
    $retorno['logradouro'] = $logradouro;
    $retorno['nome'] = $nome;
    $retorno['numero'] = $numero;
    $retorno['uf'] = $UF;
    $retorno['status'] = $status;

    echo json_encode($retorno);
?>