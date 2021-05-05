<?php
include ('../../conexao.php');
// $produto = $_GET['produto'];
// $preco = $_GET['preco'];
// $quantidade = $_GET['quantidade'];
$itens = $_GET['itens'];

// if(!(empty($produto)) && !(empty($quantidade) && !(empty($preco)))){


// $SQLProduto = "select id_produto from tb_produto where descricao = '" . $produto . "')";
// $RSProduto = mysqli_query($conexao,$SQLProduto);

$SQL = "insert into tb_produto_venda(id_produto,id_venda,valor_unit,quantidade)values(" . 10 . "," . 2 . "," . $preco . "," . $quantidade . ");";
echo "<script>console.log('caiu no eco')</script>";
 if(!(mysqli_multi_query($conexao,$SQL)))
 {
     $erro = mysqli_error($conexao);
     echo $erro;
     echo ("<br>");
     echo $SQL;
     echo ("<br>");
 }
 else
 {
    $retorno = 3;
    header("Location: ../clientes.php?retorno=".$retorno);
 }
// $SQL = "insert into tb_produto_venda(id_produto,id_venda,valor_unit,quantidade)values(" . 5 . "," . 1 . "," . $preco . "," . $quantidade . ");
//  insert into tb_produto_venda(id_produto,id_venda,valor_unit,quantidade)values(" . 5 . "," . 1 . "," . $preco . "," . $quantidade . ");";

// if(!(mysqli_multi_query($conexao,$SQL)))
// {
//     $erro = mysqli_error($conexao);
//     echo $erro;
//     echo ("<br>");
//     echo $SQL;
//     echo ("<br>");
// }
// else
// {
//    $retorno = 3;
//    header("Location: ../produtos.php?retorno=".$retorno);
// }
// }
?>