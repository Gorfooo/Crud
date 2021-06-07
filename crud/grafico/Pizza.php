<?php
include ('../../conexao.php');
$SQLClienteVenda = "select cli.nome as nome,
sum((pv.quantidade) * (pv.valor_unit)) as valor
from tb_cliente cli inner join tb_venda v
on cli.id_cliente = v.id_cliente
inner join tb_produto_venda pv
on pv.id_venda = v.id_venda
group by cli.id_cliente
order by valor desc
limit 5";
$RSClienteVenda = mysqli_query($conexao,$SQLClienteVenda);
$clientes = [];
$valorCompra = [];
while($RowClienteVenda = mysqli_fetch_assoc($RSClienteVenda)){
    $RowCliente = $RowClienteVenda['nome'];
    $RowValor = $RowClienteVenda['valor'];
    array_push($clientes,$RowCliente);
    array_push($valorCompra,$RowValor);
}
$retorno['clientes'] = $clientes;
$retorno['valorCompra'] = $valorCompra;
echo json_encode($retorno);
?>