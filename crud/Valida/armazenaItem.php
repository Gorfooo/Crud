<?php
include ('../../conexao.php');
$itens = $_POST['itens'];

$i = 0;
$produto = [];
while ($i < sizeof($itens)){
    $SQLProduto = "select id_produto from tb_produto where descricao = '" . $itens[$i] . "'";
    if(!mysqli_query($conexao,$SQLProduto))
{
    $erro["retornado"] = mysqli_error($conexao);//validar antes de inserir a venda (arquivo Valida/vendas.php)
    $erro["codigo"] = 3;
    echo json_encode($erro);
}
    $row = mysqli_fetch_assoc($RSProduto);
    array_push($produto,$row['id_produto']);
    $i = $i + 3;
}

$SQLVenda = "SHOW TABLE STATUS LIKE 'tb_venda'";
$RS = mysqli_query($conexao, $SQLVenda) or die (mysqli_error($conexao));
$row = mysqli_fetch_array($RS);

$preco = [];
$quantidade = [];
$i = 0;
$posPreco = 1;
$posQtd = 2;
while ($i < sizeof($itens)){
    array_push($preco,$itens[$posPreco]);
    array_push($quantidade,$itens[$posQtd]);
    $posPreco = $posPreco + 3;
    $posQtd = $posQtd + 3;
    $i = $i + 3;
}

$i = 0;
while ($i < sizeof($produto)){
    $SQL = "insert into tb_produto_venda(id_produto,id_venda,valor_unit,quantidade)values(" . $produto[$i] . "," . ($row['Auto_increment']-1) . "," . $preco[$i] . "," . $quantidade[$i] . ");";
    if(!mysqli_query($conexao,$SQL))
    {
        $erro["retornado"] = mysqli_error($conexao);
        $erro["codigo"] = 4;
        echo json_encode($erro);
    }
    $i++;
}
?>