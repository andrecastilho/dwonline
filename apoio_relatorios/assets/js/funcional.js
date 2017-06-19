

$(document).ready(function () {

    $("#empresas").change(function () {
// obtendo o valor do atributo value da tag option
        var idtEmpresa = $("#empresas option:selected").val();

        $.getJSON("../pages/php/buscarUsuarios.php?empresaCnpj=" + idtEmpresa,
                function (data, status) {

                    var options = '<option value="0">Selecione</option>';

                    $.each(data, function (i) {
                        options += '<option value="' + data[i].idtb_usuario + '">' + data[i].tb_usuario_nome + ' - ' + data[i].tb_usuario_username_email + '</option>';
                    });
                    $("#usuarios").html(options);

                });
    });

    $("#buscaUsuarios").click(function () {
        //alert($("#empresas").val())
// obtendo o valor do atributo value da tag option
        var idtUsuario = $("#user").val();
        var dataInicial = $("#dataInicial").val();
        var dataFinal = $("#dataFinal").val();
        var empresaCnpj = $("#empresas").val();
        /*
         var empresa = $(this)                // Representa o elemento clicado (checkbox)
         .closest('tr')  // Encontra o elemento pai do seletor mais próximo
         .find('td') // Encontra o elemento do seletor (todos os tds)
         .eq(0)      // pega o segundo (contagem do eq inicia em 0)
         .text();    // Retorna o texto do elemento
         alert(empresa);
         */

        $.getJSON("../pages/php/buscarTotaisUsuarios.php?usuario=" + idtUsuario + '&dataInicial=' + dataInicial + '&dataFinal=' + dataFinal + '&empresaCnpj=' + empresaCnpj,
                function (data, status) {

                    var tr = null

                    tr += "<table id='tableExport' class='table table-striped' style='border: 2px;'>";
                    tr += "<thead>";
                    tr += "<tr >";
                    tr += "<th colspan='2'>Nome Usuário</th>";
                    tr += "<th>Nome Empresa</th>";
                    tr += "<th>Qtd. Total Online</th>";
                    tr += "<th>Vlr. Total Online</th>";
                    tr += "<th>Qtd. Total Cnf Simples</th>";
                    tr += "<th>Vlr. Total CnfSimples</th>";
                    tr += "<th>Qtd. Total Cnf Detalhado</th>";
                    tr += "<th>Vlr. Total Detalhado</th>";
                    tr += "<th>Qtd. Total Valor Contratado</th>";
                    tr += "</tr>"
                    tr += "</thead>";
                    tr += "<tbody>";


                    $.each(data, function (i) {

                        tr += "<tr>";
                        //tr+="";

                        //tr += "<td </td>";
                        tr += "<td colspan='2'> " + data[i]['tb_usuario_nome'] + " </td>"; 
                        tr += "<td colspan='2'> " + data[i]['tb_empresa_nome'] + " </td>";
                        tr += "<td > " + (data[i]['totalOnline'] * 1).toFixed(2) + " </td>";
                        tr += "<td >" + currencyFormat(data[i]['val_total_online']) + "</td>";
                        tr += "<td > " + data[i]['totalClikSimples'] + " </td>";
                        tr += "<td > " + currencyFormat(data[i]['vl_total_cnfsimples']) + " </td>";
                        tr += "<td >" + data[i]['totalClikDetalhado'] + "</td>";
                        tr += "<td > " + currencyFormat(data[i]['vl_total_cnfdetalhado']) + " </td>";
                        tr += "<td > " + data[i]['tb_empresa_valor_pacote'] + " </td>";
                        tr += "</tr>"

                    });

                    tr += "</tbody>";

                    $("#resultUsuarios").html(tr);

                });
    });


    function currencyFormat(num) {
        if (num) {
            return  parseFloat(num).toFixed(2).replace('.', ",");
        } else {
            return '0,00';
        }
    }

});

