<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--  -->
    <script src="js/login.js"></script>
    <!--  -->
    <link rel="stylesheet" type="text/css" href="css/Login.css">
    <!--  -->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="faviconlogin/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="faviconlogin/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="faviconlogin/favicon-16x16.png">
    <link rel="manifest" href="faviconlogin/site.webmanifest"> -->
    <!--  -->
    <title>Login</title>
</head>
<body>

<?php 
$retorno = $_GET['retorno']; //pega o retorno do header do arquivo validaLogin.php
?>
<script>var retorno = "<?= $retorno ?>";</script> 
<script src="js/login.js"></script>
    <div class='container' style='width: 400px;'>
        <form name='form' id='form' method="POST" action="validaLogin.php">
            <div class='form-group pt-5'>
                <label for="usuario">Usuário:</label>
                <input type='text' name='usuario' id='usuario' class='form-control mb-2' placeholder="E-mail" maxlength="50" autofocus>
                <label for="senha">Senha:</label>
                <input autocomplete="off" type='password' name='senha' id='senha' class='form-control' placeholder="Senha" maxlength="50">
                <a href="#" class="btn btn-dark mt-2 btn-block" id='mostrarSenha'>Mostrar Senha</a>
                <input type="checkbox" id='lembrarSenha'> Lembrar Senha?<br>
                <div class='row'>
                    <div class='col pr-1'>
                        <a href="#" class="btn btn-dark mt-2 btn-md btn-block" onclick='enviaForm()'>Login</a>   
                    </div>
                    <div class='col pl-1'>
                        <a href="#" class="btn btn-dark mt-2 btn-md btn-block" onclick='window.open("cadastro.html","_self")'>Criar Conta</a>
                </div>
            </div>
        </form>
    </div> 
        </div class='row'>
            <div>
            <div class="col-auto alert alert-danger text-center" id='usuarioIncorreto' style='width: 200px;' role="alert">
                Usuário Incorreto
            </div>
            <div class="col-auto alert alert-danger text-center" id='senhaIncorreta' style='width: 200px;' role="alert">
                Senha Incorreta
            </div>
        </div> 
</body>
</html>