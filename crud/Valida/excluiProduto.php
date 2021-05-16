<?php
include ('../../conexao.php');
$id = $_POST['id'];
$SQL = "delete from tb_produto where id_produto = " . $id;
mysqli_query($conexao, $SQL) or die (mysqli_error($conexao));//erro
// if(!(mysqli_query($conexao,$SQL)))//retornar parâmetro que não conseguiu excluir produto
// {
//     $erro = mysqli_error($conexao);
//     echo $erro;
//     echo ("<br>");
//     echo $SQL;
//     echo ("<br>");
//     // $p['retorno'] = 3;//usar o encode para voltar os erros na tela
// }//não usar o else pq deu pau
// echo json_encode($p);
?>