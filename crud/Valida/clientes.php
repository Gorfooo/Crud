<?php
session_start();
if((!isset ($_SESSION['usuario']) == true) && (!isset ($_SESSION['senha']) == true))
{
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('location:../index.php');
}
include ('../../conexao.php');
$cpf = $_GET['cpf'];
$cnpj = $_GET['cnpj'];
$limiteCredito = $_GET['limiteCredito'];
$nome = $_GET['nome'];
$cep = $_GET['cep'];
$numero = $_GET['numero'];
$logradouro = $_GET['logradouro'];
$cidade = $_GET['cidade'];
$uf = $_GET['uf'];
$status = $_GET['status'];

$nome = str_replace("'", "", $nome);
$logradouro = str_replace("'", "", $logradouro);
$cidade = str_replace("'", "", $cidade);
$uf = str_replace("'", "", $uf);

if ($status == "on"){
    $status = 'A';
}
else
{
    $status = 'I';
}

if ($limiteCredito > 999999999 || $numero > 999999999){//valida limite de crédito e número
    $retorno = 1;
    header("Location: ../clientes.php?retorno=".$retorno);
    return false;
}
else if(empty($nome) || empty($cep) || empty($logradouro) || empty($cidade) || empty($uf)){//valida campos em branco
    $retorno = 2;
    header("Location: ../clientes.php?retorno=".$retorno);
    return false;
}
else if(empty($cpf) && empty($cnpj)){//valida cpf e cnpj em branco
    $retorno = 2;
    header("Location: ../clientes.php?retorno=".$retorno);
    return false;
}
else if(empty($cnpj)){//CNPJ está vazio, dessa forma, valida cpf
    if(!(validaCPF($cpf))){
        $retorno = 3;
        header("Location: ../clientes.php?retorno=".$retorno);
        return false;
    }
}
else{//CPF está vazio, dessa forma, valida CNPJ
    if(!(validar_cnpj($cnpj))){
        $retorno = 4;
        header("Location: ../clientes.php?retorno=".$retorno);
        return false;
    }
}

if(!preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $cep)) {//valida cep
    $retorno = 5;
    header("Location: ../clientes.php?retorno=".$retorno);
    return false;
}

$SQLUF = "select id_uf from tb_uf where descricao='" . $uf ."'";
$RSUF = mysqli_query($conexao,$SQLUF);
$RowUF = mysqli_fetch_assoc($RSUF);
$uf = $RowUF['id_uf'];

$SQL = "insert into tb_cliente (nome,cep,numero,logradouro,cidade,id_uf,limite_credito,cpf,cnpj,status) values ('" . $nome . "','" . $cep . "'," . $numero . ",'" . $logradouro . "','"
. $cidade . "','" . $uf . "'," . $limiteCredito . ",'" . $cpf . "','" . $cnpj . "','" . $status . "')";

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
    header("Location: ../clientes.php");
 }

 function validar_cnpj($cnpj)
 {
     $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
     
     // Valida tamanho
     if (strlen($cnpj) != 14)
         return false;
 
     // Verifica se todos os digitos são iguais
     if (preg_match('/(\d)\1{13}/', $cnpj))
         return false;	
 
     // Valida primeiro dígito verificador
     for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
     {
         $soma += $cnpj[$i] * $j;
         $j = ($j == 2) ? 9 : $j - 1;
     }
 
     $resto = $soma % 11;
 
     if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
         return false;
 
     // Valida segundo dígito verificador
     for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
     {
         $soma += $cnpj[$i] * $j;
         $j = ($j == 2) ? 9 : $j - 1;
     }
 
     $resto = $soma % 11;
 
     return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
 }

 function validaCPF($cpf) {
 
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;

}
?>