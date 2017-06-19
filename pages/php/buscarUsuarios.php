<?php

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();


$empresaCnpj = $db->anti_injection($_GET['empresaCnpj']);

    $db_retorno = $db->query("SELECT  *  FROM tb_usuario WHERE tb_usuario_cnpj_empresa ='$empresaCnpj'");

if ($db_retorno != NULL) {
    // Obtém os dados da base de dados MySQL
    $fetch_user = $db_retorno->fetchAll();

// Configura o ID do usuário
    echo json_encode($fetch_user);
} else {
    echo json_encode('002'); //nenhum encontrado
}






