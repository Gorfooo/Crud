function mostraSenha(){
    $(function(){
        if($('#senha').attr("type") == "text")
        {
            $('#senha').attr("type","password");
        }
        else
        {
            $('#senha').attr("type","text");
        }
    })
}

$(function(){//desaparece mensagem de erro e adiciona efeito do cursor
    $('#usuarioIncorreto').bind('click',function(){
        $(this).fadeOut();
    })
    $('#usuarioIncorreto').bind('mouseover',function(){
        $('#usuarioIncorreto').css('cursor','pointer');
    })
//desaparece mensagem de erro e adiciona efeito do cursor
    $('#senhaIncorreta').bind('click',function(){
        $(this).fadeOut();
    })
    $('#senhaIncorreta').bind('mouseover',function(){
        $('#senhaIncorreta').css('cursor','pointer');
    })
})

setTimeout(function() {
    $('#usuarioIncorreto').fadeOut();
}, 3000);

setTimeout(function() {
    $('#senhaIncorreta').fadeOut();
}, 3000);

function enviaForm(){
    $('#form').submit();
}

var retorno = retorno;
if(retorno==1)//aparece mensagem de erro de acordo com retorno
{
    $(function()
    {
        $('#usuarioIncorreto').fadeIn();
    })
}
else if (retorno==2)
{
    $(function()
    {
        $('#senhaIncorreta').fadeIn();
    })
}