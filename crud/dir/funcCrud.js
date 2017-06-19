$(document).ready(function () {

    $("#buscarCrud").click(function () {

        var cpfCnpj = $("#tb_pessoa_fisica_cpf_busca").val();

        $.getJSON("../pages/php/buscaCpfCnpj.php?busca=" + cpfCnpj + "&cnpjEmpresa=96335712000130",
                function (data, status) {

                    var dia = data[0].tb_pessoa_fisica_data_nascimento.substr(6, 2);
                    var mes = data[0].tb_pessoa_fisica_data_nascimento.substr(4, 2);
                    var ano = data[0].tb_pessoa_fisica_data_nascimento.substr(0, 4);

                    $("#tb_pessoa_fisica_cpf").val(data[0].tb_pessoa_fisica_cpf);
                    $("#tb_pessoa_fisica_nome").val(data[0].tb_pessoa_fisica_nome);
                    $("#tb_pessoa_fisica_sexo").val(data[0].tb_pessoa_fisica_sexo);
                    $("#tb_pessoa_fisica_data_nascimento").val(ano + "-" + mes + "-" + dia);

                });

    });

    $("#buscarCrudPj").click(function () {

        var cpfCnpj = $("#tb_pessoa_juridica_cnpjBusca").val();

        $.getJSON("../pages/php/buscaCpfCnpj.php?busca=" + cpfCnpj + "&cnpjEmpresa=96335712000130",
                function (data, status) {

                    var dia = data[0].tb_pessoa_juridica_data_nascimento.substr(6, 2);
                    var mes = data[0].tb_pessoa_juridica_data_nascimento.substr(4, 2);
                    var ano = data[0].tb_pessoa_juridica_data_nascimento.substr(0, 4);

                    $("#tb_pessoa_juridica_cnpj").val(data[0].tb_pessoa_juridica_cnpj);
                    $("#tb_pessoa_juridica_nome").val(data[0].tb_pessoa_juridica_nome);
                    $("#tb_pessoa_juridica_fantasia").val(data[0].tb_pessoa_juridica_fantasia);
                    $("#tb_pessoa_juridica_matriz").val(data[0].tb_pessoa_juridica_matriz);

                    $("#tb_pessoa_juridica_qtd_empregados").val(data[0].tb_pessoa_juridica_qtd_empregados);
                    $("#tb_pessoa_juridica_cnae").val(data[0].tb_pessoa_juridica_cnae);
                    $("#tb_pessoa_juridica_id_natureza").val(data[0].tb_pessoa_juridica_id_natureza);
                    $("#tb_pessoa_juridica_porte").val(data[0].tb_pessoa_juridica_porte);

                    $("#tb_pessoa_juridica_data_nascimento").val(ano + "-" + mes + "-" + dia);

                });
    });

    $("#buscarCrudExcluirEmailPf").click(function () {

        var cpfCnpj = $("#tb_pessoa_fisica_cpf").val();
        
        $("#emails").html("  <div id='emails'></div>");

        $.getJSON("../pages/php/buscaEmailCpfCnpj.php?cpfCnpj=" + cpfCnpj + "&cnpjEmpresa=96335712000130",
                function (data, status) {

                    $.each(data, function (i, element) {

                        var emails =
                                "<div id = 'emails' style = 'padding: 2px;border-bottom: 1px solid #EBEBEB;' >" +
                                "Email : <A href='../crud/excluirEmailPf.php?email=" + data[i].idtb_pessoa_fisica_email + "'>"+ data[i].tb_pessoa_fisica_email_email + "   --->    Excluir</A>" +
                                "</div>";
                        $("#emails").append(emails);
                        
                        console.log(emails);

                    });
                });
    });


});