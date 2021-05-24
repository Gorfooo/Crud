<?php
include ('../../conexao.php');
$cliente = $_POST['cliente'];
$data = $_POST['data'];
$itens = $_POST['itens'];

//pega id_cliente
if(strlen($cliente) == 14){
    $SQLCPF = "select id_cliente from tb_cliente where cpf = '" . $cliente . "'";
    $RSCPF = mysqli_query($conexao,$SQLCPF);
    $RowCpf = mysqli_fetch_assoc($RSCPF);
    $id_cliente = $RowCpf['id_cliente'];
}else{
    $SQLCNPJ = "select id_cliente from tb_cliente where cnpj = '" . $cliente . "'"; 
    $RSCNPJ = mysqli_query($conexao,$SQLCNPJ);
    $RowCnpj = mysqli_fetch_assoc($RSCNPJ);
    $id_cliente = $RowCnpj['id_cliente'];
}

$SQL = "insert into tb_venda(data,id_cliente)values('" . $data . "'," . $id_cliente . ")";
if(!mysqli_query($conexao,$SQL)){
    $erro["retornado"] = mysqli_error($conexao);
    $erro["codigo"] = 1;//erro ao inserir venda
    echo json_encode($erro);
}

$SQLVenda = "SHOW TABLE STATUS LIKE 'tb_venda'";
$RS = mysqli_query($conexao, $SQLVenda) or die (mysqli_error($conexao));
$row = mysqli_fetch_array($RS);
$i = 0;
$pos_produto = 0;
$pos_preco = 1;
$pos_quantidade = 2;
while ($i < sizeof($itens)){
    //transforma nome do item no ID do item
    $SQLProduto = "select id_produto from tb_produto where descricao = '" . $itens[$pos_produto] . "'";
    $RSProduto = mysqli_query($conexao,$SQLProduto);
    $RowProduto = mysqli_fetch_assoc($RSProduto);

    $SQL = "insert into tb_produto_venda(id_produto,id_venda,valor_unit,quantidade)values(" . $RowProduto['id_produto'] . "," . ($row['Auto_increment']-1) . "," . $itens[$pos_preco] . "," . $itens[$pos_quantidade] . ");";
    if(!mysqli_query($conexao,$SQL))
    {
        $erro["retornado"] = mysqli_error($conexao);
        $erro["codigo"] = 2;//erro ao inserir itens da venda
        echo json_encode($erro);
        break;
    }
    $pos_produto = $pos_produto + 3;
    $pos_preco = $pos_preco + 3;
    $pos_quantidade = $pos_quantidade + 3;
    $i = $i + 3;
}
$erro["codigo"] = 3;//deu boa
echo json_encode($erro);
?>