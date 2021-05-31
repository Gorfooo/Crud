<?php
include ('../../conexao.php');
$id = $_POST['id'];
$preco = $_POST['preco'];
$custo = $_POST['custo'];
$descricao = $_POST['descricao'];
$quantidade = $_POST['quantidade'];
$unidadeMedida = $_POST['unidade_medida'];
$status = $_POST['status'];

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
$SQL = "update tb_produto set preco = $preco, custo = $custo, descricao = '$descricao', quantidade = $quantidade,
id_unidade_medida = $unidadeMedida, status = '$status' where id_produto = $id";
if(!mysqli_query($conexao,$SQL))
{
    $erro = mysqli_error($conexao);
    echo ('deu pau pra atualizar: ' . $erro);
}
?>