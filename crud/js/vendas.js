$(function(){
    $('#fecharModal').css('cursor','pointer');
})
var itens = [];
var i = 1;
var pos1 = 0;
var pos2 = 1;
var pos3 = 2;
$(function(){
    $('#produtos>tbody').append("<tr><th scope='row'></th>#<td><b>Descrição</b></td><td><b>Quantidade</b></td><td><b>Preço</b></td></tr>");
})
$(function(){
    $('#cliente').bind('focus',function(){
        $(this).removeClass('border-danger');
    });
    $('#produto').bind('focus',function(){
        $(this).removeClass('border-danger');
    });
    $('#quantidade').bind('focus',function(){
        $(this).removeClass('border-danger');
    });
    $('#data').bind('focus',function(){
        $(this).removeClass('border-danger');
    });
    $('#preco').bind('focus',function(){
        $(this).removeClass('border-danger');
    });
})

$(function () {
    $('#cliente').mask('00.000.000/0000-00', {
        reverse: true
    });
    $("#cliente").mousedown(function() {
        if($('#cliente').val().length == 0){
            $('#cliente').mask('00.000.000/0000-00', {
                reverse: true
            });
        }else if($('#cliente').val().length == 14){ 
            $('#cliente').mask('00.000.000/0000-00', {
                reverse: true
            });
        }
    })
    $("#cliente").click(function() {
        // var x = event.keyCode;
            if($('#cliente').val().length <= 14){  
                $('#cliente').mask('000.000.000-00', {
                    reverse: true
                });
            }else{
                $('#cliente').mask('00.000.000/0000-00', {
                    reverse: true
                });
            }
      });
    $("#cliente").keydown(function() {
        var x = event.keyCode;
        if(x == 86 || x == 96 || x == 97 || x == 98 || x == 99 || x == 100 || x == 101 || x == 102 || x == 103 || x == 104 || x == 105 || x == 48 || x == 49 || x == 50 || x == 51 || x == 52 || x == 53 || x == 54 || x == 55 || x == 56 || x == 57){
            if($('#cliente').val().length == 0){
                $('#cliente').mask('00.000.000/0000-00', {
                    reverse: true
                });
            }else if($('#cliente').val().length == 14){ 
                $('#cliente').mask('00.000.000/0000-00', {
                    reverse: true
                });
            }
        }
    })
    $("#cliente").keyup(function() {
        var x = event.keyCode;
            if($('#cliente').val().length <= 14){  
                $('#cliente').mask('000.000.000-00', {
                    reverse: true
                });
            }else{
                $('#cliente').mask('00.000.000/0000-00', {
                    reverse: true
                });
            }
      });
})

function limpaModal(){
    if (erro == 1 || erro == 2){
        //caso ocorrer erro na inserção irá manter os dados para tentar enviar novamente
    }else{
        $('#cliente').val('');
        $('#data').val('');
        $('#produto').val('');
        $('#quantidade').val('');
        $('#preco').val('');
        itens = [];
        $('#produtos tr').remove();
        $('#produtos>tbody').append("<tr><th scope='row'></th>#<td><b>Descrição</b></td><td><b>Quantidade</b></td><td><b>Preço</b></td></tr>");
    }
}

function validaProduto(){
    event.preventDefault();
    $.ajax({
        type:'POST',
        url:'Valida/validaProduto.php',
        dataType:'json',
        data:{
            produto: $('#produto').val()
        },
        success:function(result){
            var retorno = result.retorno;
            if (retorno == 1){
                enviaItem();
            }else{
                $('#produto').addClass('border-danger');
            }
        },
        error:function(request, status, error){
            console.log(request + status + error);
        }
    });
    
}

function enviaItem(){
    var executa = true;
    $('#preco').removeClass('border-danger');
    $('#quantidade').removeClass('border-danger');
    $('#produto').removeClass('border-danger');
    $('#cliente').removeClass('border-danger');
    $('#data').removeClass('border-danger');
    if($('#preco').val()>999999999){
        $('#preco').addClass('border-danger');
        executa = false;
    }
    if ($('#quantidade').val()>999999999){
        $('#quantidade').addClass('border-danger');
        executa = false;
    }
    if ($('#produto').val() == ""){
        $('#produto').addClass('border-danger');
        executa = false;
    }
    if ($('#preco').val() == ""){
        $('#preco').addClass('border-danger');
        executa = false;
    }
    if ($('#quantidade').val() == ""){
        $('#quantidade').addClass('border-danger');
        executa = false;
    }
    if ($('#cliente').val() == ""){
        $('#cliente').addClass('border-danger');
        executa = false;
    }
    if ($('#data').val() == ""){
        $('#data').addClass('border-danger');
        executa = false;
    }
    if(executa == true){
        itens.push($('#produto').val().replaceAll("'",''));//testar
        itens.push($('#preco').val());
        itens.push($('#quantidade').val());
        $('#produtos').append("<tr><th scope='row'>"+i+"</th><td>"+itens[pos1]+"</td><td>"+itens[pos2]+"</td><td>"+itens[pos3]+"</td><td><i class='fas fa-times ml-3'onclick='excluiItem("+ i +");'style='cursor:pointer'></i></td></tr>")
        $('#produto').val("");
        $('#preco').val("");
        $('#quantidade').val("");
        i++;
        pos1 = pos1 + 3;
        pos2 = pos2 + 3;
        pos3 = pos3 + 3;
    }
}

