var itens = [];
var i = 1;
var pos1 = 0;
var pos2 = 1;
var pos3 = 2;
$(function(){
    $('#produtos>tbody').append("<tr><th scope='row'></th>#<td><b>Descrição</b></td><td><b>Quantidade</b></td><td><b>Preço</b></td></tr>");
})
$(function(){
    $('#cliente').bind('focus',function(){
        $(this).removeClass('border-danger');
    });
    $('#produto').bind('focus',function(){
        $(this).removeClass('border-danger');
    });
    $('#quantidade').bind('focus',function(){
        $(this).removeClass('border-danger');
    });
    $('#data').bind('focus',function(){
        $(this).removeClass('border-danger');
    });
    $('#preco').bind('focus',function(){
        $(this).removeClass('border-danger');
    });
    $('#fecharModal').css('cursor','pointer');
    $('#produto').on('focus click',function(){
        $('#consultaProduto li').remove();
        $('#consultaProduto').show();
    })
    $('#produto').on('blur',function(){
        setTimeout(function () {
            $('#consultaProduto').hide();
        }, 100);
    })
    $('#cliente').on('focus click',function(){
        $('#consultaCliente li').remove();
        $('#consultaCliente').show();
    })
    $('#cliente').on('blur',function(){
        setTimeout(function () {
            $('#consultaCliente').hide();
        }, 100);
    })
    $('#cliente').on('keyup mouseup',function(){
        event.preventDefault();
        $.ajax({
            type:'POST',
            url:'Valida/consultaCliente.php',
            dataType:'text',
            data:{
                cliente: $('#cliente').val().replaceAll(".",'').replaceAll("-",'').replaceAll("/",'')
            },
            success:function(result){
                console.log(result);
                $('#consultaCliente li').remove();
                for (i=0;i<5;i++){
                    result.retorno[i] ? $('#consultaCliente').append("<li class='list-group-item' onclick='preencheCliente(this);'>"+result.retorno[i]+"</li>") : '';
                }
            },
            error:function(request, status, error){
                console.log(request + status + error);
            }
        });
    })
    $('#produto').on('keyup mouseup',function(){
        event.preventDefault();
        $.ajax({
            type:'POST',
            url:'Valida/consultaProduto.php',
            dataType:'json',
            data:{
                produto: $('#produto').val()
            },
            success:function(result){
                $('#consultaProduto li').remove();
                for (i=0;i<5;i++){
                    result.retorno[i] ? $('#consultaProduto').append("<li class='list-group-item' onclick='preencheValor(this);'>"+result.retorno[i]+"</li>") : '';
                }
            },
            error:function(request, status, error){
                console.log(request + status + error);
            }
        });
    })
})

function preencheCliente(dado){
    $('#cliente').val($(dado).html());
}

function preencheValor(dado){
    $('#produto').val($(dado).html());
}

$(function(){//bloqueia caracter especial e deixa . e ,
    $('#preco, #quantidade').bind('keydown', function (event) {
        switch (event.keyCode) {
            default: var regex = new RegExp("^[a-zA-Z0-9.,/ $@()]+$");
            var key = event.key;
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            } 
            break; 
        } 
    }); 
})

function maxLengthCheck(object)//limita qtd de caracteres
{
    if (object.value.length > object.maxLength)
      object.value = object.value.slice(0, object.maxLength)
}

