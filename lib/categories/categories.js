$(document).ready(function() {
    $('#tabela').empty();
    $.ajax({
        type: 'get',
        dataType: 'json',
        url: '/readcat',
        success: function(dados) {
            console.log(dados);
            for (var i = 0; dados.length > i; i++) {
                $('#tabela').append('<tr><td>' + dados[i].name + '</td><td>' + dados[i].code + '</td><td id ="delete"><label id=' + dados[i].id + '><a href="">delete</a></label>' + '</td></tr>');
                // $('#tabela').append('<tr><td>' + dados[i].name + '</td><td>' + dados[i].code + '</td><td>' + '<div class="actions"><div class="action edit"><span>Edit</span></div><div class="action delete"><span>Delete</span></div>' + '</td></tr>');
                // $('#tabela').append('<tr><td>' + dados[i].id + '</td><td>' + dados[i].nome + '</td><td>' + dados[i].email + '</td></tr>');

            }
        }
    });

    $('#tabela').on('click', function(event) {
        event.preventDefault();
        var dados = $(this).serialize();
        $.ajax({
            url: '/catdelete',
            type: 'post',
            dataType: 'html',
            data: 'dados',
            success: function(data) {
                alert("consegui");
            }
        });

    });

});