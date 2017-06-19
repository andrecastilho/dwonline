<?php
/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 */

include 'class/apoio.php';
include 'class/dbClass.php';
date_default_timezone_set("Brazil/East");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Quantitativa  CNF  - Click Detalhe - Clik Simples</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
        </style>
    </head>
    <body>
        <!-- Start Wrapper-->
        <div id="container">
            <div style="padding-top:1%; padding-left: 0.5%; padding-bottom: 1%;"><img src="../dist/img/logo2.jpg" border='0' alt="" /></div>
            <div style="text-align: center; padding-bottom: 2%; "><h4> Quantitativa  CNF  - Click Detalhe - Clik Simples</h4> </div>
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
                            &nbsp;Usuarios: 
                            <select id="usuarios" name="usuarios"></select>
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
                    <table  id="tableExport" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id Empresa</th>
                                <th>Nome Empresa</th>
                                <th>Qtd.Utilizada Cnf ClikSimples</th>
                                <th>Valor Total ClikSimples</th>
                                <th>Qtd.Utilizada Cnf Detalhado</th>
                                <th>Valor Total Detalhado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- php -->
                            <?php
                            $ap = new APOIO();

                            if ($data_inicial == $dataFinal) {
                                $data_final = strtotime('+1 days', strtotime($ap->converte_data($_GET['dataFinal'])));
                            } else {
                                $data_final = strtotime($ap->converte_data($_GET['dataFinal']));
                            }
                            //$data_final = strtotime('+1 days', strtotime($ap->converte_data($_GET['dataFinal'])));
                            $data_inicial = strtotime($ap->converte_data($_GET['dataInicial']));

                            $usuario = $_GET['usuarios'];
                            $empresa = $_GET['empresas'];

                            $ap->relatorioUtilizacaoSistemaQuantitativoCnf($data_inicial, $data_final, $usuario, $empresa);
                            $ap->fechaConexao();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
