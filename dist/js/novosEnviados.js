$(document).ready(function () {

//busca endereço apatir do CEP
    $("#cepRetro").blur(function () {

        var callback;
        var cep = $("#cepRetro").val();

        var retorno = $.getJSON("../pages/php/buscaCep.php?cep=" + cep,
                function (data, sucess) {

                    $("#endRetro").val(data[0].tb_pessoa_fisica_end_end);
                    $("#tb_pessoa_fisica_end_bairro").val(data[0].tb_pessoa_fisica_end_bairro);
                    $("#cidadeRetro").val(data[0].tb_pessoa_fisica_end_cidade);
                    $("#bairroRetro").val(data[0].tb_pessoa_fisica_end_bairro);
                    $("#ufRetro").val(data[0].tb_pessoa_fisica_end_uf);

                });
    });

    //envia novos endereços
    $("#enviarEnderecoNovo").click(function () {

        var cpfCnpj = $("#cpf_cnpj_redirect").val().replace(/[^\d]+/g, '');
        var end = $("#endRetro").val();
        var num = $("#numRetro").val();
        var compl = $("#complRetro").val();
        var bairro = $("#bairroRetro").val();
        var uf = $("#ufRetro").val();
        var cep = $("#cepRetro").val();
        var cidade = $("#cidadeRetro").val();
        var user = $("#idtbVendedor").val();
        var callback;

        var retorno = $.getJSON("../pages/php/inserirEndRetro.php?cpfCnpfRetro=" + cpfCnpj + "&end=" + end + "&num=" + num + "&compl=" + compl + "&bairro=" + bairro + "&cidade=" + cidade + "&uf=" + uf + "&cep=" + cep + "&user=" + user, callback);
        alert("Inserido com sucesso");
        $('#novosEnderecos').modal('toggle');
    });

    //envia novos telefones
    $("#enviarTelefoneNovo").click(function () {

        var cpfCnpj = $("#cpf_cnpj_redirect").val().replace(/[^\d]+/g, '');
        var ddd = $("#dddRetro").val();
        var fone = $("#foneRetro").val();
        var user = $("#idtbVendedor").val();
        var operadora = $("#operadoraRetro").val();
        var callback;

        var retorno = $.getJSON("../pages/php/inserirFoneRetro.php?cpfCnpjRetro=" + cpfCnpj + "&ddd=" + ddd + "&fone=" + fone + "&user=" + user + "&operadora=" + operadora, callback);
        alert("Inserido com sucesso");
        $('#novosTelefones').modal('toggle');

    });
    
    //envia novos emails
    $("#enviarEmailNovo").click(function () {

        var cpfCnpj = $("#cpf_cnpj_redirect").val().replace(/[^\d]+/g, '');
        var email = $("#emailRetro").val();
        var user = $("#idtbVendedor").val();
        var callback;

        var retorno = $.getJSON("../pages/php/inserirEmailRetro.php?cpfCnpjRetro=" + cpfCnpj + "&email=" + email + "&user=" + user, callback);
        alert("Inserido com sucesso");
        $('#novosEmails').modal('toggle');

    });


});

 