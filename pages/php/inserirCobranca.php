<?php

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();


$idVendedor = $_GET['idtbVendedor'];
$cnpjEmpresa = $_GET['cnpjEmpresa'];
$filtro = $_GET['filtro'];
$server = $_SERVER;
$user['cnpjEmpresa'] = $cnpjEmpresa;
$user['idtbVendedor'] = $idVendedor;
$user['filtro'] = $filtro;

$db->utilizacaoSistema($server, $user);

