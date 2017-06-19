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

            $filtro = "SELECT * FROM tb_pessoa_fisica_social
                
                       LEFT JOIN tb_cbo 
                       ON tb_cbo.tb_cbo_id_cbo = tb_pessoa_fisica_social.tb_pessoa_fisica_social_id_cbo
                       
                       LEFT JOIN tb_pessoa_juridica_socio
                       ON tb_pessoa_juridica_socio.tb_pessoa_juridica_socio_cpf_id = tb_pessoa_fisica_social.tb_pessoa_fisica_social_cpf
                       
                       WHERE tb_pessoa_fisica_social_cpf = '$cpfPostados'
                       ORDER BY tb_pessoa_fisica_social_renda_estimada desc
                       LIMIT 1";

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

        echo ">>>pj";


        break;
}

