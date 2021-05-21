var retorno = retorno;
$(function(){  
    if(retorno == 1)
    { 
        $('#valorAlto').fadeIn();
    }
    else if (retorno == 2)
    {
        $('#campoVazio').fadeIn();
    }
})
$(function(){  
    $('#excluiProduto').bind('click',function(){
        $('#excluiProduto').fadeOut();
    });
})
$(function(){  
    $('#excluiProduto').bind('mouseover',function(){
        $('#excluiProduto').css('cursor','pointer');
    });
})
$(function(){  
    $('#campoVazio').bind('click',function(){
        $('#campoVazio').fadeOut();
    });
})
$(function(){  
    $('#campoVazio').bind('mouseover',function(){
        $('#campoVazio').css('cursor','pointer');
    });
})
$(function(){  
    $('#valorAlto').bind('click',function(){
        $('#valorAlto').fadeOut();
    });
})
$(function(){  
    $('#valorAlto').bind('mouseover',function(){
        $('#valorAlto').css('cursor','pointer');
    });
})

setTimeout(function() {
    $('#valorAlto').fadeOut();
}, 3000);
setTimeout(function() {
    $('#campoVazio').fadeOut();
}, 3000);
setTimeout(function() {
    $('#excluiProduto').fadeOut();
}, 4000);

$(function(){
    $('#fecharModal').css('cursor','pointer');
})

function enviaProduto() {
    $('#form').submit();
}

function excluiProduto(id){
    $.ajax({
        type:'POST',
        url:'Valida/excluiProduto.php',
        data:{
            id: id
        },
	    dataType:'text',
        success:function(result){
            $('#produtos').load("Valida/loadProdutos.php");
            mensagem = result.retornado;
            codigo = result.codigo;
            if (codigo == 3){
                $('#excluiProduto').html('');
                $('#excluiProduto').append('Não é possível excluir esse produto! Mensagem original: '+mensagem);
                $('#excluiProduto').fadeIn();
                setTimeout(function () {
                    $('#excluiProduto').fadeOut();
                }, 5000);
            }
        }, 
        error:function(result){
            console.log(result);
        }
    });
}

function editaProduto(id){
    // $('.loadModal').load('loadModalProdutos.php?id='+id);
    $.ajax({
        type:'POST',
        url:'loadModalProdutos.php',
        data:{
            id: id
        },
	    dataType:'text',
        success:function(text){
            $('.loadModal').load('loadModalProdutos.php');
            $('.modal').modal();
        }, 
        error:function(request, status, error){
            console.log(request.responseText,status.responseText,error.responseText);
        }
    });
}