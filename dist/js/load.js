$(window).load(function () {

    if ($('#cpf_cnpj_redirect').val()) {
        var cpfCnpj = $('#cpf_cnpj_redirect').val().replace(/[^\d]+/g, '');
    }

    if (cpfCnpj) {
//esconde icones
        $("#situacaoCadastroPage").hide();
        $("#perfilsocialPage").hide();
        $("#perfilconsumoPage").hide();
        $("#pessoasempresasrelacionadasPage").hide();
        $("#participacaoemprePage").hide();
        $("#quemconsultouPage").hide();
        $("#msg").hide();
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


        var idtbVendedor = $("#idtbVendedor").val();

        $.getJSON("../pages/php/buscaCpfCnpj.php?busca=" + cpfCnpj + "&loginEmpresa=" + $('#loginEmpresa').val() + "&cnpjEmpresa=" + $('#cnpjEmpresa').val() + "&idtbVendedor=" + idtbVendedor,
                function (data, status) {

                    if (cpfCnpj.length === 14) {
                        if (data.length > 0) {

                            $("#liObito").hide();
                            $("#liemail").hide();
                            $("#dadosCadastraisCpf").hide();
                            $("#dadosCadastraisCnpj").show(600);
                            $("#tb_pessoa_juridica_cnpj").html(formataCnpj(cpfCnpj));

                            $("#participacaoempre").html("<div  style='width: 100%;'class='btn btn-primary btn-xsGrande' id='participacaoempre'><i class='fa fa-fw  fa-paperclip' style='width: 15px;'></i>&nbsp;P. Societária &nbsp;</div>");
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
//localização 3
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
                                                            "<a  title='Vizinhos Relacionados ao endereço'href='../busca-endereco/?numero=" + res + res2 + "&cep=" + cep + "&pessoa=juridica 'id='relacaoEndereco'><i class='fa fa-hospital-o' style'color:black;'>&nbsp;&nbsp;</i></a>" +
                                                            "</div>" +
                                                            "<div style='text-align: right'>" +
                                                            "<a  title='Pessoas Relacionadas ao endereço'href='../busca-endereco/?rua=" + endereco + "&numero=" + numero + "&bairro=" + bairro + "&cidade" + cidade + "&uf=" + uf + "&cep=" + cep + "&pessoa='fisica' 'id='relacaoEndereco'><i class='fa fa-search'>&nbsp;&nbsp;</i></a>" +
                                                            "</div>" +
                                                            "</div><br>";
                                                    $("#local").append(localizacao);

                                                }
                                            }
                                        }
                                    }
                                }

                            });
//telefones
                            $.getJSON("/pages/php/buscaTelefoneDoc.php?busca=" + cpfCnpj,
                                    function (data, status) {
                                        $.each(data, function (i) {

                                            if (data[i].tb_procon_fone) {
                                                var imgProcon = "<img src='dist/img/procon_logo.gif' width=30 height=30  align='center'/>";
                                            } else {
                                                var imgProcon = "";
                                            }


                                            if (i <= 10)
                                                var tel =
                                                        "<div id = 'infoTelefone' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                                        "Telefone : <A href='../busca-tel/?ddd=" + data[i].tb_pessoa_juridica_fones_ddd + "&fone=" + data[i].tb_pessoa_juridica_fones_fone + "&pessoa=juridica'>(" + data[i].tb_pessoa_juridica_fones_ddd + ") " + data[i].tb_pessoa_juridica_fones_fone + "</A>&nbsp;&nbsp;&nbsp;" +
                                                        imgProcon + "<div  style = 'float:right' >" +
                                                        "<div>Data: " + data[i].tb_pessoa_juridica_fones_data + "</div>" +
                                                        "<div style='text-align: right'>" +
                                                        "<a  title='Telefones Relacionados 'href='../busca-tel/?ddd=" + data[i].tb_pessoa_juridica_fones_ddd + "&fone=" + data[i].tb_pessoa_juridica_fones_fone + "&pessoa=juridica'><i class='fa fa-search'>&nbsp;&nbsp;</i></a>" +
                                                        "</div>" +
                                                        "<div  style = 'float:right' >" +
                                                        "</div>" +
                                                        "</div>";
                                            $("#tel").append(tel);
                                        });//each
                                    });//getJSON
