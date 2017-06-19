<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 * 
 */

require_once '../../classes/class-TutsupDB.php';
require_once "./lib/nusoap.php";

$server = new soap_server();
$server->debug_flag = true;
$server->configureWSDL('dataWeb', 'WSDL');
$server->wsdl->schemaTargetNameSpace = 'urn:dataWeb';

//----------------------------------//




function consultaCnf($dados) {

    $parametros = array();
    $db = new TutsupDB();

    $qtdMaxRegistros = "SELECT tb_empresa_qtd_max_registros,tb_empresa_permite_excedente,tb_empresa_qtd_contratada FROM tb_empresa where tb_empresa_cnpj = '" . $dados['cnpjEmpresa'] . "'";
    $db_retornoMR = $db->query($qtdMaxRegistros);
    $fetch_userMR = $db_retornoMR->fetchAll();


    if ((($fetch_userMR[0]['tb_empresa_qtd_contratada'] - ($fetch_userMR[0]['tb_empresa_qtd_max_registros'])) >= 1) || $fetch_userMR[0]['tb_empresa_permite_excedente'] == 'on') {


        $db_retorno_cod_empresa = $db->query('SELECT * FROM tb_empresa where tb_empresa.tb_empresa_codigo_web_service  in (' . $dados['login'] . ') '
                . 'and tb_empresa.tb_empresa_cnpj in (' . $dados['cnpjEmpresa'] . ') ');
        // Obtém os dados da base de dados MySQL
        $fetch_empresa_web_service = $db_retorno_cod_empresa->fetchAll();

        if (!$fetch_empresa_web_service) {
            return json_encode('001'); // autenticação falhou
        }

        $cnf = $dados['cpf'];

        $filtro = "SELECT * FROM tb_cnf where tb_cnf_cpf = '$cnf'";
        $db_retorno = $db->query($filtro);

        $result = $db_retorno->fetchAll();

        if ($result) {

            $idVendedor = 'WebService';
            $cnpjEmpresa = $dados['cnpjEmpresa'];
            $server = $_SERVER;
            $user['cnpjEmpresa'] = $cnpjEmpresa;
            $user['idtbVendedor'] = $idVendedor;
            $user['filtro'] = $filtro;
            $retornoOk = 1;

            $utilizacao = $db->utilizacaoSistema($server, $user, $retornoOk);

            return json_encode(true);
        } else {

            $idVendedor = 'WebService';
            $cnpjEmpresa = $dados['cnpjEmpresa'];
            $server = $_SERVER;
            $user['cnpjEmpresa'] = $cnpjEmpresa;
            $user['idtbVendedor'] = $idVendedor;
            $user['filtro'] = $filtro;
            $retornoOk = 1;

            $utilizacao = $db->utilizacaoSistema($server, $user, $retornoOk);

            return json_encode(false); //nenhum encontrado
        }
    } else {
        return json_encode('003'); //sem saldo 
    }
}

$server->wsdl->addComplexType(
        'arrConsultaCnf', 'complextType', 'struct', 'sequence', '', array(
    'login' => array('name' => 'login', 'type' => 'xsd:string'),
    'cnpjEmpresa' => array('name' => 'cnpjEmpresa', 'type' => 'xsd:string'),
    'cpf' => array('name' => 'cpf', 'type' => 'xsd:string')
        )
);


$server->register('consultaCnf', array('parametros' => 'tns:arrConsultaCnf'), array('return' => 'xsd:string'), 'urn:dataWeb', 'urn:dataWeb#consultaCnf', 'rpc', 'encoded', '');



$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);



