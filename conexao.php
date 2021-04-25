<?php
$conexao = new mysqli('localhost','root','','site');
if(!($conexao))
{
    die('Não foi possível conectar ao banco de dados!') . mysqli_error($conexao);
}
// mysqli_close($conexao);
?>