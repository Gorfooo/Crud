<?php
include ('../../conexao.php');
$id = $_POST['id'];

$SQLDescricao = "select p.descricao from tb_produto_venda pv inner join tb_produto p on pv.id_produto = p.id_produto where id_venda = " . $id;
$SQLQuantidade = "select quantidade from tb_produto_venda where id_venda = " . $id;
$SQLPreco = "select valor_unit from tb_produto_venda where id_venda = " . $id;
$RSDescricao = mysqli_query($conexao,$SQLDescricao);
$RSQuantidade = mysqli_query($conexao,$SQLQuantidade);
$RSPreco = mysqli_query($conexao,$SQLPreco);

$arrayDescricao = [];
$arrayQuantidade = [];
$arrayPreco = [];
while($rowDescricao = mysqli_fetch_assoc($RSDescricao)){
    array_push($arrayDescricao,$rowDescricao);
};
while($rowQuantidade = mysqli_fetch_assoc($RSQuantidade)){
    array_push($arrayQuantidade,$rowQuantidade);
};
while($rowPreco = mysqli_fetch_assoc($RSPreco)){
    array_push($arrayPreco,$rowPreco);
};
$tamanho = count($arrayDescricao);

$SQLCliente = "select cli.cpf,cli.cnpj from tb_cliente cli inner join tb_venda v on cli.id_cliente = v.id_cliente where id_venda = ". $id;
$SQLData = "select data from tb_venda where id_venda =".$id;
$RSCliente = mysqli_query($conexao,$SQLCliente);
$RSData = mysqli_query($conexao,$SQLData);
$rowCliente = mysqli_fetch_assoc($RSCliente);
$rowData = mysqli_fetch_assoc($RSData);
$cpf = $rowCliente['cpf'];
$cnpj = $rowCliente['cnpj'];
$data = $rowData['data'];

function data($data){
    return date("d/m/Y", strtotime($data));
}

    $retorno['tamanho'] = $tamanho;
    $retorno['descricao'] = $arrayDescricao;
    $retorno['quantidade'] = $arrayQuantidade;
    $retorno['preco'] = $arrayPreco;
    $retorno['cpf'] = $cpf;
    $retorno['cnpj'] = $cnpj;
    $retorno['data'] = data($data);
    echo json_encode($retorno);
?>