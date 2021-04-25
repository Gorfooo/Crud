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
function enviaForm(){
    $('#form').submit();
}
var retorno = retorno;
if(retorno==1)//valida de acordo com o retorno da função php
{
    $(function()
    {
        $('#usuarioIncorreto').css('display','');
    })
}
else if (retorno==2)
{
    $(function()
    {
        $('#senhaIncorreta').css('display','');
    })
}