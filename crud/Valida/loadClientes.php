<?php
session_start();
if((!isset ($_SESSION['usuario']) == true) && (!isset ($_SESSION['senha']) == true))
{
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('location:../index.php');
}
include ('../../conexao.php');
$SQL = "select cli.id_cliente,cli.nome,cli.cpf,cli.cnpj,uf.descricao from tb_cliente cli inner join tb_uf uf on cli.id_uf = uf.id_uf";
$RS = mysqli_query($conexao,$SQL);
$i = 1;
while ($row = mysqli_fetch_assoc($RS)){
    if(empty($row['cpf'])){
        $pessoa = 'cnpj';
    }else{
        $pessoa = 'cpf';
    }
    echo "<tr>
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