<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '../../classes/class-TutsupDB.php';



$db = new TutsupDB();

$idExtracao = $db->anti_injection($_GET['idtbEnriquecimento']);
$qtdProcessar = $db->anti_injection($_GET['qtdProcessar']);
$cnpjEmpresa = $db->anti_injection($_GET['cnpjEmpresa']);

$qtdMaxRegistros = "SELECT tb_empresa_qtd_max_registros,tb_empresa_permite_excedente,tb_empresa_qtd_contratada FROM tb_empresa where tb_empresa_cnpj = '$cnpjEmpresa'";
$db_retornoMR = $db->query($qtdMaxRegistros);
$fetch_userMR = $db_retornoMR->fetchAll();

//die(($fetch_userMR[0]['tb_empresa_qtd_max_registros']));

if ((($fetch_userMR[0]['tb_empresa_qtd_contratada'] - ($fetch_userMR[0]['tb_empresa_qtd_max_registros']*-1)) >= $qtdProcessar) || $fetch_userMR[0]['tb_empresa_permite_excedente'] == 'on') {

    //fazer atualização dos creditos
    $query0 = $db->update('tb_empresa', 'tb_empresa_cnpj', $cnpjEmpresa, array(
        'tb_empresa_qtd_max_registros' => ($fetch_userMR[0]['tb_empresa_qtd_max_registros']+$qtdProcessar)));
    
     if ($query0) {
        echo("Processo Atualizado em créditos para empresa ".$cnpjEmpresa);
    }
   
    $query = $db->update('tb_extracao', 'idtb_extracao', $idExtracao, array(
        'tb_extracao_processar' => '1',
        'tb_extracao_qtd_processar' => $qtdProcessar));

    if ($query) {
        echo(" Geração de Arquivo ...");
    }
} else {

    echo "Seus créditos não permitem este processamento. Necessário  ".(($fetch_userMR[0]['tb_empresa_qtd_contratada'] - $fetch_userMR[0]['tb_empresa_qtd_max_registros']) - $qtdProcessar) * (-1) . " créditos para este enriquecimento \n";;
    exit();
}


