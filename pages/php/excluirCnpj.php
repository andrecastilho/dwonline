<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

if (empty($_GET['cnpj'])) {

    $form_msg = "Digite um CNPJ";
    // Termina se nada foi enviado
    echo $form_msg;
    return;
}

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

// Verifica se o usuário existe
$db_check_user = $db->query("DELETE FROM tb_empresa WHERE tb_empresa_cnpj = :cnpj", array(':cnpj' => $db->anti_injection($_GET['cnpj'])));

// Verifica se a consulta foi realizada com sucesso
if (!$db_check_user) {
    echo '<p class="form_error">Internal error.</p>';
    return;
}

// Obtém os dados da base de dados MySQL
//$fetch_user = $db_check_user->fetch();

// Configura o ID do usuário
echo ("excluido");

