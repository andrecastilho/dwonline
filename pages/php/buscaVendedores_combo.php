<?php

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

// Verifica se o usuário existe
$db_check_user = $db->query("SELECT * FROM tb_usuario 
                             WHERE tb_usuario_e_vendedor='on'");

// Verifica se a consulta foi realizada com sucesso
if (!$db_check_user) {
    echo '<p class="form_error">Internal error.</p>';
    return;
}

// Obtém os dados da base de dados MySQL
$fetch_user = $db_check_user->fetch();

print_r($fetch_user);

// Configura o ID do usuário
//echo json_encode($fetch_user);

