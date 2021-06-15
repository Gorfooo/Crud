<?php
include ('../../conexao.php');
$cliente = $_POST['cliente'];
$clienteCnpj = $cliente;
$clienteCpf = $cliente;
if(strlen($clienteCpf) >= 3){
    $clienteCpf = substr_replace($clienteCpf, '.', 3, 0);
}
if(strlen($clienteCpf) >= 7){
    $clienteCpf = substr_replace($clienteCpf, '.', 7, 0);
}
if(strlen($clienteCpf) >= 11){
    $clienteCpf = substr_replace($clienteCpf, '-', 11, 0);
}
if(strlen($clienteCpf) >= 11){
    $clienteCpf = substr_replace($clienteCpf, '', 14, 3);
}

if(strlen($clienteCnpj) >= 2){
    $clienteCnpj = substr_replace($clienteCnpj, '.', 2, 0);
}
if(strlen($clienteCnpj) >= 6){
    $clienteCnpj = substr_replace($clienteCnpj, '.', 6, 0);
}
if(strlen($clienteCnpj) >= 10){
    $clienteCnpj = substr_replace($clienteCnpj, '/', 10, 0);
}
if(strlen($clienteCnpj) >= 15){
    $clienteCnpj = substr_replace($clienteCnpj, '-', 15, 0);
}

$SQL = "select cpf,cnpj from tb_cliente where (cpf like '%" . $clienteCpf . "%' or cnpj like '%".$clienteCnpj."%') and (status = 'A') order by id_cliente limit 5";
$RS = mysqli_query($conexao,$SQL);
$pessoa = [];
while($RowCliente = mysqli_fetch_assoc($RS)){
    $RowClienteCpf = $RowCliente['cpf'];
    $RowClienteCnpj = $RowCliente['cnpj'];
    if($RowClienteCpf){
        array_push($pessoa,$RowClienteCpf);
    }else{
        array_push($pessoa,$RowClienteCnpj);
    }
};
$retorno['retorno'] = $pessoa;
echo json_encode($retorno);
?>