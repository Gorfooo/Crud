<?php
include ('../../conexao.php');
$cliente = $_GET['cliente'];
$data = $_GET['data'];
$produto = $_GET['produto'];
$quantidade = $_GET['quantidade'];
$preco = $_GET['preco'];

$produto = str_replace("'", "", $produto);

$SQLCliente = "select id_cliente from tb_cliente where nome = '" . $cliente . "'";
if(!(mysqli_query($conexao,$SQLCliente)))
{
    $erro = mysqli_error($conexao);
    echo $erro;
    echo ("<br>");
    echo $SQL;
    echo ("<br>");
    return false;//testar
}
else
{
    $RSS = mysqli_query($conexao,$SQLCliente);
    $RS = mysqli_fetch_assoc($RSS);
    $cliente = $RS['id_cliente'];
}

if ($preco > 999999999 || $quantidade > 999999999){
    $retorno = 1;
    header("Location: ../vendas.php?retorno=".$retorno);
}
else if (empty($quantidade)||empty($preco)||empty($produto)||empty($data)||empty($cliente)){
    $retorno = 2;
    header("Location: ../vendas.php?retorno=".$retorno);
}

$SQL = "insert into tb_venda(data,id_cliente)values('" . $data . "'," . $cliente . ")";

 if(!(mysqli_query($conexao,$SQL)))
 {
     $erro = mysqli_error($conexao);
     echo $erro;
     echo ("<br>");
     echo $SQL;
     echo ("<br>");
 }
 else
 {
    $retorno = 1;
    header("Location: ../vendas.php?retorno=".$retorno);
 }
?>