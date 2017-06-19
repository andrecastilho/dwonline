<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

$estado = $db->anti_injection($_GET['estado']);

$ex = "'" . str_replace(",", "','", $estado) . "'";

if ($ex=='*') {
    $sql = "select tb_pessoa_fisica_end_cidade from tb_cidades  order by tb_pessoa_fisica_end_cidade ";
} else {
    $sql = "select tb_pessoa_fisica_end_cidade from tb_cidades WHERE tb_pessoa_fisica_end_uf in ($ex) order by tb_pessoa_fisica_end_cidade ";
}

$db_retorno = $db->query($sql);


// Obtém os dados da base de dados MySQL
$fetch_cep = $db_retorno->fetchAll();

echo json_encode($fetch_cep);






