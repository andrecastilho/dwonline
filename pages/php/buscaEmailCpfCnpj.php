<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
 * 
 */


require_once '../../classes/class-TutsupDB.php';


$db = new TutsupDB();


$email = $db->anti_injection($_GET['cpfCnpj']);
$dadosTamanho = strlen($email);
$idVendedor = $db->anti_injection($_GET['idtbVendedor']);


switch ($dadosTamanho) {

    case $dadosTamanho == 11:

        if ($email != NULL) {

            $filtro = "SELECT * FROM tb_pessoa_fisica_email WHERE tb_pessoa_fisica_email_cpf = '$email'";

            $db_retorno = $db->query($filtro);
        } else {
            return json_encode('002'); //nenhum encontrado
        }


// Obtém os dados da base de dados MySQL
        $fetch_user = $db_retorno->fetchAll();


        if ($fetch_user != null) {

            $server = $_SERVER;
            $user['cnpjEmpresa'] = $cnpjEmpresa;
            $user['idtbVendedor'] = $idVendedor;
            $user['filtro'] = $filtro;

            $db->utilizacaoSistema($server, $user, '1');
// Configura o ID do usuário
            echo json_encode($fetch_user);
        }
        break;
}

