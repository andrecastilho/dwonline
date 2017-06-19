<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

$endCpfCnpjRetro = $_GET['cpfCnpjRetro'];
$email = $_GET['email'];
$user = $_GET['user'];

$data_array = array('', // idtb_utilizacao_sistema
    $db->anti_injection($endCpfCnpjRetro),
    $db->anti_injection($email),
    $db->anti_injection(date('d/m/Y')),
    $db->anti_injection($user)
);

$query = ('INSERT INTO `dataWebProducao`.`tb_pessoa_fisica_email_retro`
            (`idtb_pessoa_fisica_email`,
            `tb_pessoa_fisica_email_cpf`,
            `tb_pessoa_fisica_email_email`,
            `tb_pessoa_fisica_email_data`,
            `tb_pessoa_fisica_email_retro_user`)
            VALUES (?,?,?,?,?)');

// Prepara e executa
$query = $db->pdo->prepare($query);


if (!$query) {

    return false;
}

$check_exec = $query->execute($data_array);
// Verifica se a consulta aconteceu

return (var_dump($check_exec));

