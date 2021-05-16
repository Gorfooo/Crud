<?php
include ('../../conexao.php');
$id = $_POST['id'];
$SQL = "delete from tb_produto where id_produto = " . $id;

if(!(mysqli_query($conexao,$SQL)))
{
    $erro = mysqli_error($conexao);
    echo $erro;
    echo ("<br>");
    echo $SQL;
    echo ("<br>");
    // $p['retorno'] = 3;//usar o encode para voltar os erros na tela
}//não usar o else
// echo json_encode($p);
?>