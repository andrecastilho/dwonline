<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

$estado = $db->anti_injection($_GET['estado']);
if ($_GET['cidade'] != "*") {
    $cidade = $db->anti_injection($_GET['cidade']);
} else {
    $cidade = "*";
}

$ex = "'" . str_replace(",", "','", $estado) . "'";

if ($cidade == "*") {

     $sql = "select tb_pessoa_fisica_end_bairro from tb_cidades_estados_bairros
            WHERE tb_pessoa_fisica_end_uf=$ex
            order by tb_pessoa_fisica_end_bairro ";
} else {
     $sql = "select tb_pessoa_fisica_end_bairro from tb_cidades_estados_bairros
            WHERE tb_pessoa_fisica_end_uf=$ex
            AND tb_pessoa_fisica_end_cidade='$cidade' order by tb_pessoa_fisica_end_bairro ";
}

$db_retorno = $db->query($sql);


// Obtém os dados da base de dados MySQL
$fetch_cep = $db_retorno->fetchAll();

echo json_encode($fetch_cep);






