<?php

require '../../config/conexao.class.php.php';

$conect = new conexao();
$mysqli = $conect->conecta();

//$cnpj = preg_replace(".", '', $_GET['cnpj']);
$cnpj = $_GET['cnpj'];


$query = "INSERT INTO  tb_usuario "."(null,'".$cnpj."');";









