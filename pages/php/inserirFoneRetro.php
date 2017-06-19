<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);




require_once '../../classes/class-TutsupDB.php';


$db = new TutsupDB();

$endCpfCnpjRetro = $_GET['cpfCnpjRetro'];
$foneFone = $_GET['fone'];
$foneDdd = $_GET['ddd'];
$user = $_GET['user'];
$foneOperadora = $_GET['operadoraRetro'];


$data_array = array('', // idtb_utilizacao_sistema
    $db->anti_injection($endCpfCnpjRetro),
    $db->anti_injection($foneDdd),
    $db->anti_injection($foneFone),
    $db->anti_injection($foneOperadora),
    $db->anti_injection(date('d/m/Y')),
    $db->anti_injection($user)
);

$query = ('INSERT INTO `tb_pessoa_fisica_fones_retro`
            (`idtb_pessoa_fisica_fones`,
            `tb_pessoa_fisica_fones_cpf`,
            `tb_pessoa_fisica_fones_ddd`,
            `tb_pessoa_fisica_fones_fone`,
            `tb_pessoa_fisica_fones_operadora`,
            `tb_pessoa_fisica_fones_data`,
            `tb_pessoa_fisica_fones_retro_user`)
            VALUES (?,?,?,?,?,?,?)');

// Prepara e executa
$query = $db->pdo->prepare($query);


if (!$query) {

    return false;
}

$check_exec = $query->execute($data_array);
// Verifica se a consulta aconteceu

return (var_dump($check_exec));

