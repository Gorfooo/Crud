function mostraSenha(){
    if($('#senha').attr("type") == "text")
    {
        $('#senha').attr("type","password");
    }
    else
    {
        $('#senha').attr("type","text");
    }
    
    if($('#senha2').attr("type") == "text")
    {
        $('#senha2').attr("type","password");
    }
    else
    {
        $('#senha2').attr("type","text");
    }
}

$(function(){//esconde mensagens de erro
    $('#senhaincorreta').hide();
    $('#emailincorreto').hide();
    $('#datamaior').hide();
    $('#dataantiga').hide();
})

$(function(){//desaparece mensagem de erro e adiciona efeito do cursor
    $('#senhaincorreta').bind('click',function(){
        $(this).fadeOut();
    })
    $('#senhaincorreta').bind('mouseover',function(){
        $('#senhaincorreta').css('cursor','pointer');
    })
})
$(function(){//desaparece mensagem de erro e adiciona efeito do cursor
    $('#emailincorreto').bind('click',function(){
        $(this).fadeOut();
    })
    $('#emailincorreto').bind('mouseover',function(){
        $('#emailincorreto').css('cursor','pointer');
    })
})
$(function(){//desaparece mensagem de erro e adiciona efeito do cursor
    $('#datamaior').bind('click',function(){
        $(this).fadeOut();
    })
    $('#datamaior').bind('mouseover',function(){
        $('#datamaior').css('cursor','pointer');
    })
})
$(function(){//desaparece mensagem de erro e adiciona efeito do cursor
    $('#dataantiga').bind('click',function(){
        $(this).fadeOut();
    })
    $('#dataantiga').bind('mouseover',function(){
        $('#dataantiga').css('cursor','pointer');
    })
})

function validaSenha(){//valida senhas e aparece mensagem de erro
    $(function(){
        if($('#senha').val() != $('#senha2').val())
        {
            $('#senhaincorreta').fadeIn();
        }
    })
    return false
}

function validateEmail(email)//valida email
{
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
};

function validaData(){
    var dataform = $('#nascimento').val().replace("-","/");
    var dataformformatada = dataform.replace("-","/");
    var dataformcorreta = new Date(dataformformatada).toDateString();
    if(new Date < new Date(dataformcorreta))
    {
        $('#datamaior').fadeIn();
        return false;
    } 
    else if (new Date(dataformcorreta) < new Date('01/01/1900'))
    {
        $('#dataantiga').fadeIn();
        return false;
    }
    return true;
}

function enviaForm(){//valida senha e email, se estiverem corretas envia o form
    if(!(validaData()))
    {
        return false;
    }
    else if(!(validateEmail($('#email').val())))
    {
        $('#emailincorreto').fadeIn();
        $('#email').focus();
        $('#email').addClass('borda');
        return false;
    }
    else if (!(validaSenha()))
    {
        return false;
    }
    $('#form').submit();
}