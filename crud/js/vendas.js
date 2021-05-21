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
function enviaItem(){
    var executa = true;
    event.preventDefault();
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
            console.log(result);
        },
        error:function(request, status, error){
            console.log(request + status + error);
        }
    });
    // armazenaItem();
}

// function armazenaItem(){
//     $.ajax({
//         type:'POST',
//         url:'Valida/armazenaItem.php',
//         dataType:'text',
//         data:{
//             itens: itens
//         },
//         success:function(result){
//             $('#form').submit();
//             $('#venda').load("Valida/loadVendas.php");
//             console.log(result);
//         }, 
//         error:function(result){
//             console.log(result);
//         }
//     });
// }

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