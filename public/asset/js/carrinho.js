

function loadList() {
    $.ajax({
        url: URL_BASE + '?c=carrinho&a=list',
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
                        <ul class="d-flex list-unstyled gap-3 mt-0">
                            <li>
                                <input type="number" min="0" style="width: 80px" name="quantidade" value="${ln.quantidade}" />
                                <input type="hidden" name="preco" value="${ln.preco}" />
                            </li>
                            <li>
                               <div class="btn btn-success js_bt_cart_up" data-id="${ln.id}">
                                  Atualizar
                               </div>
                            </li>
                         </ul>
                     </td>
                     <td class="js_subtotal">${tl_moedaBr(ln.subtotal)}</td>
                     <td class="text-end">
                         <ul class="d-flex justify-content-end list-unstyled gap-3 mt-0">
                         <li>
                            <div class="btn btn-danger js_bt_cart_del" data-id="${ln.id}">
                               delete
                            </div>
                         </li>
                         </ul>
                     </td>
                 </tr>
                 `);
            });
            tbody.append(`
                <tr>
                    <td>#</td>
                    <td colspan="3">Total:</td>
                    <td>R$ ${response.total}</td>
                    <td class="text-end">${response.total_item} iten(s)</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">Frete:</td>
                    <td colspan="2">${response.frete}</td>
                </tr>
            `);
        }
    });
}

$(document).ready(function(){
    loadList();

    $(document).on("click", ".js_bt_cart_up", function() {

    let $tr = $(this).closest('tr');
    let id = $(this).data("id");
    let quantidade = parseFloat($tr.find('input[name="quantidade"]').val());
    let preco = parseFloat($tr.find('input[name="preco"]').val());
    let subtotal = quantidade * preco;

    $tr.find('.js_subtotal').text(subtotal.toFixed(2));
        let formData = {
            id: id,
            quantidade: quantidade
        };

        $.ajax({
            url: URL_BASE + '?c=carrinho&a=update',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success'){
                    loadList();
                }
            }
        });
    });

    $(document).on("click", ".js_bt_cart_del", function() {

        let id = $(this).data("id");
        $(this).closest('tr').fadeOut(300);

        let formData = {
            id: id
        };

        $.ajax({
            url: URL_BASE + '?c=carrinho&a=delete',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success'){
                    loadList();
                }
            }
        });
    });



  });
