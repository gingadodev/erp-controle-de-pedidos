  $(document).ready(function(){


    $('#preco').mask('000.000.000,00', {reverse: true});
    $('#variacao').mask('0000000000');
    $('#estoque').mask('0000000000');


    $('#btnSaveProduct').on('click', function(e) {
        e.preventDefault();

        let formData = new FormData();
        let nome = $('#nome').val();
        let preco = $('#preco').val();
        let variacao = $('#variacao').val();
        let estoque = $('#estoque').val();
        let loadSalvar = $('.js_loadSalvar');

        loadSalvar.removeClass('d-none');

        $.ajax({
            url: URL_BASE + '?c=produto&a=insert',
            method: 'POST',
            data: {
                nome: nome,
                preco: preco,
                variacao: variacao,
                estoque: estoque
            },
            dataType: 'json',
            success: function(response) {
                loadSalvar.addClass('d-none');
                tl_alert(response.title, response.message);
            },
            error: function(xhr) {
                loadSalvar.addClass('d-none');
                console.error('Erro ao processar a requisição.', xhr.responseText);
            }
        });
    });


  });
