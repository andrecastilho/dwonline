<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 */

require_once '../../classes/class-TutsupDB.php';


$db = new TutsupDB();


$dadosBusca = $db->anti_injection($_GET['busca']);
$loginEmpresa = $db->anti_injection($_GET['loginEmpresa']);
$cnpjEmpresa = $db->anti_injection($_GET['cnpjEmpresa']);
$dadosTamanho = strlen($dadosBusca);
$idVendedor = $db->anti_injection($_GET['idtbVendedor']);


switch ($dadosTamanho) {

    case $dadosTamanho == 11:

        $cpfPostados = ($dadosBusca);

        if ($cpfPostados != NULL) {

            $filtro = "SELECT distinct(tb_perfil_consumo_descricao) 
                       FROM dataWebProducao.tb_perfil_consumo_pf where tb_perfil_consumo_cpf = '$cpfPostados'
                       ORDER BY tb_perfil_consumo_descricao";

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
        break;

    case $dadosTamanho == 14;

        $cnpjPostados = ($dadosBusca);

        if ($cnpjPostados != NULL) {

            $filtro = "SELECT * FROM tb_perfil_consumo_pJ where tb_perfil_consumo_cnpj = '$cnpjPostados'                      ORDER BY tb_perfil_consumo_descricao";

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
        break;
}

