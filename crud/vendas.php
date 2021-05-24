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
    <script src="https://kit.fontawesome.com/00a4711f34.js" crossorigin="anonymous"></script>
    <!--  -->
    <link rel="stylesheet" type="text/css" href="css/vendas.css">
    <!--  -->
    <script src="js/jquery.mask.js"></script>
    <title>Vendas</title>
</head>

<body>
    <?php
$retorno = $_GET['retorno'];
?>
    <script>
        var retorno = "<?= $retorno ?>";
    </script>
    <script src="js/vendas.js"></script>
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
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#"
                        onclick="window.open('clientes.php','_self');">Clientes</a></li>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#">Vendas</a></li>
            </ul>
            <a class="navbar-brand text-white" href="#" onclick='window.open("../index.php","_self")'>Sair</a>
        </div>
    </nav>
    <div class='container'>
        <div class='mt-4'>
            <div class="alert alert-danger text-center grid2" role="alert" id='erroInserirVenda'
                style='height:70px;display:none'>
                Erro ao inserir venda! Mensagem original:
            </div>
        </div>
        <div class='mt-4'>
            <div class="alert alert-danger text-center grid2" role="alert" id='erroInserirItensVenda'
                style='height:70px;display:none'>
                Erro ao inserir itens da venda! Mensagem original:
            </div>
        </div>
    </div>
    <Div class='container'>
        <div class='row mt-4'>
            <div class='col'>
                <h1 class='text-primary'>Registrar Venda</h1>
            </div>
            <div class='col grid'>
                <button type="button" class="btn btn-primary" id='modalVendas' data-toggle="modal"
                    data-target=".bd-example-modal-lg">Nova Venda</button>
            </div>
        </div>
        <hr>
        <table class="table table-hover">
            <thead class="thead-light table-striped">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Código</th>
                    <th scope="col">Data</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id='venda'>
            <?php
            include ('../conexao.php');
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
            </tbody>
        </table>
    </Div>
    <div class="modal fade bd-example-modal-lg" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <Div class='container'>
                    <div class="modal-body">
                        <div class='text-right'>
                            <i class="fas fa-times" id='fecharModal' data-dismiss="modal" aria-label="Close"></i>
                        </div>
                        <div class='row'>
                            <div class='col'>
                                <h2 class='text-center'>CADASTRO DA VENDA:</h2>
                                <form class='form-group' id='form' >
                                    <div class="form-row mt-3">
                                        <div class='form-group col'>
                                            <label for="cliente">CPF/CNPJ:</label>
                                            <input type='text' name='cliente' id='cliente' class='form-control' style='font-size: 13.4px;'>
                                        </div>
                                        <div class='form-group col'>
                                            <label for="data">Data:</label>
                                            <input type='date' name='data' id='data' class='form-control'>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class='form-group'>
                                        <div class='form-row'>
                                            <div class='form-group col pt-1'>
                                                <label for="produto">Produto:</label>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class='form-group col'>
                                                <input type='text' name='produto' id='produto' class='form-control'
                                                    maxlength="50">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class='form-group col'>
                                            <label for="quantidade">Quantidade:</label>
                                            <input type='number' name='quantidade' id='quantidade' class='form-control'>
                                        </div>
                                        <div class='form-group col'>
                                            <label for="preco">Preço:</label>
                                            <input type='number' name='preco' id='preco' class='form-control'>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='form-group col-md-2'>
                                            <button class='btn btn-primary' onclick='validaProduto();'>Adicionar Item</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class='col mx-2'>
                                <div class='row'>
                                    <div class='col'>
                                        <h2 class='text-center'>ITENS DA VENDA:</h2>
                                    </div>
                                    <table class="table table-hover" id='produtos'>
                                        <thead class='table-borderless'>
                                        </thead>
                                        <tbody >
                                        </tbody>
                                    </table>
                                    <div class='fixed-bottom mb-5 mr-4' style='left:auto'>
                                        <button class='btn btn-primary'onclick='validaCliente();'>Salvar</button>
                                    </div>
                                    <!-- ajustar -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>