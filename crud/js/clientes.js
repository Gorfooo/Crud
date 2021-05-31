$(function () {
    $("#pessoa").bind('click', function () {
        $('#cpf').toggle();
        $('#cnpj').toggle();
    });
    $('#cpfInput').mask('000.000.000-00', {
        reverse: true
    });
    $('#cnpjInput').mask('00.000.000/0000-00', {
        reverse: true
    });
    $('#cep').mask('00000-000');
    $('#numero, #limiteCredito').on('keypress', function (event) {//bloqueia caracter especial
        var regex = new RegExp("^[a-zA-Z0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    $('#modalClientes').bind('click',function(){
        $('#salvar').attr("onclick","enviaCliente();");
    })
})

function maxLengthCheck(object)//limita qtd de caracteres
{
    if (object.value.length > object.maxLength)
      object.value = object.value.slice(0, object.maxLength)
}

var retorno = retorno;
if (retorno == 1) {
    $(function () {
        $('#limiteAlto').fadeIn();
    })
} else if (retorno == 2) {
    $(function () {
        $('#campoVazio').fadeIn();
    })
} else if (retorno == 3) {
    $(function () {
        $('#CPFInvalido').fadeIn();
    })
} else if (retorno == 4) {
    $(function () {
        $('#CNPJInvalido').fadeIn();
    })
} else if (retorno == 5) {
    $(function () {
        $('#CEPInvalido').fadeIn();
    })
}else if (retorno == 7) {
    $(function () {
        $('#ClienteCadastrado').fadeIn();
    })
}

$(function () {
    $('#ClienteCadastrado').bind('click', function () {
        $('#ClienteCadastrado').fadeOut();
    });
    $('#ClienteCadastrado').bind('mouseover', function () {
        $('#ClienteCadastrado').css('cursor', 'pointer');
    });
    $('#excluiCliente').bind('click', function () {
        $('#excluiCliente').fadeOut();
    });
    $('#excluiCliente').bind('mouseover', function () {
        $('#excluiCliente').css('cursor', 'pointer');
    });
    $('#limiteAlto').bind('click', function () {
        $('#limiteAlto').fadeOut();
    });
    $('#limiteAlto').bind('mouseover', function () {
        $('#limiteAlto').css('cursor', 'pointer');
    });
    $('#campoVazio').bind('click', function () {
        $('#campoVazio').fadeOut();
    });
    $('#campoVazio').bind('mouseover', function () {
        $('#campoVazio').css('cursor', 'pointer');
    });
    $('#CPFInvalido').bind('click', function () {
        $('#CPFInvalido').fadeOut();
    });
    $('#CPFInvalido').bind('mouseover', function () {
        $('#CPFInvalido').css('cursor', 'pointer');
    });
    $('#CNPJInvalido').bind('click', function () {
        $('#CNPJInvalido').fadeOut();
    });
    $('#CNPJInvalido').bind('mouseover', function () {
        $('#CNPJInvalido').css('cursor', 'pointer');
    });
    $('#CEPInvalido').bind('click', function () {
        $('#CEPInvalido').fadeOut();
    });
    $('#CEPInvalido').bind('mouseover', function () {
        $('#CEPInvalido').css('cursor', 'pointer');
    });
    $('#cpfInput, #cnpjInput').bind('focus',function(){
        $(this).removeClass('border-danger');
    });
    $('#fecharModal').css('cursor', 'pointer');
})

setTimeout(function () {
    $('#ClienteCadastrado').fadeOut();
}, 3000);

setTimeout(function () {
    $('#limiteAlto').fadeOut();
}, 3000);

setTimeout(function () {
    $('#campoVazio').fadeOut();
}, 3000);

setTimeout(function () {
    $('#CPFInvalido').fadeOut();
}, 3000);

setTimeout(function () {
    $('#CNPJInvalido').fadeOut();
}, 3000);

setTimeout(function () {
    $('#CEPInvalido').fadeOut();
}, 3000);

setTimeout(function () {
    $('#excluiCliente').fadeOut();
}, 5000);

function enviaCliente() {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'Valida/validaClienteDuplicado.php',
        data: {
            cpf: $('#cpfInput').val(),
            cnpj: $('#cnpjInput').val()
        },
        dataType: 'json',
        success: function (result) {
            if(result == 1){
                $('#cpfInput').addClass('border-danger');
                $('#cnpjInput').addClass('border-danger');
            }else{
                $('#form').submit();
            }
        },
        error: function (result) {
            console.log(result);
        }
    });
}

