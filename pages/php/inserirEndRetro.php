<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 * 
 */



require_once '../../classes/class-TutsupDB.php';


$db = new TutsupDB();

$endCpfCnpjRetro = $_GET['cpfCnpfRetro'];
$endEnd = $_GET['end'];
$endNun = $_GET['num'];
$endComp = $_GET['compl'];
$endBairro = $_GET['bairro'];
$endCidade = $_GET['cidade'];
$endUf = $_GET['uf'];
$endCep = $_GET['cep'];
$user = $_GET['user'];


$data_array = array('', // idtb_utilizacao_sistema
    $db->anti_injection($endCpfCnpjRetro),
    $db->anti_injection($endEnd),
    $db->anti_injection($endNun),
    $db->anti_injection($endComp),
    $db->anti_injection($endBairro),
    $db->anti_injection($endCidade),
    $db->anti_injection($endUf),
    $db->anti_injection($endCep),
    $db->anti_injection(date('d/m/Y')),
    $db->anti_injection($user)
);

$query = ('INSERT INTO `tb_pessoa_fisica_end_retro`
(`idtb_pessoa_fisica_end`,
`tb_pessoa_fisica_end_cpf`,
`tb_pessoa_fisica_end_end`,
`tb_pessoa_fisica_end_num`,
`tb_pessoa_fisica_end_compl`,
`tb_pessoa_fisica_end_bairro`,
`tb_pessoa_fisica_end_cidade`,
`tb_pessoa_fisica_end_uf`,
`tb_pessoa_fisica_end_cep`,
`tb_pessoa_fisica_end_data`,
`tb_pessoa_fisica_end_retro_user`)
VALUES (?,?,?,?,?,?,?,?,?,?,?)');

// Prepara e executa
$query = $db->pdo->prepare($query);


if (!$query) {

    return false;
}

$check_exec = $query->execute($data_array);
// Verifica se a consulta aconteceu

return (var_dump($check_exec));

