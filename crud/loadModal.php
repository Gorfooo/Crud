<script src="js/produtos.js"></script>
<?php
include ('../conexao.php');
$id = $_POST['id'];

$SQL = "select * from tb_produto where id = " . $id;

$RS = mysqli_query($conexao,$SQL);
while ($row = mysqli_fetch_assoc($RS)){
    $select = $row['id_unidade_medida'];
    $select1 = '';
    $select2 = '';
    $select3 = '';
    $select4 = '';
    $select5 = '';
    if($select == 1){
        $select1 = 'selected';
    } else if ($select == 2){
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
    
    echo "<form class='form-group' id='form' action='Valida/produtos.php'>
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
</form>";
}
?>