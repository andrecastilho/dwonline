$(document).ready(function () {


    //-----------aqui //---------------//
    



    $.getJSON("../pages/php/buscaVendedores.php?cnpj=" + $('#cnpj_adm').val(),
            function (data, status) {

                var options = "";
                $.each(data, function (i) {
                    options += '<option value="' + data[i].idtb_usuario + '">' + data[i].tb_usuario_nome + ' - ' + data[i].tb_usuario_cnpj_empresa + ' - ' + data[i].tb_empresa_nome + '</option>';

                });
                $("#tb_empresa_id_vendedor").append(options);
            });



    $.getJSON("../pages/php/buscaCnpj_tb_empresa.php?cnpj=" + $('#cnpj_adm').val() + "&razao=" + $('#buscarRazao').val(),
            function (data, status) {

                $("#mostraBuscaEmpresa").fadeIn();
                $("#buscarEmrepsa").fadeIn();
                $('#btnExcluirtEmpresa').removeAttr('disabled');
                $('#btnAtualizaEmpresa').removeAttr('disabled');
                $("[name='tb_empresa_cnpj_envio']").val($("#cnpj").val());
                //var cnpj = $("#tb_empresa_cnpj").val();

                //VERIFICAR CONSISTENCIA check box
                if (data.tb_empresa_cnpj) {

                    //webservice
                    if (data.tb_empresa_webservice === null) {
                        $("#divwebservice").prop('checked', false);
                    } else {
                        $("#divwebservice").prop('checked', true);
                    }

                    //online
                    if (data.tb_empresa_online === null) {
                        $("#divonline").prop('checked', false);
                    } else {
                        $("#divonline").prop('checked', true);
                    }

                    //enriquecimento
                    if (data.tb_empresa_enriquecimento === null) {
                        $("#divenriquecimento").prop('checked', false);
                    } else {
                        $("#divenriquecimento").prop('checked', true);
                    }

                    if (data.tb_empresa_permite_excedente === null) {
                        $("#excedente").prop('checked', false);
                    } else {
                        $("#excedente").prop('checked', true);
                    }

                    $("[name='tb_empresa_cnpj_envio']").val(data.tb_empresa_cnpj);
                    $("[name='tb_empresa_cnpj']").val(data.tb_empresa_cnpj);
                    $("[name='tb_empresa_matriz']").val(data.tb_empresa_matriz);
                    $("[name='tb_empresa_nome']").val(data.tb_empresa_nome);
                    $("[name='tb_empresa_fantasia']").val(data.tb_empresa_fantasia);
                    $("[name='tb_empresa_numero_empregados']").val(data.tb_empresa_numero_empregados);
                    $("[name='tb_empresa_endereco']").val(data.tb_empresa_endereco);
                    $("[name='tb_empresa_numero']").val(data.tb_empresa_numero);
                    $("[name='tb_empresa_complemento']").val(data.tb_empresa_complemento);
                    $("[name='tb_empresa_cep']").val(data.tb_empresa_cep);
                    $("[name='tb_empresa_bairro']").val(data.tb_empresa_bairro);
                    $("[name='tb_empresa_cidade']").val(data.tb_empresa_cidade);
                    $("[name='tb_empresa_uf']").val(data.tb_empresa_uf);
                    $("[name='tb_empresa_id_vendedor_mostra']").val(data.tb_empresa_id_vendedor);
                    $("[name='tb_empresa_id_vendedor']").val(data.tb_empresa_id_vendedor);
                    $("[name='tb_empresa_valor_pacote']").val(data.tb_empresa_valor_pacote);
                    $("[name='tb_empresa_qtd_contratada']").val(data.tb_empresa_qtd_contratada);
                    $("[name='tb_empresa_valor_unitario']").val(data.tb_empresa_valor_unitario);
                    $("[name='tb_empresa_valor_unitario_mostra']").val(data.tb_empresa_valor_unitario);
                    $("[name='tb_empresa_qtd_usuarios']").val(data.tb_empresa_qtd_usuarios);
                    $("[name='tb_empresa_valor_unitario']").val(data.tb_empresa_valor_unitario);
                    $("[name='tb_empresa_enriquecimento']").val(data.tb_empresa_enriquecimento);
                    $("[name='tb_empresa_unitario_execedente']").val(data.tb_empresa_unitario_execedente);
                    $("[name='tb_empresa_permite_excedente']").val(data.tb_empresa_permite_excedente);
                    $("[name='codigo_web_service']").val(data.tb_empresa_codigo_web_service);

                } else {

                    var items = [];
                    $("#mostraBuscaEmpresa").fadeOut();
                    $("#retornoAllEmpresas").html(' ');
                    $.each(data, function (i) {
                        items.push("<a><li onclick=chama(this.id," + data[i].tb_empresa_cnpj + ");  id='" + data[i].tb_empresa_cnpj + "'>Nome:  " + data[i].tb_empresa_nome + "<br>CNPJ:  " + data[i].tb_empresa_cnpj + "</li></a><br>");
                    });
                    $("<ul/>", {
                        "id": "myul",
                        html: items.join("")
                    }).appendTo($("#retornoAllEmpresas"));
                }
            });

//adm usuario
    $("#btnExcluirUsuario").show(600);
    $("#btnInsertUser").show(600);
    $("#btnExcluirUsuario1").show(600);
    var perfilAtual = $('#perfilAtualHidden').val();
    $('#btnInsertUser').removeAttr('disabled');
    //$('#btnExcluirUsuario').removeAttr('disabled');
    $.getJSON("../pages/php/buscaEmail_tb_usuario.php?cnpj=" + $("[name='tb_usuario_cnpj_empresa']").val() + "&email=" + $('#tb_usuario_username_email_adm').val(),
            function (data, status) {

                $("#mostraBuscaPessoa").fadeIn();
                $("[name='tb_usuario_nome']").focus();
                if (parseInt(data.tb_usuario_id_perfil) < parseInt(perfilAtual)) {
                    $("#mostraBuscaPessoa").fadeOut();
                    $("[name='tb_usuario_username_email']").focus();
                    alertModal("Seu perfil não atualiza usuários superiores", "info");
                } else {
                    $("#infoCnpj").html(' ');
                    $("#msg").html(' ');
                    $("#infoEmail").html(' ');
                    $("#modal").html(' ');
                }
                //VERIFICAR CONSISTENCIA
                if (data.tb_usuario_username_email) {

                    $("[name='tb_usuario_cpf_tb_usuario']").val(data.tb_usuario_cpf);
                    $("[name='tb_usuario_nome']").val(data.tb_usuario_nome);
                    $("[name='tb_usuario_id_perfil']").val(data.tb_usuario_id_perfil);
                    $("[name='tb_usuario_username_email']").val(data.tb_usuario_username_email);
                    $("[name='tb_usuario_validade']").val(data.tb_usuario_validade);
                    if (data.tb_usuario_ativo === "on") {

                        $("[name='tb_usuario_ativo']").attr("checked", true);
                    } else {
                        $("[name='tb_usuario_ativo']").attr("checked", false);
                    }
                    if (data.tb_usuario_e_vendedor === "on") {
                        $("[name='tb_usuario_e_vendedor']").attr("checked", true);
                    } else {
                        $("[name='tb_usuario_e_vendedor']").attr("checked", false);
                    }
                } else {

                    $("#mostraBuscaPessoa").fadeOut();
                    var items = [];
                    $("#retornoAllusers").html(' ');
                    $.each(data, function (i) {
                        items.push("<a ><li onclick=chama(this.id," + data[i].tb_empresa_cnpj + ");  id='" + data[i].tb_usuario_username_email + "'> Nome:  " + data[i].tb_usuario_nome + "<br>Email:  " + data[i].tb_usuario_username_email + "</li></a><br>");
                    });
                    $("<ul/>", {
                        "class": "",
                        html: items.join("")
                    }).appendTo($("#retornoAllusers"));
                }
            });

    $(".form-control").keyup(function () {
        $(this).val($(this).val().toUpperCase());
    });

    $("#mostraBuscaEmpresa").fadeOut();
    $("#mostraBuscaPessoa").fadeOut();
    $('#btnInsertUser').attr('disabled', 'disabled');
    $('#btnExcluirtUser').attr('disabled', 'disabled');
    //$('#btnExcluirUsuario').attr('disabled', 'disabled');
    $('#btnExcluirtEmpresa').attr('disabled', 'disabled');
    $('#btnAtualizaEmpresa').attr('disabled', 'disabled');
    $("[name='tb_empresa_valor_unitario_mostra']").attr('disabled', 'disabled');
    $("[name='codigo_web_service']").fadeOut();
    $("#unitario_excedente").fadeOut();
    $("#btnInsertUser").hide();
    $("#btnExcluirUsuario1").hide();
    $("#btnAtualizaEmpresa").hide();
    $("#btnExcluirtEmpresa").hide();
    $("#btnExcluirEmpresa1").hide();
    //$("#btnExcluirUsuario").hide();
    $("#cnpjMostrar").hide();
    var perfilAtual = $('#perfilAtualHidden').val();
    if (perfilAtual === '1') {
        $("#cnpjMostrar").show(200);
    }

    $("[name='tb_empresa_permite_excedente']").click(function () {

        $("#unitario_excedente").fadeIn();
    });
    $("[name='webservice']").click(function () {

        $("[name='codigo_web_service']").fadeIn();
    });
//VALIDAÇÕES
    $("#cnpj").blur(function () {

        if (validarCNPJ(String($("#cnpj").val()))) {

            $('#buscarEmrepsa').removeAttr('disabled');
        } else {

            $('#buscarEmrepsa').attr('disabled', 'disabled');
            $("#cnpj").focus();
            alertModal('CNPJ inválido ', 'danger');
            //$("#infoCnpj").html("<div id='infoCnpj' style='color:red'>CNPJ inválido</div>");

        }


        $.getJSON("../pages/php/buscaCnpj_tb_empresa.php?cnpj=" + $('#cnpj').val(),
                function (data, status) {
                    if (data !== false) {
                        $("#infoCnpj").html("<div id='infoCnpj' style='color:red'>Empresa já cadastrada</div>");
                        $("#cnpj").focus();
                        $("#mostraBuscaEmpresa").fadeOut();
                        alertModal("Empresa já cadastrada", "info");
                    } else {
                        $('#mostraBuscaEmpresa').hide();
                        //$('#msg').html(' ');
                        $("#infoCnpj").html(' ');
                    }
                });
    });

    $("#cnpj_adm").blur(function () {

        if (validarCNPJ(String($("#cnpj_adm").val()))) {

            $('#buscarEmrepsa').removeAttr('disabled');
        } else {

            //$("#infoCnpj").html("<div id='infoCnpj' style='color:red'>CNPJ inválido </div>");
            //$("#cnpj_adm").focus();
            //alertModal('CNPJ inválido ', 'danger');
        }

        $.getJSON("../pages/php/buscaCnpj_tb_empresa.php?cnpj=" + $('#cnpj_adm').val(),
                function (data, status) {
                    if (data === false) {
                        $("#infoCnpj").html("<div style='color:red'>Empresa não cadastrado</div>");
                        $("#cnpj_adm").focus();
                        $('#buscarEmrepsa').attr('disabled', 'disabled');
                        alertModal("Empresa não cadastrada", "info");
                    } else {

                        $("[name='tb_empresa_cnpj_envio']").val(data.tb_empresa_cnpj);
                        $("[name='tb_empresa_cnpj']").val(data.tb_empresa_cnpj);
                        $("[name='tb_empresa_matriz']").val(data.tb_empresa_matriz);
                        $("[name='tb_empresa_nome']").val(data.tb_empresa_nome);
                        $("[name='tb_empresa_fantasia']").val(data.tb_empresa_fantasia);
                        $("[name='tb_empresa_numero_empregados']").val(data.tb_empresa_numero_empregados);
                        $("[name='tb_empresa_endereco']").val(data.tb_empresa_endereco);
                        $("[name='tb_empresa_numero']").val(data.tb_empresa_numero);
                        $("[name='tb_empresa_complemento']").val(data.tb_empresa_complemento);
                        $("[name='tb_empresa_cep']").val(data.tb_empresa_cep);
                        $("[name='tb_empresa_bairro']").val(data.tb_empresa_bairro);
                        $("[name='tb_empresa_cidade']").val(data.tb_empresa_cidade);
                        $("[name='tb_empresa_uf']").val(data.tb_empresa_uf);
                        $("[name='tb_empresa_id_vendedor_mostra']").val(data.tb_empresa_id_vendedor);
                        $("[name='tb_empresa_id_vendedor']").val(data.tb_empresa_id_vendedor);
                        $("[name='tb_empresa_valor_pacote']").val(data.tb_empresa_valor_pacote);
                        $("[name='tb_empresa_qtd_contratada']").val(data.tb_empresa_qtd_contratada);
                        $("[name='tb_empresa_valor_unitario']").val(data.tb_empresa_valor_unitario);
                        $("[name='tb_empresa_valor_unitario_mostra']").val(data.tb_empresa_valor_unitario);
                        $("[name='tb_empresa_qtd_usuarios']").val(data.tb_empresa_qtd_usuarios);
                        $("[name='tb_empresa_valor_unitario']").val(data.tb_empresa_valor_unitario);
                        $("[name='tb_empresa_enriquecimento']").val(data.tb_empresa_enriquecimento);
                        $('#msg').hide();
                        $("#infoCnpj").html(' ');
                    }
                }
        );
    });
//FIM VALIDAÇÕES

//calculo valor unitário
    $("[name='tb_empresa_qtd_contratada']").blur(function () {

        var pacote = ($("[name='tb_empresa_valor_pacote']").val());
        pacote = pacote.replace(",", ".");
        var qtdContrato = ($("[name='tb_empresa_qtd_contratada']").val());
        qtdContrato = qtdContrato.replace(",", ".");
        var unitario = pacote / qtdContrato;
        unitario = unitario.toString().replace(".", ",");
        $("[name='tb_empresa_valor_unitario_mostra']").attr('disabled', 'disabled');
        $("[name='tb_empresa_valor_unitario_mostra']").val('R$ ' + unitario);
        $("[name='tb_empresa_valor_unitario']").val(unitario);
    });
    $("#tb_usuario_username_email_adm").blur(function () {


        $.getJSON("../pages/php/buscaEmail_tb_usuario.php?email=" + $('#tb_usuario_username_email_adm').val(),
                function (data, status) {

                    var perfilAtual = $('#perfilAtualHidden').val();
                    if (parseInt(data.tb_usuario_id_perfil) < parseInt(perfilAtual)) {
                        $("#mostraBuscaPessoa").fadeOut();
                        $("[name='tb_usuario_username_email']").focus();
                        alertModal("Seu perfil não atualiza usuários superiores", "info");
                    }
                    if (data === false) {

                        $("#mostraBuscaPessoa").fadeOut();
                        $("#infoEmail").html("<div style='color:red'>Email não cadastrado</div>");
                        alertModal("Email não cadastrado", "info");
                    } else {

                        $("#infoEmail").html(' ');
                        $("#modal").html(' ');
                        $("#msg").html(' ');
                    }
                });
    });
    $("#tb_usuario_username_email").blur(function () {

        $.getJSON("../pages/php/buscaEmail_tb_usuario.php?email=" + $('#tb_usuario_username_email').val(),
                function (data, status) {
                    //alert(data.tb_usuario_username_email);
                    if (data.length > 0) {
                        $("#tb_usuario_username_email").focus();
                        $("#infoEmail").html("<div style='color:red'>Email já cadastrado</div>");
                        alertModal("Email já cadastrado", "info");
                        //$("#mostraBuscaPessoa").fadeOut();
                    } else {
                        //$("#mostraBuscaPessoa").fadeOut();
                        $("#infoEmail").html(' ');
                        $("#msg").html(' ');
                    }
                });
    });
    $("#tb_usuario_cnpj_empresa").blur(function () {

        if (validarCNPJ(String($("#tb_usuario_cnpj_empresa").val()))) {

        } else {
            $("#msg").html(' ');
            $("#infoCnpj").html("<div id='infoCnpj' style='color:red'>CNPJ inválido</div>");
            $("#tb_usuario_cnpj_empresa").focus();
            alertModal("CNPJ inválido", 'danger');
        }

        $.getJSON("../pages/php/buscaCnpj_tb_empresa.php?cnpj=" + $('#tb_usuario_cnpj_empresa').val(),
                function (data, status) {

                    if (data === false) {
                        $("#tb_usuario_cnpj_empresa").focus();
                        $("#infoCnpj").html("<div id='infoCnpj' style='color:red'>CNPJ não cadastrado</div>");
                        //$("#infoCnpj").fadeOut();
                        alertModal("CNPJ não cadastrado", "info");
                    } else {
                        $("#infoCnpj").html(' ');
                        $("#msg").html(' ');
                    }
                });
    });
    $("#buscarUser_tb_pessoa_juridica").click(function () {

        $("#btnInsertUser").show(600);
        $("#msg").html(' ');
        if (TestaCPF(String($('#tb_usuario_cpf').val())) || $('#tb_usuario_cpf').val() === "") {

            $('#btnInsertUser').removeAttr('disabled');
            $("#mostraBuscaPessoa").fadeIn();
            $("[name='tb_usuario_nome']").focus();
            $.getJSON("../pages/php/buscaCpf.php?cpf=" + $('#tb_usuario_cpf').val(),
                    function (data, status) {

                        $("#mostraBuscaPessoa").fadeIn();
                        $("[name='tb_usuario_nome']").focus();
                        //VERIFICAR CONSISTENCIA
                        if (data.tb_pessoa_fisica_cpf) {

                            $("[name='tb_usuario_cpf']").val(data.tb_pessoa_fisica_cpf);
                            $("[name='tb_usuario_nome']").val(data.tb_pessoa_fisica_nome);
                            $("[name='tb_usuario_id_perfil']").val(data.tb_pessoa_juridica_matriz);
                            $("[name='tb_usuario_username_email']").val(data.tb_pessoa_juridica_nome);
                            $("[name='tb_usuario_validade']").val(data.tb_pessoa_juridica_fantasia);
                        }
                    });
        } else {

            alertModal("CPF inválido ", "danger");
            return;
        }
    });
    $("#tb_usuario_cpf_tb_usuario_busca_adm").click(function () {


        $("#btnExcluirUsuario").show(600);
        $("#btnInsertUser").show(600);
        $("#btnExcluirUsuario1").show(600);
        var perfilAtual = $('#perfilAtualHidden').val();
        $('#btnInsertUser').removeAttr('disabled');
        //$('#btnExcluirUsuario').removeAttr('disabled');
        $.getJSON("../pages/php/buscaEmail_tb_usuario.php?cnpj=" + $("[name='tb_usuario_cnpj_empresa']").val() + "&email=" + $('#tb_usuario_username_email_adm').val(),
                function (data, status) {

                    $("#mostraBuscaPessoa").fadeIn();
                    $("[name='tb_usuario_nome']").focus();
                    if (parseInt(data.tb_usuario_id_perfil) < parseInt(perfilAtual)) {
                        $("#mostraBuscaPessoa").fadeOut();
                        $("[name='tb_usuario_username_email']").focus();
                        alertModal("Seu perfil não atualiza usuários superiores", "info");
                    } else {
                        $("#infoCnpj").html(' ');
                        $("#msg").html(' ');
                        $("#infoEmail").html(' ');
                        $("#modal").html(' ');
                    }
                    //VERIFICAR CONSISTENCIA
                    if (data.tb_usuario_username_email) {

                        $("[name='tb_usuario_cpf_tb_usuario']").val(data.tb_usuario_cpf);
                        $("[name='tb_usuario_nome']").val(data.tb_usuario_nome);
                        $("[name='tb_usuario_id_perfil']").val(data.tb_usuario_id_perfil);
                        $("[name='tb_usuario_username_email']").val(data.tb_usuario_username_email);
                        $("[name='tb_usuario_validade']").val(data.tb_usuario_validade);
                        if (data.tb_usuario_ativo === "on") {

                            $("[name='tb_usuario_ativo']").attr("checked", true);
                        } else {
                            $("[name='tb_usuario_ativo']").attr("checked", false);
                        }
                        if (data.tb_usuario_e_vendedor === "on") {
                            $("[name='tb_usuario_e_vendedor']").attr("checked", true);
                        } else {
                            $("[name='tb_usuario_e_vendedor']").attr("checked", false);
                        }
                    } else {

                        $("#mostraBuscaPessoa").fadeOut();
                        var items = [];
                        $("#retornoAllusers").html(' ');
                        $.each(data, function (i) {
                            items.push("<a ><li onclick=chama(this.id," + data[i].tb_empresa_cnpj + ");  id='" + data[i].tb_usuario_username_email + "'> Nome:  " + data[i].tb_usuario_nome + "<br>Email:  " + data[i].tb_usuario_username_email + "</li></a><br>");
                        });
                        $("<ul/>", {
                            "class": "",
                            html: items.join("")
                        }).appendTo($("#retornoAllusers"));
                    }
                });
    });

    $("#buscarEmrepsa").click(function () {

        $("#msg").hide();
        $("#btnInsertUser").show(600);
        $.getJSON("../pages/php/buscaVendedores.php",
                function (data, status) {
                    var options = "";
                    $.each(data, function (i) {
                        options += '<option value="' + data[i].idtb_usuario + '">' + data[i].tb_usuario_nome + ' - ' + data[i].tb_usuario_cnpj_empresa + ' - ' + data[i].tb_empresa_nome + '</option>';
                    });
                    $("#tb_empresa_id_vendedor").html(options);
                });
        $.getJSON("../pages/php/buscaCnpj.php?cnpj=" + $('#cnpj').val(),
                function (data, status) {

                    $("#mostraBuscaEmpresa").fadeIn();
                    $("#buscarEmrepsa").fadeIn();
                    $('#btnInsertUser').removeAttr('disabled');
                    $("[name='tb_empresa_id_vendedor_mostra']").val($("#id_vendedor_hidden").val());
                    $("[name='tb_empresa_id_vendedor']").val($("#id_vendedor_hidden").val());
                    //VERIFICAR CONSISTENCIA
                    $("[name='tb_empresa_cnpj_envio']").val($("#cnpj").val());
                    if (data.tb_pessoa_juridica_cnpj) {

                        $("[name='tb_empresa_cnpj_envio']").val(data.tb_pessoa_juridica_cnpj);
                        $("[name='tb_empresa_cnpj']").val(data.tb_pessoa_juridica_cnpj);
                        $("[name='tb_empresa_matriz']").val(data.tb_pessoa_juridica_matriz);
                        $("[name='tb_empresa_nome']").val(data.tb_pessoa_juridica_nome);
                        $("[name='tb_empresa_fantasia']").val(data.tb_pessoa_juridica_fantasia);
                        $("[name='tb_empresa_numero_empregados']").val(data.tb_pessoa_juridica_gtd_empregados);
                        $("[name='tb_empresa_endereco']").val(data.tb_pessoa_juridica_end_end);
                        $("[name='tb_empresa_numero']").val(data.tb_pessoa_juridica_end_num);
                        $("[name='tb_empresa_complemento']").val(data.tb_pessoa_juridica_end_compl);
                        $("[name='tb_empresa_cep']").val(data.tb_pessoa_juridica_end_cep);
                        $("[name='tb_empresa_bairro']").val(data.tb_pessoa_juridica_end_bairro);
                        $("[name='tb_empresa_cidade']").val(data.tb_pessoa_juridica_end_cidade);
                        $("[name='tb_empresa_uf']").val(data.tb_pessoa_juridica_end_uf);
                        $("[name='tb_empresa_id_vendedor_mostra']").val($("#id_vendedor_hidden").val());
                        $("[name='tb_empresa_id_vendedor']").val($("#id_vendedor_hidden").val());
                        $("[name='tb_empresa_valor_pacote']").val(data.tb_empresa_valor_pacote);
                        $("[name='tb_empresa_qtd_contratada']").val(data.tb_empresa_qtd_contratada);
                        $("[name='tb_empresa_valor_unitario']").val(data.tb_empresa_valor_unitario);
                        $("[name='tb_empresa_qtd_usuarios']").val(data.tb_empresa_qtd_usuarios);
                        $("[name='tb_empresa_webservice']").val(data.tb_empresa_webservice);
                        $("[name='tb_empresa_online']").val(data.tb_empresa_online);
                        $("[name='tb_empresa_valor_unitario']").val(data.tb_empresa_valor_unitario);
                        $("[name='tb_empresa_enriquecimento']").val(data.tb_empresa_enriquecimento);
                    }
                });
    });
// dataWeb/adm-empresas/




    $("#buscarEmrepsa_tb_empresa").click(function () {

        $("#btnAtualizaEmpresa").show(600);
        $("#btnExcluirtEmpresa").show(600);
        $("#btnExcluirEmpresa1").show(600);

        $("[name='codigo_web_service']").fadeIn();
        $("[name='codigo_web_service']").show();

        //-----------aqui //---------------//


        $.getJSON("../pages/php/buscaVendedores.php?cnpj=" + $('#cnpj_adm').val(),
                function (data, status) {

                    var options = "";
                    $.each(data, function (i) {
                        options += '<option value="' + data[i].idtb_usuario + '">' + data[i].tb_usuario_nome + ' - ' + data[i].tb_usuario_cnpj_empresa + ' - ' + data[i].tb_empresa_nome + '</option>';

                    });
                    $("#tb_empresa_id_vendedor").append(options);
                });



        $.getJSON("../pages/php/buscaCnpj_tb_empresa.php?cnpj=" + $('#cnpj_adm').val() + "&razao=" + $('#buscarRazao').val(),
                function (data, status) {

                    $("#mostraBuscaEmpresa").fadeIn();
                    $("#buscarEmrepsa").fadeIn();
                    $('#btnExcluirtEmpresa').removeAttr('disabled');
                    $('#btnAtualizaEmpresa').removeAttr('disabled');
                    $("[name='tb_empresa_cnpj_envio']").val($("#cnpj").val());
                    //var cnpj = $("#tb_empresa_cnpj").val();

                    //VERIFICAR CONSISTENCIA check box
                    if (data.tb_empresa_cnpj) {

                        //webservice
                        if (data.tb_empresa_webservice === null) {
                            $("#divwebservice").prop('checked', false);
                        } else {
                            $("#divwebservice").prop('checked', true);
                        }

                        //online
                        if (data.tb_empresa_online === null) {
                            $("#divonline").prop('checked', false);
                        } else {
                            $("#divonline").prop('checked', true);
                        }

                        //enriquecimento
                        if (data.tb_empresa_enriquecimento === null) {
                            $("#divenriquecimento").prop('checked', false);
                        } else {
                            $("#divenriquecimento").prop('checked', true);
                        }

                        if (data.tb_empresa_permite_excedente === null) {
                            $("#excedente").prop('checked', false);
                        } else {
                            $("#excedente").prop('checked', true);
                        }

                        $("[name='tb_empresa_cnpj_envio']").val(data.tb_empresa_cnpj);
                        $("[name='tb_empresa_cnpj']").val(data.tb_empresa_cnpj);
                        $("[name='tb_empresa_matriz']").val(data.tb_empresa_matriz);
                        $("[name='tb_empresa_nome']").val(data.tb_empresa_nome);
                        $("[name='tb_empresa_fantasia']").val(data.tb_empresa_fantasia);
                        $("[name='tb_empresa_numero_empregados']").val(data.tb_empresa_numero_empregados);
                        $("[name='tb_empresa_endereco']").val(data.tb_empresa_endereco);
                        $("[name='tb_empresa_numero']").val(data.tb_empresa_numero);
                        $("[name='tb_empresa_complemento']").val(data.tb_empresa_complemento);
                        $("[name='tb_empresa_cep']").val(data.tb_empresa_cep);
                        $("[name='tb_empresa_bairro']").val(data.tb_empresa_bairro);
                        $("[name='tb_empresa_cidade']").val(data.tb_empresa_cidade);
                        $("[name='tb_empresa_uf']").val(data.tb_empresa_uf);
                        $("[name='tb_empresa_id_vendedor_mostra']").val(data.tb_empresa_id_vendedor);
                        $("[name='tb_empresa_id_vendedor']").val(data.tb_empresa_id_vendedor);
                        $("[name='tb_empresa_valor_pacote']").val(data.tb_empresa_valor_pacote);
                        $("[name='tb_empresa_qtd_contratada']").val(data.tb_empresa_qtd_contratada);
                        $("[name='tb_empresa_valor_unitario']").val(data.tb_empresa_valor_unitario);
                        $("[name='tb_empresa_valor_unitario_mostra']").val(data.tb_empresa_valor_unitario);
                        $("[name='tb_empresa_qtd_usuarios']").val(data.tb_empresa_qtd_usuarios);
                        $("[name='tb_empresa_valor_unitario']").val(data.tb_empresa_valor_unitario);
                        $("[name='tb_empresa_enriquecimento']").val(data.tb_empresa_enriquecimento);
                        $("[name='tb_empresa_unitario_execedente']").val(data.tb_empresa_unitario_execedente);
                        $("[name='tb_empresa_permite_excedente']").val(data.tb_empresa_permite_excedente);
                        $("[name='codigo_web_service']").val(data.tb_empresa_codigo_web_service);
                        
                        $("[name='tb_credito_custo_empresa_produtos_web_service']").val(data.tb_credito_custo_empresa_produtos_web_service);
                        $("[name='tb_credito_custo_empresa_produtos_online']").val(data.tb_credito_custo_empresa_produtos_online);
                        $("[name='tb_credito_custo_empresa_produtos_enriquecimento']").val(data.tb_credito_custo_empresa_produtos_enriquecimento);
                        $("[name='tb_credito_custo_empresa_produtos_cnf_simples']").val(data.tb_credito_custo_empresa_produtos_cnf_simples);
                        $("[name='tb_credito_custo_empresa_produtos_cnf_detalhado']").val(data.tb_credito_custo_empresa_produtos_cnf_detalhado);
                        $("[name='tb_credito_custo_empresa_produtos_extracao']").val(data.tb_credito_custo_empresa_produtos_extracao);

                    } else {

                        var items = [];
                        $("#mostraBuscaEmpresa").fadeOut();
                        $("#retornoAllEmpresas").html(' ');
                        $.each(data, function (i) {
                            items.push("<a><li onclick=chama(this.id," + data[i].tb_empresa_cnpj + ");  id='" + data[i].tb_empresa_cnpj + "'>Nome:  " + data[i].tb_empresa_nome + "<br>CNPJ:  " + data[i].tb_empresa_cnpj + "</li></a><br>");
                        });
                        $("<ul/>", {
                            "id": "myul",
                            html: items.join("")
                        }).appendTo($("#retornoAllEmpresas"));
                    }
                });
    });
});
//adm-empresas-view.php

