<?php

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

if (empty($_GET['cnpj'])) {

    $razao = $_GET['razao'];

    if ($razao) {
        $where = "WHERE tb_empresa_nome LIKE '$razao%'";
    } else {
        $where = "";
    }

    // Verifica se o usuário existe
    $db_check_user = $db->query("SELECT * FROM tb_empresa $where");
// Obtém os dados da base de dados MySQL
    $fetch_user = $db_check_user->fetchAll();

// Configura o ID do usuário
    echo json_encode($fetch_user);

    exit();
}

$db_check_user = $db->query("SELECT * FROM tb_empresa 

                            left join tb_credito_custo_empresa_produtos
                            on tb_credito_custo_empresa_produtos.tb_credito_custo_empresa_produtos_cnpj=tb_empresa.tb_empresa_cnpj

                            WHERE tb_empresa_cnpj LIKE :cnpj", array(':cnpj' => $db->anti_injection($_GET['cnpj'])));

// Verifica se a consulta foi realizada com sucesso
if (!$db_check_user) {
    echo '<p class="form_error">Internal error.</p>';
    return;
}

// Obtém os dados da base de dados MySQL
$fetch_user = $db_check_user->fetch();

// Configura o ID do usuário
echo json_encode($fetch_user);

