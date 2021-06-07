<?php
include ('../../conexao.php');
$id = $_POST['id'];
$cliente = $_POST['cliente'];
$data = $_POST['data'];
$itens = $_POST['itens'];

if(strlen($cliente)==14){
    $SQLCliente = "select id_cliente from tb_cliente where cpf = '" . $cliente . "'";
    $RSCliente = mysqli_query($conexao,$SQLCliente);
    $rowCliente = mysqli_fetch_assoc($RSCliente);
    $cliente = $rowCliente['id_cliente'];
}else{
    $SQLCliente = "select id_cliente from tb_cliente where cnpj = '" . $cliente . "'";
    $RSCliente = mysqli_query($conexao,$SQLCliente);
    $rowCliente = mysqli_fetch_assoc($RSCliente);
    $cliente = $rowCliente['id_cliente'];
}

$SQLDeleteItem = "delete from tb_produto_venda where id_venda = " . $id;
mysqli_query($conexao,$SQLDeleteItem);

$tamanho = count($itens);
$i = 0;
$pos1 = 0;
$pos2 = 1;
$pos3 = 2;
while($i < $tamanho){
    $SQLProduto = "select id_produto from tb_produto where descricao = '" . $itens[$pos1] . "'";
    $RSProduto = mysqli_query($conexao,$SQLProduto);
    $rowProduto = mysqli_fetch_assoc($RSProduto);
    $produto = $rowProduto['id_produto'];

    $SQL = "insert into tb_produto_venda(id_produto,valor_unit,quantidade,id_venda)
    values (" . $produto . "," . $itens[$pos2] . "," . $itens[$pos3] . "," . $id . ")";
    mysqli_query($conexao,$SQL);

    $pos1 = $pos1 + 3;
    $pos2 = $pos2 + 3;
    $pos3 = $pos3 + 3;
    $i = $i+3;
}

$SQLVenda = "update tb_venda set id_cliente = ". $cliente . ", data = '". $data . "' where id_venda = ". $id;
mysqli_query($conexao,$SQLVenda);
?>