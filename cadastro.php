<?php
include ("conexao.php");
$email = $_POST['email'];
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];
$nome = $_POST['nome'];
$nascimento = $_POST['nascimento'];
$empresa = $_POST['empresa'];
$SQL = "insert into login(email,senha,nome,nascimento,emprsa)values('" . $email . "','" . $senha . "','" . $nome . "','" . $nascimento . "','" . $empresa . "')";
if(!(mysqli_query($conexao,$SQL)))
{
    $erro = mysqli_error($conexao);
    echo $erro;
    echo ("<br>");
    echo $SQL;
    echo ("<br>");
}
else
{
    echo "<script>javascript:window.location='crud/principal.html';</script>";
}
?>