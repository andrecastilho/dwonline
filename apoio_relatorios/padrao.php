<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

include 'class/apoio.php';
include 'class/dbClass.php';
date_default_timezone_set("Brazil/East");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Busca Detalhada</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen" />
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="export/tableExport.js"></script>
        <script type="text/javascript" src="export/jquery.base64.js"></script>
        <script type="text/javascript" src="export/html2canvas.js"></script>
        <script type="text/javascript" src="export/jspdf/libs/sprintf.js"></script>
        <script type="text/javascript" src="export/jspdf/jspdf.js"></script>
        <script type="text/javascript" src="export/jspdf/libs/base64.js"></script>
        <script>

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

                    $('.tgl').before('<span> + Iniciar Busca</span>');
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
        </style>
    </head>
    <body>
        <!-- Start Wrapper-->
        <div id="container">
            <div style="padding-top:1%; padding-left: 0.5%; padding-bottom: 1%;"><img src="../dist/img/logo2.jpg" border='0' alt="" /></div>
            <div style="text-align: center; padding-bottom: 2%; "><h4> Busca Detalhada</h4> </div>
            <form  action="" method="GET" >
                <div id="box-toggle">
                    <div class="tgl">
                        Data Inicial &nbsp; <input type="text" id="dataInicial" name="dataInicial" value="">
                        Data Final  &nbsp; <input type="text" id="dataFinal" name="dataFinal" value="">
                        &nbsp;&nbsp;&nbsp;<input  type="submit" name="enviar" style="vertical-align: text-bottom;" id="enviar"   value="Buscar" /><br>
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
                    <table  id="tableExport" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id Empresa</th>
                                <th>Idt User</th>
                                <th>Nome </th>Padr&abreve;o
                                <th>Ip</th>
                                <th>Busca Efetuada</th>
                                <th>Navegador</th>
                                <th>Data/Hora</th>


                            </tr>
                        </thead>
                        <tbody>
                            <!-- php -->

                            <?php
                            $ap = new APOIO();
                            $db = new DB();
                            $data_inicial = $_GET['dataInicial'];
                            $data_final = $_GET['dataFinal'];
                            $db->conexao();
                            $ap->relatorioUtilizacaoSistema($data_inicial, $data_final);
                            $ap->fechaConexao();
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>




    </body>
</html>
