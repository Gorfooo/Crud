<?php
include ('../../conexao.php');
$id = $_POST['id'];
$cliente = $_POST['cliente'];
$data = $_POST['data'];
$itens = $_POST['itens'];

if(strlen($cliente)==14){
    $cpf = $cliente;
}else{
    $cnpj = $cliente;
}

$tamanho = count($itens);
$i = 0;
$pos1 = 0;
$pos2 = 1;
$pos3 = 2;
while($i < $tamanho){
    
    $i = $i+3;
}
// $SQLProdutos = "update tb_produto_venda set  where id_venda = " . $id;
// $SQLVenda = "delete from tb_venda"
// if(!mysqli_query($conexao,$SQL))
// {
//     $erro = mysqli_error($conexao);
//     echo ('deu pau pra atualizar: ' . $erro);
// }
?>