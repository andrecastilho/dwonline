<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 */

require_once '../../classes/class-TutsupDB.php';
require_once '../../classes/class-controleCustos.php';


$db = new TutsupDB();
$controleCustos = new controleCustos();


$cpf = str_pad($db->anti_injection($_GET['cpfCnpj']), 11, STR_PAD_LEFT);
$dadosTamanho = strlen(str_pad($db->anti_injection($_GET['cpfCnpj']), 11, STR_PAD_LEFT));

$cnpjEmpresa = $db->anti_injection($_GET['cnpjEmpresa']);
$idVendedor = $db->anti_injection($_GET['idtbVendedor']);
$tipo = $db->anti_injection($_GET['tipo']);

if ($tipo == 'simples') {
    echo $controleCustos->debitarDw($cnpjEmpresa, 'cnf_simples');
} else {
    echo $controleCustos->debitarDw($cnpjEmpresa, 'cnf_detalhado');
}


if ($dadosTamanho != NULL) {

    $filtro = "SELECT * FROM tb_cnfnew WHERE tb_cnfnew_cpf = '$cpf'";

    $db_retorno = $db->query($filtro);

    $fetch_user = $db_retorno->fetchAll();

    //print_r($fetch_user[0]['tb_cnfnew_cpf']);

    if ($fetch_user[0]['tb_cnfnew_cpf'] != null) {
        echo json_encode($fetch_user);
    } else {
        echo ('002'); //nenhum encontrado
    }
} else {
    echo ('002'); //nenhum encontrado
}

/*
  echo "</pre>";
  var_dump($fetch_user[0]['tb_cnf_cpf']);
  echo "</pre>";
  die("..");
 * 
 */

if ($fetch_user[0]['tb_cnfnew_cpf'] != null and $_GET['naoContar'] != 1) {

    $server = $_SERVER;
    $user['cnpjEmpresa'] = $cnpjEmpresa;
    $user['idtbVendedor'] = $idVendedor;
    $user['filtro'] = $filtro;

    $db->utilizacaoSistema($server, $user, '1');
}