function excluiItem(cont){
    $('#produtos tr').remove();
    $('#produtos>tbody').append("<tr><th scope='row'></th>#<td><b>Descrição</b></td><td><b>Quantidade</b></td><td><b>Preço</b></td></tr>");
    y=0
    for (x=0;x<cont;x++){
        y = y+3;
    }
    itens.splice(y-3,3);

    var ioriginal = i;
    i=1;
    pos1 = 0;
    pos2 = 1;
    pos3 = 2;
    while (i!=(ioriginal-1)){
        $('#produtos>tbody').append("<tr><th scope='row'>"+i+"</th><td>"+itens[pos1]+"</td><td>"+itens[pos2]+"</td><td>"+itens[pos3]+"</td><td><i class='fas fa-times ml-3'onclick='excluiItem("+ i +");'style='cursor:pointer'></i></td></tr>")
        i++;
        pos1 = pos1 + 3;
        pos2 = pos2 + 3;
        pos3 = pos3 + 3;
    }
}

setTimeout(function () {
    $('#erroInserirVenda').fadeOut();
}, 3000);
$(function () {
    $('#erroInserirVenda').bind('click', function () {
        $('#erroInserirVenda').fadeOut();
    });
})
$(function () {
    $('#erroInserirVenda').bind('mouseover', function () {
        $('#erroInserirVenda').css('cursor', 'pointer');
    });
})

setTimeout(function () {
    $('#erroInserirItensVenda').fadeOut();
}, 3000);
$(function () {
    $('#erroInserirItensVenda').bind('click', function () {
        $('#erroInserirItensVenda').fadeOut();
    });
})
$(function () {
    $('#erroInserirItensVenda').bind('mouseover', function () {
        $('#erroInserirItensVenda').css('cursor', 'pointer');
    });
})

erro = '';
function enviaVenda(){
    event.preventDefault();
    $.ajax({
        type:'POST',
        url:'Valida/vendas.php',
        dataType:'json',
        data:{
            itens: itens,
            cliente: $('#cliente').val(),
            data: $('#data').val()
        },
        success:function(result){
            erro = result.codigo;
            if(result.codigo == 1){
                $('.modal').modal('hide');
                $('#erroInserirVenda').html('');
                $('#erroInserirVenda').append('Erro ao inserir venda! Mensagem original: ' + result.retornado);
                $('#erroInserirVenda').fadeIn();
            }else if (result.codigo == 2){
                $('.modal').modal('hide');
                $('#erroInserirItensVenda').append('Erro ao inserir itens da venda! Mensagem original: ' + result.retornado);
                $('#erroInserirItensVenda').fadeIn();
            }else{
                $('.modal').modal('hide');
                $('#venda').load("Valida/loadVendas.php");
            }
            setTimeout(function () {
                $('#erroInserirVenda').fadeOut();
            }, 5000);
            setTimeout(function () {
                $('#erroInserirItensVenda').fadeOut();
            }, 3000);
            limpaModal();
        },
        error:function(request, status, error){
            console.log(request + status + error);
        }
    });
}

function validaCliente(){
    event.preventDefault();
    $.ajax({
        type:'POST',
        url:'Valida/validaCliente.php',
        dataType:'json',
        data:{
            cliente: $('#cliente').val()
        },
        success:function(result){
            if(result.retorno == 1){
                $('#cliente').addClass('border-danger');
            }else{
                enviaVenda();
            }
        },
        error:function(request, status, error){
            console.log(request + status + error);
            $('#cliente').addClass('border-danger');
        }
    });
}

function excluiVenda(id){
    $.ajax({
        type:'POST',
        url:'Valida/excluiVenda.php',
        data:{
            id: id
        },
	    dataType:'json',
        success: function (result) {
            $('#venda').load("Valida/loadVendas.php");
            console.log(result);
        },
        error: function (result) {
            $('#venda').load("Valida/loadVendas.php");
            console.log(result);
        }
    });
}