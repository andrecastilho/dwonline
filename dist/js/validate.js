

$('#buscarBairro').hide();
$("#incluirFiltroEnd").hide();
$("#botaoSalvar").hide();



// botões processar -------------------------------------------------------------------------------------//
$("#processarExtracao0").click(function () {

    var queroProcessar = $("#qtdAProcessar0").val();
    var idtbFiltro = $("#idenriquecimento0").val();
    var cnpjEmpresa = $("#cnpjEmpresa").val();

    $.ajax({url: "/pages/php/atualizaProcessamentoExtracao.php?idtbEnriquecimento=" + idtbFiltro + "&qtdProcessar=" + queroProcessar + "&cnpjEmpresa=" + cnpjEmpresa,
        success: function (result) {
            alert(result);
        }});

    $("#processarExtracao0").hide();
    alert("Aguarde você será redirecionado automaticamente... ");

    setTimeout(function () {
        location.reload();
    }, 4000);

});
$("#processarExtracao1").click(function () {

    var queroProcessar = $("#qtdAProcessar1").val();
    var idtbFiltro = $("#idenriquecimento1").val();
    var cnpjEmpresa = $("#cnpjEmpresa").val();
    $.ajax({url: "/pages/php/atualizaProcessamentoExtracao.php?idtbEnriquecimento=" + idtbFiltro + "&qtdProcessar=" + queroProcessar + "&cnpjEmpresa=" + cnpjEmpresa,
        success: function (result) {
            //alert(result);
        }});
    $("#processarExtracao1").hide();
    alert("Aguarde você será redirecionado automaticamente... ");
    setTimeout(function () {
        location.reload();
    }, 4000);
});

$("#processarExtracao2").click(function () {

    var queroProcessar = $("#qtdAProcessar2").val();
    var idtbFiltro = $("#idenriquecimento2").val();
    var cnpjEmpresa = $("#cnpjEmpresa").val();
    $.ajax({url: "/pages/php/atualizaProcessamentoExtracao.php?idtbEnriquecimento=" + idtbFiltro + "&qtdProcessar=" + queroProcessar + "&cnpjEmpresa=" + cnpjEmpresa,
        success: function (result) {
            //alert(result);
        }});
    $("#processarExtracao2").hide();
    alert("Aguarde você será redirecionado automaticamente... ");
    setTimeout(function () {
        location.reload();
    }, 4000);
});
$("#processarExtracao3").click(function () {

    var queroProcessar = $("#qtdAProcessar3").val();
    var idtbFiltro = $("#idenriquecimento3").val();
    var cnpjEmpresa = $("#cnpjEmpresa").val();
    $.ajax({url: "/pages/php/atualizaProcessamentoExtracao.php?idtbEnriquecimento=" + idtbFiltro + "&qtdProcessar=" + queroProcessar + "&cnpjEmpresa=" + cnpjEmpresa,
        success: function (result) {
            //alert(result);
        }});
    $("#processarExtracao3").hide();
    alert("Aguarde você será redirecionado automaticamente... ");
    setTimeout(function () {
        location.reload();
    }, 4000);
});
$("#processarExtracao4").click(function () {

    var queroProcessar = $("#qtdAProcessar4").val();
    var idtbFiltro = $("#idenriquecimento4").val();
    var cnpjEmpresa = $("#cnpjEmpresa").val();
    $.ajax({url: "/pages/php/atualizaProcessamentoExtracao.php?idtbEnriquecimento=" + idtbFiltro + "&qtdProcessar=" + queroProcessar + "&cnpjEmpresa=" + cnpjEmpresa,
        success: function (result) {
            //alert(result);
        }});
    $("#processarExtracao4").hide();
    alert("Aguarde você será redirecionado automaticamente... ");
    setTimeout(function () {
        location.reload();
    }, 4000);
});
$("#processarExtracao5").click(function () {

    var queroProcessar = $("#qtdAProcessar5").val();
    var idtbFiltro = $("#idenriquecimento5").val();
    var cnpjEmpresa = $("#cnpjEmpresa").val();
    $.ajax({url: "/pages/php/atualizaProcessamentoExtracao.php?idtbEnriquecimento=" + idtbFiltro + "&qtdProcessar=" + queroProcessar + "&cnpjEmpresa=" + cnpjEmpresa,
        success: function (result) {
            //alert(result);
        }});
    $("#processarExtracao5").hide();
    alert("Aguarde você será redirecionado automaticamente... ");
    setTimeout(function () {
        location.reload();
    }, 4000);
});

// botoes cancelar-------------------------------------------------------------------------------------//

$("#excluirExtracao0").click(function () {

    var id = $("#idenriquecimento0").val();
    var retorno = $.getJSON("/pages/php/excluirExtracao.php?idtbExtracao=" + id,
            function (data, status) {

            });
    alert("Aguarde você será redirecionado automaticamente... ");
    setTimeout(function () {
        location.reload();
    }, 2000);
});
$("#excluirExtracao1").click(function () {

    var id = $("#idenriquecimento1").val();
    var retorno = $.getJSON("/pages/php/excluirExtracao.php?idtbExtracao=" + id,
            function (data, status) {

            });
    alert("Aguarde você será redirecionado automaticamente... ");
    setTimeout(function () {
        location.reload();
    }, 2000);
});
$("#excluirExtracao2").click(function () {

    var id = $("#idenriquecimento2").val();
    var retorno = $.getJSON("/pages/php/excluirExtracao.php?idtbExtracao=" + id,
            function (data, status) {

            });
    alert("Aguarde você será redirecionado automaticamente... ");
    setTimeout(function () {
        location.reload();
    }, 2000);
});
$("#excluirExtracao3").click(function () {

    var id = $("#idenriquecimento3").val();
    var retorno = $.getJSON("/pages/php/excluirExtracao.php?idtbExtracao=" + id,
            function (data, status) {

            });
    alert("Aguarde você será redirecionado automaticamente... ");
    setTimeout(function () {
        location.reload();
    }, 2000);
});
$("#excluirExtracao4").click(function () {

    var id = $("#idenriquecimento4").val();
    var retorno = $.getJSON("/pages/php/excluirExtracao.php?idtbExtracao=" + id,
            function (data, status) {

            });
    alert("Aguarde você será redirecionado automaticamente... ");
    setTimeout(function () {
        location.reload();
    }, 2000);
});


// botões editar -------------------------------------------------------------------------------------//

$("#atualizarFiltros").click(function () {
    var idtbFiltro = $("#idenriquecimento0").val();
    alert(idtbFiltro);
});



