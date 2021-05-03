<?php
$conexao = new mysqli('localhost','root','','site');
mysqli_set_charset($conexao,"utf8");
if(!($conexao))
{
    die('Não foi possível conectar ao banco de dados!') . mysqli_error($conexao);
}
?>