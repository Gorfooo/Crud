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
	    dataType:'json',
        success:function(json){
            $('#produtos').load("Valida/loadProdutos.php");
        }, 
        error:function(request, status, error){
            console.log(request.responseText,status.responseText,error.responseText);
            if(request.responseText.length>0){
                $('#excluiProduto').fadeIn();
            }
            setTimeout(function() {
                $('#excluiProduto').fadeOut();
            }, 4000);
        }
    });
}

setTimeout(function() {
    $('#excluiProduto').fadeOut();
}, 4000);

function editaProduto(id){
    $('.modal').modal();
    // $(".modal").load('loadModal.php?id=' + id);
    $.ajax({
        type:'POST',
        url:'loadModal.php',
        data:{
            id: id
        },
	    dataType:'json',
        success:function(json){
            $('.loadModal').load('loadModal.php');
        }, 
        error:function(request, status, error){
            console.log(request.responseText,status.responseText,error.responseText);
        }
    });
}