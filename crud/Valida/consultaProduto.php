<?php
include ('../../conexao.php');
$item = $_POST['produto'];
$SQL = "select descricao from tb_produto where (descricao like '%" . $item . "%') and (status = 'A') order by id_produto limit 5";
$RS = mysqli_query($conexao,$SQL);
$produto = [];
while($Row = mysqli_fetch_assoc($RS)){
    $RowItem = $Row['descricao'];
    array_push($produto,$RowItem);
};
$retorno['retorno'] = $produto;
echo json_encode($retorno);
?>