//situacao
                            $("#tb_pessoa_juridica_id_natureza").html(data[0].tb_pessoa_juridica_id_natureza);
                            $("#tb_pessoa_juridica_matriz").html(data[0].tb_pessoa_juridica_matriz);
                            $("#tb_pessoa_juridica_porte").html(data[0].tb_pessoa_juridica_porte);


                        } else {
                            $("#mostraBusca").hide();
                            alertModal("Não encontrado", "danger");
                        }
                    } else {
                        //cpf


                        $("#nomeMae").val('');
                        $("#participacaoempre").html("<div  style='width: 100%;'class='btn btn-primary btn-xsGrande' id='participacaoempre'><i class='fa fa-fw  fa-paperclip' style='width: 6px;'></i>&nbsp;Part. em Empresas &nbsp;</div>");

                        $.getJSON("../pages/php/buscaMae.php?cpfFilho=" + cpfCnpj,
                                function (data, status) {

                                    $("#nomeMae").val(data[0]['tb_pessoa_fisica_mae_nome_mae']);
                                    var nomeMae = data[0]['tb_pessoa_fisica_mae_nome_mae'];
                                    $("#buscaMae").html("<div id='buscaMae' style='float: right;'><a href='../busca-nome/?nome=" + nomeMae + "'<i class='fa fa-search'>&nbsp;&nbsp;</i></a></div>")
                                });


                        if (data.length > 0) {

                            $("#dadosCadastraisCnpj").hide();
                            $("#dadosCadastraisCpf").show(600);
                            $("#liObito").show(600);
                            $("#liSitCadast").hide(600);
                            $("#liemail").show(600);
                            $("#cpf1").val(formataCpf(cpfCnpj));
                            $("#tb_pessoa_juridica_cnpj").html(formataCpf(cpfCnpj));
                            $("#tb_pessoa_juridica_nome").html(data[0].tb_pessoa_fisica_nome);
                            $("#nome").val(data[0].tb_pessoa_fisica_nome);
                            //$("#nomeMae").val(data[0].tb_pessoa_fisica_nome_mae);
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

                            if (data[0].tb_pessoa_fisica_sexo === 'F') {

                                $("#feminino").attr("checked", true);
                                $("#masculino").attr("checked", false);
                            } else {

                                $("#masculino").attr("checked", true);
                                $("#feminino").attr("checked", false);
                            }
//localização 4

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
                                            orderCep.push(cep);
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
                                                            "<a  title='Vizinhos Relacionados ao endereço'href='../busca-endereco/?numero=" + res + res2 + "&cep=" + cep + "&pessoa=juridica 'id='relacaoEndereco'><i class='fa fa-hospital-o' style'color:black;'>&nbsp;&nbsp;</i></a>" +
                                                            "</div>" +
                                                            "<div style='text-align: right'>" +
                                                            "<a  title='Pessoas Relacionadas ao endereço'href='../busca-endereco/?rua=" + endereco + "&numero=" + numero + "&bairro=" + bairro + "&cidade" + cidade + "&uf=" + uf + "&cep=" + cep + "&pessoa='fisica' 'id='relacaoEndereco'><i class='fa fa-search'>&nbsp;&nbsp;</i></a>" +
                                                            "</div>" +
                                                            "</div><br>";
                                                    $("#local").append(localizacao);

                                                }
                                            }
                                        }
                                    }
                                }
                            });

//telefones load
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
                                                                "<div>Data: " + data[i].tb_pessoa_fisica_fones_data + "</div>" +
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

                        } else {

                            $("#mostraBusca").hide();
                            alertModal("Não encontrado", "danger");
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
            //alert('comercio')

            if (qtdFuncionarios >= 1 & qtdFuncionarios <= 9) {
                $("#porte").html('Micro (Serviços)');
                $("#fpresumido").html("Até R$1200 mil");
            }
            if (qtdFuncionarios >= 10 & qtdFuncionarios <= 49) {
                $("#porte").html('Pequena (Serviços)');
                $("#fpresumido").html("De R$1200 mil a R$10500 mil");
            }
            if (qtdFuncionarios >= 50 & qtdFuncionarios <= 99) {
                $("#porte").html('Media (Serviços)');
                $("#fpresumido").html("De R$10500 mil a R$60 milhões");
            }
            if (qtdFuncionarios > 99) {
                $("#porte").html('Grande (Serviços)');
                $("#fpresumido").html("Acima de 60 milhões");
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
    function formataData(data) {

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
                $("#signo").val("Aquarios");
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

    function pad(str, max) {
        str = str.toString();
        return str.length < max ? pad("0" + str, max) : str;
    }

    $.fn.extend({pad: function (str, max) {
            str = str.toString();
            return str.length < max ? pad("0" + str, max) : str;
        }, formataData: function (data) {
            var ano;
            var mes;
            var dia;

            data = data.toString();
            ano = data.substring(0, 4);
            mes = data.substring(4, 6);
            dia = data.substring(6, 8);
            return dia + " / " + mes + " / " + ano;
        }
    });
});