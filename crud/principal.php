<!DOCTYPE html>
<html lang="en">

<head>
<?php
session_start();
if((!isset ($_SESSION['usuario']) == true) && (!isset ($_SESSION['senha']) == true))
{
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('location:../index.php');
}
?>
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
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="../faviconprincipal/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../faviconprincipal/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../faviconprincipal/favicon-16x16.png">
    <link rel="manifest" href="../faviconprincipal/site.webmanifest"> -->
    <!--  -->
    <link rel="stylesheet" type="text/css" href="css/principal.css">
    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Crud</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#">Dashboard</a></li>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#"
                        onclick="window.open('produtos.php','_self');">Produtos</a></li>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#"
                        onclick="window.open('clientes.php','_self');">Clientes</a></li>
                <li class='nav-item'><a class="navbar-brand text-white pr-2" href="#"
                        onclick="window.open('vendas.php','_self');">Vendas</a></li>
            </ul>
            <a class="navbar-brand text-white" href="#" onclick='window.open("../index.php","_self")'>Sair</a>
        </div>
    </nav>
    <div class='row'>
        <div class='col'>
            <div class="chart-container-barra ml-5 max-300" style="position: relative; height:300px; width:600px">
                <canvas id="Bar"></canvas>
            </div>
            <script>
                $.ajax({
                    type: 'POST',
                    url: 'grafico/Barra.php',
                    dataType: 'json',
                    success: function (result) {
                        var meses = [];
                        var valores = [];
                        var tamanho = result.tamanho;
                        for (x = 0; x < tamanho; x++) {
                            meses.push(result.meses[x]);
                            valores.push(result.valores[x]);
                        }
                        var data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        var y = 1;
                        var z = 0;
                        for (x = 0; x < 12; x++) {
                            if (meses[z] == y) {
                                data[x] = valores[z];
                                z++;
                            }
                            y++;
                        }
                        var ctx = document.getElementById('Bar');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ["jan", "fev", "mar", "abr", "mai", "jun", "jul", "ago",
                                    "set", "out",
                                    "nov",
                                    "dez"
                                ],
                                datasets: [{
                                    label: "Vendas por Mês em R$",
                                    data: data,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 159, 64, 0.6)',
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 159, 64, 0.6)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    },
                    error: function (result) {
                        console.log(result);
                    }
                });
            </script>
        </div>
        <div class='col'>
            <div class="chart-container-donut ml-5" style="position: relative; height:250px; width:500px">
                <canvas id="Donut"></canvas>
            </div>
            <script>
                $.ajax({
                    type: 'POST',
                    url: 'grafico/Donut.php',
                    dataType: 'json',
                    success: function (result) {
                        var quantidade = [];
                        var tamanho = result.tamanho;
                        for (x = 0; x < tamanho; x++) {
                            quantidade.push(result.quantidade[x]);
                        }
                        var ctx = document.getElementById('Donut');
                        var myChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ["AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", "MA",
                                    "MT", "MS", "MG",
                                    "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO", "RR",
                                    "SC", "SP", "SE",
                                    "TO"
                                ],
                                datasets: [{
                                    label: "Vendas por Mês",
                                    data: [quantidade[0],quantidade[1],quantidade[2],quantidade[3],quantidade[4],quantidade[5],quantidade[6],quantidade[7],quantidade[8],quantidade[9],
                                    quantidade[10],quantidade[11],quantidade[12],quantidade[13],quantidade[14],quantidade[15],quantidade[16],quantidade[17],quantidade[18],quantidade[19],
                                    quantidade[20],quantidade[21],quantidade[22],quantidade[23],quantidade[24],quantidade[25],quantidade[26]],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Quantidade de clientes por estado'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    },
                    error: function (result) {
                        console.log(result);
                    }
                });
            </script>
        </div>
    </div>
    <div class='row'>
        <div class='col'>
            <div class="chart-container-pizza ml-5 mt-5" style="position: relative; height:250px; width:500px">
                <canvas id="Pizza"></canvas>
            </div>
            <script>
                $.ajax({
                    type: 'POST',
                    url: 'grafico/Pizza.php',
                    dataType: 'json',
                    success: function (result) {
                        var clientes = [];
                        var valorCompra = [];
                        for (x = 0; x < 5; x++) {
                            clientes.push(result.clientes[x]);
                            valorCompra.push(result.valorCompra[x]);
                        }
                        var ctx = document.getElementById('Pizza');
                        var myChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: clientes,
                                datasets: [{
                                    label: "Vendas por Mês",
                                    data: valorCompra,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 159, 64, 0.6)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Top 5 clientes que mais compraram'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    },
                    error: function (result) {
                        console.log(result);
                    }
                });
            </script>
        </div>
        <div class='col'>
            <div class="chart-container-line ml-5" style="position: relative; height:300px; width:600px">
                <canvas id="Linha"></canvas>
            </div>
            <script>
                $.ajax({
                    type: 'POST',
                    url: 'grafico/Linha.php',
                    dataType: 'json',
                    success: function (result) {
                        var Mes = [];
                        var quantidadeVendas = [];
                        var tamanho = result.tamanho;
                        for (x = 0; x < tamanho; x++) {
                            Mes.push(result.Mes[x]);
                            quantidadeVendas.push(result.quantidadeVendas[x]);
                        }
                        var data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        var y = 1;
                        var z = 0;
                        for (x = 0; x < 12; x++) {
                            if (Mes[z] == y) {
                                data[x] = quantidadeVendas[z];
                                z++;
                            }
                            y++;
                        }
                        var ctx = document.getElementById('Linha');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ["jan", "fev", "mar", "abr", "mai", "jun", "jul", "ago",
                                    "set", "out",
                                    "nov",
                                    "dez"
                                ],
                                datasets: [{
                                    label: "Quantidade de Vendas por Mês",
                                    data: data,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 159, 64, 0.6)',
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 159, 64, 0.6)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    },
                    error: function (result) {
                        console.log(result);
                    }
                });
            </script>
        </div>
    </div>
</body>
</html>