$("#btnExcluirtEmpresa").click(function () {


    $.get("../pages/php/excluirCnpj.php?cnpj=" + $('#cnpj_adm').val(), function (data) {

        if (data === 'excluido') {

            $("#mostraBuscaEmpresa").fadeOut();
            $("#infoCnpj").html(' ');
            $("#msg").html(' ');
            $("#modal").html(' ');
            alertModal("Excluido com sucesso", 'success');
            alert("Excluido com sucesso !");
        } else {
            alertModal("Não excluido !! Erro " + data, 'danger');
            alert("Não excluido ! Primeiro exclua todos usuários ");
        }
    });
});
//adm-usuarios-view.php

$("#btnExcluirUsuarioCancelar").click(function () {
    location.reload();
});
$("#btnExcluirUsuario").click(function () {

//var retorno;
    $.get("../pages/php/excluirCpf.php?email=" + $('#tb_usuario_username_email_adm').val(), function (data) {

        if (data === 'excluido') {

            $("#mostraBuscaPessoa").fadeOut();
            $("#infoCnpj").html(' ');
            $("#msg").html(' ');
            //$("#modal").html(' ');
            alertModal("Excluido com sucesso", 'success');
            alert('Excluido com sucesso !');
            setTimeout(function () {
                location.reload();
            }, 1000);
        } else {
            alertModal("Não excluido !! Erro " + data, 'danger');
            alert('Não Excluido ! Digite um email ')
        }
    });
});
//FUNÇOES 
function TestaCPF(strCPF) {

    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000")
        return false;
    for (i = 1; i <= 9; i++)
        Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11))
        Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)))
        return false;
    Soma = 0;
    for (i = 1; i <= 10; i++)
        Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11))
        Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11)))
        return false;
    return true;
}


function validarCNPJ(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g, '');
    if (cnpj == '')
        return false;
    if (cnpj.length != 14)
        return false;
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
            cnpj == "11111111111111" ||
            cnpj == "22222222222222" ||
            cnpj == "33333333333333" ||
            cnpj == "44444444444444" ||
            cnpj == "55555555555555" ||
            cnpj == "66666666666666" ||
            cnpj == "77777777777777" ||
            cnpj == "88888888888888" ||
            cnpj == "99999999999999")
        return false;
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;
    return true;
}

function alertModal(texto, tipo) {
//tipos
//ver bootstrap.css
    $("#modal").html("<div id'modal'><div id='msg' class='alert alert-" + tipo + " role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span> " + texto + "</div></div>");
    //$("#dialog").dialog();
}
//FIM FUNÇOES 
