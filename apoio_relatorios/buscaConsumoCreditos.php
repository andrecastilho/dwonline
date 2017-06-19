<?php
/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 */

include 'class/apoio.php';
include 'class/dbClass.php';
date_default_timezone_set("Brazil/East");
$user = $_GET['usuarios'];
$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];
$empresaCnpj = $_GET['empresas'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Quantitativa por User</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="utf-8"/>
        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen" />
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/funcional.js"></script>
        <script type="text/javascript" src="export/tableExport.js"></script>
        <script type="text/javascript" src="export/jquery.base64.js"></script>
        <script type="text/javascript" src="export/html2canvas.js"></script>
        <script type="text/javascript" src="export/jspdf/libs/sprintf.js"></script>
        <script type="text/javascript" src="export/jspdf/jspdf.js"></script>
        <script type="text/javascript" src="export/jspdf/libs/base64.js"></script>
        <script>

            function currencyFormat(num) {
                if (num) {
                    return  parseFloat(num).toFixed(2).replace('.', ",");
                } else {
                    return '0,00';
                }
            }
            function chama(empresaCnpj) {

                var idtUsuario = $("#user").val();
                var dataInicial = $("#dataInicial").val();
                var dataFinal = $("#dataFinal").val();
                var empresaCnpj = empresaCnpj;
                //alert("dataInicial="+ Date.parse(dataInicial)+"\n dataFinal="+Date.parse(dataFinal));
             
                $.getJSON("../pages/php/buscarTotaisUsuarios.php?usuario=" + idtUsuario + '&dataInicial=' + Date.parse(dataInicial) + '&dataFinal=' + Date.parse(dataFinal) + '&empresaCnpj=' + empresaCnpj,
                        function (data, status) {

                            var tr = null


                            tr += "<tr>";
                            tr += "<th >Nome Usuário</th>";
                            tr += "<th>Nome Empresa</th>";
                            tr += "<th>Qtd.  Online</th>";
                            tr += "<th>Vlr.  Online</th>";
                            tr += "<th>Qtd.  Cnf Simples</th>";
                            tr += "<th>Vlr.  CnfSimples</th>";
                            tr += "<th>Qtd.  Cnf Detalhado</th>";
                            tr += "<th>Vlr.  Detalhado</th>";
                            tr += "</tr>"



                            $.each(data, function (i) {
                                tr += "<tr>";
                                tr += "<td > " + data[i]['tb_usuario_nome'] + " </td>";
                                tr += "<td > " + data[i]['tb_empresa_nome'] + " </td>";
                                tr += "<td > " + (data[i]['totalOnline'] * 1).toFixed(2) + " </td>";
                                tr += "<td >" + currencyFormat(data[i]['val_total_online']) + "</td>";
                                tr += "<td > " + data[i]['totalClikSimples'] + " </td>";
                                tr += "<td > " + currencyFormat(data[i]['vl_total_cnfsimples']) + " </td>";
                                tr += "<td >" + data[i]['totalClikDetalhado'] + "</td>";
                                tr += "<td > " + currencyFormat(data[i]['vl_total_cnfdetalhado']) + " </td>";
                                tr += "</tr>"
                            });

                                tr += "</tbody>";

                            $("#resultUsuarios").append(tr);

                        });
            }


            function  moreInfoStats(id) {

                $("#dialog" + id).dialog({
                    width: 900
                });
            }

            $(function () {
                $("#dataInicial").datepicker({dateFormat: 'dd/mm/yy'});
                $("#dataFinal").datepicker({dateFormat: 'dd/mm/yy'});

                $(document).ready(function () {

                    $("[id^='dialog']").fadeOut();

                    $('.tgl').before('<span><a> + Iniciar Busca</a></span>');
                    $('.tgl').css('display', 'none')
                    $('span', '#box-toggle').click(function () {
                        $(this).next().slideToggle('slow')
                                .siblings('.tgl:visible').slideToggle('fast');
                        $(this).toggleText('Busca', 'Impressão')

                    });

                    $("#enviar").click(function () {
                        if ($("#dataInicial").val() === "" || $("#dataFinal").val() === "") {
                            alert("Selecionar datas Inicial e Final");
                            return false;
                        }
                    });
                });
            });

        </script>
        <style>
            body {
                font-size: 12px;
                margin: 10px;
            }
            th, td {
                padding: 7px;
                text-align: left;    
            }
        </style>
    </head>

    <body>
        <input type="hidden" name="user" id="user" value="<?php echo $user; ?>"/>
        <input type="hidden" name="dataInicial" id="dataInicial" value="<?php echo $dataInicial; ?>"/>
        <input type="hidden" name="dataFinal" id="dataFinal" value="<?php echo $dataFinal; ?>"/>
        <input type="hidden" name="empresaCnpj" id="empresaCnpj" value="<?php echo $empresaCnpj; ?>"/>
        <!-- Start Wrapper-->
        <div id="container">
            <div style="padding-top:1%; padding-left: 0.5%; padding-bottom: 1%;"><img src="../dist/img/logo2.jpg" border='0' alt="" /></div>
            <div style="text-align: center; padding-bottom: 2%; "><h4> Consumo / Empresa  / Usuários</h4> </div>
            <form  action="" method="GET" >
                <div id="box-toggle">
                    <div class="tgl">
                        Data Inicial &nbsp; <input type="text" id="dataInicial" name="dataInicial" value="">
                        Data Final  &nbsp; <input type="text" id="dataFinal" name="dataFinal" value="">
                        &nbsp;&nbsp;&nbsp;<input  type="submit"  style="vertical-align: text-bottom;" value="Buscar" /><br>


                        <div id="selector_destino">
                            &nbsp;Empresas: 
                            <select name="empresas" id="empresas" autofocus="autofocus" autocorrect="off" autocomplete="off">
                                <option value="0">Selecione</option>
                                <?php
                                $db = new DB();
                                $db->conexao();
                                $apoio = new APOIO();
                                $empresas = $apoio->getAllEmpresas();
                                ?>
                            </select>
                        </div>
                    </div>
                </div> 
            </form>

            <div class="box-body table-responsive" id='ptable'>
                <div class="box-body table-responsive" id='ptable'>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i>Exportar Dados</button>
                        <ul class="dropdown-menu " role="menu">
                            <li><a href="#" onClick ="$('#tableExport').tableExport({type: 'excel', escape: 'true'});"> <img src='../apoio/export/icons/xls.png' width='24px'> XLS</a></li>
                            <li class="divider"></li>
                            <!-- <li><a href="#" onClick ="$('#tableExport').tableExport({type: 'pdf', escape: 'false'});"> <img src='../apoio/export/icons/pdf.png' width='24px'> PDF</a></li> -->
                        </ul>
                    </div>		
                    <?php echo $_GET['dataInicial'] . "  a  " . $_GET['dataFinal'] ?>
                    <table  id="tableExport" class="table table-striped" style="border: 2px;">

                        <thead>
                            <tr >
                                <th>Buscar Usuários</th>
                                <th>CNPJ Empresa</th>
                                <th>Nome Empresa</th>
                                <th>Qtd.  Online</th>
                                <th>Vlr.  Online</th>
                                <th>Qtd.  Enriquecimento</th>
                                <th>Vlr.  Enriquecimento</th>
                                <th>Qtd.  WebService</th>
                                <th>Vlr.  WebService</th>
                                <th>Qtd.  Cnf Simples</th>
                                <th>Vlr.  Simples</th>
                                <th>Qtd.  Detalhado</th>
                                <th>Vlr.  Detalhado</th>
                                <th>Qtd.  Valor Contratado</th>
                                <th>Vlr. Créditos Inseridos</th>
                                <th>Qtd. Total Consultas acumuladas</th>
                                <th>Vlr. Total Faturar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- php -->
                            <?php
                            $ap = new APOIO();

                            $data_inicial = strtotime(($_GET['dataInicial']));
                            $data_final = strtotime(($_GET['dataFinal']));
                            $usuario = $_GET['usuarios'];
                            $empresa = $_GET['empresas'];

                            $ap->relatorioConsumoCreditosWebService($data_inicial, $data_final, $usuario, $empresa);
                            //$ap->relatorioConsumoCreditosOnline($data_inicial, $data_final, $usuario, $empresa);
                            //$ap->relatorioConsumoCreditosEnriquecimento($data_inicial, $data_final, $usuario, $empresa);
                            //$ap->relatorioConsumoCreditosCnfSimples($data_inicial, $data_final, $usuario, $empresa);
                            //$ap->relatorioConsumoCreditosContratadoInseridosTotal($data_inicial, $data_final, $usuario, $empresa);
                            //$ap->relatorioConsumoCreditosTotal($data_inicial, $data_final, $usuario, $empresa);
                            //$ap->fechaConexao();
                            ?>
                        <table id="resultUsuarios" style="border: 2px;"></table> 
                        </tbody>
                    </table>

                </div>
            </div>
    </body>
</html>
