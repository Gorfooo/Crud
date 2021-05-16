<?php
include ('../../conexao.php');
$SQL = "select id_cliente,nome,cpf,cnpj,uf from tb_cliente";
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
    <td>" . $row["uf"] . "</td>
    <td><i class='fas fa-pencil-alt'onclick='editaCliente(". $row["id_cliente"] .");'style='cursor:pointer'></i>
    <i class='fas fa-times ml-3'onclick='excluiCliente(". $row["id_cliente"] .");'style='cursor:pointer'></i></td>
    </tr>";
    $i++;
    };
?>