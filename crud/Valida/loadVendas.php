<?php
    include ('../../conexao.php');
    $SQL = "select * from tb_venda";
    $RS = mysqli_query($conexao,$SQL);
    $i = 1;
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
        <td>" . $row["data"] . "</td>
        <td>" . $rowCliente['nome'] ."</td>
        <td>" . $rowItem['total'] . "</td>
        <td><i class='fas fa-pencil-alt'onclick='editaVenda(". $row["id_venda"] .");'style='cursor:pointer'></i>
        <i class='fas fa-times ml-3'onclick='excluiVenda(". $row["id_venda"] .");'style='cursor:pointer'></i></td>
        </tr>";
        $i++;
        };
?>