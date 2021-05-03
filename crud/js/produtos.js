var retorno = retorno;
if(retorno == 1)
{
    $(function()
    {  
        $('#valorAlto').fadeIn();
    })
}
else if (retorno == 2)
    {
        $('#campoVazio').fadeIn();
    }

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

function enviaProduto() {
    $('#form').submit();
}

$(function(){
    $('#fecharModal').css('cursor','pointer');
})