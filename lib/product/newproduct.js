$(function() {

    var url = "/insertProduct";

    $("form").submit(function(e) {
        e.preventDefault();
        var form_data = $("form").serialize();

        $.post(url, form_data, function(response) {
            responseThis(response, alert(response.message));
        }, "json");

    });


    function responseThis(response, target) {
        console.clear();
        console.log(response);
        if (response.success) {
            var return_response = "<h1>" + response.sku + "</h1>";
            return_response += "<h1>" + response.sku + "</h1>";
            return_response += "<h1>" + response.name + "</h1>";
            return_response += "<h1>" + response.price + "</h1>";
            return_response += "<h1>" + response.qts + "</h1>";
            return_response += "<h1>" + response.category + "</h1>";
            return_response += "<h1>" + response.description + "</h1>";
            return_response += response.message ? "<p>" + response.success + "</p>" : "";

            $(target).append(return_response);
        } else {
            $(target).append("<p>Erro ao cadastrar!</p>");
        }
    }
});