$(function () {
    // $('#cliente').mask('00.000.000/0000-00', {
    //     reverse: true
    // });
    // $('#cliente').bind('keypress',function(){
    //     var options = {
    //         onKeyPress : function(cliente, e, field, options) {
    //             var masks = ['000.000.000-009', '00.000.000/0000-00'];
    //             var mask = (cliente.length > 14) ? masks[1] : masks[0];
    //             $('#cliente').mask(mask, options);
    //         }
    //     };
    //     $('#cliente').mask('000.000.000-009', options);
    // })
    

    var options = {//funciona mas no ctrl v do cnpj não fica correto
		onKeyPress : function(cliente, e, field, options) {
			var masks = ['000.000.000-009', '00.000.000/0000-00'];
			var mask = (cliente.length > 14) ? masks[1] : masks[0];
			$('#cliente').mask(mask, options);
		}
	};

    $('#cliente').mask('000.000.000-009', options);


    // $('#cliente').mask('00.000.000/0000-00', {
    //     reverse: true
    // });
    // $("#cliente").bind('mousedown keydown', function(){
    //     $('#cliente').unmask();
    //     if($("#cliente").val().length<11){
    //         $('#cliente').mask("999.999.999-99");
    //     }else{
    //         $('#cliente').mask("99.999.999/9999-99");
    //     }
    // })
    // $("#cliente").mousedown(function() {
    //     if($('#cliente').val().length == 0){
    //         $('#cliente').mask('00.000.000/0000-00', {
    //             reverse: true
    //         });
    //     }else if($('#cliente').val().length == 14){ 
    //         $('#cliente').mask('00.000.000/0000-00', {
    //             reverse: true
    //         });
    //     }
    // })
    // $("#cliente").click(function() {
    //     // var x = event.keyCode;
    //         if($('#cliente').val().length <= 14){  
    //             $('#cliente').mask('000.000.000-00', {
    //                 reverse: true
    //             });
    //         }else{
    //             $('#cliente').mask('00.000.000/0000-00', {
    //                 reverse: true
    //             });
    //         }
    //   });
    // $("#cliente").keydown(function() {
    //     var x = event.keyCode;
    //     if(x == 86 || x == 96 || x == 97 || x == 98 || x == 99 || x == 100 || x == 101 || x == 102 || x == 103 || x == 104 || x == 105 || x == 48 || x == 49 || x == 50 || x == 51 || x == 52 || x == 53 || x == 54 || x == 55 || x == 56 || x == 57){
    //         if($('#cliente').val().length == 0){
    //             $('#cliente').mask('00.000.000/0000-00', {
    //                 reverse: true
    //             });
    //         }else if($('#cliente').val().length == 14){ 
    //             $('#cliente').mask('00.000.000/0000-00', {
    //                 reverse: true
    //             });
    //         }
    //     }
    // })
    // $("#cliente").keyup(function() {
    //     var x = event.keyCode;
    //         if($('#cliente').val().length <= 14){  
    //             $('#cliente').mask('000.000.000-00', {
    //                 reverse: true
    //             });
    //         }else{
    //             $('#cliente').mask('00.000.000/0000-00', {
    //                 reverse: true
    //             });
    //         }
    //   });
})

function validaProduto(){
    event.preventDefault();
    $.ajax({
        type:'POST',
        url:'Valida/validaProduto.php',
        dataType:'json',
        data:{
            produto: $('#produto').val()
        },
        success:function(result){
            var retorno = result.retorno;
            if (retorno == 1){
                enviaItem();
            }else{
                $('#produto').addClass('border-danger');
            }
        },
        error:function(request, status, error){
            console.log(request + status + error);
        }
    });
}

