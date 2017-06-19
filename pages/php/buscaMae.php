<?php

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

$cpfFilho = $db->anti_injection($_GET['cpfFilho']);

$sql = "SELECT * FROM dataWebProducao.tb_pessoa_fisica_mae where tb_pessoa_fisica_mae_cpf = '$cpfFilho' ";

$db_retorno = $db->query($sql);


if ($db_retorno != NULL) {

    // Obtém os dados da base de dados MySQL
    $fetch_mae = $db_retorno->fetchAll();

    echo json_encode($fetch_mae);
} else {
    echo json_encode('002'); //nenhum encontrado
}





