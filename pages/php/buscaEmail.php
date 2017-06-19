<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
 * 
 */


if (empty($_GET['email'])) {

    $form_msg = "Digite um EMAIL";
    // Termina se nada foi enviado
    echo $form_msg;
}

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

// Verifica se o usuário existe
$db_check_user = $db->query("SELECT * FROM tb_pessoa_fisica 
		 LEFT JOIN tb_pessoa_fisica_end 
                 ON tb_pessoa_fisica_end.tb_pessoa_fisica_end_cpf =tb_pessoa_fisica.tb_pessoa_fisica_cpf  
                 WHERE tb_pessoa_fisica.tb_pessoa_fisica_cpf LIKE :email", array(':email' => $db->anti_injection($_GET['email'])));

//print_r($_GET['cpf']);
// Verifica se a consulta foi realizada com sucesso
if (!$db_check_user) {
    
    echo '<p class="form_error">Internal error.</p>';
    //return;
}

// Obtém os dados da base de dados MySQL
$fetch_user = $db_check_user->fetch();



// Configura o ID do usuário
echo json_encode($fetch_user);

