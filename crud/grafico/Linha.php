<?php
include ('../../conexao.php');
$ano = date("Y");//pega ano atual
$SQLVendasQuantidade = "select count(v.id_venda) as qtd,
month(v.data) as mes
from tb_venda v
where YEAR(v.data) = ". $ano ."
group by MONTH(v.data)
order by mes";
$RSVendasQuantidade = mysqli_query($conexao,$SQLVendasQuantidade);
$quantidadeVendas = [];
$Mes = [];
while($RowVendasQuantidade = mysqli_fetch_assoc($RSVendasQuantidade)){
    $RowQuantidade = $RowVendasQuantidade['qtd'];
    $RowMes = $RowVendasQuantidade['mes'];
    array_push($quantidadeVendas,$RowQuantidade);
    array_push($Mes,$RowMes);
}
$retorno['quantidadeVendas'] = $quantidadeVendas;
$retorno['Mes'] = $Mes;
$retorno['tamanho'] = sizeof($Mes);
echo json_encode($retorno);
?>