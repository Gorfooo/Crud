<?php
include ('../conexao.php');
$id = $_POST['id'];
// $id = 5;

$SQL = "select * from tb_produto where id_produto = " . $id;

$RS = mysqli_query($conexao,$SQL);
$row = mysqli_fetch_assoc($RS);
$select = $row['id_unidade_medida'];
    $select1 = '';
    $select2 = '';
    $select3 = '';
    $select4 = '';
    $select5 = '';
    if($select == 1){
        $select1 = 'selected';
    }else if ($select == 2){
        $select2 = 'selected';
    }else if ($select == 3){
        $select3 = 'selected';
    }else if ($select == 4){
        $select4 = 'selected';
    }else if ($select == 5){
        $select5 = 'selected';
    };

    $status = $row['status'];
    if ($status == 'A'){
        $status = 'checked';
    } else {
        $status = '';
    }

// var_dump($id,$SQL,$RS,$select,$status);
// while ($row = mysqli_fetch_assoc($RS)){
//     $select = $row['id_unidade_medida'];
//     $select1 = '';
//     $select2 = '';
//     $select3 = '';
//     $select4 = '';
//     $select5 = '';
//     if($select == 1){
//         $select1 = 'selected';
//     } else if ($select == 2){
//         $select2 = 'selected';
//     }else if ($select == 3){
//         $select3 = 'selected';
//     }else if ($select == 4){
//         $select4 = 'selected';
//     }else if ($select == 5){
//         $select5 = 'selected';
//     };

//     $status = $row['status'];
//     if ($status == 'A'){
//         $status = 'checked';
//     } else {
//         $status = '';
//     }
    
    echo "
    <div class='modal fade bd-example-modal-lg' data-backdrop='static' tabindex='-1' role='dialog'
    aria-labelledby='myLargeModalLabel'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <Div class='container'>
                <div class='modal-body'>
                    <div class='row'>
                        <div class='col'>
                            <h2 class='text-center'>CADASTRO DO ITEM:</h2>
                        </div>
                        <div class='col-1'>
                            <i class='fas fa-times' id='fecharModal' data-dismiss='modal' aria-label='Close'></i>
                        </div>
                    </div>
    <form class='form-group' id='form' action='Valida/produtos.php'>
<div class='form-row mt-3'>
    <div class='form-group col'>
        <label for='preco'>Preço:</label>
        <input type='number' name='preco' id='preco' class='form-control' value = '". $row['preco'] ."'>
    </div>
    <div class='form-group col'>
        <label for='custo'>Custo:</label>
        <input type='number' name='custo' id='custo' class='form-control' value = '". $row['custo'] ."'>
    </div>
</div>
<div class='form-group'>
    <label for='descricao'>Descrição:</label>
    <input type='text' name='descricao' id='descricao' class='form-control' maxlength='50' value = '". $row['descricao'] ."'>
</div>
<div class='form-row'>
    <div class='form-group col'>
        <label for='quantidade'>Quantidade:</label>
        <input type='number' name='quantidade' id='quantidade' class='form-control' value = '". $row['quantidade'] ."'>
    </div>
    <div class='form-group col'>
        <label for='unidadeMedida'>Unidade de medida:</label>
        <select name='unidadeMedida' class='custom-select custom-select'>
            <option value='unidade' ". $select1 .">UN</option>
            <option value='kilograma' ". $select2 .">KG</option>
            <option value='metro' ". $select3 .">MT</option>
            <option value='metro cubico' ". $select4 .">M³</option>
            <option value='tonelada' ". $select5 .">TON</option>
        </select>
    </div>
</div>
<div class='form-row'>
    <div class='form-group col'>
        <div class='form-check'>
            <input type='checkbox' name='status' id='status' class='form-check-input' ". $status .">
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
";
// }
//fazer um if no ID para ver se já existe, se já existir, cria uma variável php e passa no enviaProduto,
// nessa mesma função, fazer validação para executar comando update no editaProduto.php
?>