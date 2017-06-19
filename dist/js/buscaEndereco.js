$(window).load(function () {

    var endereco = $('#enderecoBuscaR').val();
    var numero = $('#enderecoNumeroBuscaR').val();
    var bairro = $('#enderecoBairroBuscaR').val();
    var cidade = $('#enderecoCidadeBuscaR').val();
    var uf = $('#enderecoUfBuscaR').val();
    var cep = $('#enderecoCepBuscaR').val();
    //var pessoa = $('#pessoa').val();


//Ajustar
    switch (true) {
        case numero.length === 0 || endereco.length === 0 & cep.length >= 1 :
            $('#modal').attr('display', 'true');
            alertModal("Digite endereço e numero ou Cep e numero", "info");
            return;
            break;
        case numero.length === 0 || cep.length === 0 & endereco.length === 0:
            $('#modal').attr('display', 'true');
            alertModal("Digite endereço e numero ou Cep e numero", "info");
            return;
            break;

        case numero.length === 0:
            $('#modal').attr('display', 'true');
            alertModal("Digite endereço e numero ou Cep e numero", "info");
            return;
            break;


        default:
            $("#modal").hide();

    }


    $("#res").html(' <div id="res">');
    $("#mostraBusca").show();
    $("#resultado").show();
    $("#imagemLoad").show();

    $.getJSON("../pages/php/buscaEndereco.php?endereco=" + endereco + "&numero=" + numero + "&bairro=" + bairro + "&cidade=" + cidade + "&cep=" + cep + "&loginEmpresa=" + $('#loginEmpresa').val() + "&cnpjEmpresa=" + $('#cnpjEmpresa').val() + "&uf=" + uf + "&pessoa=" + pessoa,
            function (data, status) {

                $("#res").append(resultado);

                if (data.length > 0) {

                    $.each(data, function (i) {

                        if (data[i].doc) {

                            if (data[i].tipo === 'pj') {

                                var numDocumento = $("#resultPad").pad(data[i].doc, 14);

                            } else {

                                var numDocumento = $("#resultPad").pad(data[i].doc, 11);

                            }

                            var resultado =
                                    "<div id = 'result' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                    "<div style='float: left;width: 40%'>" +
                                    "&nbsp; <A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + data[i].nome.substring(0, 30) + "</A>" +
                                    "</div>" +
                                    "<div style='float: rigth;width: 100%'>" +
                                    "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + data[i].endereco + "</A>" +
                                    "&nbsp;<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + data[i].numero + "</A>" +
                                    "&nbsp;<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + data[i].cidade + "</A>" +
                                    "&nbsp<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + data[i].bairro + "</A>" +
                                    "&nbsp; CEP -  &nbsp;<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + data[i].cep + "</A>" +
                                    "</div>" +
                                    "</div>";
                            $("#res").append(resultado);
                        }
                    });



                } else {
                    var resultado = "<div id='msg' class='alert alert-danger role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span> Não encontrado </div>";
                    $("#res").append(resultado);

                }
            }).always(function () {
        $("#imagemLoad").hide();
    });

}
);