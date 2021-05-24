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
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--  -->
    <script src="https://kit.fontawesome.com/00a4711f34.js" crossorigin="anonymous"></script>
    <!--  -->
    <link rel="stylesheet" type="text/css" href="css/clientes.css">
    <!--  -->
    <script src="js/jquery.mask.js"></script>
    <!--  -->
    <title>Clientes</title>
</head>

<body>
    <?php
$retorno = $_GET['retorno'];
?>
    <script>
        var retorno = "<?= $retorno ?>";
    </script>
    <script src="js/clientes.js"></script>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#"
                        onclick="window.open('principal.html','_self');">Dashboard</a></li>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#"
                        onclick="window.open('produtos.php','_self');">Produtos</a></li>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#">Clientes</a></li>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#"
                        onclick="window.open('vendas.php','_self');">Vendas</a></li>
            </ul>
            <a class="navbar-brand text-white" href="#" onclick='window.open("../index.php","_self")'>Sair</a>
        </div>
    </nav>
    <div class='container'>
        <div class='mt-4'>
            <div class="alert alert-danger text-center grid2" role="alert" id='limiteAlto'
                style='height:70px;display:none'>
                Limite De Crédito Muito Alto!
            </div>
        </div>
        <div class='mt-4'>
            <div class="alert alert-danger text-center grid2" role="alert" id='campoVazio'
                style='height:70px;display:none'>
                Campo Vazio!
            </div>
        </div>
        <div class='mt-4'>
            <div class="alert alert-danger text-center grid2" role="alert" id='CPFInvalido'
                style='height:70px;display:none'>
                CPF Inválido!
            </div>
        </div>
        <div class='mt-4'>
            <div class="alert alert-danger text-center grid2" role="alert" id='CNPJInvalido'
                style='height:70px;display:none'>
                CNPJ Inválido!
            </div>
        </div>
        <div class='mt-4'>
            <div class="alert alert-danger text-center grid2" role="alert" id='CEPInvalido'
                style='height:70px;display:none'>
                CEP Inválido!
            </div>
        </div>
        <div class='mt-4'>
            <div class="alert alert-danger text-center grid2" role="alert" id='excluiCliente'
                style='height:70px;display:none'>
                Não é possível excluir esse cliente! Mensagem original: 
            </div>
        </div>
        <div class='mt-4'>
            <div class="alert alert-danger text-center grid2" role="alert" id='ClienteCadastrado'
                style='height:70px;display:none'>
                Cliente já cadastrado! 
            </div>
        </div>
    </div>
    <Div class='container'>
        <div class='row'>
            <div class='col'>
                <h1 class='text-primary'>Registrar Cliente</h1>
            </div>
            <div class='col grid'>
                <button type="button" class="btn btn-primary" id='modalClientes' data-toggle="modal"
                    data-target=".bd-example-modal-lg">Novo Cliente</button>
            </div>
        </div>
        <hr>
        <table class="table table-hover">
            <thead class="thead-light table-striped">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF/CNPJ</th>
                    <th scope="col">UF</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id='clientes'>
            <?php
            include ('../conexao.php');
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
            </tbody>
        </table>
    </Div>
    <div class="modal fade bd-example-modal-lg" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" id='modal'>
        <div class="modal-dialog">
            <div class="modal-content">
                <Div class='container'>
                    <div class="modal-body">
                        <div class='row'>
                            <div class='col'>
                                <h2 class='text-center'>CADASTRO DO CLIENTE:</h2>
                            </div>
                            <div class='col-1'>
                                <i class="fas fa-times" id='fecharModal' data-dismiss="modal" aria-label="Close"></i>
                            </div>
                        </div>
                        <form class='form-group' id='form' action="Valida/clientes.php">
                            <div class='form-check' id='check'>
                                <input type='checkbox' name='pessoa' id='pessoa' class='form-check-input'>
                                <label>Pessoa Jurídica</label>
                            </div>
                            <div class="form-row mt-1">
                                <div class='form-group col' id='cpf'>
                                    <label for="cpf">CPF:</label>
                                    <input type='text' name='cpf' id='cpfInput' class='form-control'>
                                </div>
                                <div class='form-group col' id='cnpj' style="display: none;">
                                    <label for="cnpj">CNPJ:</label>
                                    <input type='text' name='cnpj' id='cnpjInput' class='form-control'>
                                </div>
                                <div class='form-group col'>
                                    <label for="limiteCredito">Limite de Crédito:</label>
                                    <input type='number' name='limiteCredito' id='limiteCredito' class='form-control'>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label for="nome">Nome:</label>
                                <input type='text' name='nome' id='nome' class='form-control' maxlength="50">
                            </div>
                            <div class="form-row">
                                <div class='form-group col'>
                                    <label for="cep">CEP:</label>
                                    <input type='text' name='cep' id='cep' class='form-control'>
                                </div>
                                <div class='form-group col'>
                                    <label for="numero">Número:</label>
                                    <input type='number' name='numero' id='numero' class='form-control'>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label for="logradouro">Logradouro:</label>
                                <input type='text' name='logradouro' id='logradouro' class='form-control' maxlength="50">
                            </div>
                            <div class="form-row">
                                <div class='form-group col'>
                                    <label for="cidade">Cidade:</label>
                                    <input type='text' name='cidade' id='cidade' class='form-control' maxlength="50">
                                </div>
                                <div class='form-group col'>
                                    <label for="uf">UF:</label>
                                    <input type='text' name='uf' id='uf' class='form-control' maxlength="50">
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='form-group col'>
                                    <div class='form-check'>
                                        <input type='checkbox' name='status' id='status' class='form-check-input'
                                            checked>
                                        <label>Ativo</label>
                                    </div>
                                </div>
                                <div class='form-group col-md-2'>
                                    <button class='btn btn-primary' onclick="enviaCliente();">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>