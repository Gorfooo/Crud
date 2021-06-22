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
        }, 300);
    })
    $('#cliente').on('focus click',function(){
        $('#consultaCliente li').remove();
        $('#consultaCliente').show();
    })
    $('#cliente').on('blur',function(){
        setTimeout(function () {
            $('#consultaCliente').hide();
        }, 300);
    })
    $('#cliente').on('keyup mouseup',function(){
        event.preventDefault();
        $.ajax({
            type:'POST',
            url:'Valida/consultaCliente.php',
            dataType:'json',
            data:{
                cliente: $('#cliente').val().replaceAll(".",'').replaceAll("-",'').replaceAll("/",'')
            },
            success:function(result){
                $('#consultaCliente li').remove();
                for (d=0;d<5;d++){
                    result.retorno[d] ? $('#consultaCliente').append("<li class='list-group-item' onclick='preencheCliente(this);'>"+result.retorno[d]+"</li>") : '';
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
                for (d=0;d<5;d++){
                    result.retorno[d] ? $('#consultaProduto').append("<li class='list-group-item' onclick='preencheValor(this);'>"+result.retorno[d]+"</li>") : '';
                }
            },
            error:function(request, status, error){
                console.log(request + status + error);
            }
        });
    })
    $("#codigoVenda").keydown(function() {
        var x = event.keyCode;
        if(x == 13){
            $.ajax({
                type:'POST',
                url:'Valida/loadVendas.php',
                dataType:'text',
                success:function(result){
                    $('#venda').load("Valida/loadVendas.php?codigo="+$('#codigoVenda').val());
                },
                error:function(request, status, error){
                    console.log(request + status + error);
                }
            });
        }
    })
    $('#filtraDatas').on('click',function(){
        $.ajax({
            type:'POST',
            url:'Valida/loadVendas.php',
            dataType:'text',
            success:function(result){
                $('#venda').load("Valida/loadVendas.php?dataI="+$('#dataI').val()+"&dataF="+$('#dataF').val());
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
    var options = {//funciona mas no ctrl v do cnpj não fica correto
		onKeyPress : function(cliente, e, field, options) {
			var masks = ['000.000.000-009', '00.000.000/0000-00'];
			var mask = (cliente.length > 14) ? masks[1] : masks[0];
			$('#cliente').mask(mask, options);
		}
	};

    $('#cliente').mask('000.000.000-009', options);
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
                $('.modal').modal('hide');
                $('#venda').load("Valida/loadVendas.php");
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
    $('#salvar1, #salvar2').attr("onclick","updateVenda(" + id_venda + ");");
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