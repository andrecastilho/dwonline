<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();


if (empty($_GET['email'])) {

    $db_check_user = $db->query("SELECT * FROM tb_usuario 
                                 LEFT JOIN tb_empresa 
                                 ON tb_empresa.tb_empresa_cnpj = tb_usuario.tb_usuario_cnpj_empresa
                                 WHERE tb_usuario.tb_usuario_cnpj_empresa  = :cnpj", array(':cnpj' => $db->anti_injection($_GET['cnpj'])));

    $row = $db_check_user->fetchAll();
    
// Configura o ID do usuário
    echo json_encode($row);
    exit();
}


if (empty($_GET['cnpj'])) {

    $db_check_user = $db->query("SELECT * FROM tb_usuario 
                                 LEFT JOIN tb_empresa 
                                 ON tb_empresa.tb_empresa_cnpj = tb_usuario.tb_usuario_cnpj_empresa
                                 WHERE tb_usuario.tb_usuario_username_email  = :email", array(':email' => $db->anti_injection($_GET['email'])));

    $row = $db_check_user->fetchAll();
    
// Configura o ID do usuário
    echo json_encode($row);
    exit();
}



// Verifica se o usuário existe
$db_check_user = $db->query("SELECT * FROM tb_usuario
                             WHERE tb_usuario_username_email LIKE :email and tb_usuario.tb_usuario_cnpj_empresa LIKE :cnpj", array(':email' => $db->anti_injection($_GET['email']),':cnpj' => $db->anti_injection($_GET['cnpj'])));

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

