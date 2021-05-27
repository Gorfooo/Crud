<?php
include ('../../conexao.php');
$id = $_POST['id'];

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

    $preco = $row['preco'];
    $custo = $row['custo'];
    $quantidade = $row['quantidade'];
    $descricao = $row['descricao'];
    $unidade_medida = $row['id_unidade_medida'];
    
    $retorno['preco'] = $preco;
    $retorno['custo'] = $custo;
    $retorno['quantidade'] = $quantidade;
    $retorno['descricao'] = $descricao;
    $retorno['unidade'] = $unidade_medida;
    $retorno['select1'] = $select1;
    $retorno['select2'] = $select2;
    $retorno['select3'] = $select3;
    $retorno['select4'] = $select4;
    $retorno['select5'] = $select5;
    $retorno['status'] = $status;

    echo json_encode($retorno);
?>