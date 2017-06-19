<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
 * 
 */


require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

// Verifica se o usuário existe
$db_check_user = $db->query("SELECT * FROM tb_extracao_filtros
where tb_extracao_filtros_idtb_extracao=".$db->anti_injection($_GET['idtbExtracao'])."");


// Verifica se a consulta foi realizada com sucesso
if (!$db_check_user) {
    
    echo '<p class="form_error">Internal error.</p>';
    //return;
}

// Obtém os dados da base de dados MySQL
$fetch_user = $db_check_user->fetchAll();



// Configura o ID do usuário
echo json_encode($fetch_user);

