<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

 

require_once './crud.class.php';
require_once '../classes/class-TutsupDB.php';


$conect = new TutsupDB();
//$conect->connect();

   



$crud = new Crud();
$crud->listar('tb_pessoa_fisica'); // para exibir uma tabela com todos os dados.


//mysql_close($conecta);
