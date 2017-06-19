
$(document).ready(function () {

    $("#enviaEmail").hide();
    $("#enviaSms").hide();


    $("#botaoEnviaEmail").click(function () {
        $("#enviaEmail").show(100);
    });

    $("#botaoEnviaSms").click(function () {
        $("#enviaSms").show(100);
    });

    $("#enviarDadosPorEmail").click(function () {

        var nome = $("#enviarPorEmailNome").val();
        var email = $("#enviarPorEmailEmail").val();
        var cpf = $("#cpf_cnpj_redirect").val();
        var cnpjEmpresa = $("#cnpjEmpresa").val();
        var idtbVendedor = $("#idtbVendedor").val();

        var retorno = $.getJSON("../pages/php/enviaEmailDoc.php?nome=" + nome + "&email=" + email + "&cpf=" + cpf + "&cnpjEmpresa=" + cnpjEmpresa + "&idtbVendedor=" + idtbVendedor + "  ",
                function (data, status) {

                });

        alert("Email Enviado --> Aguarde você será redirecionado automaticamente... ");
        setTimeout(function () {
            location.reload();
        }, 1000);

    });


    $(".form-control").keyup(function () {
        $(this).val($(this).val().toUpperCase());
    });
    $("#busca2").addClass("active");
    $("#cpf_cnpj").focus();
    $("#enderecoBusca").focus();
    $("#nomeBusca").focus();
    $("#mostraBusca").hide();
    $("#outrostelefone").hide();
    $("#situacao").hide();
    $("#perfilsocialdiv").hide();
    $("#perfilconsumodiv").hide();
    $("#pessoasempresasrelacionadasdiv").hide();
    $("#participacaoemprediv").hide();
    $("#quemconsultoudiv").hide();
    $("#email").hide();
    $("#obito").hide();
    $("#resultado").hide();
    $("#nomeFantasia").hide();
    $("#imagemLoad").hide();
    $("#telefonesPage").hide();
//esconde icones
    $("#situacaoCadastroPage").hide();
    $("#perfilsocialPage").hide();
    $("#perfilconsumoPage").hide();
    $("#pessoasempresasrelacionadasPage").hide();
    $("#participacaoemprePage").hide();
    $("#quemconsultouPage").hide();
    $("#cEmailPage").hide();
    $("#cObitoPage").hide();
    
    
    
    $("#liObito").click(function () {

        $("#infoTop").show();
        $("#cObitoPage").show();
        $("#outrostelefone").hide();
        $("#email").hide();
        $("#situacao").hide();
        $("#telefone").hide();
        $("#localizacao").hide();
        $("#perfilconsumodiv").hide();
        $("#pessoasempresasrelacionadasdiv").hide();
        $("#participacaoemprediv").hide();
        $("#perfilsocialdiv").hide();
        $("#quemconsultoudiv").hide();
        //mostra icone
        //$("#cObitoPage").show();
        $("#detalheCnf").html("<div id='obito1'><div style='float: right;width: 30%'></div><div id='obt'></div><div id='cnfPlus'  style='font-size: 15px;'><a href='#'>+ Detalhes</a></div><br></div>");
        $("#infoTop").html("<div id='infoTop'></div>");
        //$("#infoObt").show(600);

        var idtbVendedor = $("#idtbVendedor").val();
        var cpfCnpj = $('#cpf1').val().replace(/[^\d]+/g, '');
        var cnpjEmpresa = $('#cnpjEmpresa').val();
        var retorno = $.getJSON("../pages/php/buscaObito.php?cpfCnpj=" + cpfCnpj + "&idtbVendedor=" + idtbVendedor + '&cnpjEmpresa=' + cnpjEmpresa + '&naoContar=1&tipo=simples',
                function (data, status) {

                    var order = new Array();
                    $.each(data, function (i) {

                        var nome = data[i].tb_cnfnew_nome;
                        if (nome !== null) {

                            if (i === 0) {
                                var obito = "<div id = 'infoObt' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                        "<div id='infoTop'>" +
                                        "<a><h3>Registro encontrado no banco de dados <img src='../dist/img/cnf.jpg' width=90 height=90  align='center'/></a></h3></a><br><br>" +
                                        "</div>"
                                        ;
                                $("#obt").append(obito);
                            }

                        } else {
                            $("#obt").html("<div id='infoTop'><a style='color: red'><h3>Registro Não encontrado no banco de dados  <img src='../dist/img/cnf.jpg' width=90 height=90  align='center'/></h3></a></div><br><br>");
                        }
                    });
                    //$("#detalheCnf").hide();
                    $("#msg").hide();
                }).error(function () {
            $("#obt").html("<div id='infoTop'><a style='color: red'><h3>Registro Não encontrado no banco de dados <img src='../dist/img/cnf.jpg' width=90 height=90  align='center'/></h3></a></div><br><br>");
        });
        var display = $("#obito").css('display');
        if (display === 'none') {

            $("#obito").show(50);
            var idtbVendedor = $("#idtbVendedor").val();
            $.getJSON("../pages/php/inserirCobranca.php?cnpjEmpresa=" + $('#cnpjEmpresa').val() + "&idtbVendedor=" + idtbVendedor + "&filtro=liObitoDetalhes" + cpfCnpj,
                    function (data, status) {

                    });
        } else {
//$("#obito").hide(50);
        }

    });
    $("#cnfPlus").click(function () {

        $("#detalheCnf").show(600);
        $("#detalheCnf").html("<div id='obito1'><div style='float: right;width: 30%'></div><div id='obt'></div><div id='cnfPlus'  style='font-size: 15px;'><a href='#'>+ Detalhes</a></div><br></div>");
        $("#infoTop").html("<div id='infoTop'></div>");
        var idtbVendedor = $("#idtbVendedor").val();
        var cpfCnpj = $('#cpf1').val().replace(/[^\d]+/g, '');
        var cnpjEmpresa = $('#cnpjEmpresa').val();
        var retorno = $.getJSON("../pages/php/buscaObito.php?cpfCnpj=" + cpfCnpj + "&idtbVendedor=" + idtbVendedor + '&cnpjEmpresa=' + cnpjEmpresa,
                function (data, status) {

                    var order = new Array();
                    $.each(data, function (i) {

                        $("#cnfPlus").hide();
                        var nome = data[i].tb_cnfnew_nome;
                        var dataFalecimento = formataData(data[i].tb_cnfnew_dtobito);
                        var nomeMae = data[i].tb_cnfnew_nome_mae;
                        var cidade = data[i].tb_cnfnew_cidadecartorio;
                        var uf = data[i].tb_cnfnew_ufcartorio;
                        var tb_cnfnew_livro = data[i].tb_cnfnew_livro;
                        var tb_cnfnew_folha = data[i].tb_cnfnew_folha;
                        var tb_cnfnew_termo = data[i].tb_cnfnew_termo;
                        var tb_cnfnew_dtreg = data[i].tb_cnfnew_dtreg;
                        var tb_cnfnew_dtnasc = data[i].tb_cnfnew_dtnasc;
                        var tb_cnfnew_cpf = data[i].tb_cnfnew_cpf;
                        var tb_cnfnew_cnpjcart = data[i].tb_cnfnew_cnpjcart;
                        var tb_cnfnew_cartorio = data[i].tb_cnfnew_cartorio;
                        var tb_cnfnew_endcartorio = data[i].tb_cnfnew_endcartorio;
                        var tb_cnfnew_bairrocartorio = data[i].tb_cnfnew_bairrocartorio;
                        var tb_cnfnew_cepcartorio = data[i].tb_cnfnew_cepcartorio;
                        //var titulo = (data[i].tb_cnf_titulo);
                        //var escNumero = data[i].tb_cnf_esc_numero;
                        //var eznNumero = data[i].tb_cnf_ezn_numero;
                        //var ctrNome = data[i].tb_cnf_ctr_nome;
                        //var pesObs = data[i].tb_cnf_pes_obs;

                        if (nome !== null) {
                            if (nome === undefined) {
                                nome = "";
                            }
                            if (dataFalecimento === undefined) {
                                dataFalecimento = "";
                            }
                            if (cidade === undefined) {
                                cidade = "";
                            }
                            if (uf === undefined) {
                                uf = "";
                            }
                            /*
                             if (titulo === undefined) {
                             titulo = "";
                             }
                             if (escNumero === undefined) {
                             escNumero = "";
                             }
                             if (eznNumero === undefined) {
                             eznNumero = "";
                             }
                             if (pesObs === undefined) {
                             pesObs = "";
                             }
                             if (ctrNome === undefined) {
                             ctrNome = "";
                             }
                             */
                            if (i === 0) {
                                if (cnpjEmpresa == '06976525000143' || cnpjEmpresa == '09545629000191') {
                                    var obito = "<div id = 'infoObt' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                            "<div id='infoTop'>" +
                                            "<a><h3>Registro encontrado no banco de dados <img src='../dist/img/cnf.jpg' width=90 height=90  align='center'/></a></h3></a><br><br>" +
                                            "</div>" +
                                            "<div id='basicCnf'>" +
                                            "</div><br><br>" +
                                            "<div id='detalheCnf'>" +
                                            "Nome : <A style='color:white'; >" + nome + "</A><br>" +
                                            "Data Falecimento : <A style='color:white'; >" + dataFalecimento + "</A><br>" +
                                            "Endereço : <A style='color:white'; >" + tb_cnfnew_endcartorio + "</A><br>" +
                                            "Bairro : <A style='color:white'; >" + tb_cnfnew_bairrocartorio + "</A><br>" +
                                            "Cep : <A style='color:white'; >" + tb_cnfnew_cepcartorio + "</A><br>" +
                                            "Cidade : <A style='color:white'; >" + cidade + "</A><br>" +
                                            "Uf : <A style='color:white';>" + uf + "</A><br>" +
                                            "Livro : <A style='color:white';>" + tb_cnfnew_livro + "</A><br>" +
                                            "Folha : <A style='color:white';>" + tb_cnfnew_folha + "</A><br>" +
                                            "Termo : <A style='color:white';>" + tb_cnfnew_termo + "</A><br>" +
                                            "Data Reg  : <A style='color:white';>" + tb_cnfnew_dtreg + "</A><br>" +
                                            "Data Nasc  : <A style='color:white';>" + tb_cnfnew_dtnasc + "</A><br>" +
                                            "CPF  : <A style='color:white';>" + tb_cnfnew_cpf + "</A><br>" +
                                            "CNPJ Cartorio : <A style='color:white';>" + tb_cnfnew_cnpjcart + "</A><br>" +
                                            "Cartorio : <A style='color:white';>" + tb_cnfnew_cartorio + "</A><br>" +
                                            "<br><br><div style='color: yellow;'>Pesquisa Indicação de Cartório</div>" +
                                            "</div>" +
                                            "</div>";
                                    $("#obt").append(obito);
                                } else {
                                    var obito = "<div id = 'infoObt' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                            "<div id='infoTop'>" +
                                            "<a><h3>Registro encontrado no banco de dados <img src='../dist/img/cnf.jpg' width=90 height=90  align='center'/></a></h3></a><br><br>" +
                                            "</div>" +
                                            "<div id='basicCnf'>" +
                                            "</div><br><br>" +
                                            "<div id='detalheCnf'>" +
                                            "Nome : <A style='color:white'; >" + nome + "</A><br>" +
                                            "Data Falecimento : <A style='color:white'; >" + dataFalecimento + "</A><br>" +
                                            "Cidade : <A style='color:white'; >" + cidade + "</A><br>" +
                                            "Uf : <A style='color:white';>" + uf + "</A><br>" +
                                            "<br><br><div style='color: yellow;'>Pesquisa Indicação de Cartório</div>" +
                                            "</div>" +
                                            "</div>";
                                    $("#obt").append(obito);
                                }
                            }
                        } else {
                            $("#obt").html("<div id='infoTop'><a style='color: red'><h3>Registro Não encontrado no banco de dados  <img src='../dist/img/cnf.jpg' width=90 height=90  align='center'/></h3></a></div><br><br>");
                        }
                    });
                    //$("#detalheCnf").hide();

                    $("#msg").hide();
                }).error(function () {
            $("#obt").html("<div id='infoTop'><a style='color: red'><h3>Registro Não encontrado no banco de dados <img src='../dist/img/cnf.jpg' width=90 height=90  align='center'/></h3></a></div><br><br>");
        });
    });
    $("#cLocalizacao").click(function () {

        $("#outrostelefone").hide();
        $("#obito").hide();
        $("#situacao").hide();
        //$("#telefone").hide();
        $("#email").hide();
        $("#perfilconsumodiv").hide();
        $("#pessoasempresasrelacionadasdiv").hide();
        $("#participacaoemprediv").hide();
        $("#perfilsocialdiv").hide();
        $("#quemconsultoudiv").hide();
        //mostra icone
        $("#cLocalizacaoPage").show();
        var display = $("#localizacao").css('display');
        if (display === 'none') {

            $("#localizacao").show(50);
        } else {

// $("#localizacao").hide(50);
        }
//mostra telefones iniciais
        var display = $("#telefone").css('display');
        if (display === 'none') {

            $("#telefone").show(50);
        } else {
//$("#telefone").hide(50);
        }
    });
    $("#dddBusca").focus();
    $("#telefones").click(function () {

        $("#telefonesPage").show();
        $("#obito").hide();
        $("#situacao").hide();
        $("#localizacao").hide();
        $("#telefone").hide();
        $("#email").hide();
        $("#perfilconsumodiv").hide();
        $("#pessoasempresasrelacionadasdiv").hide();
        $("#participacaoemprediv").hide();
        $("#perfilsocialdiv").hide();
        $("#quemconsultoudiv").hide();
        //mostra icone
        $("#outrostelefone").show();

        //var target_offset = $("#scrollTelefone").offset();
        //var target_top = target_offset.top;
        //$('html, body').animate({scrollTop: target_top}, 100);

        $("#outrostelefone1").html("<div id='outrostelefone1'><div id='outrostel'></div><br></div>");
        var cpfCnpj = $("#cpf1").val().replace(/[^\d]+/g, '');
        if (!cpfCnpj) {
            var cpfCnpj = $("#cnpj1").val().replace(/[^\d]+/g, '');
        }
        $.getJSON("../pages/php/outrosTelefones.php?busca=" + cpfCnpj,
                function (data, status) {

                    var order = new Array();
                    $.each(data, function (i, element) {

                        if (i === 0) {
                            var passa = false;
                        } else {
                            var ant = i - 1;
                            var anterior = data[ant].fone;
                        }

                        if (data[i].fone) {

                            //    alert(data[i].tb_pessoa_juridica_fones_fone)
                            if (data[i].fone === anterior || passa) {

                            } else {

                                if ($.inArray(data[i].fone, order) === -1) {

                                    order.push(data[i].fone);
                                    var outrostel =
                                            "<div id = 'outrosinfoTelefone' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                            "Telefone : <A href='../busca-tel/?ddd=" + data[i].ddd + "&fone=" + data[i].fone + "&pessoa=juridica'>(" + data[i].ddd + ") " + data[i].fone + "</A>" +
                                            "<div  style = 'float:right' >" +
                                            "<div style='text-align: right'>" +
                                            "<a  title='Telefones Relacionados 'href='../busca-tel/?ddd=" + data[i].ddd + "&fone=" + data[i].fone + "&pessoa=juridica'><i class='fa fa-search'>&nbsp;&nbsp;</i></a>" +
                                            "</div>" +
                                            "<div  style = 'float:right' >" +
                                            "</div>" +
                                            "</div>";
                                    $("#outrostel").append(outrostel);
                                }
                            }
                        }
                    });
                }).error(function () {
            $("#outrostelefone1").html("<a style='color: red'><h3>Registro Não encontrado</h3></a><br><br>");
        });
    });
    $("#liemail").click(function () {

        $("#outrostelefone").hide();
        $("#obito").hide();
        $("#situacao").hide();
        $("#telefone").hide();
        $("#localizacao").hide();
        $("#perfilconsumodiv").hide();
        $("#pessoasempresasrelacionadasdiv").hide();
        $("#participacaoemprediv").hide();
        $("#perfilsocialdiv").hide();
        $("#quemconsultoudiv").hide();
        //mostra icone
        $("#cEmailPage").show();

        //var target_offset = $("#scrollEmail").offset();
        //var target_top = target_offset.top;
        //$('html, body').animate({scrollTop: target_top}, 100);

        $("#email1").html("<div id = 'email'><div id='mail'><div id='infoEmail'></div></div></div>");
        var display = $("#email").css('display');
        if (display === 'none') {

            $("#email").show(50);
            var cpfCnpj = $("#cpf1").val().replace(/[^\d]+/g, '');
            if (!cpfCnpj) {
                var cpfCnpj = $("#cnpj1").val().replace(/[^\d]+/g, '');
            }

            var user = $("#idtbVendedor").val();
            var retorno = $.getJSON("../pages/php/buscaEmailCpfCnpj.php?cpfCnpj=" + cpfCnpj + "&idtbVendedor=" + user,
                    function (data, status) {

                        var order = new Array();
                        $.each(data, function (i) {

                            if (i === 0) {
                                var passa = false;
                            } else {
                                var ant = i - 1;
                                var anterior = data[ant].idtb_pessoa_fisica_email;
                            }

                            if (data[i].tb_pessoa_fisica_email_email) {


                                if (data[i].idtb_pessoa_fisica_email === anterior || passa) {

                                } else {

                                    if ($.inArray(data[i].tb_pessoa_fisica_email_email, order) === -1) {

                                        order.push(data[i].tb_pessoa_fisica_email_email);
                                        var mail =
                                                "<div id = 'infoEmail' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                                "Email : <A  >" + data[i].tb_pessoa_fisica_email_email + "</A>" +
                                                "<input id='emailLocalizado' type='hidden' value='" + data[i].tb_pessoa_fisica_email_email + "'>" +
                                                "<div  style = 'float:right' >" +
                                                "</div>" +
                                                "</div>";
                                        $("#mail").append(mail);
                                    }

                                }
                            } else {
                                $("#mail").html("<a style='color: red'><h3>Registro Não encontrado </h3></a><br><br>");
                            }
                        });
                    }).error(function () {
                $("#mail").html("<a style='color: red'><h3>Registro Não encontrado </h3></a><br><br>");
            });
        } else {

            $("#email").hide(50);
        }
    });
    $("#situacaoCadastro").click(function () {

        $("#outrostelefone").hide();
        $("#situacaoCadastroPage").show();
        $("#obito").hide();
        $("#telefone").hide();
        $("#localizacao").hide();
        $("#email").hide();
        $("#perfilconsumodiv").hide();
        $("#pessoasempresasrelacionadasdiv").hide();
        $("#participacaoemprediv").hide();
        $("#perfilsocialdiv").hide();
        $("#quemconsultoudiv").hide();

        //var target_offset = $("#scrollSituacao").offset();
        //var target_top = target_offset.top;
        //$('html, body').animate({scrollTop: target_top}, 100);

        var display = $("#situacao").css('display');
        if (display === 'none') {
            $("#situacao").show(50);
            var idtbVendedor = $("#idtbVendedor").val();
            var cpfCnpj = $('#cnpj1').val().replace(/[^\d]+/g, '');
            var retorno = $.getJSON("../pages/php/buscaSitCadastral.php?cpfCnpj=" + cpfCnpj + "&idtbVendedor=" + idtbVendedor,
                    function (data, status) {

                        var situacaoData = data[0].tb_pessoa_juridica_data_situacao;
                        var situacao = data[0].tb_pessoa_juridica_situacao;
                        $("#tb_pessoa_juridica_data_situacao").html(formataData(situacaoData));
                        $("#tb_pessoa_juridica_situacao").html(situacao);
                    });
        } else {

            $("#situacao").hide(50);
        }
    });
    $("#perfilsocial").click(function () {

        $("#perfilSocial").html("<div id = 'perfilSocial'></div>");
        $("#outrostelefone").hide();
        $("#perfilsocialPage").show();
        $("#obito").hide();
        $("#telefone").hide();
        $("#localizacao").hide();
        $("#email").hide();
        $("#perfilconsumodiv").hide();
        $("#pessoasempresasrelacionadasdiv").hide();
        $("#participacaoemprediv").hide();
        $("#situacao").hide();
        $("#quemconsultoudiv").hide();

        //var target_offset = $("#scrollPSocioDemo").offset();
        //var target_top = target_offset.top;
        //$('html, body').animate({scrollTop: target_top}, 100);

        var display = $("#perfilsocialdiv").css('display');
        if (display === 'none') {

            $("#perfilsocialdiv").show(50);
            var cpfCnpj = $("#cpf1").val().replace(/[^\d]+/g, '');
            if (!cpfCnpj) {
                var cpfCnpj = $("#cnpj1").val().replace(/[^\d]+/g, '');
            }

            var idtbVendedor = $("#idtbVendedor").val();
            if (cpfCnpj.length === 11)
                $.getJSON("../pages/php/buscaPerfilSocial.php?busca=" + cpfCnpj + "&idtbVendedor=" + idtbVendedor + "&filtro=perfilsocial",
                        function (data, status) {

                            if (data.length !== 0) {

                                var order = new Array();
                                $.each(data, function (i, element) {

                                    if (i === 0) {
                                        var passa = false;
                                    } else {
                                        var ant = i - 1;
                                        var anterior = data[ant].idtb_pessoa_fisica_social;
                                    }

                                    if (data[i].idtb_pessoa_fisica_social) {

                                        if (data[i].idtb_pessoa_fisica_social === anterior || passa) {

                                        } else {

                                            if ($.inArray(data[i].idtb_pessoa_fisica_social, order) === -1) {

                                                $("#perfilSocialMostrar").hide();
                                                var escolaridade = data[i].tb_pessoa_fisica_social_escolaridade;
                                                switch (escolaridade) {

                                                    case "0":
                                                        var escolaridade = "";
                                                        break;
                                                    case "1":
                                                        var escolaridade = "ENSINO FUNDAMENTAL";
                                                        break;
                                                    case "2":
                                                        var escolaridade = "ENSINO MEDIO";
                                                        break;
                                                    case "3":
                                                        var escolaridade = "ENSINO SUPERIOR";
                                                        break;
                                                    case "4":
                                                        var escolaridade = "ENSINO SUPERIOR - MESTRADO";
                                                        break;
                                                    case "5":
                                                        var escolaridade = "ENSINO SUPERIOR - DOUTORADO";
                                                        break;
                                                    case "6":
                                                        var escolaridade = "ENSINO SUPERIOR - DOUTORADO++";
                                                        break;
                                                }

                                                if (data[i].tb_pessoa_juridica_socio_participacao) {
                                                    var cbo = "Empresário";
                                                } else {
                                                    var cbo = data[i].tb_cbo_mostrar;
                                                }

                                                order.push(data[i].idtb_pessoa_fisica_social);
                                                var perfilSocial =
                                                        "<div id = 'perfilSocial' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                                        "Renda Estimada : <a>R$ " + data[i].tb_pessoa_fisica_social_renda_estimada + ",00</a><br>" +
                                                        "Escolaridade : <a>" + escolaridade + "</a><br>" +
                                                        "Ocupação : <a>" + cbo + "</a><br>" +
                                                        "Classe Social : <a>" + data[i].tb_pessoa_fisica_social_classe_social + "</a><br>" +
                                                        "<div  style = 'float:right' >" +
                                                        "<div style='text-align: right'>" +
                                                        "<div  style = 'float:right' >" +
                                                        "</div>" +
                                                        "</div>";
                                                $("#perfilSocial").append(perfilSocial);
                                            }
                                        }
                                    } else {
                                        $("#perfilSocial").html("<a style='color: red'><h3>Registro Não encontrado</h3></a><br><br>");
                                    }
                                });
                            } else {
                                $("#perfilSocial").html("<a style='color: red'><h3>Registro Não encontrado</h3></a><br><br>");
                            }
                        }).error(function () {
                    $("#perfilSocialMostrar").hide();
                    $("#perfilSocial").html("<a style='color: red'><h3>Registro Não encontrado</h3></a><br><br>");
                });
        } else {

            $("#perfilsocialdiv").hide(50);
        }

    });
    $("#perfilconsumo").click(function () {

        $("#outrostelefone").hide();
        $("#perfilconsumodiv").show();
        $("#perfilconsumoPage").show();
        $("#obito").hide();
        $("#telefone").hide();
        $("#localizacao").hide();
        $("#email").hide();
        $("#perfilsocialdiv").hide();
        $("#pessoasempresasrelacionadasdiv").hide();
        $("#participacaoemprediv").hide();
        $("#situacao").hide();
        $("#quemconsultoudiv").hide();

        //var target_offset = $("#scrollPConsumo").offset();
        //var target_top = target_offset.top;
        //$('html, body').animate({scrollTop: target_top}, 100);

        $("#perfilConsumo").html("<div id='perfilConsumo'><br></div>");
        var cpfCnpj = $("#cpf1").val().replace(/[^\d]+/g, '');
        if (!cpfCnpj) {
            var cpfCnpj = $("#cnpj1").val().replace(/[^\d]+/g, '');
        }

        var idtbVendedor = $("#idtbVendedor").val();
        $.getJSON("../pages/php/buscaPerfilConsumo.php?busca=" + cpfCnpj + "&idtbVendedor=" + idtbVendedor + "&filtro=perfilsocial",
                function (data, status) {

                    if (data.length !== 0) {

                        var order = new Array();
                        $.each(data, function (i, element) {

                            if (i === 0) {
                                var passa = false;
                            } else {
                                var ant = i - 1;
                                var anterior = data[ant].tb_perfil_consumo_descricao;
                            }

                            if (data[i].tb_perfil_consumo_descricao) {

                                if (data[i].tb_perfil_consumo_descricao === anterior || passa) {

                                } else {

                                    if ($.inArray(data[i].tb_perfil_consumo_descricao, order) === -1) {

                                        order.push(data[i].tb_perfil_consumo_descricao);
                                        var perfilConsumo =
                                                "<div id = 'outrosinfoTelefone' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                                "<a>" + data[i].tb_perfil_consumo_descricao + "</a>"
                                        "<div  style = 'float:right' >" +
                                                "<div style='text-align: right'>" +
                                                "<div  style = 'float:right' >" +
                                                "</div>" +
                                                "</div>";
                                        $("#perfilConsumo").append(perfilConsumo);
                                    }

                                }
                            } else {
                                $("#perfilConsumo").html("<a style='color: red'><h3>Registro Não encontrado</h3></a><br><br>");
                            }
                        });
                    } else {
                        $("#perfilConsumo").html("<a style='color: red'><h3>Registro Não encontrado</h3></a><br><br>");
                    }
                }).error(function () {
            $("#perfilConsumo").html("<a style='color: red'><h3>Registro Não encontrado</h3></a><br><br>");
        });
    });
    $("#pessoasempresasrelacionadas").click(function () {

        $("#outrostelefone").hide();
        $("#pessoasempresasrelacionadasPage").show();
        $("#obito").hide();
        $("#telefone").hide();
        $("#localizacao").hide();
        $("#email").hide();
        $("#perfilsocialdiv").hide();
        $("#perfilconsumodiv").hide();
        $("#participacaoemprediv").hide();
        $("#situacao").hide();
        $("#quemconsultoudiv").hide();

        //scrollPEnpresarial
        var display = $("#pessoasempresasrelacionadasdiv").css('display');
        if (display === 'none') {

            $("#pessoasempresasrelacionadasdiv").show(50);
            var idtbVendedor = $("#idtbVendedor").val();
            $.getJSON("../pages/php/inserirCobranca.php?cnpjEmpresa=" + $('#cnpjEmpresa').val() + "&idtbVendedor=" + idtbVendedor + "&filtro=pessoasempresasrelacionadas",
                    function (data, status) {
                    });
        } else {

            $("#pessoasempresasrelacionadasdiv").hide(50);
        }

    });
    $("#participacaoempre").click(function () {

        $("#outrostelefone").hide();
        $("#participacaoemprePage").show();
        $("#obito").hide();
        $("#telefone").hide();
        $("#localizacao").hide();
        $("#email").hide();
        $("#perfilsocialdiv").hide();
        $("#perfilconsumodiv").hide();
        $("#pessoasempresasrelacionadasdiv").hide();
        $("#situacao").hide();
        $("#quemconsultoudiv").hide();

        //var target_offset = $("#scrollPEnpresarial").offset();
        //var target_top = target_offset.top;
        //$('html, body').animate({scrollTop: target_top}, 100);


        var display = $("#participacaoemprediv").css('display');
        if (display === 'none') {

            $("#participacaoemprediv").show(50);
            var cpfCnpj = null;
            $("#partempreMostrar").html("<div id='partempreMostrar'><div id='participacaoemprediv1'><div id='participacaoempre'></div></div></div>");
            var cpfCnpj = $('#cpf1').val().replace(/[^\d]+/g, '');
            if (!cpfCnpj) {

                var cpfCnpj = $('#cnpj1').val().replace(/[^\d]+/g, '');
            }

            var idtbVendedor = $("#idtbVendedor").val();
            var contaCpfCnpj = cpfCnpj.length;
            var retorno = $.getJSON("../pages/php/buscaPartEmp.php?busca=" + cpfCnpj + "&idtbVendedor=" + idtbVendedor,
                    function (data, status) {

                        if (contaCpfCnpj === 11) {

                            var order = new Array();
                            if (data.length !== 0) {



                                $.each(data, function (i) {

                                    if (i === 0) {
                                        var passa = false;
                                    } else {
                                        var ant = i - 1;
                                        var anterior = data[ant].idtb_pessoa_juridica_socio;
                                    }

                                    if (data[i].tb_pessoa_juridica_socio_cpf_id) {

                                        if (data[i].idtb_pessoa_juridica_socio === anterior || passa) {
                                        } else {

                                            var numDocumento = $("#resultPad").pad(data[i].tb_pessoa_juridica_socio_cnpj_id, 14);
                                            if ($.inArray(data[i].idtb_pessoa_juridica_socio, order) === -1) {

                                                order.push(data[i].idtb_pessoa_juridica_socio);
                                                var socios =
                                                        "<div class='' style = 'floadt:left;padding: 4px;border-bottom: 1px solid #EBEBEB;'>" +
                                                        "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' id='tb_pessoa_juridica_socio_cpf_id'>" + data[i].tb_pessoa_juridica_socio_cpf_id + "</A> &nbsp;&nbsp;&nbsp;&nbsp;" +
                                                        "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "''>" + data[i].nomeEmpresa.substring(0, 28) + "</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
                                                        "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' id='pempresarialPorcentagem'>" + data[i].tb_pessoa_juridica_socio_participacao + " %</A> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
                                                        "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' id='pempresarialData'></A>&nbsp;&nbsp;&nbsp;" +
                                                        "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' id='tb_pessoa_juridica_socio_tipo'>" + data[i].tb_pessoa_juridica_socio_tipo + "</A> &nbsp;&nbsp;&nbsp;" +
                                                        "<div style='text-align: right'>" +
                                                        "</div>" +
                                                        "</div>";
                                                $("#partempreMostrar").append(socios);
                                            }
                                        }
                                    }

                                });
                            } else {
                                $("#partempreMostrar").html("<a style='color: red'><h3>Registro Não encontrado </h3></a><br><br>");
                            }
                        } else {

                            var order = new Array();
                            if (data.length !== 0) {

                                $("#qtdpropietarios").html(data[0].qtdProprietarios);
                                $.each(data, function (i) {

                                    if (i === 0) {
                                        var passa = false;
                                    } else {
                                        var ant = i - 1;
                                        var anterior = data[ant].tb_pessoa_juridica_socio_cpf_id;
                                    }

                                    if (data[i].tb_pessoa_juridica_socio_cnpj_id) {

                                        if (data[i].tb_pessoa_juridica_socio_cpf_id === anterior || passa) {
                                        } else {

                                            var numDocumento = $("#resultPad").pad(data[i].tb_pessoa_juridica_socio_cpf_id, 11);
                                            //if ($.inArray(data[i].tb_pessoa_juridica_socio_cnpj_id, order) === -1) {

                                            order.push(data[i].tb_pessoa_juridica_socio_cnpj_id);
                                            var socios =
                                                    "<div class='' style = 'floadt:left;padding: 4px;border-bottom: 1px solid #EBEBEB;'>" +
                                                    "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' id='tb_pessoa_juridica_socio_cpf_id'>" + data[i].tb_pessoa_juridica_socio_cpf_id + "</A> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
                                                    "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "''>" + data[i].nomeSocio.substring(0, 20) + "</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
                                                    "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' id='pempresarialPorcentagem'>" + data[i].tb_pessoa_juridica_socio_participacao + " %</A> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
                                                    "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' id='pempresarialData'></A>&nbsp;" +
                                                    "<A href='../busca-doc/?cpfcnpj=" + numDocumento + "' id='tb_pessoa_juridica_socio_tipo'>" + data[i].tb_pessoa_juridica_socio_tipo + "</A> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
                                                    "<div style='text-align: right'>" +
                                                    "</div>" +
                                                    "</div>";
                                            $("#partempreMostrar").append(socios);
                                        }
                                        //}
                                    }

                                });
                            } else {
                                $("#partempreMostrar").html("<a style='color: red'><h3>Registro Não encontrado </h3></a><br><br>");
                            }
                        }
                    }).error(function () {
                $("#partempreMostrar").html("<a style='color: red'><h3>Registro Não encontrado </h3></a><br><br>");
            });
        } else {

            $("#participacaoemprediv").hide(50);
        }

    });
// busca cpf/cnpj    
    $("#buscar").click(function () {
        $("#erroValCnpjCpf").html("<div id='erroValCnpjCpf' ></div>  ");
        $("#modal").html("<div id='modal' ></div>");
        buscarCnpfCnpj();
    });
    $("#cpf_cnpj").keypress(function (e) {
        $("#erroValCnpjCpf").html("<div id='erroValCnpjCpf' ></div>  ");
        $("#modal").html("<div id='modal' ></div>");
        if (e.which === 13) {
            buscarCnpfCnpj();
        }
    });
//busca por telefone
    $("#buscarTelefone").click(function () {

        buscaTelefone();
    });
    $("#telBusca").keypress(function (e) {
        if (e.which === 13) {
            buscaTelefone();
        }
    });
//busca por nome
    $("#buscarNome").click(function () {
        buscaNome();
    });
    $("#nomeBusca").keypress(function (e) {
        if (e.which === 13) {
            buscaNome();
        }
    });
//busca Endereço
    $("#buscarEndereco").click(function () {
        buscaEndereco();
    });
    $("#enderecoBusca").keypress(function (e) {
        if (e.which === 13) {
            buscaEndereco();
        }
    });
    $("#enderecoNumeroBusca").keypress(function (e) {
        if (e.which === 13) {
            buscaEndereco();
        }
    });
    $("#enderecoCepBusca").keypress(function (e) {
        if (e.which === 13) {
            buscaNome();
        }
    });
    $("#pessoa").change(function () {

        if ($("#pessoa").val() === 'juridica') {
            $("#nomeFantasia").show(600);
        }

    });
//busca por endereco


    function signo(data) {

        $("#signo").val("");
        if (data) {

            data.toString();
            var month = data.substring(4, 6);
            var day = data.substring(6, 8);
            if ((month == 1 && day <= 20) || (month == 12 && day >= 22))
            {
                $("#signo").val("Capricornio");
            }
            if ((month == 2 && day <= 19) || (month == 1 && day >= 21))
            {
                $("#signo").val("Aquário");
            }
            if ((month == 3 && day <= 20) || (month == 2 && day >= 20))
            {
                $("#signo").val("Peixes");
            }
            if ((month == 4 && day <= 20) || (month == 3 && day >= 21))
            {
                $("#signo").val("Aries");
            }

            if ((month == 5 && day <= 21) || (month == 4 && day >= 21))
            {
                $("#signo").val("Touro");
            }
            if ((month == 6 && day <= 21) || (month == 5 && day >= 22))
            {
                $("#signo").val("Gemeos");
            }
            if ((month == 7 && day <= 23) || (month == 6 && day >= 21))
            {
                $("#signo").val("Cancer");
            }
            if ((month == 8 && day <= 23) || (month == 7 && day >= 24))
            {
                $("#signo").val("Leão");
            }
            if ((month == 9 && day <= 23) || (month == 8 && day >= 24))
            {
                $("#signo").val("Virgem");
            }
            if ((month == 10 && day <= 23) || (month == 9 && day >= 24))
            {
                $("#signo").val("Libra");
            }
            if ((month == 11 && day <= 22) || (month == 10 && day >= 24))
            {
                $("#signo").val("Escorpião");
            }
            if ((month == 12 && day <= 21) || (month == 11 && day >= 23))
            {
                $("#signo").val("Sagitario");
            }
        }
    }

    function formataCnpj(cnpj) {

        cnpj = cnpj.toString();
        var part1 = cnpj.substring(0, 2);
        var part2 = cnpj.substring(2, 5);
        var part3 = cnpj.substring(5, 8);
        var part4 = cnpj.substring(8, 12);
        var part5 = cnpj.substring(12, 14);
        return part1 + "." + part2 + "." + part3 + "/" + part4 + "-" + part5;
    }

    function formataCpf(cpf) {

        cpf = cpf.toString();
        var part1 = cpf.substring(0, 3);
        var part2 = cpf.substring(3, 6);
        var part3 = cpf.substring(6, 9);
        var part4 = cpf.substring(9, 11);
        return part1 + "." + part2 + "." + part3 + "-" + part4;
    }

    $.fn.extend({
        pad: function (str, max) {
            str = str.toString();
            return str.length < max ? pad("0" + str, max) : str;
        },
        formataData: function (data) {
            var ano;
            var mes;
            var dia;
            if (data) {
                data = data.toString();
                ano = data.substring(0, 4);
                mes = data.substring(4, 6);
                dia = data.substring(6, 8);
                return dia + " / " + mes + " / " + ano;
            }
        }
    });
    function pad(str, max) {
        str = str.toString();
        return str.length < max ? pad("0" + str, max) : str;
    }


    function formataData(data) {

        var ano;
        var mes;
        var dia;
        if (data) {
            data = data.toString();
            ano = data.substring(0, 4);
            mes = data.substring(4, 6);
            dia = data.substring(6, 8);
        }
        return dia + " / " + mes + " / " + ano;
    }

    function localizacaoHtmlCnpj(data) {


        var order = new Array();
        var orderCep = new Array();
        $.each(data, function (i) {

            var complemento;
            if (i === 0) {
                var passa = false;
            } else {
                var ant = i - 1;
                var anterior = data[ant].idtb_pessoa_juridica_end;
                var passa = false;
            }

            if (data[i].idtb_pessoa_juridica_end) {

                if (data[i].idtb_pessoa_juridica_end === anterior || passa) {

                } else {

                    var complemento;
                    var endereco;
                    var numero;
                    var bairro;
                    var cidade;
                    var uf;
                    var cep;
                    if (data[i].tb_pessoa_juridica_end_end) {
                        endereco = data[i].tb_pessoa_juridica_end_end;
                    } else {
                        endereco = " ";
                    }

                    if (data[i].tb_pessoa_juridica_end_num) {
                        numero = data[i].tb_pessoa_juridica_end_num;
                    } else {
                        numero = " ";
                    }

                    if (data[i].tb_pessoa_juridica_end_compl) {
                        complemento = data[i].tb_pessoa_juridica_end_compl;
                    } else {
                        complemento = " ";
                    }

                    if (data[i].tb_pessoa_juridica_end_bairro) {
                        bairro = data[i].tb_pessoa_juridica_end_bairro;
                    } else {
                        bairro = " ";
                    }

                    if (data[i].tb_pessoa_juridica_end_cidade) {
                        cidade = data[i].tb_pessoa_juridica_end_cidade;
                    } else {
                        cidade = " ";
                    }

                    if (data[i].tb_pessoa_juridica_end_uf) {
                        uf = data[i].tb_pessoa_juridica_end_uf;
                    } else {
                        uf = " ";
                    }

                    if (data[i].tb_pessoa_juridica_end_cep) {
                        cep = data[i].tb_pessoa_juridica_end_cep;
                    } else {
                        cep = " ";
                    }

                    if ($.inArray(numero, order) === -1) {
                        if ($.inArray(cep, orderCep) === -1) {

                            order.push(numero);
                            if (complemento.search(/ap/i) === 0 || complemento.search(/sl/i) === 0 || complemento.search(/cj/i) === 0 || complemento.search(/lj/i) === 0) {

                                var localizacao =
                                        "<div id = 'infoLocalizacao' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                        "<div class = '' style = 'float: left;width: 70%' >" +
                                        "Endereço : <a target='_blank' href='https://www.google.com.br/maps?q=" + endereco + "+" + numero + "+" + bairro + "+" + cidade + "'id = 'tb_pessoa_fisica_end_end' >" + endereco + "," + numero + "   " + complemento + " " + bairro + "   " + cidade + "   " + uf + "  -  " + cep + "</a>   " +
                                        "</div>" +
                                        "<div style='text-align: left;'>" +
                                        "<a  title='Vizinhos Relacionados ao endereço'href='../busca-endereco/?rua=" + endereco + "&numero=" + numero + "&bairro=" + bairro + "&cidade" + cidade + "&uf=" + uf + "&cep=" + cep + "&pessoa=juridica 'id='relacaoEndereco'><i class='fa fa-hospital-o'>&nbsp;&nbsp;</i></a>" +
                                        "</div>" +
                                        "<div style='text-align: right'>" +
                                        "<a  title='Pessoas Relacionadas ao endereço'href='../busca-endereco/?rua=" + endereco + "&numero=" + numero + "&bairro=" + bairro + "&cidade" + cidade + "&uf=" + uf + "&cep=" + cep + "&pessoa='fisica' 'id='relacaoEndereco'><i class='fa fa-search'>&nbsp;&nbsp;</i></a>" +
                                        "</div>" +
                                        "</div><br>";
                                $("#local").append(localizacao);
                            } else {

                                var i = 0;
                                var numeroAtual = parseInt(numero);
                                var res = '';
                                var res2 = '';
                                var numeroAtual2 = parseInt(numero);
                                var qtd = 10;
                                for (i; i < qtd; i++) {

                                    numeroAtual = numeroAtual + 1;
                                    if (i === qtd) {
                                        res = res + numeroAtual.toString();
                                    } else {
                                        res = res + numeroAtual.toString() + ",";
                                    }

                                    numeroAtual2 = numeroAtual2 - 1;
                                    if (numeroAtual2 > 0)
                                        if (i === qtd) {
                                            res2 = res2 + numeroAtual2.toString();
                                        } else {
                                            res2 = res2 + numeroAtual2.toString() + ",";
                                        }
                                }

                                var localizacao =
                                        "<div id = 'infoLocalizacao' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                        "<div class = '' style = 'float: left;width: 70%' >" +
                                        "Endereço : <a target='_blank' href='https://www.google.com.br/maps?q=" + endereco + "+" + numero + "+" + bairro + "+" + cidade + "'id = 'tb_pessoa_fisica_end_end' >" + endereco + "," + numero + "   " + complemento + " " + bairro + "   " + cidade + "   " + uf + "  -  " + cep + "</a>   " +
                                        "</div>" +
                                        "<div style='text-align: left;'>" +
                                        "<a  title='Vizinhos Relacionadas ao endereço'href='../busca-endereco/?numero=" + res + res2 + "&cep=" + cep + "&pessoa=juridica 'id='relacaoEndereco'><i class='fa fa-hospital-o' style'color:black;'>&nbsp;&nbsp;</i></a>" +
                                        "</div>" +
                                        "<div style='text-align: right'>" +
                                        "<a  title='Pessoas Relacionadas ao endereço'href='../busca-endereco/?rua=" + endereco + "&numero=" + numero + "&bairro=" + bairro + "&cidade" + cidade + "&uf=" + uf + "&cep=" + cep + "&pessoa=fisica 'id='relacaoEndereco'><i class='fa fa-search'>&nbsp;&nbsp;</i></a>" +
                                        "</div>" +
                                        "</div><br>";
                                $("#local").append(localizacao);
                            }
                        }
                    }
                }
            }

        }
        );
    }


    function localizacaoHtmlCpf(data) {

        var order = new Array();
        var orderCep = new Array();
        $.each(data, function (i) {

            var complemento;
            if (i === 0) {
                var passa = false;
            } else {
                var ant = i - 1;
                var anterior = data[ant].idtb_pessoa_fisica_end;
                var passa = false;
            }

            if (data[i].idtb_pessoa_fisica_end) {

                if (data[i].idtb_pessoa_fisica_end === anterior || passa) {

                } else {

                    var complemento;
                    var endereco;
                    var numero;
                    var bairro;
                    var cidade;
                    var uf;
                    var cep;
                    if (data[i].tb_pessoa_fisica_end_end) {
                        endereco = data[i].tb_pessoa_fisica_end_end;
                    } else {
                        endereco = " ";
                    }

                    if (data[i].tb_pessoa_fisica_end_num) {
                        numero = data[i].tb_pessoa_fisica_end_num;
                    } else {
                        numero = " ";
                    }

                    if (data[i].tb_pessoa_fisica_end_compl) {
                        complemento = data[i].tb_pessoa_fisica_end_compl;
                    } else {
                        complemento = " ";
                    }

                    if (data[i].tb_pessoa_fisica_end_bairro) {
                        bairro = data[i].tb_pessoa_fisica_end_bairro;
                    } else {
                        bairro = " ";
                    }

                    if (data[i].tb_pessoa_fisica_end_cidade) {
                        cidade = data[i].tb_pessoa_fisica_end_cidade;
                    } else {
                        cidade = " ";
                    }


                    if (data[i].tb_pessoa_fisica_end_uf) {
                        uf = data[i].tb_pessoa_fisica_end_uf;
                    } else {
                        uf = " ";
                    }

                    if (data[i].tb_pessoa_fisica_end_cep) {
                        cep = data[i].tb_pessoa_fisica_end_cep;
                    } else {
                        cep = " ";
                    }


                    if ($.inArray(numero, order) === -1) {
                        if ($.inArray(cep, orderCep) === -1) {

                            order.push(numero);
                            orderCep.push(cep);
                            if (complemento.search(/ap/i) === 0 || complemento.search(/sl/i) === 0 || complemento.search(/cj/i) === 0 || complemento.search(/lj/i) === 0) {

                                var localizacao =
                                        "<div id = 'infoLocalizacao' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                        "<div class = '' style = 'float: left;width: 70%' >" +
                                        "Endereço : <a target='_blank' href='https://www.google.com.br/maps?q=" + endereco + "+" + numero + "+" + bairro + "+" + cidade + "'id = 'tb_pessoa_fisica_end_end' >" + endereco + "," + numero + "   " + complemento + " " + bairro + "   " + cidade + "   " + uf + "  -  " + cep + "</a>   " +
                                        "</div>" +
                                        "<div style='text-align: left;'>" +
                                        "<a  title='Vizinhos Relacionados ao endereço'href='../busca-endereco/?rua=" + endereco + "&numero=" + numero + "&bairro=" + bairro + "&cidade" + cidade + "&uf=" + uf + "&cep=" + cep + "&pessoa=juridica 'id='relacaoEndereco'><i class='fa fa-hospital-o'>&nbsp;&nbsp;</i></a>" +
                                        "</div>" +
                                        "<div style='text-align: right'>" +
                                        "<a  title='Pessoas Relacionadas ao endereço'href='../busca-endereco/?rua=" + endereco + "&numero=" + numero + "&bairro=" + bairro + "&cidade" + cidade + "&uf=" + uf + "&cep=" + cep + "&pessoa=fisica 'id='relacaoEndereco'><i class='fa fa-search'>&nbsp;&nbsp;</i></a>" +
                                        "</div>" +
                                        "</div><br>";
                                $("#local").append(localizacao);
                            } else {

                                var i = 0;
                                var numeroAtual = parseInt(numero);
                                var res = '';
                                var res2 = '';
                                var numeroAtual2 = parseInt(numero);
                                var qtd = 10;
                                for (i; i < qtd; i++) {

                                    numeroAtual = numeroAtual + 1;
                                    if (i === qtd) {
                                        res = res + numeroAtual.toString();
                                    } else {
                                        res = res + numeroAtual.toString() + ",";
                                    }

                                    numeroAtual2 = numeroAtual2 - 1;
                                    if (numeroAtual2 > 0)
                                        if (i === qtd) {
                                            res2 = res2 + numeroAtual2.toString();
                                        } else {
                                            res2 = res2 + numeroAtual2.toString() + ",";
                                        }

                                }

                                var localizacao =
                                        "<div id = 'infoLocalizacao' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                        "<div class = '' style = 'float: left;width: 70%' >" +
                                        "Endereço : <a target='_blank' href='https://www.google.com.br/maps?q=" + endereco + "+" + numero + "+" + bairro + "+" + cidade + "'id = 'tb_pessoa_fisica_end_end' >" + endereco + "," + numero + "   " + complemento + " " + bairro + "   " + cidade + "   " + uf + "  -  " + cep + "</a>   " +
                                        "</div>" +
                                        "<div style='text-align: left;'>" +
                                        "<a  title='Vizinhos Relacionadas ao endereço'href='../busca-endereco/?numero=" + res + res2 + "&cep=" + cep + "&pessoa=juridica 'id='relacaoEndereco'><i class='fa fa-hospital-o' style'color:black;'>&nbsp;&nbsp;</i></a>" +
                                        "</div>" +
                                        "<div style='text-align: right'>" +
                                        "<a  title='Pessoas Relacionadas ao endereço'href='../busca-endereco/?rua=" + endereco + "&numero=" + numero + "&bairro=" + bairro + "&cidade" + cidade + "&uf=" + uf + "&cep=" + cep + "&pessoa=fisica 'id='relacaoEndereco'><i class='fa fa-search'>&nbsp;&nbsp;</i></a>" +
                                        "</div>" +
                                        "</div><br>";
                                $("#local").append(localizacao);
                            }
                        }
                    }
                }
            }
        });
    }

    function porteReceita(qtdFuncionarios, cnae) {

        var iniCnae = cnae.toString().substring(0, 2);
        var qtdFuncionarios = qtdFuncionarios.toString();
        //industria
        if (iniCnae >= '5' & iniCnae <= '43') {

            if (qtdFuncionarios >= 1 & qtdFuncionarios <= 19) {
                $("#porte").html('Micro (Industria)');
                $("#fpresumido").html("Até R$1200 mil");
            }
            if (qtdFuncionarios >= 20 & qtdFuncionarios <= 99) {
                $("#porte").html('Pequena (Industria)');
                $("#fpresumido").html("De R$1200 mil a R$10500 mil");
            }
            if (qtdFuncionarios >= 100 & qtdFuncionarios <= 499) {
                $("#porte").html('Média (Industria)');
                $("#fpresumido").html("De R$10500 mil a R$60 milhões");
            }
            if (qtdFuncionarios > 499) {
                $("#porte").html('Grande (Industria)');
                $("#fpresumido").html("Acima de R$60 milhões");
            }
        }

//comercio
        if (iniCnae >= '45' & iniCnae <= '47' || iniCnae >= '90' & iniCnae <= '99') {

            if (qtdFuncionarios >= 1 & qtdFuncionarios <= 9) {
                $("#porte").html('Micro (Comercio)');
                $("#fpresumido").html("Até R$1200 mil");
            }
            if (qtdFuncionarios >= 10 & qtdFuncionarios <= 49) {
                $("#porte").html('Pequena (Comercio)');
                $("#fpresumido").html("De R$1200 mil a R$10500 mil");
            }
            if (qtdFuncionarios >= 50 & qtdFuncionarios <= 99) {
                $("#porte").html('Media (Comercio)');
                $("#fpresumido").html("De R$10500 mil a R$60 milhões");
            }
            if (qtdFuncionarios > 99) {
                $("#porte").html('Grande (Comercio)');
                $("#fpresumido").html("Acima de  R$60 milhões");
            }
        }

//servicos e agropecuaria
        if (iniCnae >= '49' & iniCnae <= '88' || iniCnae >= '1' & iniCnae <= '3') {

            if (qtdFuncionarios >= 1 & qtdFuncionarios <= 9) {
                $("#porte").html('Micro (Serviços )');
                $("#fpresumido").html("Até R$1200 mil");
            }
            if (qtdFuncionarios >= 10 & qtdFuncionarios <= 49) {
                $("#porte").html('Pequena (Serviços)');
                $("#fpresumido").html("De R$1200 mil a R$10500 mil");
            }
            if (qtdFuncionarios >= 50 & qtdFuncionarios <= 99) {
                $("#porte").html('Media (Serviços)');
                $("#fpresumido").html("De R$10500 mil a R$60 milhões"); // repete tudo 



            }
            if (qtdFuncionarios > 99) {
                $("#porte").html('Grande (Serviços)');
                $("#fpresumido").html("Acima de R$60 milhões");
            }
        }
    }

    function buscarCnpfCnpj() {


//esconde icones
        $("#situacaoCadastroPage").hide();
        $("#perfilsocialPage").hide();
        $("#perfilconsumoPage").hide();
        $("#pessoasempresasrelacionadasPage").hide();
        $("#participacaoemprePage").hide();
        $("#quemconsultouPage").hide();
        $("#msg").hide();
        //fecha abas ao buscar
        $("#obito").hide();
        $("#outrostelefone").hide();
        $("#email").hide();
        $("#perfilsocialdiv").hide();
        $("#perfilconsumodiv").hide();
        //limpa buscas
        $("#partempreMostrar").html('<div id="partempreMostrar"><div id="participacaoemprediv1"><div id="participacaoempre"></div></div></div>');
        $("#localizacao1").html(' <div id="localizacao1"><div id="local"></div>');
        $("#telefone1").html('<div id="telefone1"><div id="tel"></div><br></div>');
        $("#mail1").html('<div id="mail1"><div id="mail"></div><br></div>');
        $("#infoObt").html('<div id="infoObt"><div id="infoTop"></div>');
        //perfil social
        $("#capsocial").html('<A id="capsocial"></A>');
        $("#porte").html('<A id="porte"></A>');
        $("#fpresumido").html('<A id="fpresumido"></A>');
        $("#qtdpropietarios").html('<A id="qtdpropietarios"></A>');
        $('#qtdfuncionarios').html('<A id="qtdfuncionarios"></A>');
        $("#inscestadual").html('<A id="inscestadual"></A>');
        //situacao
        $("#tb_pessoa_juridica_situacao").html('<A id="tb_pessoa_juridica_situacao"></A>');
        $("#tb_pessoa_juridica_data_situacao").html('<A id="tb_pessoa_juridica_data_situacao"></A>');
        $("#mostraBusca").show();
        $("#busca2").addClass("active");
        var cpfCnpj = $('#cpf_cnpj').val().replace(/[^\d]+/g, '');
        var idtbVendedor = $("#idtbVendedor").val();



        validar(cpfCnpj);


        $.getJSON("../pages/php/buscaCpfCnpj.php?busca=" + cpfCnpj + "&loginEmpresa=" + $('#loginEmpresa').val() + "&cnpjEmpresa=" + $('#cnpjEmpresa').val() + "&idtbVendedor=" + idtbVendedor,
                function (data, status) {

                    $("#qtdpropietarios").html(data[0].qtdProprietarios);



                    //pj---------------------//
                    if (cpfCnpj.length === 14) {

                        $("#participacaoempre").html("<div  style='width: 100%;'class='btn btn-primary btn-xsGrande' id='participacaoempre'><i class='fa fa-fw  fa-paperclip' style='width: 15px;'></i>&nbsp;P. Societária &nbsp;</div>");
                        if (data.length > 0) {

                            $('#cpf1').val('');
                            $("#liObito").hide();
                            $("#liemail").hide();
                            $("#dadosCadastraisCpf").hide();
                            $("#dadosCadastraisCnpj").show(600);
                            $("#liSitCadast").show(600);
                            $("#tb_pessoa_juridica_cnpj").html(formataCnpj(cpfCnpj));
                            $("#cpf_cnpj_redirect").html(formataCnpj(cpfCnpj));
                            //dados cadastrais          
                            var nome = data[0].tb_pessoa_juridica_nome;
                            var fantasia = data[0].tb_pessoa_juridica_fantasia;
                            var qtdEmpregados = data[0].tb_pessoa_juridica_qtd_empregados;
                            var cnae = data[0].tb_pessoa_juridica_cnae.toString();
                            var descCnae = data[0].tb_cnae_desc_secao;
                            var natureza = data[0].tb_pessoa_juridica_id_natureza;
                            var descNatureza = data[0].tb_natureza_descricao;
                            if (descNatureza === null || descNatureza === "null") {
                                descNatureza = "";
                            }

                            porteReceita(qtdEmpregados, cnae);
                            if (nome.trim() === "null") {
                                nome = "";
                            }
                            if (fantasia.trim() === "null") {
                                fantasia = "";
                            }

                            if (descCnae === null || descCnae === "null") {
                                descCnae = "";
                            }
                            if (cnae.trim() === "null") {
                                cnae = "";
                            }
                            if (natureza.trim() === "null") {
                                natureza = "";
                            }
                            if (qtdEmpregados.trim() === "null") {
                                qtdEmpregados = "";
                            }
                            $("#tb_pessoa_juridica_nome").html(nome);
                            $("#cnpj1").val(formataCnpj(cpfCnpj));
                            $("#dataAbertura").val(formataData(data[0].tb_pessoa_juridica_data_nascimento));
                            $("#razaoSocial").val(data[0].tb_pessoa_juridica_nome);
                            $("#fantasia").val(fantasia);
                            $("#cnae1").val(cnae + " " + descCnae);
                            $("#naturezaJuridica").val(natureza + " - " + descNatureza);
                            $("#qtdfuncionarios").html(qtdEmpregados);
                            if (data[0].tb_pessoa_juridica_matriz === "M") {
                                $("#matriz").val("Matriz");
                            } else {
                                $("#matriz").val("Filial");
                            }
//situação                    
                            //localização 1 

                            localizacaoHtmlCnpj(data);
                            //telefones pj


                            var imgProcon;
                            $.getJSON("../pages/php/buscaTelefoneDoc.php?busca=" + cpfCnpj,
                                    function (data, status) {

                                        $.each(data, function (i) {
                                            $.ajax({url: "../pages/php/buscaProcon.php?busca=" + data[i].tb_pessoa_fisica_fones_ddd + data[i].tb_pessoa_fisica_fones_fone, success: function (result) {

                                                    //  imgProcon = $.getJSON("../pages/php/buscaProcon.php?busca=" + data[i].tb_pessoa_fisica_fones_ddd + data[i].tb_pessoa_fisica_fones_fone,
                                                    // function (retorno, status) {
                                                    imgProcon = '';

                                                    if (result != "") {
                                                        imgProcon = "<img src='../dist/img/procon_logo.gif' width=30 height=30  align='center'/>";
                                                    }

                                                    if (i <= 10)
                                                        var tel =
                                                                "<div id = 'infoTelefone' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                                                "Telefone : <A href='../busca-tel/?ddd=" + data[i].tb_pessoa_fisica_fones_ddd + "&fone=" + data[i].tb_pessoa_fisica_fones_fone + "&pessoa=fisica'>(" + data[i].tb_pessoa_fisica_fones_ddd + ") " + data[i].tb_pessoa_fisica_fones_fone + "</A>&nbsp;&nbsp;&nbsp;" +
                                                                imgProcon + "<div  style = 'float:right' >" +
                                                                //"<div>Data: " + data[i].tb_pessoa_fisica_fones_data + "</div>" +
                                                                "<div style='text-align: right'>" +
                                                                "<a  title='Telefones Relacionados 'href='../busca-tel/?ddd=" + data[i].tb_pessoa_fisica_fones_ddd + "&fone=" + data[i].tb_pessoa_fisica_fones_fone + "&pessoa=juridica'><i class='fa fa-search'>&nbsp;&nbsp;</i></a>" +
                                                                "</div>" +
                                                                "<div  style = 'float:right' >" +
                                                                "</div>" +
                                                                "</div>";
                                                    $("#tel").append(tel);
                                                    return;
                                                }});
                                            //});
                                        });//each
                                    });//getJSON

                            //situacao
                            $("#tb_pessoa_juridica_id_natureza").html(data[0].tb_pessoa_juridica_id_natureza);
                            $("#tb_pessoa_juridica_matriz").html(data[0].tb_pessoa_juridica_matriz);
                            $("#tb_pessoa_juridica_porte").html(data[0].tb_pessoa_juridica_porte);
                            //$("#porte").html(data[0].tb_pessoa_juridica_porte);

                            $("#msg").hide();
                        } else {
                            $("#mostraBusca").hide();
                            alertModal("Não encontrado", "danger");
                        }
                    } else {
                        //cpf------------------------------------------//

                        $("#nomeMae").val('');
                        $("#participacaoempre").html("<div  style='width: 100%;'class='btn btn-primary btn-xsGrande' id='participacaoempre'><i class='fa fa-fw  fa-paperclip' style='width: 6px;'></i>&nbsp;Part. em Empresas &nbsp;</div>");
                        $.getJSON("../pages/php/buscaMae.php?cpfFilho=" + cpfCnpj,
                                function (data, status) {
                                    if (data[0]['tb_pessoa_fisica_mae_nome_mae'].length != 0)
                                        var nomeMae = data[0]['tb_pessoa_fisica_mae_nome_mae'];
                                    $("#buscaMae").html("<div id='buscaMae' style='float: right;'><a href='../busca-nome/?nome=" + nomeMae + "'<i class='fa fa-search'>&nbsp;&nbsp;</i></a></div>")
                                    if (data.length !== 0)
                                        $("#nomeMae").val(data[0]['tb_pessoa_fisica_mae_nome_mae']);
                                });
                        if (data.length > 0) {//esconde icones
                            $("#situacaoCadastroPage").hide();
                            $("#perfilsocialPage").hide();
                            var nome = data[0].tb_pessoa_fisica_nome;
                            $("#dadosCadastraisCnpj").hide();
                            $("#dadosCadastraisCpf").show(600);
                            $("#liObito").show(600);
                            $("#liSitCadast").hide();
                            $("#liemail").show(600);
                            $("#cpf1").val(($("#cpf_cnpj").val()));
                            $("#tb_pessoa_juridica_cnpj").html(($("#cpf_cnpj").val()));
                            $("#cpf_cnpj_redirect").val(($("#tb_pessoa_juridica_cnpj").val()));
                            $("#tb_pessoa_juridica_nome").html(nome);
                            $("#nome").val(nome);
                            //$("#nomeMae").val(data[0].tb_pessoa_fisica_nome_mae);

                            if (data[0].tb_pessoa_fisica_data_nascimento)
                                $("#dataNascimento").val(formataData(data[0].tb_pessoa_fisica_data_nascimento));


                            var a = new Date();
                            if (a.getMonth() < 10) {
                                var zeroMes = "0";
                            }
                            if (a.getDate() < 10) {
                                var zeroDia = "0";
                            }

                            var anoAtual = a.getFullYear();
                            var mesAtual = a.getMonth();

                            var mesAniversario = parseInt(data[0].tb_pessoa_fisica_data_nascimento.substr(4, 2));
                            var dataNascimento = (data[0].tb_pessoa_fisica_data_nascimento.substr(0, 4) + "" + data[0].tb_pessoa_fisica_data_nascimento.substr(4, 2) + "" + data[0].tb_pessoa_fisica_data_nascimento.substr(6, 2));
                            var anoNascimento = data[0].tb_pessoa_fisica_data_nascimento.substr(0, 4);
                            var diferenca = anoAtual - anoNascimento;
                            if (mesAtual < mesAniversario) {
                                var diferenca = (anoAtual - anoNascimento) - 1;
                            }

                            if (diferenca < 18) {
                                alertModal("Consulta não autorizada", "danger");
                                $("#mostraBusca").hide();
                            }

                            //$("#idade").val(diferenca.toString().substr(0, 2));
                            if (diferenca < 180)
                                $("#idade").val(diferenca.toString().substr(0, 3));
                            signo(dataNascimento);
                            //aqui
                            if (data[0].tb_pessoa_fisica_sexo === 'F') {

                                $("#feminino").attr("checked", true);
                                $("#masculino").attr("checked", false);
                            } else {

                                $("#masculino").attr("checked", true);
                                $("#feminino").attr("checked", false);
                            }
                            //localização 2
                            localizacaoHtmlCpf(data);
                            //telefones
//var imgProcon;
                            $.getJSON("../pages/php/buscaTelefoneDoc.php?busca=" + cpfCnpj,
                                    function (data, status) {

                                        $.each(data, function (i) {
                                            $.ajax({url: "../pages/php/buscaProcon.php?busca=" + data[i].tb_pessoa_fisica_fones_ddd + data[i].tb_pessoa_fisica_fones_fone, success: function (result) {

                                                    //  imgProcon = $.getJSON("../pages/php/buscaProcon.php?busca=" + data[i].tb_pessoa_fisica_fones_ddd + data[i].tb_pessoa_fisica_fones_fone,
                                                    // function (retorno, status) {
                                                    imgProcon = '';

                                                    if (result != "") {
                                                        imgProcon = "<img src='../dist/img/procon_logo.gif' width=30 height=30  align='center'/>";
                                                    }

                                                    if (i <= 10)
                                                        var tel =
                                                                "<div id = 'infoTelefone' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                                                "Telefone : <A href='../busca-tel/?ddd=" + data[i].tb_pessoa_fisica_fones_ddd + "&fone=" + data[i].tb_pessoa_fisica_fones_fone + "&pessoa=fisica'>(" + data[i].tb_pessoa_fisica_fones_ddd + ") " + data[i].tb_pessoa_fisica_fones_fone + "</A>&nbsp;&nbsp;&nbsp;" +
                                                                imgProcon + "<div  style = 'float:right' >" +
                                                                //"<div>Data: " + data[i].tb_pessoa_fisica_fones_data + "</div>" +
                                                                "<div style='text-align: right'>" +
                                                                "<a  title='Telefones Relacionados 'href='../busca-tel/?ddd=" + data[i].tb_pessoa_fisica_fones_ddd + "&fone=" + data[i].tb_pessoa_fisica_fones_fone + "&pessoa=juridica'><i class='fa fa-search'>&nbsp;&nbsp;</i></a>" +
                                                                "</div>" +
                                                                "<div  style = 'float:right' >" +
                                                                "</div>" +
                                                                "</div>";
                                                    $("#tel").append(tel);
                                                    return;
                                                }});
                                            //});
                                        });//each
                                    });//getJSON


                            /*
                             var order = new Array();
                             $.each(data, function (i) {
                             
                             
                             if (i === 0) {
                             var passa = false;
                             } else {
                             var ant = i - 1;
                             var anterior = data[ant].idtb_pessoa_fisica_fones;
                             }
                             
                             if (data[i].tb_pessoa_fisica_fones_fone) {
                             
                             if (data[i].idtb_pessoa_fisica_fones === anterior || passa) {
                             
                             } else {
                             
                             if ($.inArray(data[i].tb_pessoa_fisica_fones_fone, order) === -1) {
                             
                             if (data[i].tb_procon_fone) {
                             var imgProcon = "<img src='../dist/img/procon_logo.gif' width=30 height=30  align='center'/>";
                             } else {
                             var imgProcon = "";
                             }
                             
                             order.push(data[i].tb_pessoa_fisica_fones_fone);
                             if (i <= 10)
                             var tel =
                             "<div id = 'infoTelefone' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                             "Telefone : <A href='../busca-tel/?ddd=" + data[i].tb_pessoa_fisica_fones_ddd + "&fone=" + data[i].tb_pessoa_fisica_fones_fone + "&pessoa=fisica'>(" + data[i].tb_pessoa_fisica_fones_ddd + ") " + data[i].tb_pessoa_fisica_fones_fone + "</A>&nbsp;&nbsp;&nbsp;" +
                             imgProcon + "<div  style = 'float:right' >" +
                             "<div>Data: "+ data[i].tb_pessoa_fisica_fones_data+"</div>"+
                             "<div style='text-align: right'>" +
                             "<a  title='Telefones Relacionados 'href='../busca-tel/?ddd=" + data[i].tb_pessoa_fisica_fones_ddd + "&fone=" + data[i].tb_pessoa_fisica_fones_fone + "&pessoa=juridica'><i class='fa fa-search'>&nbsp;&nbsp;</i></a>" +
                             "</div>" +
                             "<div  style = 'float:right' >" +
                             "</div>"+
                             
                             "</div>";
                             $("#tel").append(tel);
                             }
                             }
                             }
                             });
                             */
                        } else {
                            $("#mostraBusca").hide();
                        }
                    }

                }).error(function (e) {

            $("#mostraBusca").hide();
            if (e.responseText) {
                alertModal(e.responseText, "danger");
            } else {
                alertModal("Não encontrado", "danger");
            }
        });
    }

    function buscaTelefone() {
        var telefone = $('#telBusca').val().replace(/[^\d]+/g, '');
        var ddd = $('#dddBusca').val();
        var pessoa = $('#pessoa').val();
        $("#res").html(' <div id="res">');
        $("#mostraBusca").show();
        $("#resultado").show();
        $("#imagemLoad").show();
        $.getJSON("../pages/php/buscaTelefone.php?telefone=" + telefone + "&ddd=" + ddd + "&loginEmpresa=" + $('#loginEmpresa').val() + "&cnpjEmpresa=" + $('#cnpjEmpresa').val() + "&pessoa=" + pessoa,
                function (data, status) {

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
                }).error(function () {

            $("#mostraBusca").hide();
            alertModal("Não encontrado", "danger");
        }).always(function () {
            $("#imagemLoad").hide();
        });
    }

    function buscaNome() {

        var nomeDigitado = $('#nomeBusca').val();
        var pessoa = $('#pessoa').val();
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
        $.getJSON("../pages/php/buscaNome.php?nome=" + nomeDigitado + "&loginEmpresa=" + $('#loginEmpresa').val() + "&cnpjEmpresa=" + $('#cnpjEmpresa').val() + "&idtbVendedor=" + idtbVendedor + "&pessoa=" + pessoa + "&nomeFantasia=" + nomeFantasia,
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
                            //var nome = $('#nomeBusca').val();
                            var pessoa = $('#pessoa').val();
                            if (uf) {
                                uf = uf;
                            } else {
                                uf = "&nbsp;&nbsp;";
                            }

                            var resultado =
                                    //"<div id = 'result' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;height: 25px;' >"+
                                    "<table>" +
                                    "<tr>" +
                                    "<td><A href='../busca-doc/?cpfcnpj=" + numDocumento + "&idtbVendedor=" + idtbVendedor + "'>" + numDocumento + "</A></td>" +
                                    "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>" +
                                    "<td width='400' ><A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + nome.substring(0, 60) + "</A></td>" +
                                    "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>" +
                                    "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>" +
                                    "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>" +
                                    "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>" +
                                    "<td width='200'> <A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + cidade + "</A></td>" +
                                    "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>" +
                                    "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>" +
                                    "<td><A href='../busca-doc/?cpfcnpj=" + numDocumento + "' >" + uf + "</A></td>" +
                                    "</tr>" +
                                    "</table>"
                                    //"</div>"
                                    ;
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

    function buscaEndereco() {
        var endereco = $('#enderecoBusca').val();
        var numero = $('#enderecoNumeroBusca').val();
        var bairro = $('#enderecoBairroBusca').val();
        var cidade = $('#enderecoCidadeBusca').val();
        var uf = $('#enderecoUfBusca').val();
        var cep = $('#enderecoCepBusca').val();
        var pessoa = $('#pessoa').val();
        $("#resultado").show();
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
                }).error(function () {

            $("#mostraBusca").hide();
            alertModal("Não encontrado", "danger");
        }).always(function () {

            $("#imagemLoad").hide();
        });
    }
}
);
function mascaraMutuario(o, f) {
    v_obj = o
    v_fun = f
    setTimeout('execmascara()', 1)
}

