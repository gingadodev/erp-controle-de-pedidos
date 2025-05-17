
function loadList() {
    $.ajax({
        url: URL_BASE + '?c=produto&a=list',
        type: 'POST',
        dataType: 'json',
        data: { action: 'list' },
        success: function(response) {
            const tbody = $("#listTableBody");
            tbody.empty();
            response.forEach(ln => {
                tbody.append(`
                 <tr data-id="${ln.id}">
                     <td>${ln.id}</td>
                     <td>${ln.nome}</td>
                     <td>${ln.preco}</td>
                     <td>${ln.variacao}</td>
                     <td>${ln.quantidade}</td>
                     <td class="text-end">
                         <ul class="d-flex justify-content-end list-unstyled gap-3 mt-0">
                         <li>
                             <div class="btn btn-success" data-id="${ln.id}">Comprar</div>
                         </li>
                         <li>
                             <div class="btn btn-primary js_bt_edit" data-id="${ln.id}">Editar</div>
                         </li>
                         </ul>
                     </td>
                 </tr>
                 `);
            });
        }
    });
}

  $(document).ready(function(){
      loadList();

    $('#preco').mask('000.000.000,00', {reverse: true});
    $('#variacao').mask('0000000000');
    $('#estoque').mask('0000000000');



    $('#btnSaveProduct').on('click', function(e) {
        e.preventDefault();

        let id_form = $('#id_form');
        let cod = $('#cod');
        let nome = $('#nome');
        let preco = $('#preco');
        let variacao = $('#variacao');
        let estoque = $('#estoque');
        let loadSalvar = $('.js_loadSalvar');

        let formData = {
            id: id_form.val(),
            cod: cod.val(),
            nome: nome.val(),
            preco: preco.val(),
            variacao: variacao.val(),
            estoque: estoque.val()
        };

        loadSalvar.removeClass('d-none');

        $.ajax({
            url: URL_BASE + '?c=produto&a=save',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response, data) {
                loadSalvar.addClass('d-none');

                id_form.val('0');
                cod.val('0');
                nome.val('');
                preco.val('');
                variacao.val('');
                estoque.val('');

                tl_alert(response.title, response.message);
                loadList();
            },
            error: function(xhr) {
                loadSalvar.addClass('d-none');
                console.error('Erro ao processar a requisição.', xhr.responseText);
            }
        });
    });


    $(document).on("click", ".js_bt_edit", function() {

        let id = $(this).data("id");
        let id_form = $('#id_form');
        let cod = $('#cod').val(id);
        let nome = $('#nome');
        let preco = $('#preco');
        let variacao = $('#variacao');
        let estoque = $('#estoque');
        let form_produto = $('#form_produto');
        let loadSalvar = $('.js_loadSalvar');

        let formData = {
            id: id
        };

     form_produto.addClass('bg-warning-subtle');

     setTimeout(function () {
        form_produto.removeClass('bg-warning-subtle');
      }, 1000);

        loadSalvar.removeClass('d-none');

            $.ajax({
                url: URL_BASE + '?c=produto&a=edit',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success'){

                        id_form.val(response.data.id);
                        nome.val(response.data.nome);
                        preco.val(response.data.preco);
                        variacao.val(response.data.variacao);
                        estoque.val(response.data.quantidade);

                        loadSalvar.addClass('d-none');

                    }else{
                        tl_alert(response.title, response.message);
                        loadSalvar.addClass('d-none');
                    }
                }
            });
    });


  });
