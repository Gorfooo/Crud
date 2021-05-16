$(function () {
    $("#pessoa").bind('click', function () {
        $('#cpf').toggle();
        $('#cnpj').toggle();
    });
});

$(function () {
    $('#cpfInput').mask('000.000.000-00', {
        reverse: true
    });
})
$(function () {
    $('#cnpjInput').mask('00.000.000/0000-00', {
        reverse: true
    });
})
$(function () {
    $('#cep').mask('00000-000');
})

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
}

$(function () {
    $('#excluiCliente').bind('click', function () {
        $('#excluiCliente').fadeOut();
    });
})
$(function () {
    $('#excluiCliente').bind('mouseover', function () {
        $('#excluiCliente').css('cursor', 'pointer');
    });
})

$(function () {
    $('#limiteAlto').bind('click', function () {
        $('#limiteAlto').fadeOut();
    });
})
$(function () {
    $('#limiteAlto').bind('mouseover', function () {
        $('#limiteAlto').css('cursor', 'pointer');
    });
})

$(function () {
    $('#campoVazio').bind('click', function () {
        $('#campoVazio').fadeOut();
    });
})
$(function () {
    $('#campoVazio').bind('mouseover', function () {
        $('#campoVazio').css('cursor', 'pointer');
    });
})

$(function () {
    $('#CPFInvalido').bind('click', function () {
        $('#CPFInvalido').fadeOut();
    });
})
$(function () {
    $('#CPFInvalido').bind('mouseover', function () {
        $('#CPFInvalido').css('cursor', 'pointer');
    });
})

$(function () {
    $('#CNPJInvalido').bind('click', function () {
        $('#CNPJInvalido').fadeOut();
    });
})
$(function () {
    $('#CNPJInvalido').bind('mouseover', function () {
        $('#CNPJInvalido').css('cursor', 'pointer');
    });
})

$(function () {
    $('#CEPInvalido').bind('click', function () {
        $('#CEPInvalido').fadeOut();
    });
})
$(function () {
    $('#CEPInvalido').bind('mouseover', function () {
        $('#CEPInvalido').css('cursor', 'pointer');
    });
})

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
    $('#form').submit();
}

$(function () {
    $('#fecharModal').css('cursor', 'pointer');
})

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
            // console.log(result.responseText);
            // var json = result.responseText;
            // var jsonParsed = JSON.parse(json);
            // console.log(jsonParsed.retornado);
            // console.log(jsonParsed.codigo);
            // console.log(result.retornado);
            // console.log(result.codigo);
        }
    });
}

// function excluiCliente(id) {
//     $.ajax({
//         type: 'POST',
//         url: 'Valida/excluiCliente.php',
//         data: {
//             id: id
//         },
//         dataType: 'json',
//         }).done(function(result){
//             $('#clientes').load("Valida/loadClientes.php");
//             console.log(result);
//         })
//  //$('#excluiCliente').fadeIn();
// }

    function editaCliente(id) {
        $('.modal').modal();
        // $(".modal").load('loadModal.php?id=' + id);
        $.ajax({
            type: 'POST',
            url: 'loadModal.php',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (json) {
                $('.loadModal').load('loadModal.php');
            },
            error: function (request, status, error) {
                console.log(request.responseText, status.responseText, error.responseText);
            }
        });
    }