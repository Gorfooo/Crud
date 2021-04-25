<?php
include ("conexao.php");
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$SQL= "select * from login where email = '" . $usuario . "'";
$RSS=mysqli_query($conexao,$SQL) or print($SQL);
if(mysqli_num_rows($RSS) == 0)
{
        $retorno = 1;
        header("Location: index.php?retorno=".$retorno);
}
else
{
    $SQL= "select * from login where email = '" . $usuario . "' and senha = '" . $senha . "'";
    $RSS=mysqli_query($conexao,$SQL) or print($SQL);
    if(mysqli_num_rows($RSS) == 0)
    {
        $retorno = 2;
        header("Location: index.php?retorno=".$retorno);
    }
    else
    {
        header("Location: crud/principal.html");
    }
}
?>