<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 * 
 */


set_time_limit(0);


require_once '/var/www/html/classes/class-TutsupDB.php';
require_once '/var/www/html/import/ProcessaArquivoExtracao.class.php';

$db = new TutsupDB();

$sqlCreateTable = NULL;
$quantidadeLimit = NULL;
$empresaCnpj = NULL;
$idExtracao = NULL;
$tipoArquivo = NULL;

$extracaoParaProcessar = "SELECT * FROM dataWebProducao.tb_extracao 
    
left join tb_extracao_filtros 
on tb_extracao_filtros.tb_extracao_filtros_idtb_extracao = tb_extracao.idtb_extracao
    

where tb_extracao_filtros.tb_extracao_filtros_nome_campo='tipoArquivo'            
AND tb_extracao_em_procesamento ='1'
AND tb_extracao_qtd_linhas IS NOT NULL
AND tb_extracao_query IS NOT NULL
AND tb_extracao_processar='1'
AND tb_extracao_arquivo_cpf =''
AND tb_extracao_processar_contada IS NULL
LIMIT 1";

$db_retorno = $db->query($extracaoParaProcessar);
$fetch = $db_retorno->fetchAll();




if ($fetch) {
    $tipoArquivo = $fetch[0]['tb_extracao_filtros_filtro'];
    $sqlCreateTable = $fetch[0]['tb_extracao_query'];
    $idExtracao = $fetch[0]['idtb_extracao'];
    $empresaCnpj = $fetch[0]['tb_extracao_empresa_envio'];
    $quantidadeLimit = "LIMIT " . $fetch[0]['tb_extracao_qtd_processar'];
}

$qtdMaxRegistros = "SELECT tb_empresa_qtd_max_registros,tb_empresa_permite_excedente,tb_empresa_qtd_contratada FROM tb_empresa where tb_empresa_cnpj = '$empresaCnpj'";
$db_retornoMR = $db->query($qtdMaxRegistros);
$fetch_userMR = $db_retornoMR->fetchAll();




if ((($fetch_userMR[0]['tb_empresa_qtd_contratada'] - $fetch_userMR[0]['tb_empresa_qtd_max_registros']) >= $quantidadeLimit) || $fetch_userMR[0]['tb_empresa_permite_excedente'] == 'on') {
    $processaExtracao = new ProcessaArquivoExtracao();
    $processaExtracao->processarExtracao($sqlCreateTable . " " . $quantidadeLimit, $empresaCnpj, $idExtracao, $tipoArquivo, $quantidadeLimit);
} else {

    echo "Seus créditos acabaram. Favor providenciar nova carga para empresa ! " . $empresaCnpj . "\n";
    echo "De no mínimo : ";
    echo (($fetch_userMR[0]['tb_empresa_qtd_contratada'] - $fetch_userMR[0]['tb_empresa_qtd_max_registros']) - $qtdProcessar) * (-1) . " créditos para este enriquecimento \n";
}
?> 
