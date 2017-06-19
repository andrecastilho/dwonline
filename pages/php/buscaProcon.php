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



if ($dadosBusca != NULL) {
    $filtro = "SELECT * 

                        FROM tb_procon 

                	where tb_procon_telefone  = '$dadosBusca'";

    $db_retorno = $db->query($filtro);
} else {
    return json_encode('002'); //nenhum encontrado
}


// Obtém os dados da base de dados MySQL
$fetch_user = $db_retorno->fetchAll();


if ($fetch_user != null) {

    echo json_encode($fetch_user);
}




