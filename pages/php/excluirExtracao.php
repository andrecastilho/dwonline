<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '../../classes/class-TutsupDB.php';

$idExtracao = $_GET['idtbExtracao'];

$db = new TutsupDB();

$query = $db->pdo->exec('DELETE FROM `dataWebProducao`.`tb_extracao`
WHERE idtb_extracao = ' . $idExtracao . '');

if ($query) {
    echo"Excluido  \n";
}else{
    echo $query;
}

