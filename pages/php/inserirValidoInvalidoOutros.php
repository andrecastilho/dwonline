<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 */

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

$tipo = $_GET['tipo'];
$info = $_GET['info'];
$user = $_GET['user'];

$data_array = array('', // idtb_utilizacao_sistema
    $db->anti_injection($tipo),
    $db->anti_injection($info),
    $db->anti_injection(date('d/m/Y')),
    $db->anti_injection($user)
);

$query = ('INSERT INTO `tb_retro_valido_invalido_outros`
            (`idtb_retro_valido_invalido_outros`,
            `tb_retro_valido_invalido_outros_tipo`,
            `tb_retro_valido_invalido_outros_info`,
            `tb_retro_valido_invalido_outros_data`,
            `tb_retro_valido_invalido_outros_user`)
             VALUES (?,?,?,?,?)');

// Prepara e executa
$query = $db->pdo->prepare($query);

if (!$query) {

    return false;
}

$check_exec = $query->execute($data_array);
// Verifica se a consulta aconteceu


return (var_dump($check_exec));


