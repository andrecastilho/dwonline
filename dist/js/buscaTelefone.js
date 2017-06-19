$(window).load(function () {

    if ($("#dddBuscaRedirect").val().length === 0) {

        $("#dddBusca").focus();
        $("#dddBusca").blur(function () {
            if ($("#dddBusca").val().length > 0) {
                $("#msg").hide();

            } else {
                $("#dddBusca").focus();
                $("#msg").html("<div id'modal'><div id='msg' class='alert alert-danger role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span> DDD deve ser informado </div></div>");
            }
        });
    }

    var telefone = $('#telBuscaRedirect').val().replace(/[^\d]+/g, '');
    var ddd = $('#dddBuscaRedirect').val();
    //var pessoa = $('#pessoa').val();
    $("#res").html(' <div id="res">');
    $("#modal").remove();
    $("#imagemLoad").show();

    $.getJSON("../pages/php/buscaTelefone.php?telefone=" + telefone + "&ddd=" + ddd + "&loginEmpresa=" + $('#loginEmpresa').val() + "&cnpjEmpresa=" + $('#cnpjEmpresa').val() + "&pessoa=" + pessoa,
            function (data, status) {

                $("#mostraBusca").show();
                $("#resultado").show();
                $("#imagemLoad").show();


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
                                    //"&nbsp;CPF/CNPJ : <A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + numDocumento + "</A>" +
                                    "<div style='float: left;width: 20%'>" +
                                    "&nbsp; <A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + numDocumento + "</A>" +
                                    "</div>" +
                                    "<div style='float: rigth;width: 100%'>" +
                                    "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + data[i].nome + " / (" + data[i].ddd + ") " + data[i].fone + "</A>" +
                                    "</div>";
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
});