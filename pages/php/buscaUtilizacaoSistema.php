<?php

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();


$dataInicial = $db->anti_injection($_GET['dataInicial']);
$dataFinal = $db->anti_injection($_GET['dataFinal']);

$filtro = "SELECT * FROM dataWebProducao.tb_utilizacao_sistema 
           where tb_utilizacao_sistema_data_hora BETWEEN '$dataInicial' AND '$dataFinal'";


$db_retorno = $db->query($filtro);


if ($db_retorno != NULL) {
    // Obtém os dados da base de dados MySQL
    $fetch_user = $db_retorno->fetchAll();

    //Configura o ID do usuário
    $resultado = json_encode($fetch_user);
} else {
    echo json_encode('002'); //nenhum encontrado
}






