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
    <script src="js/produtos.js"></script>
    <!--  -->
    <link rel="stylesheet" type="text/css" href="css/produtos.css">
    <!--  -->
    <title>Produtos</title>
</head>

<body>
    <?php
$retorno = $_GET['retorno'];
?>
    <script>
        var retorno = "<?= $retorno ?>";
    </script>
    <script src="js/produtos.js"></script>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#"
                        onclick="window.open('principal.html','_self');">Dashboard</a></li>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#">Produtos</a></li>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#"
                        onclick="window.open('clientes.php','_self');">Clientes</a></li>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#"
                        onclick="window.open('vendas.php','_self');">Vendas</a></li>
            </ul>
            <a class="navbar-brand text-white" href="#" onclick='window.open("../index.php","_self")'>Sair</a>
        </div>
    </nav>
    <div class='container'>
        <div class='mt-4'>
            <div class="alert alert-danger text-center grid2" role="alert" id='valorAlto'
                style='height:70px;display:none'>
                Valor muito alto!
            </div>
        </div>
        <div class='mt-4'>
            <div class="alert alert-danger text-center grid2" role="alert" id='campoVazio'
                style='height:70px;display:none'>
                Campo Vazio!
            </div>
        </div>
    </div>
    <Div class='container'>
        <div class='row'>
            <div class='col'>
                <h1 class='text-primary'>Registrar produto</h1>
            </div>
            <div class='col grid'>
                <button type="button" class="btn btn-primary" id='modalProdutos' data-toggle="modal"
                    data-target=".bd-example-modal-lg">Novo Produto</button>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover"valign="bottom">
                <thead class="thead-light table-striped">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Código</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Custo</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include ('../conexao.php');
                    $SQL = "select id_produto,descricao,quantidade,preco,custo,status from tb_produto";
                    $RS = mysqli_query($conexao,$SQL);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($RS)){
                        echo "<tr>
                        <th class='centro'>$i</th>
                        <td class='centro'>" . $row["id_produto"] . "</td>
                        <td class='centro'>" . $row["descricao"] . "</td>
                        <td class='centro'>" . $row["quantidade"] ."</td>
                        <td class='centro'>" . $row["preco"] . "</td>
                        <td class='centro'>" . $row["custo"] . "</td>
                        <td class='centro'>" . $row["status"] . "</td>
                        <td><i class='fas fa-pencil-alt' onclick='editaProduto();'></i><i class='fas fa-times ml-3' onclick='excluiProduto();'></i></td>
                        </tr>";
                        $i++;
                    };
                    ?>
                </tbody>
            </table>
        </div>
    </Div>
    <div class="modal fade bd-example-modal-lg" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <Div class='container'>
                    <div class="modal-body">
                        <div class='row'>
                            <div class='col'>
                                <h2 class='text-center'>CADASTRO DO ITEM:</h2>
                            </div>
                            <div class='col-1' onclick='window.open("produtos.php","_self")'>
                                <i class="fas fa-times" id='fecharModal'></i>
                            </div>
                        </div>
                        <form class='form-group' id='form' action="Valida/produtos.php">
                            <div class="form-row mt-3">
                                <div class='form-group col'>
                                    <label for="preco">Preço:</label>
                                    <input type='number' name='preco' id='preco' class='form-control'>
                                </div>
                                <div class='form-group col'>
                                    <label for="custo">Custo:</label>
                                    <input type='number' name='custo' id='custo' class='form-control'>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label for="descricao">Descrição:</label>
                                <input type='text' name='descricao' id='descricao' class='form-control' maxlength="50">
                            </div>
                            <div class="form-row">
                                <div class='form-group col'>
                                    <label for="quantidade">Quantidade:</label>
                                    <input type='number' name='quantidade' id='quantidade' class='form-control'>
                                </div>
                                <div class='form-group col'>
                                    <label for="unidadeMedida">Unidade de medida:</label>
                                    <select name="unidadeMedida" class='custom-select custom-select'>
                                        <option value="unidade">UN</option>
                                        <option value="kilograma">KG</option>
                                        <option value="metro">MT</option>
                                        <option value="metro cubico">M³</option>
                                        <option value="tonelada">TON</option>
                                    </select>
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
                                    <button class='btn btn-primary' onclick='enviaProduto();'>Salvar</button>
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