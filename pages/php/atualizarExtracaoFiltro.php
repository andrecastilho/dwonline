<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '../../classes/class-TutsupDB.php';

$idExtracao = $_GET['idtbExtracao'];

$db = new TutsupDB();

$query = $db->pdo->exec('UPDATE `dataWebProducao`.`tb_extracao`
SET
`tb_extracao_em_procesamento` = NULL,
`tb_extracao_query` = NULL,
`tb_extracao_qtd_linhas` = NULL,
`tb_extracao_processar` = NULL,
`tb_extracao_qtd_processar` = NULL,
`tb_extracao_processar_contada` = NULL
 WHERE idtb_extracao = ' . $idExtracao . '');

if ($query) {
    echo"atualizado  \n";
} else {
    echo "erro--> ".$query;
}

