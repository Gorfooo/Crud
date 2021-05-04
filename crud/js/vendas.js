function enviaVenda() {
    $('#form').submit();
}
$(function(){
    $('#fecharModal').css('cursor','pointer');
})
function enviaItem(){
    event.preventDefault();
    $.ajax({
        type:'POST',
        url:'Valida/armazenaItem.php',
        dataType:'text',
        data:{
            produto:$('#produto').val(),
            quantidade:$('#quantidade').val(),
            preco:$('#preco').val()
        },
        success: function (data) {
            // console.log(data.responseText);
            $('#produto').val("");
            $('#quantidade').val("");
            $('#preco').val("");
        },
        error: function (request, status, error) {
            console.log(request.responseText,status.responseText,error.responseText);
        }
    })
}