function enviaItem(){
    var executa = true;
    $('#preco').removeClass('border-danger');
    $('#quantidade').removeClass('border-danger');
    $('#produto').removeClass('border-danger');
    $('#cliente').removeClass('border-danger');
    $('#data').removeClass('border-danger');
    if($('#preco').val()>999999999){
        $('#preco').addClass('border-danger');
        executa = false;
    }
    if ($('#quantidade').val()>999999999){
        $('#quantidade').addClass('border-danger');
        executa = false;
    }
    if ($('#produto').val() == ""){
        $('#produto').addClass('border-danger');
        executa = false;
    }
    if ($('#preco').val() == ""){
        $('#preco').addClass('border-danger');
        executa = false;
    }
    if ($('#quantidade').val() == ""){
        $('#quantidade').addClass('border-danger');
        executa = false;
    }
    if ($('#cliente').val() == ""){
        $('#cliente').addClass('border-danger');
        executa = false;
    }
    if ($('#data').val() == ""){
        $('#data').addClass('border-danger');
        executa = false;
    }
    if(executa == true){
        itens.push($('#produto').val().replaceAll("'",''));//testar
        itens.push($('#preco').val());
        itens.push($('#quantidade').val());
        $('#produtos').append("<tr><th scope='row'>"+i+"</th><td>"+itens[pos1]+"</td><td>"+itens[pos2]+"</td><td>"+itens[pos3]+"</td><td><i class='fas fa-times ml-3'onclick='excluiItem("+ i +");'style='cursor:pointer'></i></td></tr>")
        $('#produto').val("");
        $('#preco').val("");
        $('#quantidade').val("");
        i++;
        pos1 = pos1 + 3;
        pos2 = pos2 + 3;
        pos3 = pos3 + 3;
    }
}

function excluiItem(cont){
    $('#produtos tr').remove();
    $('#produtos>tbody').append("<tr><th scope='row'></th>#<td><b>Descrição</b></td><td><b>Quantidade</b></td><td><b>Preço</b></td></tr>");
    y=0
    for (x=0;x<cont;x++){
        y = y+3;
    }
    itens.splice(y-3,3);

    var ioriginal = i;
    i=1;
    pos1 = 0;
    pos2 = 1;
    pos3 = 2;
    while (i!=(ioriginal-1)){
        $('#produtos>tbody').append("<tr><th scope='row'>"+i+"</th><td>"+itens[pos1]+"</td><td>"+itens[pos2]+"</td><td>"+itens[pos3]+"</td><td><i class='fas fa-times ml-3'onclick='excluiItem("+ i +");'style='cursor:pointer'></i></td></tr>")
        i++;
        pos1 = pos1 + 3;
        pos2 = pos2 + 3;
        pos3 = pos3 + 3;
    }
}

setTimeout(function () {
    $('#erroInserirVenda').fadeOut();
}, 3000);
$(function () {
    $('#erroInserirVenda').bind('click', function () {
        $('#erroInserirVenda').fadeOut();
    });
    $('#erroInserirVenda').bind('mouseover', function () {
        $('#erroInserirVenda').css('cursor', 'pointer');
    });
    $('#erroInserirItensVenda').bind('click', function () {
        $('#erroInserirItensVenda').fadeOut();
    });
    $('#erroInserirItensVenda').bind('mouseover', function () {
        $('#erroInserirItensVenda').css('cursor', 'pointer');
    });
})

setTimeout(function () {
    $('#erroInserirItensVenda').fadeOut();
}, 3000);

erro = '';
function enviaVenda(){
    event.preventDefault();
    $.ajax({
        type:'POST',
        url:'Valida/vendas.php',
        dataType:'json',
        data:{
            itens: itens,
            cliente: $('#cliente').val(),
            data: $('#data').val()
        },
        success:function(result){
            erro = result.codigo;
            if(result.codigo == 1){
                $('.modal').modal('hide');
                $('#erroInserirVenda').html('');
                $('#erroInserirVenda').append('Erro ao inserir venda! Mensagem original: ' + result.retornado);
                $('#erroInserirVenda').fadeIn();
            }else if (result.codigo == 2){
                $('.modal').modal('hide');
                $('#erroInserirItensVenda').append('Erro ao inserir itens da venda! Mensagem original: ' + result.retornado);
                $('#erroInserirItensVenda').fadeIn();
            }else{
                $('.modal').modal('hide');
                $('#venda').load("Valida/loadVendas.php");
            }
            setTimeout(function () {
                $('#erroInserirVenda').fadeOut();
            }, 5000);
            setTimeout(function () {
                $('#erroInserirItensVenda').fadeOut();
            }, 3000);
            limpaModal();
        },
        error:function(request, status, error){
            console.log(request + status + error);
        }
    });
}

