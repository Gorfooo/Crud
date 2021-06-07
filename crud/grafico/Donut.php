<?php
include ('../../conexao.php');
$SQLDonut = "select count(cli.id_cliente) as qtd,
uf.descricao as UF
from tb_cliente cli right join tb_uf uf
on cli.id_uf = uf.id_uf
group by uf
order by uf.id_uf";
$RSDonut = mysqli_query($conexao,$SQLDonut);
$quantidade = [];
while($RowDonut = mysqli_fetch_assoc($RSDonut)){
    $RowCount = $RowDonut['qtd'];
    array_push($quantidade,$RowCount);
};
$retorno['quantidade'] = $quantidade;
$retorno['tamanho'] = sizeof($quantidade);
echo json_encode($retorno);
?>