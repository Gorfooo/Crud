$(function(){
    $('#fecharModal').css('cursor','pointer');
})
var itens = [];
function enviaItem(){
    event.preventDefault();
    if($('#produto').val() != "" && $('#preco').val() != "" && $('#quantidade').val() != ""){
        itens.push($('#produto').val());
        itens.push($('#preco').val());
        itens.push($('#quantidade').val());
        $('#produto').val("");
        $('#preco').val("");
        $('#quantidade').val("");
        console.log(itens);
    }else{
        console.log('existem itens vazios');
    }
}
function enviaVenda(){
    event.preventDefault();
    $.ajax({
        type:'GET',
        url:'Valida/armazenaItem.php',
        dataType:'text',
        data:{
            itens: itens
        },
        success:function(html){
            
        }, 
        error:function(request, status, error){
            console.log(request + status + error);
        }
    });
}