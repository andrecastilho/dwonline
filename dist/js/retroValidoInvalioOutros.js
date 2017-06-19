$(document).ready(function () {

    $("#outros").hide(600);
    $("#outrosTelefones").hide(600);
    $("#botoesTelefone").hide(600);

    $("#enderecoValido").click(function () {
        var tipo = 'enderecoValido';
        var info = $("#infoLocalizacao").text();
        var user = $("#idtbVendedor").val();

        $.getJSON("../pages/php/inserirValidoInvalidoOutros.php?tipo=" + tipo + "&info=" + info + "&user=" + user,
                function (data, status) {

                }).always(function () {
            alert("Inserido com sucesso !");
        });
    });

    $("#enderecoInvalido").click(function () {
        var tipo = 'enderecoInvalido';
        var info = $("#infoLocalizacao").text();
        var user = $("#idtbVendedor").val();

        $.getJSON("../pages/php/inserirValidoInvalidoOutros.php?tipo=" + tipo + "&info=" + info + "&user=" + user,
                function (data, status) {

                }).always(function () {
            alert("Inserido com sucesso !");
        });
    });

    $("#enderecoOutros").click(function () {

        $("#outros").show(600);
    });

    $("#enviarOutros").click(function () {
        var info = $("#info").val();
        var user = $("#idtbVendedor").val();
        var tipo = 'enderecoOutros';


        $.getJSON("../pages/php/inserirValidoInvalidoOutros.php?tipo=" + tipo + "&info=" + info + "&user=" + user,
                function (data, status) {

                }).always(function () {
            alert("Inserido com sucesso !");
            $("#outros").val('');
            $("#outros").hide(600);
        });
    });

    /*
     * ----------------------TELEFONES----------------------------------------
     */

    $("#telefoneValido").click(function () {

        $("#infoTelefones").val("");
        $("#botoesTelefone").show(600);

        var tipo = 'telefoneValido';
        $("#hiddemTelefoneTipo").val(tipo);

        return tipo;
    });

    $("#telefoneInvalido").click(function () {
        $("#infoTelefones").val("");
        $("#botoesTelefone").show(600);
        //$("#cancelarEnvioTelefone").show(600);
        var tipo = 'telefoneInvalido';
        $("#hiddemTelefoneTipo").val(tipo);
        return tipo;
    });

    $("#telefoneOutros").click(function () {
        $("#infoTelefones").val("");
        $("#botoesTelefone").show(600);
        //$("#cancelarEnvioTelefone").show(600);
        var tipo = 'telefoneOutros';
        $("#hiddemTelefoneTipo").val(tipo);
        return tipo;
    });

    $("#enviarOutrosTelefones").click(function () {
        var info = $("#infoTelefones").val();
        var user = $("#idtbVendedor").val();
        var tipo = $("#hiddemTelefoneTipo").val();

        $.getJSON("../pages/php/inserirValidoInvalidoOutros.php?tipo=" + tipo + "&info=" + info + "&user=" + user,
                function (data, status) {

                }).always(function () {
            alert("Inserido com sucesso !");
            $("#outrosTelefones").val('');
            $("#botoesTelefone").hide(600);
        });
    });

    $("#cancelarEnvioTelefone").click(function () {

        $("#botoesTelefone").val('');
        $("#botoesTelefone").hide(600);
    });



});