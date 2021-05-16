<?php
include ('../../conexao.php');
$preco = $_GET['preco'];
$custo = $_GET['custo'];
$descricao = $_GET['descricao'];
$quantidade = $_GET['quantidade'];
$unidadeMedida = $_GET['unidadeMedida'];
$status = $_GET['status'];

$descricao = str_replace("'", "", $descricao);
switch ($unidadeMedida){
    case 'unidade':
        $unidadeMedida = 1;
        break;
    case 'kilograma':
        $unidadeMedida = 2;
        break;
    case 'metro':
        $unidadeMedida = 3;
        break;
    case 'metro cubico':
        $unidadeMedida = 4;
        break;
    default://tonelada
        $unidadeMedida = 5;
        break;
}
if ($status == "on"){
    $status = 'A';
}
else
{
    $status = 'I';
}

if ($preco > 999999999 || $custo > 999999999 || $quantidade >999999999){
    $retorno = 1;
    header("Location: ../produtos.php?retorno=".$retorno);
    return false;
}
else if (empty($quantidade)||empty($preco)||empty($custo)||empty($descricao)){
    $retorno = 2;
    header("Location: ../produtos.php?retorno=".$retorno);
    return false;
}

$SQL = "insert into tb_produto (descricao, preco, id_unidade_medida, custo, quantidade, status) values ('"
 . $descricao . "'," . $preco . "," . $unidadeMedida . "," . $custo . "," . $quantidade . ",'" . $status . "')";

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
    header("Location: ../produtos.php");
 }
?>