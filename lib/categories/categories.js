$(document).ready(function() {
    $('#tabela').empty(); //Limpando a tabela
    $.ajax({
        type: 'post', //Definimos o método HTTP usado
        dataType: 'json', //Definimos o tipo de retorno
        url: '/readcat', //Definindo o arquivo onde serão buscados os dados
        success: function(dados) {
            console.log(dados);
            for (var i = 0; dados.length > i; i++) {
                //Adicionando registros retornados na tabela
                $('#tabela').append('<tr><td>' + dados[i].name + '</td><td>' + dados[i].code + '</td><td>' + '<div class="actions"><div class="action edit"><span>Edit</span></div><div class="action delete"><span>Delete</span></div>' + '</td></tr>');
                // $('#tabela').append('<tr><td>' + dados[i].id + '</td><td>' + dados[i].nome + '</td><td>' + dados[i].email + '</td></tr>');

            }
        }
    });
});