$("#refazerExtracao0").click(function () {

    var idtbFiltro = $("#idenriquecimento0").val();
    $('#atualizarFiltros').val('atualizar');
    $('#idtbExtracao').val(idtbFiltro);


    var tipo;
    var cpfOn;
    var nomeOn;
    var sexoOn;
    var dataNascimentoOn;
    var maeOn;
    var cboOn;
    var desCboOn;
    var rendaEstimadaOn;
    var escolaridadeOn;
    var classeSocialOn;
    var perfilConsumoOn;
    var fone1On;
    var fone2On;
    var fone3On;
    var cel1On;
    var cel2On;
    var cel3On;
    var dddFone1On;
    var dddFone2On;
    var dddFone3On;
    var dddCel1On;
    var dddCel2On;
    var dddCel3On;
    var enderecoOn;
    var numeroOn;
    var proconOn;
    var bairroOn;
    var complementoOn;
    var cidadeOn;
    var estadoOn;
    var cidadeObitoOn;
    var emailOn;
    var dataObitoOn;
    var cepOn;
    var participacaoEmpresarialOn;

    var cpfOb;
    var nomeOb;
    var sexoOb;
    var dataNascimentoOb;
    var maeOb;
    var cboOb;
    var desCboOb;
    var rendaEstimadaOb;
    var escolaridadeOb;
    var classeSocialOb;
    var perfilConsumoOb;
    var fone1Ob;
    var fone2Ob;
    var fone3Ob;
    var cel1Ob;
    var cel2Ob;
    var cel3Ob;
    var dddFone1Ob;
    var dddFone2Ob;
    var dddFone3Ob;
    var dddCel1Ob;
    var dddCel2Ob;
    var dddCel3Ob;
    var enderecoOb;
    var numeroOb;
    var proconOb;
    var bairroOb;
    var complementoOb;
    var cidadeOb;
    var estadoOb;
    var cidadeObitoOb;
    var emailOb;
    var dataObitoOb;
    var cepOb;
    var participacaoEmpresarialOb;
    var classeSocialOnCombo;

    var cnpjOn;
    var cnpjOb;
    var proconPjOn;
    var proconPjOb;
    var nomePjOn;
    var nomePjOb;
    var matrizPjOn;
    var matrizPjOb;
    var fantasiaPjOn;
    var fantasiaPjOb;
    var nascimentoPjOn;
    var nascimentoPjOb;
    var qtdEmpregadosPjOn;
    var qtdEmpregadosPjOb;
    var cnaePjOn;
    var cnaePjOb;
    var naturezaPjOn;
    var bnaturezaPjOb;
    var desCnaePjOn;
    var desCnaePjOb;
    var desNaturezaPjOn;
    var desNaturezaPjOb;
    var enderecoPjOn;
    var enderecoPjOb;
    var numeroPjOn;
    var numeroPjOb;
    var complementoPjOn;
    var complementoPjOb;
    var bairroPjOn;
    var bairroPjOb;
    var cidadePjOn;
    var cidadePjOb;
    var estadoPjOn;
    var estadoPjOb;
    var cepPjOn;
    var cepPjOb;
    var dataSituacaoPjOn;
    var dataSituacaoPjOb;
    var faturamentoPresumidoPjOn;
    var faturamentoPresumidoPjOb;
    var qtdProprietariosPjOn;
    var qtdProprietariosPjOb;
    var perfilConsumoPjOn;
    var perfilConsumoPjOb;
    var situacaoPjOn;
    var situacaoPjOb;
    var portePjOn;
    var portePjOb;
    var fone1PjOn;
    var fone1PjOb;
    var fone2PjOn;
    var fone2PjOb;
    var fone3PjOn;
    var fone3PjOb;
    var cel1PjOn;
    var cel1PjOb;
    var cel2PjOn;
    var cel2PjOb;
    var cel3PjOn;
    var cel3PjOb;
    var sociosPjOn;
    var sociosPjOb;

    var retorno = $.getJSON("/pages/php/buscaFiltroExtracao.php?idtbExtracao=" + idtbFiltro,
            function (data, status) {

                for ($i = 0; $i < data.length; $i++) {


                    //----------------------combos pf--------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=claSocial]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=escolaridade]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var st = data[$i]['tb_extracao_filtros_filtro'].toString();

                        var dataarrayDe = st.split(',');

                        var dataDe = dataarrayDe[0];
                        var dataAte = dataarrayDe[1];

                        $('#nascimentoDe').val(dataDe);
                        $('#nascimentoAte').val(dataAte);
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var st = data[$i]['tb_extracao_filtros_filtro'].toString();

                        var dataarrayDe = st.split(',');

                        var dataDe = dataarrayDe[0];
                        var dataAte = dataarrayDe[1];

                        $('#rendaEstimadaDe').val(dataDe);
                        $('#rendaEstimadaAte').val(dataAte);
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=DDDsFone]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=enderecosQtd]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=estados]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=qtdEmail]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }


                    //----------------------combos pf fim--------------------------------------------------------------------------------------------//



                    if (data[$i]['tb_extracao_filtros_nome_campo'] == 'tipoArquivo' & data[$i]['tb_extracao_filtros_filtro'] == 'cpf') {
                        tipo = 'cpf';
                        $("#tipoArquivo").val(tipo);
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cpf' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cpfOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nome' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        nomeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'sexo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        sexoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dataNascimentoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'mae' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        maeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cbo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cboOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'descCbo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        desCboOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        rendaEstimadaOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        escolaridadeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        classeSocialOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';

                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        perfilConsumoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        enderecoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numero' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        numeroOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        proconOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairro' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        bairroOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complemento' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        complementoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidade' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cidadeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        estadoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadeObito' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cidadeObitoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        emailOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataObito' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dataObitoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cep' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cepOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'participacaoEmpresarial' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        participacaoEmpresarialOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }


//----------------------------------------------------------obrigatórios----------------------------------------------------------------------//                    


                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cpf' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cpfOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cpfOb) {
                            $('#obCpf').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nome' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        nomeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nomeOb) {
                            $('#obNome').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'sexo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        sexoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (sexoOb) {
                            $('#obSexo').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dataNascimentoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataNascimentoOb) {
                            $('#obNascimento').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'mae' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        maeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (maeOb) {
                            $('#obMae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cbo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cboOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cboOb) {
                            $('#obCbo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'descCbo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        desCboOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desCboOb) {
                            $('#obDescCbo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        rendaEstimadaOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (rendaEstimadaOb) {
                            $('#obRestimada').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        escolaridadeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (escolaridadeOb) {
                            $('#obEscolaridade').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        classeSocialOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (classeSocialOb) {
                            $('#obClaSocial').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        perfilConsumoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (perfilConsumoOb) {
                            $('#obPerConsumo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone1Ob) {
                            $('#obDDDFone1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone1' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone1Ob) {
                            $('#obFone1').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone2' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone2Ob) {
                            $('#obDDDFone2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone2' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone2Ob) {
                            $('#obFone2').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone3' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone3Ob) {
                            $('#obDDDFone3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone3' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone3Ob) {
                            $('#obFone3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel1Ob) {
                            $('#obDDDCel1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel1Ob) {
                            $('#obCel1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel2Ob) {
                            $('#obDDDCel2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel2Ob) {
                            $('#obCel2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel3Ob) {
                            $('#obDDDCel3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel3Ob) {
                            $('#obCel3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        enderecoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (enderecoOb) {
                            $('#obEndereco').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numero' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        numeroOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (numeroOb) {
                            $('#obNumero').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        proconOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (proconOb) {
                            $('#obProcon').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairro' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        bairroOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (bairroOb) {
                            $('#obBairro').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complemento' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        complementoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (complementoOb) {
                            $('#obComplemento').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidade' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cidadeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadeOb) {
                            $('#obCidade').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        estadoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (estadoOb) {
                            $('#obEstado').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadeObito' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cidadeObitoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadeObitoOb) {
                            $('#obCidadeObito').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        emailOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (emailOb) {
                            $('#obEmail').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataObito' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dataObitoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataObitoOb) {
                            $('#obDataObito').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cep' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cepOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cepOb) {
                            $('#obCep').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'participacaoEmpresarial' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        participacaoEmpresarialOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (participacaoEmpresarialOb) {
                            $('#obPEmpresarial').attr("checked", true);
                        }
                    }


//----------------------combos pj --------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'enderecoPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=enderecosQtdPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estadoPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=estadosPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadePj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=cidadesPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairroPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=bairroPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

//----------------------combos pj fim  --------------------------------------------------------------------------------------------//

//--------------------pj desejado /obrigatorio---------------------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cnpj') {
                        cnpjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cnpjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cnpjOn) {
                            $('#desCnpj').attr("checked", true);
                        }
                        if (cnpjOb) {
                            $('#obCnpj').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon') {
                        proconPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on,';
                        proconPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on,';
                        if (proconPjOn) {
                            $('#desProcon').attr("checked", true);
                        }
                        if (proconPjOb) {
                            $('#obProcon').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nomePj') {
                        nomePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        nomePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nomePjOn) {
                            $('#desNomePj').attr("checked", true);
                        }
                        if (nomePjOb) {
                            $('#obNomePj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'matriz') {
                        matrizPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        matrizPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (matrizPjOn) {
                            $('#desMatriz').attr("checked", true);
                        }
                        if (matrizPjOb) {
                            $('#obMatriz').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fantasiaPj') {
                        fantasiaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fantasiaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fantasiaPjOn) {
                            $('#desFantasia').attr("checked", true);
                        }
                        if (fantasiaPjOb) {
                            $('#obFantasia').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimentoPj') {
                        nascimentoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        nascimentoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nascimentoPjOn) {
                            $('#desNascimentoPj').attr("checked", true);
                        }
                        if (nascimentoPjOb) {
                            $('#obNascimentoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'qtdEmpregados') {
                        qtdEmpregadosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        qtdEmpregadosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (qtdEmpregadosPjOn) {
                            $('#desQtdEmpregados').attr("checked", true);
                        }
                        if (nascimentoPjOb) {
                            $('#obQtdEmpregados').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cnae') {
                        cnaePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cnaePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cnaePjOn) {
                            $('#desCnae').attr("checked", true);
                        }
                        if (cnaePjOb) {
                            $('#obCnae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'natureza') {
                        naturezaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        naturezaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (naturezaPjOn) {
                            $('#desNatureza').attr("checked", true);
                        }
                        if (naturezaPjOb) {
                            $('#obNatureza').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'desCnae') {
                        desCnaePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        desCnaePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desCnaePjOn) {
                            $('#desDesCnae').attr("checked", true);
                        }
                        if (desCnaePjOb) {
                            $('#obDesCnae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'desNatureza') {
                        desNaturezaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        desNaturezaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desNaturezaPjOn) {
                            $('#desDesNatureza').attr("checked", true);
                        }
                        if (desNaturezaPjOb) {
                            $('#obDesNatureza').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'enderecoPj') {
                        enderecoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        enderecoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (enderecoPjOn) {
                            $('#desEnderecoPj').attr("checked", true);
                        }
                        if (enderecoPjOb) {
                            $('#obEnderecoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numeroPj') {
                        numeroPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        numeroPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (numeroPjOn) {
                            $('#desNumeroPj').attr("checked", true);
                        }
                        if (numeroPjOb) {
                            $('#obNumeroPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complementoPj') {
                        complementoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        complementoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (complementoPjOn) {
                            $('#desComplementoPj').attr("checked", true);
                        }
                        if (complementoPjOb) {
                            $('#obComplementoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairroPj') {
                        bairroPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        bairroPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (bairroPjOn) {
                            $('#desBairroPj').attr("checked", true);
                        }
                        if (bairroPjOb) {
                            $('#obBairroPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadePj') {
                        cidadePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cidadePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadePjOn) {
                            $('#desCidadePj').attr("checked", true);
                        }
                        if (cidadePjOb) {
                            $('#obCidadePj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estadoPj') {
                        estadoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        estadoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (estadoPjOn) {
                            $('#desEstadoPj').attr("checked", true);
                        }
                        if (estadoPjOb) {
                            $('#obEstadoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cepPj') {
                        cepPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cepPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cepPjOn) {
                            $('#desCepPj').attr("checked", true);
                        }
                        if (cepPjOb) {
                            $('#obCepPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataSituacao') {
                        dataSituacaoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        dataSituacaoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataSituacaoPjOn) {
                            $('#desDataSituacao').attr("checked", true);
                        }
                        if (dataSituacaoPjOb) {
                            $('#obDataSituacao').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'faturamentoPresumido') {
                        faturamentoPresumidoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        faturamentoPresumidoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (faturamentoPresumidoPjOn) {
                            $('#desFPresumido').attr("checked", true);
                        }
                        if (faturamentoPresumidoPjOb) {
                            $('#obFPresumido').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'qtdProprietarios') {
                        qtdProprietariosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        qtdProprietariosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (qtdProprietariosPjOn) {
                            $('#desQtdProprietarios').attr("checked", true);
                        }
                        if (qtdProprietariosPjOb) {
                            $('#obQtdProprietarios').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo') {
                        perfilConsumoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        perfilConsumoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (perfilConsumoPjOn) {
                            $('#desConsumo').attr("checked", true);
                        }
                        if (perfilConsumoPjOb) {
                            $('#obPConsumo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'situacao') {
                        situacaoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        situacaoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (situacaoPjOn) {
                            $('#desSituacao').attr("checked", true);
                        }
                        if (situacaoPjOb) {
                            $('#obSituacao').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'porte') {
                        portePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        portePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (portePjOn) {
                            $('#desPorte').attr("checked", true);
                        }
                        if (portePjOb) {
                            $('#obPorte').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone1Pj') {
                        fone1PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone1PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone1PjOn) {
                            $('#desFone1Pj').attr("checked", true);
                        }
                        if (fone1PjOb) {
                            $('#obFone1Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone2Pj') {
                        fone2PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone2PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone2PjOn) {
                            $('#desFone2Pj').attr("checked", true);
                        }
                        if (fone2PjOb) {
                            $('#obFone2Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone3Pj') {
                        fone3PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone3PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone3PjOn) {
                            $('#desFone3Pj').attr("checked", true);
                        }
                        if (fone3PjOb) {
                            $('#obFone3Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel1Pj') {
                        cel1PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel1PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel1PjOn) {
                            $('#desCel1Pj').attr("checked", true);
                        }
                        if (cel1PjOb) {
                            $('#obCel1Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel2Pj') {
                        cel2PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel2PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel2PjOn) {
                            $('#desCel2Pj').attr("checked", true);
                        }
                        if (cel2PjOb) {
                            $('#obCe2lPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel3Pj') {
                        cel3PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel3PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel3PjOn) {
                            $('#desCel3Pj').attr("checked", true);
                        }
                        if (cel3PjOb) {
                            $('#obCe3lPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'socios') {
                        sociosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        sociosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (sociosPjOn) {
                            $('#desSocio').attr("checked", true);
                        }
                        if (sociosPjOb) {
                            $('#obSocio').attr("checked", true);
                        }
                    }
                }
                if (tipo === 'cpf') {
                    $('#mostraFiltros').show(600);
                    if (cpfOn) {
                        $('#desCpf').attr("checked", true);
                    }
                    if (nomeOn) {
                        $('#desNome').attr("checked", true);
                    }
                    if (sexoOn) {
                        $('#desSexo').attr("checked", true);
                    }
                    if (dataNascimentoOn) {
                        $('#desNascimento').attr("checked", true);
                    }
                    if (maeOn) {
                        $('#desMae').attr("checked", true);
                    }
                    if (cboOn) {
                        $('#desCbo').attr("checked", true);
                    }
                    if (desCboOn) {
                        $('#desDescCbo').attr("checked", true);
                    }
                    if (rendaEstimadaOn) {
                        $('#desRestimada').attr("checked", true);
                    }
                    if (escolaridadeOn) {
                        $('#desEscolaridade').attr("checked", true);
                    }

                    if (classeSocialOn) {
                        $('#desClaSocial').attr("checked", true);
                    }
                    if (perfilConsumoOn) {
                        $('#desPerConsumo').attr("checked", true);
                    }
                    if (dddFone1On) {
                        $('#desDDDFone1').attr("checked", true);
                        $('#desFone1').attr("checked", true);
                    }
                    if (dddFone2On) {
                        $('#desDDDFone2').attr("checked", true);
                        $('#desFone2').attr("checked", true);
                    }
                    if (dddFone3On) {
                        $('#desDDDFone3').attr("checked", true);
                        $('#desFone3').attr("checked", true);
                    }

                    if (dddCel1On) {
                        $('#desDDDCel1').attr("checked", true);
                        $('#desCel1').attr("checked", true);

                    }
                    if (dddCel2On) {
                        $('#desDDDCel2').attr("checked", true);
                        $('#desCel2').attr("checked", true);
                    }
                    if (dddCel3On) {
                        $('#desDDDCel3').attr("checked", true);
                        $('#desCel3').attr("checked", true);
                    }
                    if (enderecoOn) {
                        $('#desEndereco').attr("checked", true);
                    }
                    if (numeroOn) {
                        $('#desNumero').attr("checked", true);
                    }
                    if (bairroOn) {
                        $('#desBairro').attr("checked", true);
                    }
                    if (complementoOn) {
                        $('#desComplemento').attr("checked", true);
                    }
                    if (cidadeOn) {
                        $('#desCidade').attr("checked", true);
                    }
                    if (estadoOn) {
                        $('#desEstado').attr("checked", true);
                    }
                    if (cepOn) {
                        $('#desCep').attr("checked", true);
                    }
                    if (cidadeObitoOn) {
                        $('#desCidadeOtibo').attr("checked", true);
                    }
                    if (emailOn) {
                        $('#desEmail').attr("checked", true);
                    }
                    if (dataObitoOn) {
                        $('#desDataObito').attr("checked", true);
                    }
                    if (participacaoEmpresarialOn) {
                        $('#desPEmpresarial').attr("checked", true);
                    }
                    if (proconOn) {
                        $('#desProcon').attr("checked", true);
                    }
                } else {
                    $('#mostraFiltrosPj ').show(600);
                }
            }
    );
});

$("#refazerExtracao1").click(function () {

    var idtbFiltro = $("#idenriquecimento1").val();
    $('#atualizarFiltros').val('atualizar');
    $('#idtbExtracao').val(idtbFiltro);


    var tipo;
    var cpfOn;
    var nomeOn;
    var sexoOn;
    var dataNascimentoOn;
    var maeOn;
    var cboOn;
    var desCboOn;
    var rendaEstimadaOn;
    var escolaridadeOn;
    var classeSocialOn;
    var perfilConsumoOn;
    var fone1On;
    var fone2On;
    var fone3On;
    var cel1On;
    var cel2On;
    var cel3On;
    var dddFone1On;
    var dddFone2On;
    var dddFone3On;
    var dddCel1On;
    var dddCel2On;
    var dddCel3On;
    var enderecoOn;
    var numeroOn;
    var proconOn;
    var bairroOn;
    var complementoOn;
    var cidadeOn;
    var estadoOn;
    var cidadeObitoOn;
    var emailOn;
    var dataObitoOn;
    var cepOn;
    var participacaoEmpresarialOn;

    var cpfOb;
    var nomeOb;
    var sexoOb;
    var dataNascimentoOb;
    var maeOb;
    var cboOb;
    var desCboOb;
    var rendaEstimadaOb;
    var escolaridadeOb;
    var classeSocialOb;
    var perfilConsumoOb;
    var fone1Ob;
    var fone2Ob;
    var fone3Ob;
    var cel1Ob;
    var cel2Ob;
    var cel3Ob;
    var dddFone1Ob;
    var dddFone2Ob;
    var dddFone3Ob;
    var dddCel1Ob;
    var dddCel2Ob;
    var dddCel3Ob;
    var enderecoOb;
    var numeroOb;
    var proconOb;
    var bairroOb;
    var complementoOb;
    var cidadeOb;
    var estadoOb;
    var cidadeObitoOb;
    var emailOb;
    var dataObitoOb;
    var cepOb;
    var participacaoEmpresarialOb;
    var classeSocialOnCombo;

    var cnpjOn;
    var cnpjOb;
    var proconPjOn;
    var proconPjOb;
    var nomePjOn;
    var nomePjOb;
    var matrizPjOn;
    var matrizPjOb;
    var fantasiaPjOn;
    var fantasiaPjOb;
    var nascimentoPjOn;
    var nascimentoPjOb;
    var qtdEmpregadosPjOn;
    var qtdEmpregadosPjOb;
    var cnaePjOn;
    var cnaePjOb;
    var naturezaPjOn;
    var bnaturezaPjOb;
    var desCnaePjOn;
    var desCnaePjOb;
    var desNaturezaPjOn;
    var desNaturezaPjOb;
    var enderecoPjOn;
    var enderecoPjOb;
    var numeroPjOn;
    var numeroPjOb;
    var complementoPjOn;
    var complementoPjOb;
    var bairroPjOn;
    var bairroPjOb;
    var cidadePjOn;
    var cidadePjOb;
    var estadoPjOn;
    var estadoPjOb;
    var cepPjOn;
    var cepPjOb;
    var dataSituacaoPjOn;
    var dataSituacaoPjOb;
    var faturamentoPresumidoPjOn;
    var faturamentoPresumidoPjOb;
    var qtdProprietariosPjOn;
    var qtdProprietariosPjOb;
    var perfilConsumoPjOn;
    var perfilConsumoPjOb;
    var situacaoPjOn;
    var situacaoPjOb;
    var portePjOn;
    var portePjOb;
    var fone1PjOn;
    var fone1PjOb;
    var fone2PjOn;
    var fone2PjOb;
    var fone3PjOn;
    var fone3PjOb;
    var cel1PjOn;
    var cel1PjOb;
    var cel2PjOn;
    var cel2PjOb;
    var cel3PjOn;
    var cel3PjOb;
    var sociosPjOn;
    var sociosPjOb;


    var retorno = $.getJSON("/pages/php/buscaFiltroExtracao.php?idtbExtracao=" + idtbFiltro,
            function (data, status) {

                for ($i = 0; $i < data.length; $i++) {


                    //----------------------combos pf--------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=claSocial]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=escolaridade]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var st = data[$i]['tb_extracao_filtros_filtro'].toString();

                        var dataarrayDe = st.split(',');

                        var dataDe = dataarrayDe[0];
                        var dataAte = dataarrayDe[1];

                        $('#nascimentoDe').val(dataDe);
                        $('#nascimentoAte').val(dataAte);
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var st = data[$i]['tb_extracao_filtros_filtro'].toString();

                        var dataarrayDe = st.split(',');

                        var dataDe = dataarrayDe[0];
                        var dataAte = dataarrayDe[1];

                        $('#rendaEstimadaDe').val(dataDe);
                        $('#rendaEstimadaAte').val(dataAte);
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=DDDsFone]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=enderecosQtd]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=estados]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=qtdEmail]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }


                    //----------------------combos pf fim--------------------------------------------------------------------------------------------//



                    if (data[$i]['tb_extracao_filtros_nome_campo'] == 'tipoArquivo' & data[$i]['tb_extracao_filtros_filtro'] == 'cpf') {
                        tipo = 'cpf';
                        $("#tipoArquivo").val(tipo);
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cpf' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cpfOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nome' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        nomeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'sexo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        sexoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dataNascimentoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'mae' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        maeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cbo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cboOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'descCbo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        desCboOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        rendaEstimadaOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        escolaridadeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        classeSocialOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';

                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        perfilConsumoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        enderecoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numero' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        numeroOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        proconOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairro' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        bairroOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complemento' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        complementoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidade' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cidadeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        estadoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadeObito' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cidadeObitoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        emailOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataObito' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dataObitoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cep' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cepOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'participacaoEmpresarial' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        participacaoEmpresarialOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }


//----------------------------------------------------------obrigatórios----------------------------------------------------------------------//                    


                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cpf' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cpfOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cpfOb) {
                            $('#obCpf').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nome' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        nomeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nomeOb) {
                            $('#obNome').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'sexo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        sexoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (sexoOb) {
                            $('#obSexo').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dataNascimentoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataNascimentoOb) {
                            $('#obNascimento').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'mae' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        maeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (maeOb) {
                            $('#obMae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cbo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cboOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cboOb) {
                            $('#obCbo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'descCbo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        desCboOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desCboOb) {
                            $('#obDescCbo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        rendaEstimadaOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (rendaEstimadaOb) {
                            $('#obRestimada').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        escolaridadeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (escolaridadeOb) {
                            $('#obEscolaridade').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        classeSocialOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (classeSocialOb) {
                            $('#obClaSocial').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        perfilConsumoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (perfilConsumoOb) {
                            $('#obPerConsumo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone1Ob) {
                            $('#obDDDFone1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone1' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone1Ob) {
                            $('#obFone1').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone2' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone2Ob) {
                            $('#obDDDFone2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone2' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone2Ob) {
                            $('#obFone2').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone3' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone3Ob) {
                            $('#obDDDFone3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone3' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone3Ob) {
                            $('#obFone3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel1Ob) {
                            $('#obDDDCel1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel1Ob) {
                            $('#obCel1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel2Ob) {
                            $('#obDDDCel2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel2Ob) {
                            $('#obCel2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel3Ob) {
                            $('#obDDDCel3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel3Ob) {
                            $('#obCel3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        enderecoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (enderecoOb) {
                            $('#obEndereco').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numero' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        numeroOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (numeroOb) {
                            $('#obNumero').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        proconOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (proconOb) {
                            $('#obProcon').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairro' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        bairroOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (bairroOb) {
                            $('#obBairro').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complemento' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        complementoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (complementoOb) {
                            $('#obComplemento').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidade' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cidadeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadeOb) {
                            $('#obCidade').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        estadoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (estadoOb) {
                            $('#obEstado').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadeObito' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cidadeObitoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadeObitoOb) {
                            $('#obCidadeObito').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        emailOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (emailOb) {
                            $('#obEmail').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataObito' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dataObitoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataObitoOb) {
                            $('#obDataObito').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cep' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cepOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cepOb) {
                            $('#obCep').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'participacaoEmpresarial' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        participacaoEmpresarialOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (participacaoEmpresarialOb) {
                            $('#obPEmpresarial').attr("checked", true);
                        }
                    }


//----------------------combos pj --------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'enderecoPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=enderecosQtdPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estadoPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=estadosPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadePj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=cidadesPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairroPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=bairroPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

//----------------------combos pj fim  --------------------------------------------------------------------------------------------//

//--------------------pj desejado /obrigatorio---------------------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cnpj') {
                        cnpjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cnpjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cnpjOn) {
                            $('#desCnpj').attr("checked", true);
                        }
                        if (cnpjOb) {
                            $('#obCnpj').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon') {
                        proconPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on,';
                        proconPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on,';
                        if (proconPjOn) {
                            $('#desProcon').attr("checked", true);
                        }
                        if (proconPjOb) {
                            $('#obProcon').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nomePj') {
                        nomePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        nomePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nomePjOn) {
                            $('#desNomePj').attr("checked", true);
                        }
                        if (nomePjOb) {
                            $('#obNomePj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'matriz') {
                        matrizPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        matrizPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (matrizPjOn) {
                            $('#desMatriz').attr("checked", true);
                        }
                        if (matrizPjOb) {
                            $('#obMatriz').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fantasiaPj') {
                        fantasiaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fantasiaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fantasiaPjOn) {
                            $('#desFantasia').attr("checked", true);
                        }
                        if (fantasiaPjOb) {
                            $('#obFantasia').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimentoPj') {
                        nascimentoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        nascimentoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nascimentoPjOn) {
                            $('#desNascimentoPj').attr("checked", true);
                        }
                        if (nascimentoPjOb) {
                            $('#obNascimentoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'qtdEmpregados') {
                        qtdEmpregadosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        qtdEmpregadosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (qtdEmpregadosPjOn) {
                            $('#desQtdEmpregados').attr("checked", true);
                        }
                        if (nascimentoPjOb) {
                            $('#obQtdEmpregados').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cnae') {
                        cnaePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cnaePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cnaePjOn) {
                            $('#desCnae').attr("checked", true);
                        }
                        if (cnaePjOb) {
                            $('#obCnae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'natureza') {
                        naturezaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        naturezaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (naturezaPjOn) {
                            $('#desNatureza').attr("checked", true);
                        }
                        if (naturezaPjOb) {
                            $('#obNatureza').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'desCnae') {
                        desCnaePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        desCnaePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desCnaePjOn) {
                            $('#desDesCnae').attr("checked", true);
                        }
                        if (desCnaePjOb) {
                            $('#obDesCnae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'desNatureza') {
                        desNaturezaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        desNaturezaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desNaturezaPjOn) {
                            $('#desDesNatureza').attr("checked", true);
                        }
                        if (desNaturezaPjOb) {
                            $('#obDesNatureza').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'enderecoPj') {
                        enderecoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        enderecoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (enderecoPjOn) {
                            $('#desEnderecoPj').attr("checked", true);
                        }
                        if (enderecoPjOb) {
                            $('#obEnderecoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numeroPj') {
                        numeroPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        numeroPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (numeroPjOn) {
                            $('#desNumeroPj').attr("checked", true);
                        }
                        if (numeroPjOb) {
                            $('#obNumeroPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complementoPj') {
                        complementoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        complementoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (complementoPjOn) {
                            $('#desComplementoPj').attr("checked", true);
                        }
                        if (complementoPjOb) {
                            $('#obComplementoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairroPj') {
                        bairroPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        bairroPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (bairroPjOn) {
                            $('#desBairroPj').attr("checked", true);
                        }
                        if (bairroPjOb) {
                            $('#obBairroPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadePj') {
                        cidadePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cidadePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadePjOn) {
                            $('#desCidadePj').attr("checked", true);
                        }
                        if (cidadePjOb) {
                            $('#obCidadePj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estadoPj') {
                        estadoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        estadoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (estadoPjOn) {
                            $('#desEstadoPj').attr("checked", true);
                        }
                        if (estadoPjOb) {
                            $('#obEstadoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cepPj') {
                        cepPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cepPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cepPjOn) {
                            $('#desCepPj').attr("checked", true);
                        }
                        if (cepPjOb) {
                            $('#obCepPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataSituacao') {
                        dataSituacaoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        dataSituacaoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataSituacaoPjOn) {
                            $('#desDataSituacao').attr("checked", true);
                        }
                        if (dataSituacaoPjOb) {
                            $('#obDataSituacao').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'faturamentoPresumido') {
                        faturamentoPresumidoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        faturamentoPresumidoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (faturamentoPresumidoPjOn) {
                            $('#desFPresumido').attr("checked", true);
                        }
                        if (faturamentoPresumidoPjOb) {
                            $('#obFPresumido').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'qtdProprietarios') {
                        qtdProprietariosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        qtdProprietariosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (qtdProprietariosPjOn) {
                            $('#desQtdProprietarios').attr("checked", true);
                        }
                        if (qtdProprietariosPjOb) {
                            $('#obQtdProprietarios').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo') {
                        perfilConsumoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        perfilConsumoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (perfilConsumoPjOn) {
                            $('#desConsumo').attr("checked", true);
                        }
                        if (perfilConsumoPjOb) {
                            $('#obPConsumo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'situacao') {
                        situacaoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        situacaoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (situacaoPjOn) {
                            $('#desSituacao').attr("checked", true);
                        }
                        if (situacaoPjOb) {
                            $('#obSituacao').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'porte') {
                        portePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        portePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (portePjOn) {
                            $('#desPorte').attr("checked", true);
                        }
                        if (portePjOb) {
                            $('#obPorte').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone1Pj') {
                        fone1PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone1PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone1PjOn) {
                            $('#desFone1Pj').attr("checked", true);
                        }
                        if (fone1PjOb) {
                            $('#obFone1Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone2Pj') {
                        fone2PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone2PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone2PjOn) {
                            $('#desFone2Pj').attr("checked", true);
                        }
                        if (fone2PjOb) {
                            $('#obFone2Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone3Pj') {
                        fone3PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone3PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone3PjOn) {
                            $('#desFone3Pj').attr("checked", true);
                        }
                        if (fone3PjOb) {
                            $('#obFone3Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel1Pj') {
                        cel1PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel1PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel1PjOn) {
                            $('#desCel1Pj').attr("checked", true);
                        }
                        if (cel1PjOb) {
                            $('#obCel1Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel2Pj') {
                        cel2PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel2PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel2PjOn) {
                            $('#desCel2Pj').attr("checked", true);
                        }
                        if (cel2PjOb) {
                            $('#obCe2lPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel3Pj') {
                        cel3PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel3PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel3PjOn) {
                            $('#desCel3Pj').attr("checked", true);
                        }
                        if (cel3PjOb) {
                            $('#obCe3lPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'socios') {
                        sociosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        sociosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (sociosPjOn) {
                            $('#desSocio').attr("checked", true);
                        }
                        if (sociosPjOb) {
                            $('#obSocio').attr("checked", true);
                        }
                    }
                }
                if (tipo === 'cpf') {
                    $('#mostraFiltros').show(600);
                    if (cpfOn) {
                        $('#desCpf').attr("checked", true);
                    }
                    if (nomeOn) {
                        $('#desNome').attr("checked", true);
                    }
                    if (sexoOn) {
                        $('#desSexo').attr("checked", true);
                    }
                    if (dataNascimentoOn) {
                        $('#desNascimento').attr("checked", true);
                    }
                    if (maeOn) {
                        $('#desMae').attr("checked", true);
                    }
                    if (cboOn) {
                        $('#desCbo').attr("checked", true);
                    }
                    if (desCboOn) {
                        $('#desDescCbo').attr("checked", true);
                    }
                    if (rendaEstimadaOn) {
                        $('#desRestimada').attr("checked", true);
                    }
                    if (escolaridadeOn) {
                        $('#desEscolaridade').attr("checked", true);
                    }

                    if (classeSocialOn) {
                        $('#desClaSocial').attr("checked", true);
                    }
                    if (perfilConsumoOn) {
                        $('#desPerConsumo').attr("checked", true);
                    }
                    if (dddFone1On) {
                        $('#desDDDFone1').attr("checked", true);
                        $('#desFone1').attr("checked", true);
                    }
                    if (dddFone2On) {
                        $('#desDDDFone2').attr("checked", true);
                        $('#desFone2').attr("checked", true);
                    }
                    if (dddFone3On) {
                        $('#desDDDFone3').attr("checked", true);
                        $('#desFone3').attr("checked", true);
                    }

                    if (dddCel1On) {
                        $('#desDDDCel1').attr("checked", true);
                        $('#desCel1').attr("checked", true);

                    }
                    if (dddCel2On) {
                        $('#desDDDCel2').attr("checked", true);
                        $('#desCel2').attr("checked", true);
                    }
                    if (dddCel3On) {
                        $('#desDDDCel3').attr("checked", true);
                        $('#desCel3').attr("checked", true);
                    }
                    if (enderecoOn) {
                        $('#desEndereco').attr("checked", true);
                    }
                    if (numeroOn) {
                        $('#desNumero').attr("checked", true);
                    }
                    if (bairroOn) {
                        $('#desBairro').attr("checked", true);
                    }
                    if (complementoOn) {
                        $('#desComplemento').attr("checked", true);
                    }
                    if (cidadeOn) {
                        $('#desCidade').attr("checked", true);
                    }
                    if (estadoOn) {
                        $('#desEstado').attr("checked", true);
                    }
                    if (cepOn) {
                        $('#desCep').attr("checked", true);
                    }
                    if (cidadeObitoOn) {
                        $('#desCidadeOtibo').attr("checked", true);
                    }
                    if (emailOn) {
                        $('#desEmail').attr("checked", true);
                    }
                    if (dataObitoOn) {
                        $('#desDataObito').attr("checked", true);
                    }
                    if (participacaoEmpresarialOn) {
                        $('#desPEmpresarial').attr("checked", true);
                    }
                    if (proconOn) {
                        $('#desProcon').attr("checked", true);
                    }
                } else {
                    $('#mostraFiltrosPj ').show(600);
                }
            });
});

$("#refazerExtracao2").click(function () {

    var idtbFiltro = $("#idenriquecimento2").val();
    $('#atualizarFiltros').val('atualizar');
    $('#idtbExtracao').val(idtbFiltro);


    var tipo;
    var cpfOn;
    var nomeOn;
    var sexoOn;
    var dataNascimentoOn;
    var maeOn;
    var cboOn;
    var desCboOn;
    var rendaEstimadaOn;
    var escolaridadeOn;
    var classeSocialOn;
    var perfilConsumoOn;
    var fone1On;
    var fone2On;
    var fone3On;
    var cel1On;
    var cel2On;
    var cel3On;
    var dddFone1On;
    var dddFone2On;
    var dddFone3On;
    var dddCel1On;
    var dddCel2On;
    var dddCel3On;
    var enderecoOn;
    var numeroOn;
    var proconOn;
    var bairroOn;
    var complementoOn;
    var cidadeOn;
    var estadoOn;
    var cidadeObitoOn;
    var emailOn;
    var dataObitoOn;
    var cepOn;
    var participacaoEmpresarialOn;

    var cpfOb;
    var nomeOb;
    var sexoOb;
    var dataNascimentoOb;
    var maeOb;
    var cboOb;
    var desCboOb;
    var rendaEstimadaOb;
    var escolaridadeOb;
    var classeSocialOb;
    var perfilConsumoOb;
    var fone1Ob;
    var fone2Ob;
    var fone3Ob;
    var cel1Ob;
    var cel2Ob;
    var cel3Ob;
    var dddFone1Ob;
    var dddFone2Ob;
    var dddFone3Ob;
    var dddCel1Ob;
    var dddCel2Ob;
    var dddCel3Ob;
    var enderecoOb;
    var numeroOb;
    var proconOb;
    var bairroOb;
    var complementoOb;
    var cidadeOb;
    var estadoOb;
    var cidadeObitoOb;
    var emailOb;
    var dataObitoOb;
    var cepOb;
    var participacaoEmpresarialOb;
    var classeSocialOnCombo;

    var cnpjOn;
    var cnpjOb;
    var proconPjOn;
    var proconPjOb;
    var nomePjOn;
    var nomePjOb;
    var matrizPjOn;
    var matrizPjOb;
    var fantasiaPjOn;
    var fantasiaPjOb;
    var nascimentoPjOn;
    var nascimentoPjOb;
    var qtdEmpregadosPjOn;
    var qtdEmpregadosPjOb;
    var cnaePjOn;
    var cnaePjOb;
    var naturezaPjOn;
    var bnaturezaPjOb;
    var desCnaePjOn;
    var desCnaePjOb;
    var desNaturezaPjOn;
    var desNaturezaPjOb;
    var enderecoPjOn;
    var enderecoPjOb;
    var numeroPjOn;
    var numeroPjOb;
    var complementoPjOn;
    var complementoPjOb;
    var bairroPjOn;
    var bairroPjOb;
    var cidadePjOn;
    var cidadePjOb;
    var estadoPjOn;
    var estadoPjOb;
    var cepPjOn;
    var cepPjOb;
    var dataSituacaoPjOn;
    var dataSituacaoPjOb;
    var faturamentoPresumidoPjOn;
    var faturamentoPresumidoPjOb;
    var qtdProprietariosPjOn;
    var qtdProprietariosPjOb;
    var perfilConsumoPjOn;
    var perfilConsumoPjOb;
    var situacaoPjOn;
    var situacaoPjOb;
    var portePjOn;
    var portePjOb;
    var fone1PjOn;
    var fone1PjOb;
    var fone2PjOn;
    var fone2PjOb;
    var fone3PjOn;
    var fone3PjOb;
    var cel1PjOn;
    var cel1PjOb;
    var cel2PjOn;
    var cel2PjOb;
    var cel3PjOn;
    var cel3PjOb;
    var sociosPjOn;
    var sociosPjOb;

    var retorno = $.getJSON("/pages/php/buscaFiltroExtracao.php?idtbExtracao=" + idtbFiltro,
            function (data, status) {

                for ($i = 0; $i < data.length; $i++) {


                    //----------------------combos pf--------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=claSocial]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=escolaridade]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var st = data[$i]['tb_extracao_filtros_filtro'].toString();

                        var dataarrayDe = st.split(',');

                        var dataDe = dataarrayDe[0];
                        var dataAte = dataarrayDe[1];

                        $('#nascimentoDe').val(dataDe);
                        $('#nascimentoAte').val(dataAte);
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var st = data[$i]['tb_extracao_filtros_filtro'].toString();

                        var dataarrayDe = st.split(',');

                        var dataDe = dataarrayDe[0];
                        var dataAte = dataarrayDe[1];

                        $('#rendaEstimadaDe').val(dataDe);
                        $('#rendaEstimadaAte').val(dataAte);
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=DDDsFone]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=enderecosQtd]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=estados]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=qtdEmail]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }


                    //----------------------combos pf fim--------------------------------------------------------------------------------------------//



                    if (data[$i]['tb_extracao_filtros_nome_campo'] == 'tipoArquivo' & data[$i]['tb_extracao_filtros_filtro'] == 'cpf') {
                        tipo = 'cpf';
                        $("#tipoArquivo").val(tipo);
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cpf' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cpfOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nome' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        nomeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'sexo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        sexoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dataNascimentoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'mae' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        maeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cbo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cboOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'descCbo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        desCboOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        rendaEstimadaOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        escolaridadeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        classeSocialOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';

                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        perfilConsumoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        enderecoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numero' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        numeroOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        proconOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairro' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        bairroOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complemento' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        complementoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidade' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cidadeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        estadoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadeObito' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cidadeObitoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        emailOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataObito' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dataObitoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cep' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cepOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'participacaoEmpresarial' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        participacaoEmpresarialOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }


//----------------------------------------------------------obrigatórios----------------------------------------------------------------------//                    


                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cpf' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cpfOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cpfOb) {
                            $('#obCpf').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nome' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        nomeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nomeOb) {
                            $('#obNome').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'sexo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        sexoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (sexoOb) {
                            $('#obSexo').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dataNascimentoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataNascimentoOb) {
                            $('#obNascimento').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'mae' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        maeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (maeOb) {
                            $('#obMae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cbo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cboOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cboOb) {
                            $('#obCbo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'descCbo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        desCboOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desCboOb) {
                            $('#obDescCbo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        rendaEstimadaOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (rendaEstimadaOb) {
                            $('#obRestimada').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        escolaridadeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (escolaridadeOb) {
                            $('#obEscolaridade').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        classeSocialOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (classeSocialOb) {
                            $('#obClaSocial').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        perfilConsumoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (perfilConsumoOb) {
                            $('#obPerConsumo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone1Ob) {
                            $('#obDDDFone1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone1' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone1Ob) {
                            $('#obFone1').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone2' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone2Ob) {
                            $('#obDDDFone2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone2' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone2Ob) {
                            $('#obFone2').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone3' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone3Ob) {
                            $('#obDDDFone3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone3' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone3Ob) {
                            $('#obFone3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel1Ob) {
                            $('#obDDDCel1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel1Ob) {
                            $('#obCel1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel2Ob) {
                            $('#obDDDCel2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel2Ob) {
                            $('#obCel2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel3Ob) {
                            $('#obDDDCel3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel3Ob) {
                            $('#obCel3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        enderecoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (enderecoOb) {
                            $('#obEndereco').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numero' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        numeroOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (numeroOb) {
                            $('#obNumero').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        proconOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (proconOb) {
                            $('#obProcon').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairro' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        bairroOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (bairroOb) {
                            $('#obBairro').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complemento' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        complementoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (complementoOb) {
                            $('#obComplemento').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidade' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cidadeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadeOb) {
                            $('#obCidade').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        estadoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (estadoOb) {
                            $('#obEstado').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadeObito' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cidadeObitoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadeObitoOb) {
                            $('#obCidadeObito').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        emailOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (emailOb) {
                            $('#obEmail').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataObito' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dataObitoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataObitoOb) {
                            $('#obDataObito').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cep' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cepOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cepOb) {
                            $('#obCep').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'participacaoEmpresarial' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        participacaoEmpresarialOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (participacaoEmpresarialOb) {
                            $('#obPEmpresarial').attr("checked", true);
                        }
                    }


//----------------------combos pj --------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'enderecoPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=enderecosQtdPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estadoPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=estadosPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadePj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=cidadesPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairroPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=bairroPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

//----------------------combos pj fim  --------------------------------------------------------------------------------------------//

//--------------------pj desejado /obrigatorio---------------------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cnpj') {
                        cnpjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cnpjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cnpjOn) {
                            $('#desCnpj').attr("checked", true);
                        }
                        if (cnpjOb) {
                            $('#obCnpj').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon') {
                        proconPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on,';
                        proconPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on,';
                        if (proconPjOn) {
                            $('#desProcon').attr("checked", true);
                        }
                        if (proconPjOb) {
                            $('#obProcon').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nomePj') {
                        nomePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        nomePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nomePjOn) {
                            $('#desNomePj').attr("checked", true);
                        }
                        if (nomePjOb) {
                            $('#obNomePj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'matriz') {
                        matrizPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        matrizPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (matrizPjOn) {
                            $('#desMatriz').attr("checked", true);
                        }
                        if (matrizPjOb) {
                            $('#obMatriz').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fantasiaPj') {
                        fantasiaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fantasiaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fantasiaPjOn) {
                            $('#desFantasia').attr("checked", true);
                        }
                        if (fantasiaPjOb) {
                            $('#obFantasia').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimentoPj') {
                        nascimentoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        nascimentoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nascimentoPjOn) {
                            $('#desNascimentoPj').attr("checked", true);
                        }
                        if (nascimentoPjOb) {
                            $('#obNascimentoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'qtdEmpregados') {
                        qtdEmpregadosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        qtdEmpregadosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (qtdEmpregadosPjOn) {
                            $('#desQtdEmpregados').attr("checked", true);
                        }
                        if (nascimentoPjOb) {
                            $('#obQtdEmpregados').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cnae') {
                        cnaePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cnaePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cnaePjOn) {
                            $('#desCnae').attr("checked", true);
                        }
                        if (cnaePjOb) {
                            $('#obCnae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'natureza') {
                        naturezaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        bnaturezaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (naturezaPjOn) {
                            $('#desNatureza').attr("checked", true);
                        }
                        if (bnaturezaPjOb) {
                            $('#obNatureza').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'desCnae') {
                        desCnaePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        desCnaePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desCnaePjOn) {
                            $('#desDesCnae').attr("checked", true);
                        }
                        if (desCnaePjOb) {
                            $('#obDesCnae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'desNatureza') {
                        desNaturezaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        desNaturezaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desNaturezaPjOn) {
                            $('#desDesNatureza').attr("checked", true);
                        }
                        if (desNaturezaPjOb) {
                            $('#obDesNatureza').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'enderecoPj') {
                        enderecoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        enderecoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (enderecoPjOn) {
                            $('#desEnderecoPj').attr("checked", true);
                        }
                        if (enderecoPjOb) {
                            $('#obEnderecoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numeroPj') {
                        numeroPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        numeroPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (numeroPjOn) {
                            $('#desNumeroPj').attr("checked", true);
                        }
                        if (numeroPjOb) {
                            $('#obNumeroPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complementoPj') {
                        complementoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        complementoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (complementoPjOn) {
                            $('#desComplementoPj').attr("checked", true);
                        }
                        if (complementoPjOb) {
                            $('#obComplementoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairroPj') {
                        bairroPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        bairroPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (bairroPjOn) {
                            $('#desBairroPj').attr("checked", true);
                        }
                        if (bairroPjOb) {
                            $('#obBairroPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadePj') {
                        cidadePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cidadePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadePjOn) {
                            $('#desCidadePj').attr("checked", true);
                        }
                        if (cidadePjOb) {
                            $('#obCidadePj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estadoPj') {
                        estadoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        estadoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (estadoPjOn) {
                            $('#desEstadoPj').attr("checked", true);
                        }
                        if (estadoPjOb) {
                            $('#obEstadoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cepPj') {
                        cepPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cepPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cepPjOn) {
                            $('#desCepPj').attr("checked", true);
                        }
                        if (cepPjOb) {
                            $('#obCepPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataSituacao') {
                        dataSituacaoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        dataSituacaoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataSituacaoPjOn) {
                            $('#desDataSituacao').attr("checked", true);
                        }
                        if (dataSituacaoPjOb) {
                            $('#obDataSituacao').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'faturamentoPresumido') {
                        faturamentoPresumidoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        faturamentoPresumidoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (faturamentoPresumidoPjOn) {
                            $('#desFPresumido').attr("checked", true);
                        }
                        if (faturamentoPresumidoPjOb) {
                            $('#obFPresumido').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'qtdProprietarios') {
                        qtdProprietariosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        qtdProprietariosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (qtdProprietariosPjOn) {
                            $('#desQtdProprietarios').attr("checked", true);
                        }
                        if (qtdProprietariosPjOb) {
                            $('#obQtdProprietarios').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo') {
                        perfilConsumoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        perfilConsumoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (perfilConsumoPjOn) {
                            $('#desConsumo').attr("checked", true);
                        }
                        if (perfilConsumoPjOb) {
                            $('#obPConsumo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'situacao') {
                        situacaoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        situacaoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (situacaoPjOn) {
                            $('#desSituacao').attr("checked", true);
                        }
                        if (situacaoPjOb) {
                            $('#obSituacao').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'porte') {
                        portePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        portePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (portePjOn) {
                            $('#desPorte').attr("checked", true);
                        }
                        if (portePjOb) {
                            $('#obPorte').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone1Pj') {
                        fone1PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone1PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone1PjOn) {
                            $('#desFone1Pj').attr("checked", true);
                        }
                        if (fone1PjOb) {
                            $('#obFone1Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone2Pj') {
                        fone2PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone2PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone2PjOn) {
                            $('#desFone2Pj').attr("checked", true);
                        }
                        if (fone2PjOb) {
                            $('#obFone2Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone3Pj') {
                        fone3PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone3PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone3PjOn) {
                            $('#desFone3Pj').attr("checked", true);
                        }
                        if (fone3PjOb) {
                            $('#obFone3Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel1Pj') {
                        cel1PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel1PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel1PjOn) {
                            $('#desCel1Pj').attr("checked", true);
                        }
                        if (cel1PjOb) {
                            $('#obCel1Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel2Pj') {
                        cel2PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel2PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel2PjOn) {
                            $('#desCel2Pj').attr("checked", true);
                        }
                        if (cel2PjOb) {
                            $('#obCe2lPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel3Pj') {
                        cel3PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel3PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel3PjOn) {
                            $('#desCel3Pj').attr("checked", true);
                        }
                        if (cel3PjOb) {
                            $('#obCe3lPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'socios') {
                        sociosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        sociosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (sociosPjOn) {
                            $('#desSocio').attr("checked", true);
                        }
                        if (sociosPjOb) {
                            $('#obSocio').attr("checked", true);
                        }
                    }
                }
                if (tipo === 'cpf') {
                    $('#mostraFiltros').show(600);
                    if (cpfOn) {
                        $('#desCpf').attr("checked", true);
                    }
                    if (nomeOn) {
                        $('#desNome').attr("checked", true);
                    }
                    if (sexoOn) {
                        $('#desSexo').attr("checked", true);
                    }
                    if (dataNascimentoOn) {
                        $('#desNascimento').attr("checked", true);
                    }
                    if (maeOn) {
                        $('#desMae').attr("checked", true);
                    }
                    if (cboOn) {
                        $('#desCbo').attr("checked", true);
                    }
                    if (desCboOn) {
                        $('#desDescCbo').attr("checked", true);
                    }
                    if (rendaEstimadaOn) {
                        $('#desRestimada').attr("checked", true);
                    }
                    if (escolaridadeOn) {
                        $('#desEscolaridade').attr("checked", true);
                    }

                    if (classeSocialOn) {
                        $('#desClaSocial').attr("checked", true);
                    }
                    if (perfilConsumoOn) {
                        $('#desPerConsumo').attr("checked", true);
                    }
                    if (dddFone1On) {
                        $('#desDDDFone1').attr("checked", true);
                        $('#desFone1').attr("checked", true);
                    }
                    if (dddFone2On) {
                        $('#desDDDFone2').attr("checked", true);
                        $('#desFone2').attr("checked", true);
                    }
                    if (dddFone3On) {
                        $('#desDDDFone3').attr("checked", true);
                        $('#desFone3').attr("checked", true);
                    }

                    if (dddCel1On) {
                        $('#desDDDCel1').attr("checked", true);
                        $('#desCel1').attr("checked", true);

                    }
                    if (dddCel2On) {
                        $('#desDDDCel2').attr("checked", true);
                        $('#desCel2').attr("checked", true);
                    }
                    if (dddCel3On) {
                        $('#desDDDCel3').attr("checked", true);
                        $('#desCel3').attr("checked", true);
                    }
                    if (enderecoOn) {
                        $('#desEndereco').attr("checked", true);
                    }
                    if (numeroOn) {
                        $('#desNumero').attr("checked", true);
                    }
                    if (bairroOn) {
                        $('#desBairro').attr("checked", true);
                    }
                    if (complementoOn) {
                        $('#desComplemento').attr("checked", true);
                    }
                    if (cidadeOn) {
                        $('#desCidade').attr("checked", true);
                    }
                    if (estadoOn) {
                        $('#desEstado').attr("checked", true);
                    }
                    if (cepOn) {
                        $('#desCep').attr("checked", true);
                    }
                    if (cidadeObitoOn) {
                        $('#desCidadeOtibo').attr("checked", true);
                    }
                    if (emailOn) {
                        $('#desEmail').attr("checked", true);
                    }
                    if (dataObitoOn) {
                        $('#desDataObito').attr("checked", true);
                    }
                    if (participacaoEmpresarialOn) {
                        $('#desPEmpresarial').attr("checked", true);
                    }
                    if (proconOn) {
                        $('#desProcon').attr("checked", true);
                    }
                } else {
                    $('#mostraFiltrosPj ').show(600);
                }
            });
});
$("#refazerExtracao3").click(function () {

    var idtbFiltro = $("#idenriquecimento3").val();
    $('#atualizarFiltros').val('atualizar');
    $('#idtbExtracao').val(idtbFiltro);


    var tipo;
    var cpfOn;
    var nomeOn;
    var sexoOn;
    var dataNascimentoOn;
    var maeOn;
    var cboOn;
    var desCboOn;
    var rendaEstimadaOn;
    var escolaridadeOn;
    var classeSocialOn;
    var perfilConsumoOn;
    var fone1On;
    var fone2On;
    var fone3On;
    var cel1On;
    var cel2On;
    var cel3On;
    var dddFone1On;
    var dddFone2On;
    var dddFone3On;
    var dddCel1On;
    var dddCel2On;
    var dddCel3On;
    var enderecoOn;
    var numeroOn;
    var proconOn;
    var bairroOn;
    var complementoOn;
    var cidadeOn;
    var estadoOn;
    var cidadeObitoOn;
    var emailOn;
    var dataObitoOn;
    var cepOn;
    var participacaoEmpresarialOn;

    var cpfOb;
    var nomeOb;
    var sexoOb;
    var dataNascimentoOb;
    var maeOb;
    var cboOb;
    var desCboOb;
    var rendaEstimadaOb;
    var escolaridadeOb;
    var classeSocialOb;
    var perfilConsumoOb;
    var fone1Ob;
    var fone2Ob;
    var fone3Ob;
    var cel1Ob;
    var cel2Ob;
    var cel3Ob;
    var dddFone1Ob;
    var dddFone2Ob;
    var dddFone3Ob;
    var dddCel1Ob;
    var dddCel2Ob;
    var dddCel3Ob;
    var enderecoOb;
    var numeroOb;
    var proconOb;
    var bairroOb;
    var complementoOb;
    var cidadeOb;
    var estadoOb;
    var cidadeObitoOb;
    var emailOb;
    var dataObitoOb;
    var cepOb;
    var participacaoEmpresarialOb;
    var classeSocialOnCombo;
    var cnpjOn;
    var cnpjOb;
    var proconPjOn;
    var proconPjOb;
    var nomePjOn;
    var nomePjOb;
    var matrizPjOn;
    var matrizPjOb;
    var fantasiaPjOn;
    var fantasiaPjOb;
    var nascimentoPjOn;
    var nascimentoPjOb;
    var qtdEmpregadosPjOn;
    var qtdEmpregadosPjOb;
    var cnaePjOn;
    var cnaePjOb;
    var naturezaPjOn;
    var bnaturezaPjOb;
    var desCnaePjOn;
    var desCnaePjOb;
    var desNaturezaPjOn;
    var desNaturezaPjOb;
    var enderecoPjOn;
    var enderecoPjOb;
    var numeroPjOn;
    var numeroPjOb;
    var complementoPjOn;
    var complementoPjOb;
    var bairroPjOn;
    var bairroPjOb;
    var cidadePjOn;
    var cidadePjOb;
    var estadoPjOn;
    var estadoPjOb;
    var cepPjOn;
    var cepPjOb;
    var dataSituacaoPjOn;
    var dataSituacaoPjOb;
    var faturamentoPresumidoPjOn;
    var faturamentoPresumidoPjOb;
    var qtdProprietariosPjOn;
    var qtdProprietariosPjOb;
    var perfilConsumoPjOn;
    var perfilConsumoPjOb;
    var situacaoPjOn;
    var situacaoPjOb;
    var portePjOn;
    var portePjOb;
    var fone1PjOn;
    var fone1PjOb;
    var fone2PjOn;
    var fone2PjOb;
    var fone3PjOn;
    var fone3PjOb;
    var cel1PjOn;
    var cel1PjOb;
    var cel2PjOn;
    var cel2PjOb;
    var cel3PjOn;
    var cel3PjOb;
    var sociosPjOn;
    var sociosPjOb;

    var retorno = $.getJSON("/pages/php/buscaFiltroExtracao.php?idtbExtracao=" + idtbFiltro,
            function (data, status) {

                for ($i = 0; $i < data.length; $i++) {


                    //----------------------combos pf--------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=claSocial]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=escolaridade]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var st = data[$i]['tb_extracao_filtros_filtro'].toString();

                        var dataarrayDe = st.split(',');

                        var dataDe = dataarrayDe[0];
                        var dataAte = dataarrayDe[1];

                        $('#nascimentoDe').val(dataDe);
                        $('#nascimentoAte').val(dataAte);
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var st = data[$i]['tb_extracao_filtros_filtro'].toString();

                        var dataarrayDe = st.split(',');

                        var dataDe = dataarrayDe[0];
                        var dataAte = dataarrayDe[1];

                        $('#rendaEstimadaDe').val(dataDe);
                        $('#rendaEstimadaAte').val(dataAte);
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=DDDsFone]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=enderecosQtd]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=estados]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=qtdEmail]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }


                    //----------------------combos pf fim--------------------------------------------------------------------------------------------//



                    if (data[$i]['tb_extracao_filtros_nome_campo'] == 'tipoArquivo' & data[$i]['tb_extracao_filtros_filtro'] == 'cpf') {
                        tipo = 'cpf';
                        $("#tipoArquivo").val(tipo);
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cpf' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cpfOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nome' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        nomeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'sexo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        sexoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dataNascimentoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'mae' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        maeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cbo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cboOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'descCbo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        desCboOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        rendaEstimadaOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        escolaridadeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        classeSocialOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';

                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        perfilConsumoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        enderecoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numero' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        numeroOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        proconOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairro' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        bairroOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complemento' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        complementoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidade' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cidadeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        estadoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadeObito' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cidadeObitoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        emailOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataObito' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dataObitoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cep' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cepOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'participacaoEmpresarial' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        participacaoEmpresarialOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }


//----------------------------------------------------------obrigatórios----------------------------------------------------------------------//                    


                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cpf' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cpfOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cpfOb) {
                            $('#obCpf').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nome' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        nomeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nomeOb) {
                            $('#obNome').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'sexo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        sexoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (sexoOb) {
                            $('#obSexo').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dataNascimentoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataNascimentoOb) {
                            $('#obNascimento').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'mae' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        maeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (maeOb) {
                            $('#obMae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cbo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cboOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cboOb) {
                            $('#obCbo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'descCbo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        desCboOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desCboOb) {
                            $('#obDescCbo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        rendaEstimadaOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (rendaEstimadaOb) {
                            $('#obRestimada').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        escolaridadeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (escolaridadeOb) {
                            $('#obEscolaridade').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        classeSocialOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (classeSocialOb) {
                            $('#obClaSocial').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        perfilConsumoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (perfilConsumoOb) {
                            $('#obPerConsumo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone1Ob) {
                            $('#obDDDFone1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone1' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone1Ob) {
                            $('#obFone1').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone2' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone2Ob) {
                            $('#obDDDFone2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone2' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone2Ob) {
                            $('#obFone2').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone3' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone3Ob) {
                            $('#obDDDFone3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone3' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone3Ob) {
                            $('#obFone3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel1Ob) {
                            $('#obDDDCel1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel1Ob) {
                            $('#obCel1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel2Ob) {
                            $('#obDDDCel2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel2Ob) {
                            $('#obCel2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel3Ob) {
                            $('#obDDDCel3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel3Ob) {
                            $('#obCel3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        enderecoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (enderecoOb) {
                            $('#obEndereco').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numero' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        numeroOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (numeroOb) {
                            $('#obNumero').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        proconOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (proconOb) {
                            $('#obProcon').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairro' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        bairroOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (bairroOb) {
                            $('#obBairro').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complemento' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        complementoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (complementoOb) {
                            $('#obComplemento').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidade' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cidadeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadeOb) {
                            $('#obCidade').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        estadoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (estadoOb) {
                            $('#obEstado').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadeObito' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cidadeObitoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadeObitoOb) {
                            $('#obCidadeObito').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        emailOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (emailOb) {
                            $('#obEmail').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataObito' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dataObitoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataObitoOb) {
                            $('#obDataObito').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cep' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cepOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cepOb) {
                            $('#obCep').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'participacaoEmpresarial' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        participacaoEmpresarialOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (participacaoEmpresarialOb) {
                            $('#obPEmpresarial').attr("checked", true);
                        }
                    }


//----------------------combos pj --------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'enderecoPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=enderecosQtdPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estadoPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=estadosPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadePj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=cidadesPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairroPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=bairroPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

//----------------------combos pj fim  --------------------------------------------------------------------------------------------//

//--------------------pj desejado /obrigatorio---------------------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cnpj') {
                        cnpjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cnpjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cnpjOn) {
                            $('#desCnpj').attr("checked", true);
                        }
                        if (cnpjOb) {
                            $('#obCnpj').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon') {
                        proconPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on,';
                        proconPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on,';
                        if (proconPjOn) {
                            $('#desProcon').attr("checked", true);
                        }
                        if (proconPjOb) {
                            $('#obProcon').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nomePj') {
                        nomePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        nomePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nomePjOn) {
                            $('#desNomePj').attr("checked", true);
                        }
                        if (nomePjOb) {
                            $('#obNomePj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'matriz') {
                        matrizPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        matrizPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (matrizPjOn) {
                            $('#desMatriz').attr("checked", true);
                        }
                        if (matrizPjOb) {
                            $('#obMatriz').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fantasiaPj') {
                        fantasiaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fantasiaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fantasiaPjOn) {
                            $('#desFantasia').attr("checked", true);
                        }
                        if (fantasiaPjOb) {
                            $('#obFantasia').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimentoPj') {
                        nascimentoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        nascimentoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nascimentoPjOn) {
                            $('#desNascimentoPj').attr("checked", true);
                        }
                        if (nascimentoPjOb) {
                            $('#obNascimentoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'qtdEmpregados') {
                        qtdEmpregadosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        qtdEmpregadosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (qtdEmpregadosPjOn) {
                            $('#desQtdEmpregados').attr("checked", true);
                        }
                        if (nascimentoPjOb) {
                            $('#obQtdEmpregados').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cnae') {
                        cnaePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cnaePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cnaePjOn) {
                            $('#desCnae').attr("checked", true);
                        }
                        if (cnaePjOb) {
                            $('#obCnae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'natureza') {
                        naturezaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        naturezaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (naturezaPjOn) {
                            $('#desNatureza').attr("checked", true);
                        }
                        if (naturezaPjOb) {
                            $('#obNatureza').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'desCnae') {
                        desCnaePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        desCnaePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desCnaePjOn) {
                            $('#desDesCnae').attr("checked", true);
                        }
                        if (desCnaePjOb) {
                            $('#obDesCnae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'desNatureza') {
                        desNaturezaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        desNaturezaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desNaturezaPjOn) {
                            $('#desDesNatureza').attr("checked", true);
                        }
                        if (desNaturezaPjOb) {
                            $('#obDesNatureza').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'enderecoPj') {
                        enderecoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        enderecoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (enderecoPjOn) {
                            $('#desEnderecoPj').attr("checked", true);
                        }
                        if (enderecoPjOb) {
                            $('#obEnderecoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numeroPj') {
                        numeroPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        numeroPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (numeroPjOn) {
                            $('#desNumeroPj').attr("checked", true);
                        }
                        if (numeroPjOb) {
                            $('#obNumeroPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complementoPj') {
                        complementoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        complementoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (complementoPjOn) {
                            $('#desComplementoPj').attr("checked", true);
                        }
                        if (complementoPjOb) {
                            $('#obComplementoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairroPj') {
                        bairroPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        bairroPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (bairroPjOn) {
                            $('#desBairroPj').attr("checked", true);
                        }
                        if (bairroPjOb) {
                            $('#obBairroPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadePj') {
                        cidadePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cidadePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadePjOn) {
                            $('#desCidadePj').attr("checked", true);
                        }
                        if (cidadePjOb) {
                            $('#obCidadePj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estadoPj') {
                        estadoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        estadoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (estadoPjOn) {
                            $('#desEstadoPj').attr("checked", true);
                        }
                        if (estadoPjOb) {
                            $('#obEstadoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cepPj') {
                        cepPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cepPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cepPjOn) {
                            $('#desCepPj').attr("checked", true);
                        }
                        if (cepPjOb) {
                            $('#obCepPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataSituacao') {
                        dataSituacaoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        dataSituacaoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataSituacaoPjOn) {
                            $('#desDataSituacao').attr("checked", true);
                        }
                        if (dataSituacaoPjOb) {
                            $('#obDataSituacao').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'faturamentoPresumido') {
                        faturamentoPresumidoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        faturamentoPresumidoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (faturamentoPresumidoPjOn) {
                            $('#desFPresumido').attr("checked", true);
                        }
                        if (faturamentoPresumidoPjOb) {
                            $('#obFPresumido').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'qtdProprietarios') {
                        qtdProprietariosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        qtdProprietariosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (qtdProprietariosPjOn) {
                            $('#desQtdProprietarios').attr("checked", true);
                        }
                        if (qtdProprietariosPjOb) {
                            $('#obQtdProprietarios').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo') {
                        perfilConsumoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        perfilConsumoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (perfilConsumoPjOn) {
                            $('#desConsumo').attr("checked", true);
                        }
                        if (perfilConsumoPjOb) {
                            $('#obPConsumo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'situacao') {
                        situacaoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        situacaoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (situacaoPjOn) {
                            $('#desSituacao').attr("checked", true);
                        }
                        if (situacaoPjOb) {
                            $('#obSituacao').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'porte') {
                        portePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        portePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (portePjOn) {
                            $('#desPorte').attr("checked", true);
                        }
                        if (portePjOb) {
                            $('#obPorte').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone1Pj') {
                        fone1PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone1PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone1PjOn) {
                            $('#desFone1Pj').attr("checked", true);
                        }
                        if (fone1PjOb) {
                            $('#obFone1Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone2Pj') {
                        fone2PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone2PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone2PjOn) {
                            $('#desFone2Pj').attr("checked", true);
                        }
                        if (fone2PjOb) {
                            $('#obFone2Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone3Pj') {
                        fone3PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone3PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone3PjOn) {
                            $('#desFone3Pj').attr("checked", true);
                        }
                        if (fone3PjOb) {
                            $('#obFone3Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel1Pj') {
                        cel1PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel1PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel1PjOn) {
                            $('#desCel1Pj').attr("checked", true);
                        }
                        if (cel1PjOb) {
                            $('#obCel1Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel2Pj') {
                        cel2PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel2PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel2PjOn) {
                            $('#desCel2Pj').attr("checked", true);
                        }
                        if (cel2PjOb) {
                            $('#obCe2lPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel3Pj') {
                        cel3PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel3PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel3PjOn) {
                            $('#desCel3Pj').attr("checked", true);
                        }
                        if (cel3PjOb) {
                            $('#obCe3lPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'socios') {
                        sociosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        sociosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (sociosPjOn) {
                            $('#desSocio').attr("checked", true);
                        }
                        if (sociosPjOb) {
                            $('#obSocio').attr("checked", true);
                        }
                    }
                }
                if (tipo === 'cpf') {
                    $('#mostraFiltros').show(600);
                    if (cpfOn) {
                        $('#desCpf').attr("checked", true);
                    }
                    if (nomeOn) {
                        $('#desNome').attr("checked", true);
                    }
                    if (sexoOn) {
                        $('#desSexo').attr("checked", true);
                    }
                    if (dataNascimentoOn) {
                        $('#desNascimento').attr("checked", true);
                    }
                    if (maeOn) {
                        $('#desMae').attr("checked", true);
                    }
                    if (cboOn) {
                        $('#desCbo').attr("checked", true);
                    }
                    if (desCboOn) {
                        $('#desDescCbo').attr("checked", true);
                    }
                    if (rendaEstimadaOn) {
                        $('#desRestimada').attr("checked", true);
                    }
                    if (escolaridadeOn) {
                        $('#desEscolaridade').attr("checked", true);
                    }

                    if (classeSocialOn) {
                        $('#desClaSocial').attr("checked", true);
                    }
                    if (perfilConsumoOn) {
                        $('#desPerConsumo').attr("checked", true);
                    }
                    if (dddFone1On) {
                        $('#desDDDFone1').attr("checked", true);
                        $('#desFone1').attr("checked", true);
                    }
                    if (dddFone2On) {
                        $('#desDDDFone2').attr("checked", true);
                        $('#desFone2').attr("checked", true);
                    }
                    if (dddFone3On) {
                        $('#desDDDFone3').attr("checked", true);
                        $('#desFone3').attr("checked", true);
                    }

                    if (dddCel1On) {
                        $('#desDDDCel1').attr("checked", true);
                        $('#desCel1').attr("checked", true);

                    }
                    if (dddCel2On) {
                        $('#desDDDCel2').attr("checked", true);
                        $('#desCel2').attr("checked", true);
                    }
                    if (dddCel3On) {
                        $('#desDDDCel3').attr("checked", true);
                        $('#desCel3').attr("checked", true);
                    }
                    if (enderecoOn) {
                        $('#desEndereco').attr("checked", true);
                    }
                    if (numeroOn) {
                        $('#desNumero').attr("checked", true);
                    }
                    if (bairroOn) {
                        $('#desBairro').attr("checked", true);
                    }
                    if (complementoOn) {
                        $('#desComplemento').attr("checked", true);
                    }
                    if (cidadeOn) {
                        $('#desCidade').attr("checked", true);
                    }
                    if (estadoOn) {
                        $('#desEstado').attr("checked", true);
                    }
                    if (cepOn) {
                        $('#desCep').attr("checked", true);
                    }
                    if (cidadeObitoOn) {
                        $('#desCidadeOtibo').attr("checked", true);
                    }
                    if (emailOn) {
                        $('#desEmail').attr("checked", true);
                    }
                    if (dataObitoOn) {
                        $('#desDataObito').attr("checked", true);
                    }
                    if (participacaoEmpresarialOn) {
                        $('#desPEmpresarial').attr("checked", true);
                    }
                    if (proconOn) {
                        $('#desProcon').attr("checked", true);
                    }
                } else {
                    $('#mostraFiltrosPj ').show(600);
                }
            });
});
$("#refazerExtracao4").click(function () {

    var idtbFiltro = $("#idenriquecimento4").val();
    $('#atualizarFiltros').val('atualizar');
    $('#idtbExtracao').val(idtbFiltro);


    var tipo;
    var cpfOn;
    var nomeOn;
    var sexoOn;
    var dataNascimentoOn;
    var maeOn;
    var cboOn;
    var desCboOn;
    var rendaEstimadaOn;
    var escolaridadeOn;
    var classeSocialOn;
    var perfilConsumoOn;
    var fone1On;
    var fone2On;
    var fone3On;
    var cel1On;
    var cel2On;
    var cel3On;
    var dddFone1On;
    var dddFone2On;
    var dddFone3On;
    var dddCel1On;
    var dddCel2On;
    var dddCel3On;
    var enderecoOn;
    var numeroOn;
    var proconOn;
    var bairroOn;
    var complementoOn;
    var cidadeOn;
    var estadoOn;
    var cidadeObitoOn;
    var emailOn;
    var dataObitoOn;
    var cepOn;
    var participacaoEmpresarialOn;

    var cpfOb;
    var nomeOb;
    var sexoOb;
    var dataNascimentoOb;
    var maeOb;
    var cboOb;
    var desCboOb;
    var rendaEstimadaOb;
    var escolaridadeOb;
    var classeSocialOb;
    var perfilConsumoOb;
    var fone1Ob;
    var fone2Ob;
    var fone3Ob;
    var cel1Ob;
    var cel2Ob;
    var cel3Ob;
    var dddFone1Ob;
    var dddFone2Ob;
    var dddFone3Ob;
    var dddCel1Ob;
    var dddCel2Ob;
    var dddCel3Ob;
    var enderecoOb;
    var numeroOb;
    var proconOb;
    var bairroOb;
    var complementoOb;
    var cidadeOb;
    var estadoOb;
    var cidadeObitoOb;
    var emailOb;
    var dataObitoOb;
    var cepOb;
    var participacaoEmpresarialOb;
    var classeSocialOnCombo;

    var cnpjOn;
    var cnpjOb;
    var proconPjOn;
    var proconPjOb;
    var nomePjOn;
    var nomePjOb;
    var matrizPjOn;
    var matrizPjOb;
    var fantasiaPjOn;
    var fantasiaPjOb;
    var nascimentoPjOn;
    var nascimentoPjOb;
    var qtdEmpregadosPjOn;
    var qtdEmpregadosPjOb;
    var cnaePjOn;
    var cnaePjOb;
    var naturezaPjOn;
    var bnaturezaPjOb;
    var desCnaePjOn;
    var desCnaePjOb;
    var desNaturezaPjOn;
    var desNaturezaPjOb;
    var enderecoPjOn;
    var enderecoPjOb;
    var numeroPjOn;
    var numeroPjOb;
    var complementoPjOn;
    var complementoPjOb;
    var bairroPjOn;
    var bairroPjOb;
    var cidadePjOn;
    var cidadePjOb;
    var estadoPjOn;
    var estadoPjOb;
    var cepPjOn;
    var cepPjOb;
    var dataSituacaoPjOn;
    var dataSituacaoPjOb;
    var faturamentoPresumidoPjOn;
    var faturamentoPresumidoPjOb;
    var qtdProprietariosPjOn;
    var qtdProprietariosPjOb;
    var perfilConsumoPjOn;
    var perfilConsumoPjOb;
    var situacaoPjOn;
    var situacaoPjOb;
    var portePjOn;
    var portePjOb;
    var fone1PjOn;
    var fone1PjOb;
    var fone2PjOn;
    var fone2PjOb;
    var fone3PjOn;
    var fone3PjOb;
    var cel1PjOn;
    var cel1PjOb;
    var cel2PjOn;
    var cel2PjOb;
    var cel3PjOn;
    var cel3PjOb;
    var sociosPjOn;
    var sociosPjOb;

    var retorno = $.getJSON("/pages/php/buscaFiltroExtracao.php?idtbExtracao=" + idtbFiltro,
            function (data, status) {

                for ($i = 0; $i < data.length; $i++) {


                    //----------------------combos pf--------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=claSocial]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=escolaridade]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var st = data[$i]['tb_extracao_filtros_filtro'].toString();

                        var dataarrayDe = st.split(',');

                        var dataDe = dataarrayDe[0];
                        var dataAte = dataarrayDe[1];

                        $('#nascimentoDe').val(dataDe);
                        $('#nascimentoAte').val(dataAte);
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var st = data[$i]['tb_extracao_filtros_filtro'].toString();

                        var dataarrayDe = st.split(',');

                        var dataDe = dataarrayDe[0];
                        var dataAte = dataarrayDe[1];

                        $('#rendaEstimadaDe').val(dataDe);
                        $('#rendaEstimadaAte').val(dataAte);
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=DDDsFone]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=enderecosQtd]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=estados]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=qtdEmail]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }


                    //----------------------combos pf fim--------------------------------------------------------------------------------------------//



                    if (data[$i]['tb_extracao_filtros_nome_campo'] == 'tipoArquivo' & data[$i]['tb_extracao_filtros_filtro'] == 'cpf') {
                        tipo = 'cpf';
                        $("#tipoArquivo").val(tipo);
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cpf' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cpfOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nome' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        nomeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'sexo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        sexoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dataNascimentoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'mae' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        maeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cbo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cboOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'descCbo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        desCboOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        rendaEstimadaOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        escolaridadeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        classeSocialOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';

                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        perfilConsumoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddFone3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        fone3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel1On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel2On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                        cel3On = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        enderecoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numero' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        numeroOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        proconOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairro' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        bairroOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complemento' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        complementoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidade' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cidadeOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        estadoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadeObito' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cidadeObitoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        emailOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataObito' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dataObitoOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cep' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cepOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'participacaoEmpresarial' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        participacaoEmpresarialOn = data[$i]['tb_extracao_filtros_desejado'] === 'on'
                    }


//----------------------------------------------------------obrigatórios----------------------------------------------------------------------//                    


                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cpf' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cpfOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cpfOb) {
                            $('#obCpf').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nome' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        nomeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nomeOb) {
                            $('#obNome').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'sexo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        sexoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (sexoOb) {
                            $('#obSexo').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimento' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dataNascimentoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataNascimentoOb) {
                            $('#obNascimento').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'mae' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        maeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (maeOb) {
                            $('#obMae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cbo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cboOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cboOb) {
                            $('#obCbo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'descCbo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        desCboOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desCboOb) {
                            $('#obDescCbo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'rendaEstimada' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        rendaEstimadaOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (rendaEstimadaOb) {
                            $('#obRestimada').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'escolaridade' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        escolaridadeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (escolaridadeOb) {
                            $('#obEscolaridade').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'classeSocial' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        classeSocialOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (classeSocialOb) {
                            $('#obClaSocial').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        perfilConsumoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (perfilConsumoOb) {
                            $('#obPerConsumo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone1' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone1Ob) {
                            $('#obDDDFone1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone1' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone1Ob) {
                            $('#obFone1').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone2' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone2Ob) {
                            $('#obDDDFone2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone2' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone2Ob) {
                            $('#obFone2').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddFone3' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dddFone3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';

                        if (dddFone3Ob) {
                            $('#obDDDFone3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone3' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        fone3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone3Ob) {
                            $('#obFone3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel1Ob) {
                            $('#obDDDCel1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel1' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel1Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel1Ob) {
                            $('#obCel1').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel2Ob) {
                            $('#obDDDCel2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel2' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel2Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel2Ob) {
                            $('#obCel2').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dddCel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        dddCel3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dddCel3Ob) {
                            $('#obDDDCel3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel3' & data[$i]['tb_extracao_filtros_desejado'] === 'on') {
                        cel3Ob = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel3Ob) {
                            $('#obCel3').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'endereco' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        enderecoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (enderecoOb) {
                            $('#obEndereco').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numero' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        numeroOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (numeroOb) {
                            $('#obNumero').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        proconOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (proconOb) {
                            $('#obProcon').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairro' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        bairroOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (bairroOb) {
                            $('#obBairro').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complemento' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        complementoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (complementoOb) {
                            $('#obComplemento').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidade' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cidadeOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadeOb) {
                            $('#obCidade').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estado' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        estadoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (estadoOb) {
                            $('#obEstado').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadeObito' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cidadeObitoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadeObitoOb) {
                            $('#obCidadeObito').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'email' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        emailOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (emailOb) {
                            $('#obEmail').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataObito' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        dataObitoOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataObitoOb) {
                            $('#obDataObito').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cep' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        cepOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cepOb) {
                            $('#obCep').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'participacaoEmpresarial' & data[$i]['tb_extracao_filtros_obrigatorio'] === 'on') {
                        participacaoEmpresarialOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (participacaoEmpresarialOb) {
                            $('#obPEmpresarial').attr("checked", true);
                        }
                    }


//----------------------combos pj --------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'enderecoPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=enderecosQtdPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estadoPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=estadosPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadePj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=cidadesPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairroPj' & data[$i]['tb_extracao_filtros_filtro'].length > 0) {
                        var dataarray = data[$i]['tb_extracao_filtros_filtro'].split(",");
                        $('select[id=bairroPj]').val(dataarray);
                        $('.selectpicker').selectpicker('refresh');
                    }

//----------------------combos pj fim  --------------------------------------------------------------------------------------------//

//--------------------pj desejado /obrigatorio---------------------------------------------------------------------------------------------------------//

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cnpj') {
                        cnpjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cnpjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cnpjOn) {
                            $('#desCnpj').attr("checked", true);
                        }
                        if (cnpjOb) {
                            $('#obCnpj').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'procon') {
                        proconPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on,';
                        proconPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on,';
                        if (proconPjOn) {
                            $('#desProcon').attr("checked", true);
                        }
                        if (proconPjOb) {
                            $('#obProcon').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nomePj') {
                        nomePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        nomePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nomePjOn) {
                            $('#desNomePj').attr("checked", true);
                        }
                        if (nomePjOb) {
                            $('#obNomePj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'matriz') {
                        matrizPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        matrizPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (matrizPjOn) {
                            $('#desMatriz').attr("checked", true);
                        }
                        if (matrizPjOb) {
                            $('#obMatriz').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fantasiaPj') {
                        fantasiaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fantasiaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fantasiaPjOn) {
                            $('#desFantasia').attr("checked", true);
                        }
                        if (fantasiaPjOb) {
                            $('#obFantasia').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'nascimentoPj') {
                        nascimentoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        nascimentoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (nascimentoPjOn) {
                            $('#desNascimentoPj').attr("checked", true);
                        }
                        if (nascimentoPjOb) {
                            $('#obNascimentoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'qtdEmpregados') {
                        qtdEmpregadosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        qtdEmpregadosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (qtdEmpregadosPjOn) {
                            $('#desQtdEmpregados').attr("checked", true);
                        }
                        if (nascimentoPjOb) {
                            $('#obQtdEmpregados').attr("checked", true);
                        }
                    }

                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cnae') {
                        cnaePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cnaePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cnaePjOn) {
                            $('#desCnae').attr("checked", true);
                        }
                        if (cnaePjOb) {
                            $('#obCnae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'natureza') {
                        naturezaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        naturezaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (naturezaPjOn) {
                            $('#desNatureza').attr("checked", true);
                        }
                        if (naturezaPjOb) {
                            $('#obNatureza').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'desCnae') {
                        desCnaePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        desCnaePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desCnaePjOn) {
                            $('#desDesCnae').attr("checked", true);
                        }
                        if (desCnaePjOb) {
                            $('#obDesCnae').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'desNatureza') {
                        desNaturezaPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        desNaturezaPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (desNaturezaPjOn) {
                            $('#desDesNatureza').attr("checked", true);
                        }
                        if (desNaturezaPjOb) {
                            $('#obDesNatureza').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'enderecoPj') {
                        enderecoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        enderecoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (enderecoPjOn) {
                            $('#desEnderecoPj').attr("checked", true);
                        }
                        if (enderecoPjOb) {
                            $('#obEnderecoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'numeroPj') {
                        numeroPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        numeroPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (numeroPjOn) {
                            $('#desNumeroPj').attr("checked", true);
                        }
                        if (numeroPjOb) {
                            $('#obNumeroPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'complementoPj') {
                        complementoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        complementoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (complementoPjOn) {
                            $('#desComplementoPj').attr("checked", true);
                        }
                        if (complementoPjOb) {
                            $('#obComplementoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'bairroPj') {
                        bairroPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        bairroPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (bairroPjOn) {
                            $('#desBairroPj').attr("checked", true);
                        }
                        if (bairroPjOb) {
                            $('#obBairroPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cidadePj') {
                        cidadePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cidadePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cidadePjOn) {
                            $('#desCidadePj').attr("checked", true);
                        }
                        if (cidadePjOb) {
                            $('#obCidadePj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'estadoPj') {
                        estadoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        estadoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (estadoPjOn) {
                            $('#desEstadoPj').attr("checked", true);
                        }
                        if (estadoPjOb) {
                            $('#obEstadoPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cepPj') {
                        cepPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cepPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cepPjOn) {
                            $('#desCepPj').attr("checked", true);
                        }
                        if (cepPjOb) {
                            $('#obCepPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'dataSituacao') {
                        dataSituacaoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        dataSituacaoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (dataSituacaoPjOn) {
                            $('#desDataSituacao').attr("checked", true);
                        }
                        if (dataSituacaoPjOb) {
                            $('#obDataSituacao').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'faturamentoPresumido') {
                        faturamentoPresumidoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        faturamentoPresumidoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (faturamentoPresumidoPjOn) {
                            $('#desFPresumido').attr("checked", true);
                        }
                        if (faturamentoPresumidoPjOb) {
                            $('#obFPresumido').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'qtdProprietarios') {
                        qtdProprietariosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        qtdProprietariosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (qtdProprietariosPjOn) {
                            $('#desQtdProprietarios').attr("checked", true);
                        }
                        if (qtdProprietariosPjOb) {
                            $('#obQtdProprietarios').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'perfilConsumo') {
                        perfilConsumoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        perfilConsumoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (perfilConsumoPjOn) {
                            $('#desConsumo').attr("checked", true);
                        }
                        if (perfilConsumoPjOb) {
                            $('#obPConsumo').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'situacao') {
                        situacaoPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        situacaoPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (situacaoPjOn) {
                            $('#desSituacao').attr("checked", true);
                        }
                        if (situacaoPjOb) {
                            $('#obSituacao').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'porte') {
                        portePjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        portePjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (portePjOn) {
                            $('#desPorte').attr("checked", true);
                        }
                        if (portePjOb) {
                            $('#obPorte').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone1Pj') {
                        fone1PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone1PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone1PjOn) {
                            $('#desFone1Pj').attr("checked", true);
                        }
                        if (fone1PjOb) {
                            $('#obFone1Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone2Pj') {
                        fone2PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone2PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone2PjOn) {
                            $('#desFone2Pj').attr("checked", true);
                        }
                        if (fone2PjOb) {
                            $('#obFone2Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'fone3Pj') {
                        fone3PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        fone3PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (fone3PjOn) {
                            $('#desFone3Pj').attr("checked", true);
                        }
                        if (fone3PjOb) {
                            $('#obFone3Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel1Pj') {
                        cel1PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel1PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel1PjOn) {
                            $('#desCel1Pj').attr("checked", true);
                        }
                        if (cel1PjOb) {
                            $('#obCel1Pj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel2Pj') {
                        cel2PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel2PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel2PjOn) {
                            $('#desCel2Pj').attr("checked", true);
                        }
                        if (cel2PjOb) {
                            $('#obCe2lPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'cel3Pj') {
                        cel3PjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        cel3PjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (cel3PjOn) {
                            $('#desCel3Pj').attr("checked", true);
                        }
                        if (cel3PjOb) {
                            $('#obCe3lPj').attr("checked", true);
                        }
                    }
                    if (data[$i]['tb_extracao_filtros_nome_campo'] === 'socios') {
                        sociosPjOn = data[$i]['tb_extracao_filtros_desejado'] === 'on';
                        sociosPjOb = data[$i]['tb_extracao_filtros_obrigatorio'] === 'on';
                        if (sociosPjOn) {
                            $('#desSocio').attr("checked", true);
                        }
                        if (sociosPjOb) {
                            $('#obSocio').attr("checked", true);
                        }
                    }
                }
                if (tipo === 'cpf') {
                    $('#mostraFiltros').show(600);
                    if (cpfOn) {
                        $('#desCpf').attr("checked", true);
                    }
                    if (nomeOn) {
                        $('#desNome').attr("checked", true);
                    }
                    if (sexoOn) {
                        $('#desSexo').attr("checked", true);
                    }
                    if (dataNascimentoOn) {
                        $('#desNascimento').attr("checked", true);
                    }
                    if (maeOn) {
                        $('#desMae').attr("checked", true);
                    }
                    if (cboOn) {
                        $('#desCbo').attr("checked", true);
                    }
                    if (desCboOn) {
                        $('#desDescCbo').attr("checked", true);
                    }
                    if (rendaEstimadaOn) {
                        $('#desRestimada').attr("checked", true);
                    }
                    if (escolaridadeOn) {
                        $('#desEscolaridade').attr("checked", true);
                    }

                    if (classeSocialOn) {
                        $('#desClaSocial').attr("checked", true);
                    }
                    if (perfilConsumoOn) {
                        $('#desPerConsumo').attr("checked", true);
                    }
                    if (dddFone1On) {
                        $('#desDDDFone1').attr("checked", true);
                        $('#desFone1').attr("checked", true);
                    }
                    if (dddFone2On) {
                        $('#desDDDFone2').attr("checked", true);
                        $('#desFone2').attr("checked", true);
                    }
                    if (dddFone3On) {
                        $('#desDDDFone3').attr("checked", true);
                        $('#desFone3').attr("checked", true);
                    }

                    if (dddCel1On) {
                        $('#desDDDCel1').attr("checked", true);
                        $('#desCel1').attr("checked", true);

                    }
                    if (dddCel2On) {
                        $('#desDDDCel2').attr("checked", true);
                        $('#desCel2').attr("checked", true);
                    }
                    if (dddCel3On) {
                        $('#desDDDCel3').attr("checked", true);
                        $('#desCel3').attr("checked", true);
                    }
                    if (enderecoOn) {
                        $('#desEndereco').attr("checked", true);
                    }
                    if (numeroOn) {
                        $('#desNumero').attr("checked", true);
                    }
                    if (bairroOn) {
                        $('#desBairro').attr("checked", true);
                    }
                    if (complementoOn) {
                        $('#desComplemento').attr("checked", true);
                    }
                    if (cidadeOn) {
                        $('#desCidade').attr("checked", true);
                    }
                    if (estadoOn) {
                        $('#desEstado').attr("checked", true);
                    }
                    if (cepOn) {
                        $('#desCep').attr("checked", true);
                    }
                    if (cidadeObitoOn) {
                        $('#desCidadeOtibo').attr("checked", true);
                    }
                    if (emailOn) {
                        $('#desEmail').attr("checked", true);
                    }
                    if (dataObitoOn) {
                        $('#desDataObito').attr("checked", true);
                    }
                    if (participacaoEmpresarialOn) {
                        $('#desPEmpresarial').attr("checked", true);
                    }
                    if (proconOn) {
                        $('#desProcon').attr("checked", true);
                    }
                } else {
                    $('#mostraFiltrosPj ').show(600);
                }
            });
});
//botão processar extração -----------------------------------------------------------------------------------------///
$("#processarExtracao").click(function () {

    var queroProcessar = $("#qtdAProcessar").val();
    var idtbFiltro = $("#idenriquecimento").val();
    var retorno = $.getJSON("/pages/php/atualizaProcessamentoExtracao.php?idtbEnriquecimento=" + idtbFiltro + "&qtdProcessar=" + queroProcessar,
            function (data, status) {

            });
    $("#processarExtracao").hide();
    alert("Aguarde você será redirecionado automaticamente... ");
    setTimeout(function () {
        location.reload();
    }, 2000);
});
//-------------------------------------------------------------------------//
var mySelect = $('#first-disabled2');
$('#special').on('click', function () {
    mySelect.find('option:selected').prop('disabled', true);
    mySelect.selectpicker('refresh');
});
$('#special2').on('click', function () {
    mySelect.find('option:disabled').prop('disabled', false);
    mySelect.selectpicker('refresh');
});
//------------------------------------------------------------------------//


function marcardesmarcar() {
    if ($("#todos").is(':checked')) {

        $(".desC").attr("checked", true);
    } else {

        $(".desC").attr("checked", false);
    }

}

function marcardesmarcar2() {
    if ($("#todos2").is(':checked')) {

        $(".obC").attr("checked", true);
    } else {

        $(".obC").attr("checked", false);
    }
}


var idtbFiltro;
$("#mostraFiltros").hide();
$("#optionTipo").change(function () {

    if ($("#optionTipo").val() == 'cpf') {


        $("#mostraFiltros").show(600);
        $("#mostraFiltrosPj").hide(600);

    } else {
        $("#mostraFiltros").hide(600);
        $("#mostraFiltrosPj").show(600);
    }
    if ($("#optionTipo").val() == '1' || $("#optionTipo").val() == '2' || $("#optionTipo").val() == '3' || $("#optionTipo").val() == '4' || $("#optionTipo").val() == '5' || $("#optionTipo").val() == '6' || $("#optionTipo").val() == '7' || $("#optionTipo").val() == '8') {
        $("#mostraFiltros").hide(600);
        $("#mostraFiltrosPj").hide(600);
        $("#botaoSalvar").show(600);

    }
    idtbFiltro = $("#optionFiltros").val();
});
var selectEstados = [];
var selectEstadosPj = [];
var selecEscolaridade = [];
var selecClaSocial = [];
var selecDDDsFone = [];
var selecDDDsCel = [];
var enderecos = [];
var enderecosQtdPj = [];
var qtdEmail = [];
//estados pj
$('#estadosPj').change(function () {

    selectEstadosPj = ($('#estadosPj').val());
    var html;
    $('#cidadesPj').remove();
    $('#bairroPj').remove();

    if (selectEstadosPj.length === 1) {
        $.getJSON("/pages/php/buscaCidade.php?estado=" + selectEstadosPj,
                function (data, status) {
                    html = "<select id='cidadesPj'   title='Selecione Cidade'data-done-button='true'>";
                    html += ("<option value=''></option>");
                    for ($i = 0; $i < data.length; $i++) {
                        if (data[$i]['tb_pessoa_fisica_end_cidade'] !== "") {
                            html += ("<option value='" + data[$i]['tb_pessoa_fisica_end_cidade'] + "'>" + data[$i]['tb_pessoa_fisica_end_cidade'] + "</option>");
                        }
                    }
                    html += '</select>';
                    $('#optionCidadesPj').append(html);
                    $('#buscarBairro').show();
                });
    }


});

$('#incluirFiltroEnd').click(function () {

    var estadosPj = $("#estadosPj").val();
    var cidadesPj = $("#cidadesPj").val();
    var bairrosPj = $("#bairroPj").val();

    $("#tableFiltroEndEstados").append("<a href='#' class='list-group-item' style='width: 45%;'><h4 class='list-subject-name'>Estados</h4>" + estadosPj);
    $("#tableFiltroEndCidades").append("<h4 class='list-subject-name'>Cidades</h4>" + cidadesPj);
    $("#tableFiltroEndBairros").append("<h4 class='list-subject-name'>Bairros</h4>" + bairrosPj + "</a>");
    $("#tableFiltroQueryBairros").val("OR(tb_pessoa_juridica_end_cidade='" + cidadesPj + "' AND tb_pessoa_juridica_end_bairro IN ('" + bairrosPj + "'))");

    $("#cidadesPj").hide();
    $("#bairroPj").hide();
    $("#buscarBairro").hide();
    $("#incluirFiltroEnd").hide();

    //$("#estadosPj").empty();
    $("#cidadesPj").empty();
    $("#bairroPj").empty();

    //alert($("#tableFiltroQueryBairros").val());

});

$('#buscarBairro').click(function () {

    var html;
    selectCidadesPj = ($('#cidadesPj').val());
    selectEstadosPj = ($('#estadosPj').val());
    $("#incluirFiltroEnd").show();
    $('#bairroPj').remove();
    $.getJSON("/pages/php/buscaBairro.php?cidade=" + selectCidadesPj + '&estado=' + selectEstadosPj,
            function (data, status) {
                html = "<select id='bairroPj'  size=15 style='height: 15%;' multiple title='Selecione Bairro'data-done-button='true'>";
                html += ("<option value='*'> </option>");
                for ($i = 0; $i < data.length; $i++) {
                    if (data[$i]['tb_pessoa_fisica_end_bairro'] !== "") {
                        html += ("<option value='" + data[$i]['tb_pessoa_fisica_end_bairro'] + "'>" + data[$i]['tb_pessoa_fisica_end_bairro'] + "</option>");
                    }
                }
                html += '</select>';
                $('#optionBairroPj').append(html);
            });
});

//estados 
$('#estados').change(function () {
    selectEstados.push($('#estados').val());
});
//escolaridade
$('#escolaridade').change(function () {
    selecEscolaridade.push($('#escolaridade').val());
});
//classe social
$('#claSocial').change(function () {
    selecClaSocial.push($('#claSocial').val());
});
//DDDsFone
$('#DDDsFone').change(function () {
    selecDDDsFone.push($('#DDDsFone').val());
});
//DDDsCel
$('#DDDsCel').change(function () {

    selecDDDsCel.push($('#DDDsCel').val());
});
//endereços pf
$('#enderecosQtdPj').change(function () {

    enderecosQtdPj.push($('#enderecosQtdPj').val());
});
//endereços pf
$('#enderecosQtd').change(function () {

    enderecos.push($('#enderecosQtd').val());
});
//qtdemail
$('#qtdEmail').change(function () {

    qtdEmail.push($('#qtdEmail').val());
});
$('#desDDDFone1').change(function () {
    if ($("#desDDDFone1").is(":checked")) {
        $("#desFone1").attr("checked", true);
    }
});
$('#desDDDFone2').change(function () {
    if ($("#desDDDFone2").is(":checked")) {
        $("#desFone2").attr("checked", true);
    }
});
$('#desDDDFone3').change(function () {
    if ($("#desDDDFone3").is(":checked")) {
        $("#desFone3").attr("checked", true);
    }
});
$('#desDDDCel1').change(function () {
    if ($("#desDDDCel1").is(":checked")) {
        $("#desCel1").attr("checked", true);
    }
});
$('#desDDDCel2').change(function () {
    if ($("#desDDDCel2").is(":checked")) {
        $("#desCel2").attr("checked", true);
    }
});
$('#desDDDCel3').change(function () {
    if ($("#desDDDCel3").is(":checked")) {
        $("#desCel3").attr("checked", true);
    }
});
$("#mostraFiltrosPj").hide();
$("#cadastrarPj").click(function () {

    $("#mostraFiltros").hide(600);
    $("#mostraFiltrosPj").show(600);
    $("#salvarFiltros").show();
});
//-----------------------------------------------------------pj----------------------------------------------------
$("#salvarFiltros").click(function () {


    var selectEstados = [];
    var selectEstadosPj = [];
    var selecEscolaridade = [];
    var selecClaSocial = [];
    var selecDDDsFone = [];
    var selecDDDsCel = [];
    var enderecos = [];
    var enderecosQtdPj = [];
    var qtdEmail = [];

    selectEstadosPj.push($('#estadosPj').val());
    selectEstados.push($('#estados').val());
    selecEscolaridade.push($('#escolaridade').val());
    selecClaSocial.push($('#claSocial').val());
    selecDDDsFone.push($('#DDDsFone').val());
    selecDDDsCel.push($('#DDDsCel').val());
    enderecosQtdPj.push($('#enderecosQtdPj').val());
    enderecos.push($('#enderecosQtd').val());
    qtdEmail.push($('#qtdEmail').val());

    if ($('#atualizarFiltros').val() === 'atualizar') {
        var idtbFiltro = $("#idtbExtracao").val();
        var tipoArquivo = $("#tipoArquivo").val();
        var tipoArquivoEntrada = $("#optionTipoEntrada").val();


        var retorno = $.getJSON("/pages/php/atualizarExtracaoFiltro.php?idtbExtracao=" + idtbFiltro,
                function (data, status) {

                });
        var retorno = $.getJSON("/pages/php/excluirExtracaoFiltro.php?idtbExtracao=" + idtbFiltro,
                function (data, status) {

                });
    } else {
        var idtbFiltro = $("#optionFiltros").val();
        var tipoArquivo = $("#optionTipo").val();
        var tipoArquivoEntrada = $("#optionTipoEntrada").val();
    }

    var desCnpj = [];
    var obCnpj = [];
    var desNomePj = [];
    var obNomePj = [];
    var desFantasia = [];
    var obFantasia = [];
    var desMatriz = [];
    var obMatriz = [];
    var desNascimentoPj = [];
    var obNascimentoPj = [];
    var desQtdEmpregados = [];
    var obQtdEmpregados = [];
    var desCnae = [];
    var obCnae = [];
    var desDesCnae = [];
    var obDesCnae = [];
    var desNatureza = [];
    var obNatureza = [];
    var desDesNatureza = [];
    var obDesNatureza = [];
    var desEnderecoPj = [];
    var obEnderecoPj = [];
    var desNumeroPj = [];
    var obNumeroPj = [];
    var desComplementoPj = [];
    var obComplementoPj = [];
    var desBairroPj = [];
    var obBairroPj = [];
    var desCidadePj = [];
    var obCidadePj = [];
    var desEstadoPj = [];
    var obEstadoPj = [];
    var desCepPj = [];
    var obCepPj = [];
    var desSituacao = [];
    var obSituacao = [];
    var desDataSituacao = [];
    var obDataSituacao = [];
    var desPorte = [];
    var obPorte = [];
    var desFPresumido = [];
    var obFPresumido = [];
    var desQtdProprietarios = [];
    var obQtdProprietarios = [];
    var desPConsumo = [];
    var obPConsumo = [];
    var desFone1Pj = [];
    var obFone1Pj = [];
    var desFone2Pj = [];
    var obFone2Pj = [];
    var desFone3Pj = [];
    var obFone3Pj = [];
    var desCel1Pj = [];
    var obCel2Pj = [];
    var desCel2Pj = [];
    var obCe2lPj = [];
    var desCel3Pj = [];
    var obCe3lPj = [];
    var desSocio = [];
    var obSocios = [];
    var desProcon = [];
    var obProcon = [];
    var nullProcon = [];



    var extracao = $("#extracao").val();

    var tableFiltroQueryBairros = $("#tableFiltroQueryBairros").val();
    //alert(tableFiltroQueryBairros);
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=tableFiltroQueryBairros" + "&filtro=" + tableFiltroQueryBairros + "&extracao=" + extracao,
            function (data, status) {

            });

    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=tipoArquivo" + "&filtro=" + tipoArquivo + "&extracao=" + extracao,
            function (data, status) {

            });

    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=tipoArquivoEntrada" + "&filtro=" + tipoArquivoEntrada + "&extracao=" + extracao,
            function (data, status) {

            });
    //null procon
    $('#nullProcon:checked').each(function () {

        nullProcon.push($(this).val());
        //alert(desCpf);
    });
//desejado procon
    $('#desProcon:checked').each(function () {

        desProcon.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio cnpj
    $('#obProcon:checked').each(function () {

        obProcon.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=procon" + '&desejado=' + desProcon + '&obrigatorio=' + obProcon + "&extracao=" + extracao + "&filtro=" + nullProcon,
            function (data, status) {

            });
    //desejado cnpj
    $('#desCnpj:checked').each(function () {

        desCnpj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio cnpj
    $('#obCnpj:checked').each(function () {

        obCnpj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cnpj" + '&desejado=' + desCnpj + '&obrigatorio=' + obCnpj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado nome
    $('#desNomePj:checked').each(function () {

        desNomePj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio nome
    $('#obNomePj:checked').each(function () {

        obNomePj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=nomePj" + '&desejado=' + desNomePj + '&obrigatorio=' + obNomePj + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado fantasia
    $('#desFantasia:checked').each(function () {

        desFantasia.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio fantasia
    $('#obFantasia:checked').each(function () {

        obFantasia.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fantasiaPj" + '&desejado=' + desFantasia + '&obrigatorio=' + obFantasia + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado matriz
    $('#desMatriz:checked').each(function () {

        desMatriz.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio matriz
    $('#obMatriz:checked').each(function () {

        obMatriz.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=matriz" + '&desejado=' + desMatriz + '&obrigatorio=' + obMatriz + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado nadcimento pj
    $('#desNascimentoPj:checked').each(function () {

        desNascimentoPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio nadcimento pj
    $('#obNascimentoPj:checked').each(function () {

        obNascimentoPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=nascimentoPj" + '&desejado=' + desNascimentoPj + '&obrigatorio=' + obNascimentoPj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado qtd empregado
    $('#desQtdEmpregados:checked').each(function () {

        desQtdEmpregados.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio qtd empregado
    $('#obQtdEmpregados:checked').each(function () {

        obQtdEmpregados.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=qtdEmpregados" + '&desejado=' + desQtdEmpregados + '&obrigatorio=' + obQtdEmpregados + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desCnae
    $('#desCnae:checked').each(function () {

        desCnae.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCnae
    $('#obCnae:checked').each(function () {

        obCnae.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cnae" + '&desejado=' + desCnae + '&obrigatorio=' + obCnae + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desCnae
    $('#desDesCnae:checked').each(function () {

        desDesCnae.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obDesCnae
    $('#obDesCnae:checked').each(function () {

        obDesCnae.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=desCnae" + '&desejado=' + desDesCnae + '&obrigatorio=' + obDesCnae + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desNatureza
    $('#desNatureza:checked').each(function () {

        desNatureza.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obNatureza
    $('#obNatureza:checked').each(function () {

        obNatureza.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=natureza" + '&desejado=' + desNatureza + '&obrigatorio=' + obNatureza + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desDesNatureza
    $('#desDesNatureza:checked').each(function () {

        desDesNatureza.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obDesNatureza
    $('#obDesNatureza:checked').each(function () {

        obDesNatureza.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=desNatureza" + '&desejado=' + desDesNatureza + '&obrigatorio=' + obDesNatureza + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desEnderecoPj
    $('#desEnderecoPj:checked').each(function () {

        desEnderecoPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obEnderecoPj
    $('#obEnderecoPj:checked').each(function () {

        obEnderecoPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=enderecoPj" + '&desejado=' + desEnderecoPj + '&obrigatorio=' + obEnderecoPj + "&filtro=" + enderecosQtdPj + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desNumeroPj
    $('#desNumeroPj:checked').each(function () {

        desNumeroPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obNumeroPj
    $('#obNumeroPj:checked').each(function () {

        obNumeroPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=numeroPj" + '&desejado=' + desNumeroPj + '&obrigatorio=' + obNumeroPj + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desComplementoPj
    $('#desComplementoPj:checked').each(function () {

        desComplementoPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obComplementoPj
    $('#obComplementoPj:checked').each(function () {

        obComplementoPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=complementoPj" + '&desejado=' + desComplementoPj + '&obrigatorio=' + obComplementoPj + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desBairroPj
    $('#desBairroPj:checked').each(function () {

        desBairroPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obBairroPj
    $('#obBairroPj:checked').each(function () {

        obBairroPj.push($(this).val());
        //alert(desCpf);
    });

    var bairroPj = $('#bairroPj').val();
    if (bairroPj === undefined) {
        bairroPj === '';
    }

    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=bairroPj" + '&desejado=' + desBairroPj + '&obrigatorio=' + obBairroPj + "&extracao=" + extracao + "&filtro=",
            function (data, status) {

            });
    //desejado  desCidadePj
    $('#desCidadePj:checked').each(function () {

        desCidadePj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCidadePj
    $('#obCidadePj:checked').each(function () {

        obCidadePj.push($(this).val());
        //alert(desCpf);
    });

    var cidadePj = $('#cidadesPj').val();
    if (cidadePj === undefined) {
        cidadePj === '';
    }
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cidadePj" + '&desejado=' + desCidadePj + '&obrigatorio=' + obCidadePj + "&extracao=" + extracao + '&filtro=' + cidadePj,
            function (data, status) {

            });
    //desejado  desEstadoPj
    $('#desEstadoPj:checked').each(function () {

        desEstadoPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obEstadoPj
    $('#obEstadoPj:checked').each(function () {

        obEstadoPj.push($(this).val());
        //alert(desCpf);
    });


    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=estadoPj" + '&desejado=' + desEstadoPj + '&obrigatorio=' + obEstadoPj + "&filtro=" + selectEstadosPj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desCepPj
    $('#desCepPj:checked').each(function () {

        desCepPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCepPj
    $('#obCepPj:checked').each(function () {

        obCepPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cepPj" + '&desejado=' + desCepPj + '&obrigatorio=' + obCepPj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desSituacao
    $('#desSituacao:checked').each(function () {

        desSituacao.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obSituacao
    $('#obSituacao:checked').each(function () {

        obSituacao.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=situacao" + '&desejado=' + desSituacao + '&obrigatorio=' + obSituacao + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desDataSituacao
    $('#desDataSituacao:checked').each(function () {

        desDataSituacao.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obSituacao
    $('#obDataSituacao:checked').each(function () {

        obDataSituacao.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dataSituacao" + '&desejado=' + desDataSituacao + '&obrigatorio=' + obDataSituacao + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desPorte
    $('#desPorte:checked').each(function () {

        desPorte.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obSituacao
    $('#obPorte:checked').each(function () {

        obPorte.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=porte" + '&desejado=' + desPorte + '&obrigatorio=' + obPorte + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desFPresumido
    $('#desFPresumido:checked').each(function () {

        desFPresumido.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obFPresumido
    $('#obFPresumido:checked').each(function () {

        obFPresumido.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=faturamentoPresumido" + '&desejado=' + desFPresumido + '&obrigatorio=' + obFPresumido + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desQtdProprietarios
    $('#desQtdProprietarios:checked').each(function () {

        desQtdProprietarios.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obQtdProprietarios
    $('#obQtdProprietarios:checked').each(function () {

        obQtdProprietarios.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=qtdProprietarios" + '&desejado=' + desQtdProprietarios + '&obrigatorio=' + obQtdProprietarios + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desPConsumo
    $('#desPConsumo:checked').each(function () {

        desPConsumo.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obPConsumo
    $('#obPConsumo:checked').each(function () {

        obPConsumo.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=perfilConsumo" + '&desejado=' + desPConsumo + '&obrigatorio=' + obPConsumo + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desFone1Pj
    $('#desFone1Pj:checked').each(function () {

        desFone1Pj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obFone1Pj
    $('#obFone1Pj:checked').each(function () {

        obFone1Pj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fone1Pj" + '&desejado=' + desFone1Pj + '&obrigatorio=' + obFone1Pj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desFone2Pj
    $('#desFone2Pj:checked').each(function () {

        desFone2Pj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obFone2Pj
    $('#obFone2Pj:checked').each(function () {

        obFone2Pj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fone2Pj" + '&desejado=' + desFone2Pj + '&obrigatorio=' + obFone2Pj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desFone3Pj
    $('#desFone3Pj:checked').each(function () {

        desFone3Pj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obFone3Pj
    $('#obFone3Pj:checked').each(function () {

        obFone3Pj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fone3Pj" + '&desejado=' + desFone3Pj + '&obrigatorio=' + obFone3Pj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desCel1Pj
    $('#desCel1Pj:checked').each(function () {

        desCel1Pj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCel2Pj
    $('#obCel2Pj:checked').each(function () {

        obCel2Pj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cel1Pj" + '&desejado=' + desCel1Pj + '&obrigatorio=' + obCel2Pj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desCel2Pj
    $('#desCel2Pj:checked').each(function () {

        desCel2Pj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCel2Pj
    $('#obCe2lPj:checked').each(function () {

        obCe2lPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cel2Pj" + '&desejado=' + desCel1Pj + '&obrigatorio=' + obCe2lPj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desCel3Pj
    $('#desCel3Pj:checked').each(function () {

        desCel3Pj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCel2Pj
    $('#obCe3lPj:checked').each(function () {

        obCe3lPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cel3Pj" + '&desejado=' + desCel3Pj + '&obrigatorio=' + obCe3lPj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desCel3Pj
    $('#desSocio:checked').each(function () {

        desSocio.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCel2Pj
    $('#obSocios:checked').each(function () {

        obSocios.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=socios" + '&desejado=' + desSocio + '&obrigatorio=' + obSocios + "&extracao=" + extracao,
            function (data, status) {

            });
    alert("Aguarde você será redirecionado automaticamente... ");

    if (extracao === 'extracao') {

        setTimeout(function () {
            window.location = "http://dwonline.com.br/desenv/extracao/"

        }, 4000);
    } else {
        setTimeout(function () {
            location.reload();
        }, 4000);
    }


});


$("#salvarFiltros2").click(function () {


    var selectEstados = [];
    var selectEstadosPj = [];
    var selecEscolaridade = [];
    var selecClaSocial = [];
    var selecDDDsFone = [];
    var selecDDDsCel = [];
    var enderecos = [];
    var enderecosQtdPj = [];
    var qtdEmail = [];

    selectEstados.push($('#estados').val());
    selecEscolaridade.push($('#escolaridade').val());
    selecClaSocial.push($('#claSocial').val());
    selecDDDsFone.push($('#DDDsFone').val());
    selecDDDsCel.push($('#DDDsCel').val());
    enderecosQtdPj.push($('#enderecosQtdPj').val());
    enderecos.push($('#enderecosQtd').val());
    qtdEmail.push($('#qtdEmail').val());

    if ($('#atualizarFiltros').val() === 'atualizar') {
        var idtbFiltro = $("#idtbExtracao").val();
        var tipoArquivo = $("#tipoArquivo").val();
        var tipoArquivoEntrada = $("#optionTipoEntrada").val();


        var retorno = $.getJSON("/pages/php/atualizarExtracaoFiltro.php?idtbExtracao=" + idtbFiltro,
                function (data, status) {

                });
        var retorno = $.getJSON("/pages/php/excluirExtracaoFiltro.php?idtbExtracao=" + idtbFiltro,
                function (data, status) {

                });
    } else {
        var idtbFiltro = $("#optionFiltros").val();
        var tipoArquivo = $("#optionTipo").val();
        var tipoArquivoEntrada = $("#optionTipoEntrada").val();
    }


    // var idtbFiltro = $('#idtbExtracao').val();
    var desCpf = [];
    var obCpf = [];
    var desNome = [];
    var obNome = [];
    var desSexo = [];
    var obSexo = [];
    var desNascimento = [];
    var obNascimento = [];
    var nascimentoDe = ($("#nascimentoDe").val());
    var nascimentoAte = ($("#nascimentoAte").val());
    var desMae = [];
    var obMae = [];
    var desCbo = [];
    var obCbo = [];
    var desDescCbo = [];
    var obDescCbo = [];
    var desRestimada = [];
    var obRestimada = [];
    var rendaEstimadaDe = ($("#rendaEstimadaDe").val());
    var rendaEstimadaAte = ($("#rendaEstimadaAte").val());
    var desEscolaridade = [];
    var obEscolaridade = [];
    var desClaSocial = [];
    var obClaSocial = [];
    var desPerConsumo = [];
    var obPerConsumo = [];
    var desDDDFone1 = [];
    var obDDDFone1 = [];
    var desFone2 = [];
    var desFone1 = [];
    var obFone1 = [];
    var desDDDFone2 = [];
    var obDDDFone2 = [];
    var obFone2 = [];
    var desDDDFone3 = [];
    var obDDDFone3 = [];
    var desFone3 = [];
    var obFone3 = [];
    var desDDDCel1 = [];
    var obDDDCel1 = [];
    var desDDDCel2 = [];
    var obDDDCel2 = [];
    var desCel2 = [];
    var desCel1 = [];
    var obCel1 = [];
    var obCel2 = [];
    var desDDDCel3 = [];
    var obDDDCel3 = [];
    var desCel3 = [];
    var obCel3 = [];
    var desEndereco = [];
    var obEndereco = [];
    var desNumero = [];
    var obNumero = [];
    var desComplemento = [];
    var obComplemento = [];
    var desBairro = [];
    var obBairro = [];
    var desCidade = [];
    var obCidade = [];
    var desEstado = [];
    var obEstado = [];
    var desCep = [];
    var obCep = [];
    var desEmail = [];
    var obEmail = [];
    var desDataObito = [];
    var obDataObito = [];
    var desCidadeObito = [];
    var obCidadeObito = [];
    var desPEmpresarial = [];
    var obPEmpresarial = [];
    var desProcon = [];
    var obProcon = [];
    var nullProcon = [];


    var extracao = $("#extracao").val();

    var tableFiltroQueryBairros = $("#tableFiltroQueryBairros").val();
    //alert(tableFiltroQueryBairros);
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=tableFiltroQueryBairros" + "&filtro=" + tableFiltroQueryBairros + "&extracao=" + extracao,
            function (data, status) {

            });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=tipoArquivo" + "&filtro=" + tipoArquivo + "&extracao=" + extracao,
            function (data, status) {

            });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=tipoArquivoEntrada" + "&filtro=" + tipoArquivoEntrada + "&extracao=" + extracao,
            function (data, status) {

            });
//--------------------------------------------------pf-----------------------------------------------------------//
//
//

//null procon
    $('#nullProcon:checked').each(function () {

        nullProcon.push($(this).val());
        //alert(desCpf);
    });
//desejado procon
    $('#desProcon:checked').each(function () {

        desProcon.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio cnpj
    $('#obProcon:checked').each(function () {

        obProcon.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=procon" + '&desejado=' + desProcon + '&obrigatorio=' + obProcon + "&extracao=" + extracao + "&filtro=" + nullProcon,
            function (data, status) {

            });
//desejado cpf
    $('#desCpf:checked').each(function () {

        desCpf.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio cpf
    $('#obCpf:checked').each(function () {

        obCpf.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cpf" + '&desejado=' + desCpf + '&obrigatorio=' + obCpf + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel nome    
    $('#desNome:checked').each(function () {

        desNome.push($(this).val());
        //alert(desNome);
    });
    //obrigatorio nome    
    $('#obNome:checked').each(function () {

        obNome.push($(this).val());
        //alert(obNome);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=nome" + '&desejado=' + desNome + '&obrigatorio=' + obNome + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel sex
    $('#desSexo:checked').each(function () {

        desSexo.push($(this).val());
        //alert(desSexo);
    });
//obrigatorio nome    
    $('#obSexo:checked').each(function () {

        obSexo.push($(this).val()); //alert(obSexo);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=sexo" + '&desejado=' + desSexo + '&obrigatorio=' + obSexo + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel nascimento
    $('#desNascimento:checked').each(function () {

        desNascimento.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio nascimento
    $('#obNascimento:checked').each(function () {

        obNascimento.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=nascimento" + '&desejado=' + desNascimento + '&obrigatorio=' + obNascimento + "&filtro=" + nascimentoDe + "," + nascimentoAte + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel mae
    $('#desMae:checked').each(function () {

        desMae.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio mae
    $('#obMae:checked').each(function () {

        obMae.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=mae" + '&desejado=' + desMae + '&obrigatorio=' + obMae + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel cbo
    $('#desCbo:checked').each(function () {

        desCbo.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio cbo
    $('#obCbo:checked').each(function () {

        obCbo.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cbo" + '&desejado=' + desCbo + '&obrigatorio=' + obCbo + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel descricao cbo
    $('#desDescCbo:checked').each(function () {

        desDescCbo.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio descrição cbo
    $('#obDescCbo:checked').each(function () {

        obDescCbo.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=descCbo" + '&desejado=' + desDescCbo + '&obrigatorio=' + obDescCbo + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel renda estimada
    $('#desRestimada:checked').each(function () {

        desRestimada.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio renda estimada
    $('#obRestimada:checked').each(function () {

        obRestimada.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=rendaEstimada" + '&desejado=' + desRestimada + '&obrigatorio=' + obRestimada + "&filtro=" + rendaEstimadaDe + "," + rendaEstimadaAte + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel escolaridade
    $('#desEscolaridade:checked').each(function () {

        desEscolaridade.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio escolaridade
    $('#obEscolaridade:checked').each(function () {

        obEscolaridade.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=escolaridade" + '&desejado=' + desEscolaridade + '&obrigatorio=' + obEscolaridade + "&filtro=" + selecEscolaridade + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel classe social
    $('#desClaSocial:checked').each(function () {

        desClaSocial.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio classe social
    $('#obClaSocial:checked').each(function () {

        obClaSocial.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=classeSocial" + '&desejado=' + desClaSocial + '&obrigatorio=' + obClaSocial + "&filtro=" + selecClaSocial + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel perfil consumo
    $('#desPerConsumo:checked').each(function () {

        desPerConsumo.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio perdil consumo
    $('#obPerConsumo:checked').each(function () {

        obPerConsumo.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=perfilConsumo" + '&desejado=' + desPerConsumo + '&obrigatorio=' + obPerConsumo + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel ddd fone 1
    $('#desDDDFone1:checked').each(function () {

        desDDDFone1.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio obDDDFone1
    $('#obDDDFone1:checked').each(function () {

        obDDDFone1.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dddFone1" + '&desejado=' + desDDDFone1 + '&obrigatorio=' + obDDDFone1 + "&filtro=" + selecDDDsFone + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel fone1
    $('#desFone1:checked').each(function () {

        desFone1.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio fone1
    $('#obFone1:checked').each(function () {

        obFone1.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fone1" + '&desejado=' + desFone1 + '&obrigatorio=' + obFone1 + "&filtro=" + selecDDDsFone + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel ddd fone 2
    $('#desDDDFone2:checked').each(function () {

        desDDDFone2.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio obDDDFone2
    $('#obDDDFone2:checked').each(function () {

        obDDDFone2.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dddFone2" + '&desejado=' + desDDDFone2 + '&obrigatorio=' + obDDDFone2 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel fone2
    $('#desFone2:checked').each(function () {

        desFone2.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio fone2
    $('#obFone2:checked').each(function () {

        obFone2.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fone2" + '&desejado=' + desFone2 + '&obrigatorio=' + obFone2 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel ddd fone 3
    $('#desDDDFone3:checked').each(function () {

        desDDDFone3.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio obDDDFone3
    $('#obDDDFone3:checked').each(function () {

        obDDDFone3.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dddFone3" + '&desejado=' + desDDDFone3 + '&obrigatorio=' + obDDDFone3 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel fone3
    $('#desFone3:checked').each(function () {

        desFone3.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio fone3
    $('#obFone3:checked').each(function () {

        obFone3.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fone3" + '&desejado=' + desFone3 + '&obrigatorio=' + obFone3 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
//desejavel ddd cel 1
    $('#desDDDCel1:checked').each(function () {

        desDDDCel1.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio obDDDcel1
    $('#obDDDCel1:checked').each(function () {

        obDDDCel1.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dddCel1" + '&desejado=' + desDDDCel1 + '&obrigatorio=' + obDDDCel1 + "&filtro=" + selecDDDsCel + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel Cel1
    $('#desCel1:checked').each(function () {

        desCel1.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio fone3
    $('#obCel1:checked').each(function () {

        obCel1.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cel1" + '&desejado=' + desCel1 + '&obrigatorio=' + obCel1 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
//desejavel ddd cel 2
    $('#desDDDCel2:checked').each(function () {

        desDDDCel2.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio obDDDcel2
    $('#obDDDCel2:checked').each(function () {

        obDDDCel2.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dddCel2" + '&desejado=' + desDDDCel2 + '&obrigatorio=' + obDDDCel2 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel Cel2
    $('#desCel2:checked').each(function () {

        desCel2.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio fone3
    $('#obCel2:checked').each(function () {

        obCel2.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cel2" + '&desejado=' + desCel2 + '&obrigatorio=' + obCel2 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
//desejavel ddd cel 3
    $('#desDDDCel3:checked').each(function () {

        desDDDCel3.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio obDDDcel2
    $('#obDDDCel3:checked').each(function () {

        obDDDCel3.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dddCel3" + '&desejado=' + desDDDCel3 + '&obrigatorio=' + obDDDCel3 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel Cel3
    $('#desCel3:checked').each(function () {

        desCel3.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio fone3
    $('#obCel3:checked').each(function () {

        obCel3.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cel3" + '&desejado=' + desCel3 + '&obrigatorio=' + obCel3 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel endereço
    $('#desEndereco:checked').each(function () {

        desEndereco.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio endereço
    $('#obEndereco:checked').each(function () {

        obEndereco.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=endereco" + '&desejado=' + desEndereco + '&obrigatorio=' + obEndereco + "&filtro=" + enderecos + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel numero
    $('#desNumero:checked').each(function () {

        desNumero.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio numero
    $('#obNumero:checked').each(function () {

        obNumero.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=numero" + '&desejado=' + desNumero + '&obrigatorio=' + obNumero + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel complemento
    $('#desComplemento:checked').each(function () {

        desComplemento.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio complemento
    $('#obComplemento:checked').each(function () {

        obComplemento.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=complemento" + '&desejado=' + desComplemento + '&obrigatorio=' + obComplemento + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
//desejavel Bairro
    $('#desBairro:checked').each(function () {

        desBairro.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio Bairro
    $('#obBairro:checked').each(function () {

        obBairro.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=bairro" + '&desejado=' + desBairro + '&obrigatorio=' + obBairro + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
//desejavel Cidade
    $('#desCidade:checked').each(function () {

        desCidade.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio Cidade
    $('#obCidade:checked').each(function () {

        obCidade.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cidade" + '&desejado=' + desCidade + '&obrigatorio=' + obCidade + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
//desejavel Estado
    $('#desEstado:checked').each(function () {

        desEstado.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio Estado
    $('#obEstado:checked').each(function () {

        obEstado.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=estado" + '&desejado=' + desEstado + '&obrigatorio=' + obEstado + "&filtro=" + selectEstados + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel Cep
    $('#desCep:checked').each(function () {

        desCep.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio Cep
    $('#obCep:checked').each(function () {

        obCep.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cep" + '&desejado=' + desCep + '&obrigatorio=' + obCep + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel Email
    $('#desEmail:checked').each(function () {

        desEmail.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio Email
    $('#obEmail:checked').each(function () {

        obEmail.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=email" + '&desejado=' + desEmail + '&obrigatorio=' + obEmail + "&filtro=" + qtdEmail + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel DataObito
    $('#desDataObito:checked').each(function () {

        desDataObito.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio DataObito
    $('#obDataObito:checked').each(function () {

        obDataObito.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dataObito" + '&desejado=' + desDataObito + '&obrigatorio=' + obDataObito + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel CidadeObito
    $('#desCidadeOtibo:checked').each(function () {

        desCidadeObito.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio CidadeObito
    $('#obCidadeObito:checked').each(function () {

        obCidadeObito.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cidadeObito" + '&desejado=' + desCidadeObito + '&obrigatorio=' + obCidadeObito + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel PEmpresarial
    $('#desPEmpresarial:checked').each(function () {

        desPEmpresarial.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio PEmpresarial
    $('#obPEmpresarial:checked').each(function () {

        obPEmpresarial.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=participacaoEmpresarial" + '&desejado=' + desPEmpresarial + '&obrigatorio=' + obPEmpresarial + "&filtro=Atualizar" + "&extracao=" + extracao,
            function (data, status) {
                console.log(data);
            });
    //location.reload(); // ação, atualização do documento

    alert("Aguarde você será redirecionado automaticamente... ");

    if (extracao === 'extracao') {

        setTimeout(function () {
            window.location = "http://dwonline.com.br/desenv/extracao/"

        }, 4000);
    } else {
        setTimeout(function () {
            location.reload();
        }, 4000);
    }

});

$("#salvarFiltros").click(function () {


    var selectEstados = [];
    var selectEstadosPj = [];
    var selecEscolaridade = [];
    var selecClaSocial = [];
    var selecDDDsFone = [];
    var selecDDDsCel = [];
    var enderecos = [];
    var enderecosQtdPj = [];
    var qtdEmail = [];

    selectEstadosPj.push($('#estadosPj').val());
    selectEstados.push($('#estados').val());
    selecEscolaridade.push($('#escolaridade').val());
    selecClaSocial.push($('#claSocial').val());
    selecDDDsFone.push($('#DDDsFone').val());
    selecDDDsCel.push($('#DDDsCel').val());
    enderecosQtdPj.push($('#enderecosQtdPj').val());
    enderecos.push($('#enderecosQtd').val());
    qtdEmail.push($('#qtdEmail').val());

    if ($('#atualizarFiltros').val() === 'atualizar') {
        var idtbFiltro = $("#idtbExtracao").val();
        var tipoArquivo = $("#tipoArquivo").val();
        var tipoArquivoEntrada = $("#optionTipoEntrada").val();


        var retorno = $.getJSON("/pages/php/atualizarExtracaoFiltro.php?idtbExtracao=" + idtbFiltro,
                function (data, status) {

                });
        var retorno = $.getJSON("/pages/php/excluirExtracaoFiltro.php?idtbExtracao=" + idtbFiltro,
                function (data, status) {

                });
    } else {
        var idtbFiltro = $("#optionFiltros").val();
        var tipoArquivo = $("#optionTipo").val();
        var tipoArquivoEntrada = $("#optionTipoEntrada").val();
    }

    var desCnpj = [];
    var obCnpj = [];
    var desNomePj = [];
    var obNomePj = [];
    var desFantasia = [];
    var obFantasia = [];
    var desMatriz = [];
    var obMatriz = [];
    var desNascimentoPj = [];
    var obNascimentoPj = [];
    var desQtdEmpregados = [];
    var obQtdEmpregados = [];
    var desCnae = [];
    var obCnae = [];
    var desDesCnae = [];
    var obDesCnae = [];
    var desNatureza = [];
    var obNatureza = [];
    var desDesNatureza = [];
    var obDesNatureza = [];
    var desEnderecoPj = [];
    var obEnderecoPj = [];
    var desNumeroPj = [];
    var obNumeroPj = [];
    var desComplementoPj = [];
    var obComplementoPj = [];
    var desBairroPj = [];
    var obBairroPj = [];
    var desCidadePj = [];
    var obCidadePj = [];
    var desEstadoPj = [];
    var obEstadoPj = [];
    var desCepPj = [];
    var obCepPj = [];
    var desSituacao = [];
    var obSituacao = [];
    var desDataSituacao = [];
    var obDataSituacao = [];
    var desPorte = [];
    var obPorte = [];
    var desFPresumido = [];
    var obFPresumido = [];
    var desQtdProprietarios = [];
    var obQtdProprietarios = [];
    var desPConsumo = [];
    var obPConsumo = [];
    var desFone1Pj = [];
    var obFone1Pj = [];
    var desFone2Pj = [];
    var obFone2Pj = [];
    var desFone3Pj = [];
    var obFone3Pj = [];
    var desCel1Pj = [];
    var obCel2Pj = [];
    var desCel2Pj = [];
    var obCe2lPj = [];
    var desCel3Pj = [];
    var obCe3lPj = [];
    var desSocio = [];
    var obSocios = [];
    var desProcon = [];
    var obProcon = [];
    var nullProcon = [];



    var extracao = $("#extracao").val();

    var tableFiltroQueryBairros = $("#tableFiltroQueryBairros").val();
    //alert(tableFiltroQueryBairros);
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=tableFiltroQueryBairros" + "&filtro=" + tableFiltroQueryBairros + "&extracao=" + extracao,
            function (data, status) {

            });

    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=tipoArquivo" + "&filtro=" + tipoArquivo + "&extracao=" + extracao,
            function (data, status) {

            });

    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=tipoArquivoEntrada" + "&filtro=" + tipoArquivoEntrada + "&extracao=" + extracao,
            function (data, status) {

            });
    //null procon
    $('#nullProcon:checked').each(function () {

        nullProcon.push($(this).val());
        //alert(desCpf);
    });
//desejado procon
    $('#desProcon:checked').each(function () {

        desProcon.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio cnpj
    $('#obProcon:checked').each(function () {

        obProcon.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=procon" + '&desejado=' + desProcon + '&obrigatorio=' + obProcon + "&extracao=" + extracao + "&filtro=" + nullProcon,
            function (data, status) {

            });
    //desejado cnpj
    $('#desCnpj:checked').each(function () {

        desCnpj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio cnpj
    $('#obCnpj:checked').each(function () {

        obCnpj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cnpj" + '&desejado=' + desCnpj + '&obrigatorio=' + obCnpj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado nome
    $('#desNomePj:checked').each(function () {

        desNomePj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio nome
    $('#obNomePj:checked').each(function () {

        obNomePj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=nomePj" + '&desejado=' + desNomePj + '&obrigatorio=' + obNomePj + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado fantasia
    $('#desFantasia:checked').each(function () {

        desFantasia.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio fantasia
    $('#obFantasia:checked').each(function () {

        obFantasia.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fantasiaPj" + '&desejado=' + desFantasia + '&obrigatorio=' + obFantasia + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado matriz
    $('#desMatriz:checked').each(function () {

        desMatriz.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio matriz
    $('#obMatriz:checked').each(function () {

        obMatriz.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=matriz" + '&desejado=' + desMatriz + '&obrigatorio=' + obMatriz + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado nadcimento pj
    $('#desNascimentoPj:checked').each(function () {

        desNascimentoPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio nadcimento pj
    $('#obNascimentoPj:checked').each(function () {

        obNascimentoPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=nascimentoPj" + '&desejado=' + desNascimentoPj + '&obrigatorio=' + obNascimentoPj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado qtd empregado
    $('#desQtdEmpregados:checked').each(function () {

        desQtdEmpregados.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio qtd empregado
    $('#obQtdEmpregados:checked').each(function () {

        obQtdEmpregados.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=qtdEmpregados" + '&desejado=' + desQtdEmpregados + '&obrigatorio=' + obQtdEmpregados + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desCnae
    $('#desCnae:checked').each(function () {

        desCnae.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCnae
    $('#obCnae:checked').each(function () {

        obCnae.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cnae" + '&desejado=' + desCnae + '&obrigatorio=' + obCnae + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desCnae
    $('#desDesCnae:checked').each(function () {

        desDesCnae.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obDesCnae
    $('#obDesCnae:checked').each(function () {

        obDesCnae.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=desCnae" + '&desejado=' + desDesCnae + '&obrigatorio=' + obDesCnae + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desNatureza
    $('#desNatureza:checked').each(function () {

        desNatureza.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obNatureza
    $('#obNatureza:checked').each(function () {

        obNatureza.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=natureza" + '&desejado=' + desNatureza + '&obrigatorio=' + obNatureza + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desDesNatureza
    $('#desDesNatureza:checked').each(function () {

        desDesNatureza.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obDesNatureza
    $('#obDesNatureza:checked').each(function () {

        obDesNatureza.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=desNatureza" + '&desejado=' + desDesNatureza + '&obrigatorio=' + obDesNatureza + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desEnderecoPj
    $('#desEnderecoPj:checked').each(function () {

        desEnderecoPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obEnderecoPj
    $('#obEnderecoPj:checked').each(function () {

        obEnderecoPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=enderecoPj" + '&desejado=' + desEnderecoPj + '&obrigatorio=' + obEnderecoPj + "&filtro=" + enderecosQtdPj + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desNumeroPj
    $('#desNumeroPj:checked').each(function () {

        desNumeroPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obNumeroPj
    $('#obNumeroPj:checked').each(function () {

        obNumeroPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=numeroPj" + '&desejado=' + desNumeroPj + '&obrigatorio=' + obNumeroPj + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desComplementoPj
    $('#desComplementoPj:checked').each(function () {

        desComplementoPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obComplementoPj
    $('#obComplementoPj:checked').each(function () {

        obComplementoPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=complementoPj" + '&desejado=' + desComplementoPj + '&obrigatorio=' + obComplementoPj + "&extracao=" + extracao,
            function (data, status) {

            });
//desejado  desBairroPj
    $('#desBairroPj:checked').each(function () {

        desBairroPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obBairroPj
    $('#obBairroPj:checked').each(function () {

        obBairroPj.push($(this).val());
        //alert(desCpf);
    });

    var bairroPj = $('#bairroPj').val();
    if (bairroPj === undefined) {
        bairroPj === '';
    }

    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=bairroPj" + '&desejado=' + desBairroPj + '&obrigatorio=' + obBairroPj + "&extracao=" + extracao + "&filtro=",
            function (data, status) {

            });
    //desejado  desCidadePj
    $('#desCidadePj:checked').each(function () {

        desCidadePj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCidadePj
    $('#obCidadePj:checked').each(function () {

        obCidadePj.push($(this).val());
        //alert(desCpf);
    });

    var cidadePj = $('#cidadesPj').val();
    if (cidadePj === undefined) {
        cidadePj === '';
    }
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cidadePj" + '&desejado=' + desCidadePj + '&obrigatorio=' + obCidadePj + "&extracao=" + extracao + '&filtro=' + cidadePj,
            function (data, status) {

            });
    //desejado  desEstadoPj
    $('#desEstadoPj:checked').each(function () {

        desEstadoPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obEstadoPj
    $('#obEstadoPj:checked').each(function () {

        obEstadoPj.push($(this).val());
        //alert(desCpf);
    });


    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=estadoPj" + '&desejado=' + desEstadoPj + '&obrigatorio=' + obEstadoPj + "&filtro=" + selectEstadosPj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desCepPj
    $('#desCepPj:checked').each(function () {

        desCepPj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCepPj
    $('#obCepPj:checked').each(function () {

        obCepPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cepPj" + '&desejado=' + desCepPj + '&obrigatorio=' + obCepPj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desSituacao
    $('#desSituacao:checked').each(function () {

        desSituacao.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obSituacao
    $('#obSituacao:checked').each(function () {

        obSituacao.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=situacao" + '&desejado=' + desSituacao + '&obrigatorio=' + obSituacao + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desDataSituacao
    $('#desDataSituacao:checked').each(function () {

        desDataSituacao.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obSituacao
    $('#obDataSituacao:checked').each(function () {

        obDataSituacao.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dataSituacao" + '&desejado=' + desDataSituacao + '&obrigatorio=' + obDataSituacao + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desPorte
    $('#desPorte:checked').each(function () {

        desPorte.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obSituacao
    $('#obPorte:checked').each(function () {

        obPorte.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=porte" + '&desejado=' + desPorte + '&obrigatorio=' + obPorte + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desFPresumido
    $('#desFPresumido:checked').each(function () {

        desFPresumido.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obFPresumido
    $('#obFPresumido:checked').each(function () {

        obFPresumido.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=faturamentoPresumido" + '&desejado=' + desFPresumido + '&obrigatorio=' + obFPresumido + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desQtdProprietarios
    $('#desQtdProprietarios:checked').each(function () {

        desQtdProprietarios.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obQtdProprietarios
    $('#obQtdProprietarios:checked').each(function () {

        obQtdProprietarios.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=qtdProprietarios" + '&desejado=' + desQtdProprietarios + '&obrigatorio=' + obQtdProprietarios + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desPConsumo
    $('#desPConsumo:checked').each(function () {

        desPConsumo.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obPConsumo
    $('#obPConsumo:checked').each(function () {

        obPConsumo.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=perfilConsumo" + '&desejado=' + desPConsumo + '&obrigatorio=' + obPConsumo + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desFone1Pj
    $('#desFone1Pj:checked').each(function () {

        desFone1Pj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obFone1Pj
    $('#obFone1Pj:checked').each(function () {

        obFone1Pj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fone1Pj" + '&desejado=' + desFone1Pj + '&obrigatorio=' + obFone1Pj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desFone2Pj
    $('#desFone2Pj:checked').each(function () {

        desFone2Pj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obFone2Pj
    $('#obFone2Pj:checked').each(function () {

        obFone2Pj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fone2Pj" + '&desejado=' + desFone2Pj + '&obrigatorio=' + obFone2Pj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desFone3Pj
    $('#desFone3Pj:checked').each(function () {

        desFone3Pj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obFone3Pj
    $('#obFone3Pj:checked').each(function () {

        obFone3Pj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fone3Pj" + '&desejado=' + desFone3Pj + '&obrigatorio=' + obFone3Pj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desCel1Pj
    $('#desCel1Pj:checked').each(function () {

        desCel1Pj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCel2Pj
    $('#obCel2Pj:checked').each(function () {

        obCel2Pj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cel1Pj" + '&desejado=' + desCel1Pj + '&obrigatorio=' + obCel2Pj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desCel2Pj
    $('#desCel2Pj:checked').each(function () {

        desCel2Pj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCel2Pj
    $('#obCe2lPj:checked').each(function () {

        obCe2lPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cel2Pj" + '&desejado=' + desCel1Pj + '&obrigatorio=' + obCe2lPj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desCel3Pj
    $('#desCel3Pj:checked').each(function () {

        desCel3Pj.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCel2Pj
    $('#obCe3lPj:checked').each(function () {

        obCe3lPj.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cel3Pj" + '&desejado=' + desCel3Pj + '&obrigatorio=' + obCe3lPj + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejado  desCel3Pj
    $('#desSocio:checked').each(function () {

        desSocio.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio obCel2Pj
    $('#obSocios:checked').each(function () {

        obSocios.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=socios" + '&desejado=' + desSocio + '&obrigatorio=' + obSocios + "&extracao=" + extracao,
            function (data, status) {

            });
    alert("Aguarde você será redirecionado automaticamente... ");

    if (extracao === 'extracao') {

        setTimeout(function () {
            window.location = "http://dwonline.com.br/desenv/extracao/"

        }, 4000);
    } else {
        setTimeout(function () {
            location.reload();
        }, 4000);
    }


});

$("#salvarFiltros3").click(function () {


    var selectEstados = [];
    var selectEstadosPj = [];
    var selecEscolaridade = [];
    var selecClaSocial = [];
    var selecDDDsFone = [];
    var selecDDDsCel = [];
    var enderecos = [];
    var enderecosQtdPj = [];
    var qtdEmail = [];

    selectEstados.push($('#estados').val());
    selecEscolaridade.push($('#escolaridade').val());
    selecClaSocial.push($('#claSocial').val());
    selecDDDsFone.push($('#DDDsFone').val());
    selecDDDsCel.push($('#DDDsCel').val());
    enderecosQtdPj.push($('#enderecosQtdPj').val());
    enderecos.push($('#enderecosQtd').val());
    qtdEmail.push($('#qtdEmail').val());

    if ($('#atualizarFiltros').val() === 'atualizar') {
        var idtbFiltro = $("#idtbExtracao").val();
        var tipoArquivo = $("#tipoArquivo").val();
        var tipoArquivoEntrada = $("#optionTipoEntrada").val();


        var retorno = $.getJSON("/pages/php/atualizarExtracaoFiltro.php?idtbExtracao=" + idtbFiltro,
                function (data, status) {

                });
        var retorno = $.getJSON("/pages/php/excluirExtracaoFiltro.php?idtbExtracao=" + idtbFiltro,
                function (data, status) {

                });
    } else {
        var idtbFiltro = $("#optionFiltros").val();
        var tipoArquivo = $("#optionTipo").val();
        var tipoArquivoEntrada = $("#optionTipoEntrada").val();
    }


    // var idtbFiltro = $('#idtbExtracao').val();
    var desCpf = [];
    var obCpf = [];
    var desNome = [];
    var obNome = [];
    var desSexo = [];
    var obSexo = [];
    var desNascimento = [];
    var obNascimento = [];
    var nascimentoDe = ($("#nascimentoDe").val());
    var nascimentoAte = ($("#nascimentoAte").val());
    var desMae = [];
    var obMae = [];
    var desCbo = [];
    var obCbo = [];
    var desDescCbo = [];
    var obDescCbo = [];
    var desRestimada = [];
    var obRestimada = [];
    var rendaEstimadaDe = ($("#rendaEstimadaDe").val());
    var rendaEstimadaAte = ($("#rendaEstimadaAte").val());
    var desEscolaridade = [];
    var obEscolaridade = [];
    var desClaSocial = [];
    var obClaSocial = [];
    var desPerConsumo = [];
    var obPerConsumo = [];
    var desDDDFone1 = [];
    var obDDDFone1 = [];
    var desFone2 = [];
    var desFone1 = [];
    var obFone1 = [];
    var desDDDFone2 = [];
    var obDDDFone2 = [];
    var obFone2 = [];
    var desDDDFone3 = [];
    var obDDDFone3 = [];
    var desFone3 = [];
    var obFone3 = [];
    var desDDDCel1 = [];
    var obDDDCel1 = [];
    var desDDDCel2 = [];
    var obDDDCel2 = [];
    var desCel2 = [];
    var desCel1 = [];
    var obCel1 = [];
    var obCel2 = [];
    var desDDDCel3 = [];
    var obDDDCel3 = [];
    var desCel3 = [];
    var obCel3 = [];
    var desEndereco = [];
    var obEndereco = [];
    var desNumero = [];
    var obNumero = [];
    var desComplemento = [];
    var obComplemento = [];
    var desBairro = [];
    var obBairro = [];
    var desCidade = [];
    var obCidade = [];
    var desEstado = [];
    var obEstado = [];
    var desCep = [];
    var obCep = [];
    var desEmail = [];
    var obEmail = [];
    var desDataObito = [];
    var obDataObito = [];
    var desCidadeObito = [];
    var obCidadeObito = [];
    var desPEmpresarial = [];
    var obPEmpresarial = [];
    var desProcon = [];
    var obProcon = [];
    var nullProcon = [];


    var extracao = $("#extracao").val();

    var tableFiltroQueryBairros = $("#tableFiltroQueryBairros").val();
    //alert(tableFiltroQueryBairros);
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=tableFiltroQueryBairros" + "&filtro=" + tableFiltroQueryBairros + "&extracao=" + extracao,
            function (data, status) {

            });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=tipoArquivo" + "&filtro=" + tipoArquivo + "&extracao=" + extracao,
            function (data, status) {

            });
            
              var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=tipoArquivoEntrada" + "&filtro=" + tipoArquivoEntrada + "&extracao=" + extracao,
            function (data, status) {

            });
//--------------------------------------------------pf-----------------------------------------------------------//
//
//

//null procon
    $('#nullProcon:checked').each(function () {

        nullProcon.push($(this).val());
        //alert(desCpf);
    });
//desejado procon
    $('#desProcon:checked').each(function () {

        desProcon.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio cnpj
    $('#obProcon:checked').each(function () {

        obProcon.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=procon" + '&desejado=' + desProcon + '&obrigatorio=' + obProcon + "&extracao=" + extracao + "&filtro=" + nullProcon,
            function (data, status) {

            });
//desejado cpf
    $('#desCpf:checked').each(function () {

        desCpf.push($(this).val());
        //alert(desCpf);
    });
//obrigatorio cpf
    $('#obCpf:checked').each(function () {

        obCpf.push($(this).val());
        //alert(desCpf);
    });
    var retorno = $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cpf" + '&desejado=' + desCpf + '&obrigatorio=' + obCpf + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel nome    
    $('#desNome:checked').each(function () {

        desNome.push($(this).val());
        //alert(desNome);
    });
    //obrigatorio nome    
    $('#obNome:checked').each(function () {

        obNome.push($(this).val());
        //alert(obNome);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=nome" + '&desejado=' + desNome + '&obrigatorio=' + obNome + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel sex
    $('#desSexo:checked').each(function () {

        desSexo.push($(this).val());
        //alert(desSexo);
    });
//obrigatorio nome    
    $('#obSexo:checked').each(function () {

        obSexo.push($(this).val()); //alert(obSexo);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=sexo" + '&desejado=' + desSexo + '&obrigatorio=' + obSexo + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel nascimento
    $('#desNascimento:checked').each(function () {

        desNascimento.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio nascimento
    $('#obNascimento:checked').each(function () {

        obNascimento.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=nascimento" + '&desejado=' + desNascimento + '&obrigatorio=' + obNascimento + "&filtro=" + nascimentoDe + "," + nascimentoAte + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel mae
    $('#desMae:checked').each(function () {

        desMae.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio mae
    $('#obMae:checked').each(function () {

        obMae.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=mae" + '&desejado=' + desMae + '&obrigatorio=' + obMae + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel cbo
    $('#desCbo:checked').each(function () {

        desCbo.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio cbo
    $('#obCbo:checked').each(function () {

        obCbo.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cbo" + '&desejado=' + desCbo + '&obrigatorio=' + obCbo + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel descricao cbo
    $('#desDescCbo:checked').each(function () {

        desDescCbo.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio descrição cbo
    $('#obDescCbo:checked').each(function () {

        obDescCbo.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=descCbo" + '&desejado=' + desDescCbo + '&obrigatorio=' + obDescCbo + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel renda estimada
    $('#desRestimada:checked').each(function () {

        desRestimada.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio renda estimada
    $('#obRestimada:checked').each(function () {

        obRestimada.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=rendaEstimada" + '&desejado=' + desRestimada + '&obrigatorio=' + obRestimada + "&filtro=" + rendaEstimadaDe + "," + rendaEstimadaAte + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel escolaridade
    $('#desEscolaridade:checked').each(function () {

        desEscolaridade.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio escolaridade
    $('#obEscolaridade:checked').each(function () {

        obEscolaridade.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=escolaridade" + '&desejado=' + desEscolaridade + '&obrigatorio=' + obEscolaridade + "&filtro=" + selecEscolaridade + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel classe social
    $('#desClaSocial:checked').each(function () {

        desClaSocial.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio classe social
    $('#obClaSocial:checked').each(function () {

        obClaSocial.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=classeSocial" + '&desejado=' + desClaSocial + '&obrigatorio=' + obClaSocial + "&filtro=" + selecClaSocial + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel perfil consumo
    $('#desPerConsumo:checked').each(function () {

        desPerConsumo.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio perdil consumo
    $('#obPerConsumo:checked').each(function () {

        obPerConsumo.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=perfilConsumo" + '&desejado=' + desPerConsumo + '&obrigatorio=' + obPerConsumo + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel ddd fone 1
    $('#desDDDFone1:checked').each(function () {

        desDDDFone1.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio obDDDFone1
    $('#obDDDFone1:checked').each(function () {

        obDDDFone1.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dddFone1" + '&desejado=' + desDDDFone1 + '&obrigatorio=' + obDDDFone1 + "&filtro=" + selecDDDsFone + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel fone1
    $('#desFone1:checked').each(function () {

        desFone1.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio fone1
    $('#obFone1:checked').each(function () {

        obFone1.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fone1" + '&desejado=' + desFone1 + '&obrigatorio=' + obFone1 + "&filtro=" + selecDDDsFone + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel ddd fone 2
    $('#desDDDFone2:checked').each(function () {

        desDDDFone2.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio obDDDFone2
    $('#obDDDFone2:checked').each(function () {

        obDDDFone2.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dddFone2" + '&desejado=' + desDDDFone2 + '&obrigatorio=' + obDDDFone2 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel fone2
    $('#desFone2:checked').each(function () {

        desFone2.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio fone2
    $('#obFone2:checked').each(function () {

        obFone2.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fone2" + '&desejado=' + desFone2 + '&obrigatorio=' + obFone2 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel ddd fone 3
    $('#desDDDFone3:checked').each(function () {

        desDDDFone3.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio obDDDFone3
    $('#obDDDFone3:checked').each(function () {

        obDDDFone3.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dddFone3" + '&desejado=' + desDDDFone3 + '&obrigatorio=' + obDDDFone3 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel fone3
    $('#desFone3:checked').each(function () {

        desFone3.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio fone3
    $('#obFone3:checked').each(function () {

        obFone3.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=fone3" + '&desejado=' + desFone3 + '&obrigatorio=' + obFone3 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
//desejavel ddd cel 1
    $('#desDDDCel1:checked').each(function () {

        desDDDCel1.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio obDDDcel1
    $('#obDDDCel1:checked').each(function () {

        obDDDCel1.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dddCel1" + '&desejado=' + desDDDCel1 + '&obrigatorio=' + obDDDCel1 + "&filtro=" + selecDDDsCel + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel Cel1
    $('#desCel1:checked').each(function () {

        desCel1.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio fone3
    $('#obCel1:checked').each(function () {

        obCel1.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cel1" + '&desejado=' + desCel1 + '&obrigatorio=' + obCel1 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
//desejavel ddd cel 2
    $('#desDDDCel2:checked').each(function () {

        desDDDCel2.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio obDDDcel2
    $('#obDDDCel2:checked').each(function () {

        obDDDCel2.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dddCel2" + '&desejado=' + desDDDCel2 + '&obrigatorio=' + obDDDCel2 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel Cel2
    $('#desCel2:checked').each(function () {

        desCel2.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio fone3
    $('#obCel2:checked').each(function () {

        obCel2.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cel2" + '&desejado=' + desCel2 + '&obrigatorio=' + obCel2 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
//desejavel ddd cel 3
    $('#desDDDCel3:checked').each(function () {

        desDDDCel3.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio obDDDcel2
    $('#obDDDCel3:checked').each(function () {

        obDDDCel3.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dddCel3" + '&desejado=' + desDDDCel3 + '&obrigatorio=' + obDDDCel3 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel Cel3
    $('#desCel3:checked').each(function () {

        desCel3.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio fone3
    $('#obCel3:checked').each(function () {

        obCel3.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cel3" + '&desejado=' + desCel3 + '&obrigatorio=' + obCel3 + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel endereço
    $('#desEndereco:checked').each(function () {

        desEndereco.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio endereço
    $('#obEndereco:checked').each(function () {

        obEndereco.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=endereco" + '&desejado=' + desEndereco + '&obrigatorio=' + obEndereco + "&filtro=" + enderecos + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel numero
    $('#desNumero:checked').each(function () {

        desNumero.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio numero
    $('#obNumero:checked').each(function () {

        obNumero.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=numero" + '&desejado=' + desNumero + '&obrigatorio=' + obNumero + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel complemento
    $('#desComplemento:checked').each(function () {

        desComplemento.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio complemento
    $('#obComplemento:checked').each(function () {

        obComplemento.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=complemento" + '&desejado=' + desComplemento + '&obrigatorio=' + obComplemento + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
//desejavel Bairro
    $('#desBairro:checked').each(function () {

        desBairro.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio Bairro
    $('#obBairro:checked').each(function () {

        obBairro.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=bairro" + '&desejado=' + desBairro + '&obrigatorio=' + obBairro + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
//desejavel Cidade
    $('#desCidade:checked').each(function () {

        desCidade.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio Cidade
    $('#obCidade:checked').each(function () {

        obCidade.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cidade" + '&desejado=' + desCidade + '&obrigatorio=' + obCidade + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
//desejavel Estado
    $('#desEstado:checked').each(function () {

        desEstado.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio Estado
    $('#obEstado:checked').each(function () {

        obEstado.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=estado" + '&desejado=' + desEstado + '&obrigatorio=' + obEstado + "&filtro=" + selectEstados + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel Cep
    $('#desCep:checked').each(function () {

        desCep.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio Cep
    $('#obCep:checked').each(function () {

        obCep.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cep" + '&desejado=' + desCep + '&obrigatorio=' + obCep + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel Email
    $('#desEmail:checked').each(function () {

        desEmail.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio Email
    $('#obEmail:checked').each(function () {

        obEmail.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=email" + '&desejado=' + desEmail + '&obrigatorio=' + obEmail + "&filtro=" + qtdEmail + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel DataObito
    $('#desDataObito:checked').each(function () {

        desDataObito.push($(this).val());
        //alert(desNascimento);
    });
    //obrigatorio DataObito
    $('#obDataObito:checked').each(function () {

        obDataObito.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=dataObito" + '&desejado=' + desDataObito + '&obrigatorio=' + obDataObito + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel CidadeObito
    $('#desCidadeOtibo:checked').each(function () {

        desCidadeObito.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio CidadeObito
    $('#obCidadeObito:checked').each(function () {

        obCidadeObito.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=cidadeObito" + '&desejado=' + desCidadeObito + '&obrigatorio=' + obCidadeObito + "&filtro=" + "&extracao=" + extracao,
            function (data, status) {

            });
    //desejavel PEmpresarial
    $('#desPEmpresarial:checked').each(function () {

        desPEmpresarial.push($(this).val());
        //alert(desNascimento);
    });
//obrigatorio PEmpresarial
    $('#obPEmpresarial:checked').each(function () {

        obPEmpresarial.push($(this).val());
        //alert(obNascimento);
    });
    $.getJSON("/pages/php/insertFiltroEnriquecimento.php?idtbEnriquecimento=" + idtbFiltro + "&nomeCampo=participacaoEmpresarial" + '&desejado=' + desPEmpresarial + '&obrigatorio=' + obPEmpresarial + "&filtro=Atualizar" + "&extracao=" + extracao,
            function (data, status) {
                console.log(data);
            });
    //location.reload(); // ação, atualização do documento

    alert("Aguarde você será redirecionado automaticamente... ");

    if (extracao === 'extracao') {

        setTimeout(function () {
            window.location = "http://dwonline.com.br/desenv/extracao/"

        }, 4000);
    } else {
        setTimeout(function () {
            location.reload();
        }, 4000);
    }

});
//-------carrega gif
$("#imgcarregando").hide();
$("#processar").click(function () {
    $("#imgcarregando").hide();
});

var verificaExtracaoContadaExtracao = function () {

    var cnpjEmpresa = $("#cnpjEmpresa").val();
    var userEmail = $("#userEmail").val();

    $.getJSON("/pages/php/verificaExtracaoContadaExtracao.php?empresaEnvio=" + cnpjEmpresa + "&userEmail=" + userEmail,
            function (data, status) {
                var i = 0;
                var notificaContada;

                $("#notifiContada").html('<div id="notifiContada"></div>');

                for (i = 0; i < data.length; i++) {
                    notificaContada = "<div id='notifiContada'><a href='http://dwonline.com.br/desenv/extracao/?visualidado=1'><i class='fa fa-users text-aqua'></i> Extração Id - " + data[i].idtb_extracao + " terminou a contagem </a></div>";
                    $("#notifiContada").append(notificaContada);
                }
                verificaExtracaoFinalizadaExtracao(data.length);
            });
}


var verificaExtracaoFinalizadaExtracao = function (qtdContada) {

    var cnpjEmpresa = $("#cnpjEmpresa").val();
    var userEmail = $("#userEmail").val();

    $.getJSON("/pages/php/verificarExtracaoFinal.php?empresaEnvio=" + cnpjEmpresa + "&userEmail=" + userEmail,
            function (data, status) {
                var i = 0;
                var notificaFinalizada;

                verificaEnriquecimentoFinalizado(data.length + qtdContada);

                if (data.length > 0)
                    for (i = 0; i <= data.length; i++) {

                        notificaFinalizada = "<div id='notifiContada'><a href='http://dwonline.com.br/desenv/extracao/?visualidado=1'><i class='fa fa-warning text-yellow'></i> Extração Id - " + data[i].idtb_extracao + " finalizada </a></div>";
                        $("#notifiContada").append(notificaFinalizada);
                    }

            }
    );
}

var verificaEnriquecimentoFinalizado = function (total) {

    var cnpjEmpresa = $("#cnpjEmpresa").val();
    var userEmail = $("#userEmail").val();

    $.getJSON("/pages/php/verificarEnriquecimentoFinal.php?empresaEnvio=" + cnpjEmpresa + "&userEmail=" + userEmail,
            function (data, status) {
                var i = 0;
                var notificaContada;

                $("#contaNotificacao").html(data.length + total);

                //$("#notifiContada").html('<div id="notifiContada"></div>');

                for (i = 0; i < data.length; i++) {
                    notificaContada = "<div id='notifiContada'><a href='http://dwonline.com.br/desenv/importa-arquivo/?visualidado=1'><i class='fa fa-users text-red'></i> Enriquecimento Id - " + data[i].idtb_enriquecimento + " processado </a></div>";
                    $("#notifiContada").append(notificaContada);

                }
            });
}


var recursiva = function () {

    verificaExtracaoContadaExtracao();

    setTimeout(recursiva, 20000);
}
recursiva();