function execmascara() {
    v_obj.value = v_fun(v_obj.value)
}

function cpfCnpj(v) {

//Remove tudo o que não é dígito
    v = v.replace(/\D/g, "")// repete tudo 

    if (v.length <= 11) { //CPF
//valida_cpf('form_consulta',v);
//Coloca um ponto entre o terceiro e o quarto dígitos
        v = v.replace(/(\d{3})(\d)/, "$1.$2");
        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v = v.replace(/(\d{3})(\d)/, "$1.$2");
        //Coloca um hífen entre o terceiro e o quarto dígitos         
        v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    } else { //CNPJ

//valida_cnpj('form_consulta',v);
//Coloca ponto entre o segundo e o terceiro dígitos
        v = v.replace(/^(\d{2})(\d)/, "$1.$2");
        //Coloca ponto entre o quinto e o sexto dígitos
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
        //Coloca uma barra entre o oitavo e o nono dígitos         
        v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
        //Coloca um hífen depois do bloco de quatro dígitos
        v = v.replace(/(\d{4})(\d)/, "$1-$2");
    }
    return v;
}


// a função principal de validação
function validar(objEnviado) { // recebe um objeto

    var obj = eval("{'" + objEnviado + "'}");
    var s = obj.replace(/\D/g, '');
    var tam = (s).length; // removendo os caracteres não numéricos
    if (!(tam == 11 || tam == 14)) { // validando o tamanho
        var texto = ' Não é um CPF ou um CNPJ válido!';
        $("#erroValCnpjCpf").html("<div id'erroValCnpjCpf'><div id='msg' class='alert alert-danger role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span> " + texto + "</div></div>");
        return;
    }

// se for CPF
    if (tam == 11) {
        if (!validaCPF(s)) { // chama a função que valida o CPF
            var texto = 'Não é um CPF válido';
            $("#erroValCnpjCpf").html("<div id'erroValCnpjCpf'><div id='msg' class='alert alert-danger role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span> " + texto + "</div></div>");

            return false;
        }
        return true;
    }

// se for CNPJ			
    if (tam == 14) {
        if (!validaCNPJ(s)) { // chama a função que valida o CNPJ
            var texto = 'Não é um CNPJ válido';
            $("#erroValCnpjCpf").html("<div id'erroValCnpjCpf'><div id='msg' class='alert alert-danger role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span> " + texto + "</div></div>");
            return false;
        }
        //alert("'" + s + "' É um CNPJ válido!"); // se quiser mostrar que validou				
        //obj.value = maskCNPJ(s);	// se validou o CNPJ mascaramos corretamente
        return true;
    }
}
// fim da funcao validar()

