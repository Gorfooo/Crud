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

$(function(){
    $('#modalProdutos').bind('click',function(){
        $('#salvar').attr("onclick","enviaProduto();");
    })
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

function fechaModal(){
    $('.modal').modal('hide');
}

function editaProduto(id_produto){
    $('#salvar').attr("onclick","updateProduto(" + id_produto + ");");
    $.ajax({
        type:'POST',
        url:'Valida/loadModalProduto.php',
        data:{
            id: id_produto
        },
	    dataType:'json',
        success:function(result){
            $('.modal').modal();
            $('#preco').val(result.preco);
            $('#custo').val(result.custo);
            $('#descricao').val(result.descricao);
            $('#quantidade').val(result.quantidade);
            if(result.status == 'checked'){
                $('#status').prop( "checked", true);
            }else{
                $('#status').prop( "checked", false);
            }
            if(result.select1 == 'selected'){
                $('#unidade').attr('selected',true);
            }else if(result.select2 == 'selected'){
                $('#kilograma').attr('selected',true);
            }else if(result.select3 == 'selected'){
                $('#metro').attr('selected',true);
            }else if(result.select4 == 'selected'){
                $('#metro_cubico').attr('selected',true);
            }else{
                $('#tonelada').attr('selected',true);
            }
        }, 
        error:function(result){
            console.log('deu ruim');
        }
    });
}

function updateProduto(id_produto){
    event.preventDefault();
    $.ajax({
        type:'POST',
        url:'Valida/updateProduto.php',
        data:{
            id: id_produto,
            preco: $('#preco').val(),
            custo: $('#custo').val(),
            descricao: $('#descricao').val(),
            quantidade: $('#quantidade').val(),
            unidade_medida: $('#unidadeMedida').val(),
            status: $('#status').val()
        },
	    dataType:'text',
        success:function(result){
            fechaModal();
            $('#produtos').load("Valida/loadProdutos.php");
            limpaModal();
            console.log(result);
        }, 
        error:function(result){
            console.log(result);
        }
    });
}

function limpaModal(){
    $('#preco').val('');
    $('#custo').val('');
    $('#descricao').val('');
    $('#quantidade').val('');
    $('#preco').val('');
    $('#unidade').attr('selected',true);
    $('#status').prop( "checked", true);
}