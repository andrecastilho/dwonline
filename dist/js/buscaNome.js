$(window).load(function () {

    var nome = $('#buscaNome').val();
    var pessoa = $('#pessoa').val();

    if (nome) {
        if (pessoa === 'juridica') {
            var nomeFantasia = $('#nomeFantasia').val();
        } else {
            var nomeFantasia = 'nome';
        }

        var idtbVendedor = $('#idtbVendedor').val();
        $("#res").html(' <div id="res">');
        $("#mostraBusca").show();
        $("#resultado").show();
        $("#imagemLoad").show();

        $.getJSON("../pages/php/buscaNome.php?nome=" + nome + "&loginEmpresa=" + $('#loginEmpresa').val() + "&cnpjEmpresa=" + $('#cnpjEmpresa').val() + "&idtbVendedor=" + idtbVendedor + "&pessoa=" + pessoa + "&nomeFantasia=" + nomeFantasia,
                function (data, status) {

                    if (data.length > 0) {

                        $.each(data, function (i) {

                            var nome = data[i].nome;
                            var cidade = data[i].cidade;
                            var uf = data[i].uf;

                            if (data[i].tipo === 'pj') {

                                var numDocumento = $("#resultPad").pad(data[i].doc, 14);

                            } else {

                                var numDocumento = $("#resultPad").pad(data[i].doc, 11);

                            }

                            if (numDocumento) {
                                numDocumento = numDocumento;
                            } else {
                                numDocumento = " &nbsp;&nbsp;&nbsp;";
                            }

                            if (nome) {
                                nome = nome;
                            } else {
                                nome = "&nbsp;&nbsp;&nbsp; ";
                            }

                            if (cidade) {
                                cidade = cidade;
                            } else {
                                cidade = "&nbsp;&nbsp; ";
                            }

                            if (uf) {
                                uf = uf;
                            } else {
                                uf = "&nbsp;&nbsp;";
                            }

                            var resultado =
                                    "<div id = 'result' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;height: 25px;' >" +
                                    //"&nbsp;CPF/CNPJ : <A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + numDocumento + "</A>" +
                                    "<div style='width: 15%;float: left;'>" +
                                    "&nbsp; <A href='../busca-doc/?cpfcnpj=" + numDocumento + "&idtbVendedor=" + idtbVendedor + "'>" + numDocumento + "</A>" +
                                    "</div>" +
                                    "<div style='width: 33%;float: left;'>" +
                                    "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + nome.substring(0, 30) + "</A>" +
                                    "</div>" +
                                    "<div style='width: 25%;float: left;'>" +
                                    "<A  href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + cidade + "</A>" +
                                    "</div>" +
                                    "<div style='width: 25%;float: left;'>" +
                                    "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + uf + "</A>" +
                                    "</div></div></div>";


                            $("#res").append(resultado);

                        });

                    } else {
                        var resultado = "<div id='msg' class='alert alert-danger role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span> Não encontrado </div>";
                        $("#res").append(resultado);

                    }
                }).error(function () {

            $("#mostraBusca").hide();
            alertModal("Não encontrado", "danger");

        }).always(function () {

            $("#imagemLoad").hide();

        });
    }
});
