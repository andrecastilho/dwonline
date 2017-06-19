<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 */

require_once '../../classes/class-TutsupDB.php';


$db = new TutsupDB();


$cnpj = $db->anti_injection($_GET['cpfCnpj']);
$dadosTamanho = strlen($cnpj);

$cnpjEmpresa = $db->anti_injection($_GET['cnpjEmpresa']);
$idVendedor = $db->anti_injection($_GET['idtbVendedor']);

if ($dadosTamanho != NULL) {

    $filtro = "SELECT * FROM tb_pessoa_juridica_situacao WHERE tb_pessoa_juridica_situacao_cnpj= '$cnpj'";

    $db_retorno = $db->query($filtro);
} else {
    return json_encode('002'); //nenhum encontrado
}


// Obtém os dados da base de dados MySQL
$fetch_user = $db_retorno->fetchAll();


if ($fetch_user != null) {

    $server = $_SERVER;
    $user['cnpjEmpresa'] = $cnpjEmpresa;
    $user['idtbVendedor'] = $idVendedor;
    $user['filtro'] = $filtro;

    $db->utilizacaoSistema($server, $user, '1');
// Configura o ID do usuário
    echo json_encode($fetch_user);
}


