$(document).ready(function() {
    $('#tabelaprod').empty(); //Limpando a tabela
    $.ajax({
        type: 'post', //Definimos o método HTTP usado
        dataType: 'json', //Definimos o tipo de retorno
        url: '/readprod', //Definindo o arquivo onde serão buscados os dados
        success: function(dados) {
            console.log(dados);
            for (var i = 0; dados.length > i; i++) {
                //Adicionando registros retornados na tabela
                $('#tabelaprod').append('<tr><td>' + dados[i].name + '</td><td>' + dados[i].SKU + '</td><td>' + dados[i].price + '</td><td>' + dados[i].amount + '</td><td>' + dados[i].categories + '</td><td>' + '<div class="actions"><div class="action edit"><span>Edit</span></div><div class="action delete"><span>Delete</span></div>' + '</td></tr>');
            }
        }
    });
});