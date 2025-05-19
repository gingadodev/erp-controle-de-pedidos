function tl_alert(title, message)
{
    document.getElementById('title2505151848').innerText = title;
    document.getElementById('message2505151848').innerText = message;

    var modal = new bootstrap.Modal(document.getElementById('alert2505151848'));
    modal.show();
}


function tl_moedaBr(valor){

    let moeda = Intl.NumberFormat( 'pt-br', {

        style: 'currency', 
        currency: 'BRL'

    }).format(valor);

    return moeda;
}

