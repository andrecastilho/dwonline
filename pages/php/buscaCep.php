<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

$cep = $db->anti_injection($_GET['cep']);

$sql = "SELECT  * FROM tb_pessoa_fisica_end WHERE tb_pessoa_fisica_end_cep = '$cep' limit 1 ";


$db_retorno = $db->query($sql);


if ($db_retorno != NULL) {

    // Obtém os dados da base de dados MySQL
    $fetch_cep = $db_retorno->fetchAll();

    echo json_encode($fetch_cep);
} else {
    echo json_encode('002'); //nenhum encontrado
}





