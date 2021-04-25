$(function(){

    $('#mostrarSenha').bind('click',function(e){

        if($('#senha').attr("type") == "text")
        {
            $('#senha').attr("type","password");
        }
        else
        {
            $('#senha').attr("type","text");
        }
    });
})
$(function(){

    $('#mostrarSenha').bind('click',function(e){

        if($('#senha2').attr("type") == "text")
        {
            $('#senha2').attr("type","password");
        }
        else
        {
            $('#senha2').attr("type","text");
        }
    });
})
function enviaForm(){
    if(!(validateEmail($('#email').val()))){
        alert('Verifique o e-mail: ' + ($('#email').val()));
        // $('#email').focus().css('border-color','red');
        $('#email').focus();
        $('#email').addClass('borda');
        return false;
    }
    var dados={
        email: $('#email').val(),
        senha: $('#senha').val(),
        senha2: $('#senha2').val(),
        nome: $('#nome').val(),
        nascimento: $('#nascimento').val(),
        empresa: $('#empresa').val()
    };
    $.ajax({
        url: 'validaLogin.php',
        type:'POST',
        data: dados,
        dataType: 'text'
    })
    .done(function(data){
        $('#form').submit();
    })
    .fail(function(jqXHR, textStatus, errorThrown){
        console.log(jqXHR,textStatus,errorThrown);
    });
}
function validateEmail(email) {
    console.log(email);
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
}
$(function(){
    $('#email').bind('blur',function(){
        $('#email').removeClass('borda');
    });
})
