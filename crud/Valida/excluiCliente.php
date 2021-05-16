<?php
// header('Content-Type: application/json');
include ('../../conexao.php');
$id = $_POST['id'];
$SQL = "delete from tb_cliente where id_cliente = " . $id;
// $retorno = 6;
if(!(mysqli_query($conexao,$SQL)))
{
    // echo json_encode(6);
    // $retorno = 6;
    $erro = mysqli_error($conexao);//retornar parâmetro que não conseguiu excluir cliente
    echo $erro;
    echo ("<br>");
    echo $SQL;
    echo ("<br>");
}
// $sql = mysqli_query($conexao, $SQL) or die (mysqli_error($conexao));
// echo $sql;
echo json_encode(6);
// if($retorno != 6){
//     echo json_encode($retorno);
// } 
?>