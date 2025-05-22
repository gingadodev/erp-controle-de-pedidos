
function limpaCampos() {
    $('#rua, #bairro, #cidade, #uf').val('');
}

function loadList() {
    $.ajax({
        url: URL_BASE + '?c=pedidos&a=comprar',
        type: 'POST',
        dataType: 'json',
        data: { action: 'list' },
        success: function(response) {
            const tbody = $("#listTableBody");
            tbody.empty();
            response.data.forEach(ln => {
                tbody.append(`
                 <tr data-id="${ln.id}">
                     <td>${ln.id}</td>
                     <td>${ln.nome}</td>
                     <td>${tl_moedaBr(ln.preco)}</td>
                     <td>
                        ${ln.quantidade}
                     </td>
                     <td class="js_subtotal">${tl_moedaBr(ln.subtotal)}</td>
                 </tr>
                 `);
            });

            if (response.total_item){

            tbody.append(`
                <tr>
                    <td colspan="2">#</td>
                    <td colspan="2">Total:</td>
                    <td colspan="1">R$ ${response.total} ${response.total_item} iten(s)</td>
                </tr>
                <tr>
                    <td colspan="2">#</td>
                    <td colspan="2">Frete:</td>
                    <td colspan="1">${response.frete}</td>
                </tr>
                <tr>
                    <td colspan="2">#</td>
                    <td colspan="1">Cupom:</td>
                    <td> ${response.cupom} </td>
                    <td class="js_cupom_desconto">R$ ${response.desconto} Desconto</td>
                </tr>
            `);

            }
        }
    });
}

$(document).ready(function(){
    loadList();

    $(document).on("click", ".js_bt_finalizar_pedido", function(e) {
        e.preventDefault();

        let rua = $('#rua').val();
        let numero = $('#numero').val();
        let bairro = $('#bairro').val();
        let cidade = $('#cidade').val();
        let uf = $('#uf').val();
        let cep = $('#cep').val();

        let formData = {
            rua: rua,
            numero: numero,
            bairro: bairro,
            cidade: cidade,
            uf: uf,
            cep: cep
        };

        $.ajax({
            url: URL_BASE + '?c=pedidos&a=finalizar',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success'){

                   $('.js_bt_finalizar_pedido').hide(); 
                   $('#buscar-cep').hide(); 

                    tl_alert(response.title, response.message);
                }
            }
        });
    });

    $('#cep').on('blur', function() {
        const cep = $(this).val().replace(/\D/g, '');

        if (cep !== '') {
            const validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                $('#rua').val('...');
                $('#bairro').val('...');
                $('#cidade').val('...');
                $('#uf').val('...');

                $.getJSON(`https://viacep.com.br/ws/${cep}/json/?callback=?`, function(dados) {
                    if (!("erro" in dados)) {
                        $('#rua').val(dados.logradouro);
                        $('#bairro').val(dados.bairro);
                        $('#cidade').val(dados.localidade);
                        $('#uf').val(dados.uf);
                    } else {
                        limpaCampos();
                        tl_alert('Ops!', 'CEP não encontrado.');
                    }
                });
            } else {
                limpaCampos();
                tl_alert('Ops!', 'Formato de CEP inválido.');
            }
        } else {
            limpaCampos();
        }
    });

  });