function validaCliente(){
    event.preventDefault();
    $.ajax({
        type:'POST',
        url:'Valida/validaCliente.php',
        dataType:'json',
        data:{
            cliente: $('#cliente').val()
        },
        success:function(result){
            if(result.retorno == 1){
                $('#cliente').addClass('border-danger');
            }else{
                enviaVenda();
            }
        },
        error:function(request, status, error){
            console.log(request + status + error);
            $('#cliente').addClass('border-danger');
        }
    });
}

function excluiVenda(id){
    $.ajax({
        type:'POST',
        url:'Valida/excluiVenda.php',
        data:{
            id: id
        },
	    dataType:'json',
        success: function (result) {
            $('#venda').load("Valida/loadVendas.php");
            console.log(result);
        },
        error: function (result) {
            $('#venda').load("Valida/loadVendas.php");
            console.log(result);
        }
    });
}

function fechaModal(){
    $('.modal').modal('hide');
}

function editaVenda(id_venda){
    event.preventDefault();
    erro = 3;
    limpaModal();
    $('#salvar').attr("onclick","updateVenda(" + id_venda + ");");
    $.ajax({
        type:'POST',
        url:'Valida/loadModalVenda.php',
        data:{
            id: id_venda
        },
	    dataType:'json',
        success:function(result){
            i=1;
            pos1 = 0;
            pos2 = 1;
            pos3 = 2;
            for(x = 0;x < result.tamanho;x++){
                itens.push(result.descricao[x].descricao);
                itens.push(result.preco[x].valor_unit);
                itens.push(result.quantidade[x].quantidade);
                $('#produtos').append("<tr><th scope='row'>"+i+"</th><td>"+itens[pos1]+"</td><td>"+itens[pos2]+"</td><td>"+itens[pos3]+"</td><td><i class='fas fa-times ml-3'onclick='excluiItem("+ i +");'style='cursor:pointer'></i></td></tr>")
                i++;
                pos1 = pos1 + 3;
                pos2 = pos2 + 3;
                pos3 = pos3 + 3;
            }
            if(result.cpf.length > 0){
                $('#cliente').val(result.cpf);
            }else{
                $('#cliente').val(result.cnpj);
            }
            $('#data').val(result.data.replaceAll("/",'-').split('-').reverse().join('-'));
            $('.modal').modal();
        }, 
        error:function(result){
            console.log(result.responseText);
        }
    });
}

function updateVenda(id_venda){
    event.preventDefault();
    $.ajax({
        type:'POST',
        url:'Valida/validaCliente.php',
        dataType:'json',
        data:{
            cliente: $('#cliente').val()
        },
        success:function(result){
            if(result.retorno == 1){
                $('#cliente').addClass('border-danger');
            }else{
                $.ajax({
                    type:'POST',
                    url:'Valida/updateVenda.php',
                    data:{
                        id: id_venda,
                        cliente: $('#cliente').val(),
                        data: $('#data').val(),
                        itens: itens,
                    },
                    dataType:'text',
                    success:function(result){
                        fechaModal();
                        $('#venda').load("Valida/loadVendas.php");
                    }, 
                    error:function(result){
                        console.log(result.responseText);
                    }
                });
            }
        },
        error:function(request, status, error){
            console.log(request + status + error);
            $('#cliente').addClass('border-danger');
        }
    });
}

function limpaModal(){
    if (erro == 1 || erro == 2){
        //caso ocorrer erro na inserção irá manter os dados para tentar enviar novamente
    }else{
        $('#cliente').val('');
        $('#data').val('');
        $('#produto').val('');
        $('#quantidade').val('');
        $('#preco').val('');
        itens = [];
        $('#produtos tr').remove();
        $('#produtos>tbody').append("<tr><th scope='row'></th>#<td><b>Descrição</b></td><td><b>Quantidade</b></td><td><b>Preço</b></td></tr>");
        pos1 = 0;
        pos2 = 1;
        pos3 = 2;
    }
}