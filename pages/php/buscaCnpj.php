<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
 * 
 */

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

if (empty($_GET['cnpj'])) {

    $form_msg = "Digite um CNPJ";
    // Termina se nada foi enviado
    echo $form_msg;
}

$cnpj = $db->anti_injection($_GET['cnpj']);

// Verifica se o usuário existe
$db_check_user = $db->query("SELECT * FROM tb_pessoa_juridica 
		 LEFT JOIN tb_pessoa_juridica_end 
                 ON tb_pessoa_juridica_end.tb_pessoa_juridica_end_cnpj =tb_pessoa_juridica.tb_pessoa_juridica_cnpj
                 WHERE tb_pessoa_juridica.tb_pessoa_juridica_cnpj in ('$cnpj')");

// Verifica se a consulta foi realizada com sucesso
if (!$db_check_user) {
    echo '<p class="form_error">Internal error.</p>';
    return;
}

// Obtém os dados da base de dados MySQL
$fetch_user = $db_check_user->fetch();

// Configura o ID do usuário
echo json_encode($fetch_user);