// função que valida CPF
// O algorítimo de validação de CPF é baseado em cálculos
// para o dígito verificador (os dois últimos)
// Não entrarei em detalhes de como funciona
function validaCPF(s) {
    var c = s.substr(0, 9);
    var dv = s.substr(9, 2);
    var d1 = 0;
    for (var i = 0; i < 9; i++) {
        d1 += c.charAt(i) * (10 - i);
    }
    if (d1 == 0)
        return false;
    d1 = 11 - (d1 % 11);
    if (d1 > 9)
        d1 = 0;
    if (dv.charAt(0) != d1) {
        return false;
    }
    d1 *= 2;
    for (var i = 0; i < 9; i++) {
        d1 += c.charAt(i) * (11 - i);
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9)
        d1 = 0;
    if (dv.charAt(1) != d1) {
        return false;
    }
    return true;
}

// Função que valida CNPJ
// O algorítimo de validação de CNPJ é baseado em cálculos
// para o dígito verificador (os dois últimos)
// Não entrarei em detalhes de como funciona
function validaCNPJ(CNPJ) {
    var a = new Array();
    var b = new Number;
    var c = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    for (i = 0; i < 12; i++) {
        a[i] = CNPJ.charAt(i);
        b += a[i] * c[i + 1];
    }
    if ((x = b % 11) < 2) {
        a[12] = 0
    } else {
        a[12] = 11 - x
    }
    b = 0;
    for (y = 0; y < 13; y++) {
        b += (a[y] * c[y]);
    }
    if ((x = b % 11) < 2) {
        a[13] = 0;
    } else {
        a[13] = 11 - x;
    }
    if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])) {
        return false;
    }
    return true;
}

   