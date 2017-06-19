<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '../../classes/class-TutsupDB.php';

require_once "./lib/nusoap.php";

// Create SOAP Server
$server = new soap_server();
$server->configureWSDL("Test_Service", "wsdl");

// Example "hello" function
function hello($username) {
    if ($username == 'admin') {
        return "Welcome back, Boss";
    } else {
        return "Hello, $username";
    }
}

$server->register("hello", array("username" => "xsd:string"), array("return" => "xsd:string"), "http://www.example.com", "", "", "", "say hi to the caller"
);

// Example "intCount" function (return array)
function intCount($from, $to) {
    $out = array();
    for ($i = $from; $i <= $to; $i++) {
        $out[] = $i;
    }
    return $out;
}

$server->wsdl->addComplexType(
        'intArray', 'complexType', 'array', '', 'SOAP-ENC:Array', array(), array(
    array(
        'ref' => 'SOAP-ENC:arrayType',
        'wsdl:arrayType' => 'xsd:integer[]'
    )
        ), 'xsd:integer'
);

$server->register("intCount", array("from" => "xsd:integer", "to" => "xsd:integer"), array("return" => "tns:intArray"), "http://www.example.com", "", "", "", "count from 'from' to 'to'"
);

// Example "getUserInfo" function (return struct and fault)
function getUserInfo($userId) {
    if ($userId == 1) {
        return array(
            'id' => 1,
            'username' => 'testuser',
            'email' => 'testuser@example.com'
        );
    } else {
        return new soap_fault('SOAP-ENV:Server', '', 'Requested user not found', '');
    }
}

$server->wsdl->addComplexType(
        'userInfo', 'complextType', 'struct', 'sequence', '', array(
    'id' => array('name' => 'id', 'type' => 'xsd:integer'),
    'username' => array('name' => 'username', 'type' => 'xsd:string'),
    'email' => array('name' => 'email', 'type' => 'xsd:string')
        )
);

$server->register("getUserInfo", array("userId" => "xsd:integer"), array("return" => "tns:userInfo"), "http://www.example.com", "", "", "", "get info for user"
);

function consulta($dados = array()) {

    //return $dados;
    
    if (isset($dados)) {

        $db = new TutsupDB();

// Verifica se o usuário existe
        $db_check_user = $db->query("SELECT * FROM tb_pessoa_juridica 
					left join tb_pessoa_juridica_end 
					ON tb_pessoa_juridica_end.tb_pessoa_juridica_end_cnpj = tb_pessoa_juridica.tb_pessoa_juridica_cnpj

					left join tb_pessoa_juridica_fones 
                                        ON tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_cnpj = tb_pessoa_juridica.tb_pessoa_juridica_cnpj

					left join tb_pessoa_juridica_situacao
					ON tb_pessoa_juridica_situacao.tb_pessoa_juridica_situacao_cnpj = tb_pessoa_juridica.tb_pessoa_juridica_cnpj

					left join tb_pessoa_juridica_socio
					ON tb_pessoa_juridica_socio.tb_pessoa_juridica_socio_cnpj_id = tb_pessoa_juridica.tb_pessoa_juridica_cnpj
                
					where tb_pessoa_juridica.tb_pessoa_juridica_cnpj = :cnpj", array(':cnpj' => $dados));

// Obtém os dados da base de dados MySQL
        $fetch_user = $db_check_user->fetchAll();

        //print_r($fetch_user);
// Configura o ID do usuário
        return json_encode($fetch_user);

        //return ($fetch_user);
    } else {
        return 'erro nao ';
    }
}

$server->wsdl->addComplexType(
        'consulta', 'complextType', 'struct', 'sequence', '', array(
    'idtb_pessoa_juridica' => array('name' => 'idtb_pessoa_juridica', 'type' => 'xsd:integer'),
    'tb_pessoa_juridica_cnpj' => array('name' => 'tb_pessoa_juridica_cnpj', 'type' => 'xsd:string'),
    'tb_pessoa_juridica_nome' => array('name' => 'tb_pessoa_juridica_nome', 'type' => 'xsd:string'),
    'tb_pessoa_juridica_fones_fone' => array('name' => 'tb_pessoa_juridica_fones_fone', 'type' => 'xsd:string')
        )
);

$server->register('consulta', array('parametros' => 'tns:arrConsulta'), array('return' => 'xsd:string'), 'urn:dataWeb', 'urn:dataWeb#consulta', 'rpc', 'encoded', '');



// Run service
$server->service(file_get_contents('php://input'));


