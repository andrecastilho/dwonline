<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 */

require_once '../../classes/class-TutsupDB.php';


$db = new TutsupDB();


$dadosBusca = $db->anti_injection($_GET['busca']);
$dadosTamanho = strlen($dadosBusca);
$idVendedor = $db->anti_injection($_GET['idtbVendedor']);

switch ($dadosTamanho) {

    case $dadosTamanho == 11:

        $cpfPostados = ($dadosBusca);

        if ($cpfPostados != NULL) {

            $filtro = "SELECT * 

                        FROM tb_pessoa_fisica_fones 

                	where tb_pessoa_fisica_fones.tb_pessoa_fisica_fones_cpf  = '$cpfPostados'
                        GROUP BY tb_pessoa_fisica_fones_fone
                        ORDER BY tb_pessoa_fisica_fones.tb_pessoa_fisica_fones_data DESC";

            $db_retorno = $db->query($filtro);
        } else {
            return json_encode('002'); //nenhum encontrado
        }


// Obtém os dados da base de dados MySQL
        $fetch_user = $db_retorno->fetchAll();


        if ($fetch_user != null) {

            echo json_encode($fetch_user);
        }
        break;

    case $dadosTamanho == 14;


        $cnpjPostados = ($dadosBusca);

        if ($cnpjPostados != NULL) {

            $filtro = "SELECT *  FROM tb_pessoa_juridica_fones 
                        where tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_cnpj = '$cnpjPostados'
                         GROUP BY tb_pessoa_juridica_fones_fone
                         ORDER BY tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_data DESC";


            $db_retorno = $db->query($filtro);
        } else {
            return json_encode('002'); //nenhum encontrado
        }
// Obtém os dados da base de dados MySQL
        $fetch_user = $db_retorno->fetchAll();

        if ($fetch_user != null) {
            echo json_encode($fetch_user);
        } else {
            return json_encode('000'); //nenhum encontrado
        }
}
