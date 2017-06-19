<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
 * 
 */

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

$cnpj = $db->anti_injection($_GET['cnpj']);

if (!empty($cnpj)) {

    // Verifica se o usuário existe
    $db_check_user = $db->query("SELECT idtb_usuario,tb_usuario_nome,tb_usuario_cnpj_empresa,emp.tb_empresa_nome FROM tb_usuario as user "
            . "left join tb_empresa as emp"
            . "on emp.tb_empresa_cnpj = user.tb_usuario_cnpj_empresa  "
            . "WHERE tb_usuario_e_vendedor = 'on' and tb_usuario_cnpj_empresa in (':cpf') ", array(':cpf' => intval($cnpj)));
} else {
//echo ">>>>";
// Verifica se o usuário existe
    $db_check_user = $db->query("SELECT idtb_usuario,tb_usuario_nome,tb_usuario_cnpj_empresa,emp.tb_empresa_nome FROM tb_usuario as user 
            left join tb_empresa as emp
            on emp.tb_empresa_cnpj = user.tb_usuario_cnpj_empresa
            WHERE tb_usuario_e_vendedor = 'on' ");
}

// Verifica se a consulta foi realizada com sucesso
if (!$db_check_user) {
    echo '<p class="form_error">Internal error.</p>';
    return;
}

// Obtém os dados da base de dados MySQL
$fetch_user = $db_check_user->fetchAll();

// Configura o ID do usuário
echo json_encode($fetch_user);

