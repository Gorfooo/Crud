<?php
include ('../../conexao.php');
$ano = date("Y");//pega ano atual
$SQLVendaMes = "select sum((pv.quantidade) * (pv.valor_unit)) as valor,
month(v.data) as mes
from tb_venda v inner join tb_produto_venda pv
on v.id_venda = pv.id_venda
where YEAR(v.data) = ".$ano ."
group by MONTH(v.data)
order by mes";
$RSBarra = mysqli_query($conexao,$SQLVendaMes);
$valores = [];
$meses = [];
while($RowBarra = mysqli_fetch_assoc($RSBarra)){
    $RowValor = $RowBarra['valor'];
    $RowMes = $RowBarra['mes'];
    array_push($valores,$RowValor);
    array_push($meses,$RowMes);
};
$retorno['valores'] = $valores;
$retorno['meses'] = $meses;
$retorno['tamanho'] = sizeof($meses);
echo json_encode($retorno);
?>