function excluiCliente(id) {
    $.ajax({
        type: 'POST',
        url: 'Valida/excluiCliente.php',
        data: {
            id: id
        },
        dataType: 'json',
        success: function (result) {
            $('#clientes').load("Valida/loadClientes.php");
            mensagem = result.retornado;
            codigo = result.codigo;
            if (codigo == 6){
                $('#excluiCliente').html('');
                $('#excluiCliente').append('Não é possível excluir esse cliente! Mensagem original: '+mensagem);
                $('#excluiCliente').fadeIn();
                setTimeout(function () {
                    $('#excluiCliente').fadeOut();
                }, 5000);
            }
        },
        error: function (result) {
            $('#clientes').load("Valida/loadClientes.php");
            console.log(result);
        }
    });
}

function fechaModal(){
    $('.modal').modal('hide');
}

function editaCliente(id_cliente){
    $('#salvar').attr("onclick","updateCliente(" + id_cliente + ");");
    $.ajax({
        type:'POST',
        url:'Valida/loadModalCliente.php',
        data:{
            id: id_cliente
        },
	    dataType:'json',
        success:function(result){
            $('.modal').modal();
            if(result.cnpj.length>0){
                $('#pessoa').prop( "checked", true);
                $('#cnpj').removeAttr('style');
                $('#cpf').removeAttr('style');
                $('#cnpj').css('display','unset');
                $('#cpf').css('display','none');
            }else{
                $('#pessoa').prop( "checked", false);
                $('#cnpj').removeAttr('style');
                $('#cpf').removeAttr('style');
                $('#cnpj').css('display','none');
                $('#cpf').css('display','unset');
            }
            $('#cpfInput').val(result.cpf);
            $('#cnpjInput').val(result.cnpj);
            $('#limiteCredito').val(result.limite_credito);
            $('#nome').val(result.nome);
            $('#cep').val(result.cep);
            $('#numero').val(result.numero);
            $('#logradouro').val(result.logradouro);
            $('#cidade').val(result.cidade);
            $('#uf').val(result.uf);
            if(result.status == 'checked'){
                $('#status').prop( "checked", true);
            }else{
                $('#status').prop( "checked", false);
            }
        }, 
        error:function(result){
            console.log('deu ruim');
        }
    });
}

function updateCliente(id_cliente){
    if($('#status').is(':checked')){
        var status = 'on';
    }else{
        var status = '';
    }
    event.preventDefault();
    $.ajax({
        type:'POST',
        url:'Valida/updateCliente.php',
        data:{
            id: id_cliente,
            cpf: $('#cpfInput').val(),
            cnpj: $('#cnpjInput').val(),
            limiteCredito: $('#limiteCredito').val(),
            nome: $('#nome').val(),
            cep: $('#cep').val(),
            numero: $('#numero').val(),
            logradouro: $('#logradouro').val(),
            cidade: $('#cidade').val(),
            uf: $('#uf').val(),
            status: status
        },
	    dataType:'text',
        success:function(result){
            fechaModal();
            $('#clientes').load("Valida/loadClientes.php");
        }, 
        error:function(result){
            console.log(result);
        }
    });
}

function limpaModal(){
    $('#cpfInput').val('');
    $('#cnpjInput').val('');
    $('#limiteCredito').val('');
    $('#nome').val('');
    $('#cep').val('');
    $('#numero').val('');
    $('#logradouro').val('');
    $('#cidade').val('');
    $('#uf').val('');
    $('#pessoa').prop('checked',false);
    $('#status').prop( "checked", true);
}