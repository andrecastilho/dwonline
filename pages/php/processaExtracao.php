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
$processaExtracao = new ProcessaArquivoExtracao();


//mudar aqui 
$extracaoParaProcessar = "SELECT * FROM dataWebProducao.tb_extracao where 
                          tb_extracao_filtro IS NOT NULL
                          -- AND tb_extracao_arquivo_cnpj= ''
                          AND tb_extracao_em_procesamento IS NULL
                          OR tb_extracao_em_procesamento=''
                          LIMIT 1";

$db_retorno = $db->query($extracaoParaProcessar);

try {
    $fetch_user = $db_retorno->fetchAll();
    
} catch (PDOException $e) {
    echo $e->getMessage();
}


if (!empty($fetch_user)) {
    $idExtracao = $fetch_user[0]['idtb_extracao'];
    $empresaCnpj = $value['tb_extracao_empresa_envio'];
//ATUALIZA EXTRAÇÃO PARA EM PROCESSAMENTO NÃO CHAMANDO NOVAMENTE 
   //$processaExtracao->atualizaArquivoEmProcesamentoEx($idExtracao);
} else {

    die("Nada há processar ! \n");
}

//BUSCA QUANTIDADE DE LINHAS A SER PROCESSADA
$qtdExtracao = $processaExtracao->qtdExtracao($idExtracao, $empresaCnpj);

//ATUALIZA EM BANCO QUANTIDADE DE LINHAS E SER PROCESSADA + QUERY PARA EXRTRAÇÃO
$processaExtracao->atualizaQtdLinhasExtracao($idExtracao, $qtdExtracao);
?> 
