<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


if (empty($_GET['cpf'])) {

    $form_msg = "Digite um CPF";
    // Termina se nada foi enviado
    echo $form_msg;
}

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

// Verifica se o usuário existe
$db_check_user = $db->query("SELECT * FROM tb_usuario
                             WHERE tb_usuario_cpf LIKE :cpf", array(':cpf' => $db->anti_injection($_GET['cpf'])));

//print_r($_GET['cpf']);
// Verifica se a consulta foi realizada com sucesso
if (!$db_check_user) {
    echo '<p class="form_error">Internal error.</p>';
    return;
}

// Obtém os dados da base de dados MySQL
$fetch_user = $db_check_user->fetch();

// Configura o ID do usuário
echo json_encode($fetch_user);

