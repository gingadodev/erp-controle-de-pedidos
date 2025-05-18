
function loadList() {
    $.ajax({
        url: URL_BASE + '?c=cupons&a=list',
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
                     <td>${ln.codigo}</td>
                     <td>${ln.desconto}</td>
                     <td>${ln.valor_minimo}</td>
                     <td>${ln.validade_br}</td>
                     <td class="text-end">
                         <ul class="d-flex justify-content-end list-unstyled gap-3 mt-0">
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

    $('#desconto').mask('000.000.000,00', {reverse: true});
    $('#valor_minimo').mask('000.000.000,00', {reverse: true});
    $('#validade').mask('00/00/0000');

    $('#codigo').on('input', function () {
        this.value = this.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
    });

    $('#btnSaveCupom').on('click', function(e) {
        e.preventDefault();

        let id_form = $('#id_form');
        let cod = $('#cod');
        let codigo = $('#codigo');
        let desconto = $('#desconto');
        let valor_minimo = $('#valor_minimo');
        let validade = $('#validade');
        let loadSalvar = $('.js_loadSalvar');

        if (
          codigo.val().trim() === '' ||
          desconto.val().trim() === '' ||
          valor_minimo.val().trim() === '' ||
          validade.val().trim() === ''
        ) {

          tl_alert('Ops!', 'Por favor, preencha todos os campos.');
          return;
        }


        let formData = {
            id: id_form.val(),
            cod: cod.val(),
            codigo: codigo.val(),
            desconto: desconto.val(),
            valor_minimo: valor_minimo.val(),
            validade: validade.val()
        };

        loadSalvar.removeClass('d-none');

        $.ajax({
            url: URL_BASE + '?c=cupons&a=save',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response, data) {
                loadSalvar.addClass('d-none');

                id_form.val('0');
                cod.val('0');
                codigo.val('');
                desconto.val('');
                valor_minimo.val('');
                validade.val('');

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
        let codigo = $('#codigo');
        let desconto = $('#desconto');
        let valor_minimo = $('#valor_minimo');
        let validade = $('#validade');
        let form_cupons = $('#form_cupons');
        let loadSalvar = $('.js_loadSalvar');

        let formData = {
            id: id
        };

     form_cupons.addClass('bg-warning-subtle');

     setTimeout(function () {
        form_cupons.removeClass('bg-warning-subtle');
      }, 1000);

        loadSalvar.removeClass('d-none');

            $.ajax({
                url: URL_BASE + '?c=cupons&a=edit',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success'){

                        id_form.val(response.data.id);
                        codigo.val(response.data.codigo);
                        desconto.val(response.data.desconto);
                        valor_minimo.val(response.data.valor_minimo);
                        validade.val(response.data.validade_br);

                        desconto.trigger('input');
                        valor_minimo.trigger('input');

                        loadSalvar.addClass('d-none');

                    }else{
                        tl_alert(response.title, response.message);
                        loadSalvar.addClass('d-none');
                    }
                }
            });
    });


  });
