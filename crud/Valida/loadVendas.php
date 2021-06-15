<?php
session_start();
if((!isset ($_SESSION['usuario']) == true) && (!isset ($_SESSION['senha']) == true))
{
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('location:../index.php');
}
include ('../../conexao.php');
$SQL = "select * from tb_venda";
$Codigo = $_GET['codigo'];
if($Codigo){
    $SQL = "select * from tb_venda where id_venda = ". $Codigo;
}
$DataI = $_GET['dataI'];
$DataF = $_GET['dataF'];
if($DataI && $DataF){
    $SQL = "select * from tb_venda where data between '".$DataI."' and '".$DataF."'";
}
$RS = mysqli_query($conexao,$SQL);
$i = 1;
function data($data){
    return date("d/m/Y", strtotime($data));
}
while ($row = mysqli_fetch_assoc($RS)){
$SQLCliente = "select nome from tb_cliente where id_cliente = " . $row["id_cliente"];
$RSCliente = mysqli_query($conexao,$SQLCliente);
$rowCliente = mysqli_fetch_assoc($RSCliente);
$SQLItens = "select sum(quantidade * valor_unit) as total from tb_produto_venda where id_venda = " . $row["id_venda"];
$RSItens = mysqli_query($conexao,$SQLItens);
$rowItem = mysqli_fetch_assoc($RSItens);
    echo "<tr>
    <th>$i</th>
    <td>" . $row["id_venda"] . "</td>
    <td>" . data($row["data"]) . "</td>
    <td>" . $rowCliente['nome'] ."</td>
    <td>" . $rowItem['total'] . "</td>
    <td><i class='fas fa-pencil-alt'onclick='editaVenda(". $row["id_venda"] .");'style='cursor:pointer'></i>
    <i class='fas fa-times ml-3'onclick='excluiVenda(". $row["id_venda"] .");'style='cursor:pointer'></i></td>
    </tr>";
    $i++;
};
?>