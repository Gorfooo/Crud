<?php
session_start();
if((!isset ($_SESSION['usuario']) == true) && (!isset ($_SESSION['senha']) == true))
{
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('location:../index.php');
}
include ('../../conexao.php');
$SQL = "select cli.id_cliente,cli.nome,cli.cpf,cli.cnpj,uf.descricao,cli.status from tb_cliente cli inner join tb_uf uf on cli.id_uf = uf.id_uf";
$Codigo = $_GET['codigo'];
if($Codigo){
    $SQL = "select cli.id_cliente,cli.nome,cli.cpf,cli.cnpj,uf.descricao,cli.status from tb_cliente cli inner join tb_uf uf on cli.id_uf = uf.id_uf where id_cliente = ".$Codigo;
}
$RS = mysqli_query($conexao,$SQL);
$i = 1;
while ($row = mysqli_fetch_assoc($RS)){
    if(empty($row['cpf'])){
        $pessoa = 'cnpj';
    }else{
        $pessoa = 'cpf';
    }
    if($row['status'] == 'I'){
        $inativo = "style='opacity:0.5'";
    }else{
        $inativo = "style='opacity:1'";
    }
    echo "<tr ".$inativo.">
    <th>$i</th>
    <td>" . $row["id_cliente"] . "</td>
    <td>" . $row["nome"] . "</td>
    <td>" . $row["$pessoa"] ."</td>
    <td>" . $row["descricao"] . "</td>
    <td><i class='fas fa-pencil-alt'onclick='editaCliente(". $row["id_cliente"] .");'style='cursor:pointer'></i>
    <i class='fas fa-times ml-3'onclick='excluiCliente(". $row["id_cliente"] .");'style='cursor:pointer'></i></td>
    </tr>";
    $i++;
    };
?>