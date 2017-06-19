<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 * 
 */
//error_reporting(E_WARNING);
set_time_limit(0);
error_reporting(0); // sem msg de erro


require_once '/var/www/html/classes/class-TutsupDB.php';
require_once '../../import/teste.php';

$db = new TutsupDB();

//mudar aqui 
$arquivosParaProcessar = "SELECT * FROM dataWebProducao.tb_enriquecimento 
                          where 
                          tb_enriquecimento_filtro IS NOT NULL
                          AND tb_enriquecimento_em_procesamento IS NULL
                          AND tb_enriquecimento_ambiente='desenv'
                          LIMIT 1";

$db_retorno = $db->query($arquivosParaProcessar);
$fetch_user = $db_retorno->fetchAll();

if($fetch_user){
foreach ($fetch_user as $key => $value) {


    if ($value['tb_enriquecimento_ambiente'] == 'homolog') {
        $arquivo = "http://dwonline.com.br/desenv/dataWebHomolog/import" . substr($value['tb_enriquecimento_arquivo_enviado'], 1);
    }
    if ($value['tb_enriquecimento_ambiente'] == 'desenv') {
        $arquivo = "http://dwonline.com.br/desenv/import" . substr($value['tb_enriquecimento_arquivo_enviado'], 1);
    }

    //echo ">>".$arquivo;
    //die(",");
    $idEnriquecimento = $value['idtb_enriquecimento'];
    $empresaCnpj = $value['tb_enriquecimento_empresa_envio'];

    $processaArquivo = new ProcessaArquivo();
    $processaArquivo->leArquivo($arquivo, $idEnriquecimento, $empresaCnpj);

    //echo $processaArquivo;
}
}else{
    echo "Sem arquivos para processamento \n";
}
?> 
