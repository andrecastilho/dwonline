<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '../../classes/class-TutsupDB.php';
require_once "./lib/nusoap.php";
require_once '../../classes/class-controleCustos.php';


$server = new soap_server();
$server->debug_flag = true;
$server->configureWSDL('dataWeb', 'WSDL');
$server->wsdl->schemaTargetNameSpace = 'urn:dataWeb';

//----------------------------------//

function consultaCnpj($dados = array()) {


//return json_encode('1');
    $naoEncontrado['err'] = 'Não encontrado';

    $db = new TutsupDB();
    $controleCustos = new controleCustos();

    $cnpjEmpresa = $dados['cnpjEmpresa'];
    $semSaldo = $controleCustos->debitarDw($cnpjEmpresa, 'webservice');


    if ($semSaldo == '003') {
        return json_encode('003'); // sem saldo
    }

    $db_retorno_cod_empresa = $db->query('SELECT * FROM tb_empresa where tb_empresa.tb_empresa_codigo_web_service  in ("' . $dados['login'] . '") '
            . 'and tb_empresa.tb_empresa_cnpj in (' . $dados['cnpjEmpresa'] . ') ');
    // Obtém os dados da base de dados MySQL
    $fetch_empresa_web_service = $db_retorno_cod_empresa->fetchAll();


    if (!$fetch_empresa_web_service) {
        return json_encode('001'); // autenticação falhou
    }

    //criar classe
    foreach ($dados as $key => $value) {

        if ($key != "login" && $key != "cnpjEmpresa") {

            $db_test_cnpj = $db->query('SELECT tb_pessoa_juridica_cnpj FROM tb_pessoa_juridica where tb_pessoa_juridica.tb_pessoa_juridica_cnpj   in ("' . $value . '")');
            // Obtém os dados da base de dados MySQL
            $fetch_teste_cnpj = $db_test_cnpj->fetchAll();

            //return json_encode($fetch_teste_cnpj); //nenhum encontrado

            if (!$fetch_teste_cnpj) {

                $naoEncontrado[$key] = $value;
            } else {

                $return [] = $value . ",";
            }
        }
    }

    $cnpjPostados = implode($return);
    $cnpjPostados = substr($cnpjPostados, 0, -1);
    $cnpjPostados = str_replace('"', '', $cnpjPostados);


    if ($cnpjPostados != NULL) {

        $filtro = "SELECT * FROM tb_pessoa_juridica 
                
					left join tb_pessoa_juridica_end 
					ON tb_pessoa_juridica_end.tb_pessoa_juridica_end_cnpj = tb_pessoa_juridica.tb_pessoa_juridica_cnpj

					left join tb_pessoa_juridica_fones 
                                        ON tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_cnpj = tb_pessoa_juridica.tb_pessoa_juridica_cnpj

					left join tb_pessoa_juridica_situacao
					ON tb_pessoa_juridica_situacao.tb_pessoa_juridica_situacao_cnpj = tb_pessoa_juridica.tb_pessoa_juridica_cnpj

					left join tb_pessoa_juridica_socio
					ON tb_pessoa_juridica_socio.tb_pessoa_juridica_socio_cnpj_id = tb_pessoa_juridica.tb_pessoa_juridica_cnpj
                                        
                                        left join tb_cnae_nivel_sete 
					ON tb_pessoa_juridica.tb_pessoa_juridica_cnae = tb_cnae_id_cnae
                                        
                                        left join tb_natureza
					ON tb_pessoa_juridica.tb_pessoa_juridica_id_natureza = tb_natureza.tb_natureza_id
                
                
					where tb_pessoa_juridica.tb_pessoa_juridica_cnpj in ('$cnpjPostados')
                                        order by tb_pessoa_juridica_end.tb_pessoa_juridica_end_data DESC,
                                        tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_data DESC";

        $db_retorno = $db->query($filtro);
    } else {
        return json_encode('002'); //nenhum encontrado
    }
// Obtém os dados da base de dados MySQL
    $fetch_user = $db_retorno->fetchAll();

    array_push($fetch_user, $naoEncontrado);

    if ($fetch_user != null) {

        $sqlInsertUtilizacaoSistema = "INSERT INTO tb_utilizacao_sistema
                    ( idtb_utilizacao_sistema ,
                     tb_utilizacao_sistema_empresa_user ,
                     tb_utilizacao_sistema_idtb_user,
                     tb_utilizacao_sistema_session_user ,
                     tb_utilizacao_sistema_ip_user ,
                     tb_utilizacao_sistema_busca ,
                     tb_utilizacao_sistema_filtro ,
                     tb_utilizacao_sistema_data_hora ,
                     tb_utilizacao_sistema_HTTP_COOKIE ,
                     tb_utilizacao_sistema_SCRIPT_FILENAME ,
                     tb_utilizacao_sistema_REQUEST_METHOD,
                     tb_utilizacao_sistema_HTTP_USER_AGENT,
                     tb_utilizacao_sistema_retorno_ok)
                    VALUES (''," . $dados['cnpjEmpresa'] . ",'','','',$cnpjPostados,'Webservice'," . time() . ",'','','','','')";

        $db_retornoInsert = $db->pdo->exec($sqlInsertUtilizacaoSistema);

        if (!$db_retornoInsert) {
            return '000';
        }
    }

    return json_encode($fetch_user);
}

$server->wsdl->addComplexType(
        'arrConsultaCnpj', 'complextType', 'struct', 'sequence', '', array(
    'login' => array('name' => 'login', 'type' => 'xsd:string'),
    'cnpjEmpresa' => array('name' => 'cnpjEmpresa', 'type' => 'xsd:string'),
    'cnpj' => array('name' => 'cnpj', 'type' => 'xsd:string')
        )
);




$server->register('consultaCnpj', array('parametros' => 'tns:arrConsultaCnpj'), array('return' => 'xsd:string'), 'urn:dataWeb', 'urn:dataWeb#consultaCnpj', 'rpc', 'encoded', '');

//----------------------------------//

function consultaCpf($dados) {

    $naoEncontrado['err'] = 'Não encontrado';



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

        //criar classe
        foreach ($dados as $key => $value) {

            if ($key != "login" && $key != "cnpjEmpresa") {



                $db_cpf = $db->query('SELECT tb_pessoa_fisica_cpf FROM tb_pessoa_fisica where tb_pessoa_fisica.tb_pessoa_fisica_cpf   in ("' . $value . '")');
                // Obtém os dados da base de dados MySQL
                $fetch_cpf = $db_cpf->fetchAll();

                //return json_encode($fetch_teste_cnpj); //nenhum encontrado

                if (!$fetch_cpf) {

                    $naoEncontrado[$key] = $value;
                } else {

                    $return [] = $value . ",";
                }
            }
        }

        $cpfPostados = implode($return);
        $cpfPostados = substr($cpfPostados, 0, -1);
        $cpfPostados = str_replace('"', '', $cpfPostados);


        if ($cpfPostados != NULL) {

            $filtro = 'SELECT * FROM tb_pessoa_fisica 
					left join tb_pessoa_fisica_end 
					ON tb_pessoa_fisica_end.tb_pessoa_fisica_end_cpf = tb_pessoa_fisica.tb_pessoa_fisica_cpf

					left join tb_pessoa_fisica_fones 
                                        ON tb_pessoa_fisica_fones.tb_pessoa_fisica_fones_cpf = tb_pessoa_fisica.tb_pessoa_fisica_cpf

					left join tb_pessoa_fisica_email
					ON tb_pessoa_fisica_email.tb_pessoa_fisica_email_cpf = tb_pessoa_fisica.tb_pessoa_fisica_cpf
                
					where tb_pessoa_fisica.tb_pessoa_fisica_cpf  in ("' . $cpfPostados . '")';

            //return json_encode($cpfPostados); 

            $db_retorno = $db->query($filtro);
        } else {
            return json_encode('002'); //nenhum encontrado
        }


// Obtém os dados da base de dados MySQL
        $fetch_user = $db_retorno->fetchAll();
        array_push($fetch_user, $naoEncontrado);

        if ($fetch_user != null) {

            $sqlInsertUtilizacaoSistema = "INSERT INTO tb_utilizacao_sistema
                    ( idtb_utilizacao_sistema ,
                     tb_utilizacao_sistema_empresa_user ,
                     tb_utilizacao_sistema_idtb_user,
                     tb_utilizacao_sistema_session_user ,
                     tb_utilizacao_sistema_ip_user ,
                     tb_utilizacao_sistema_busca ,
                     tb_utilizacao_sistema_filtro ,
                     tb_utilizacao_sistema_data_hora ,
                     tb_utilizacao_sistema_HTTP_COOKIE ,
                     tb_utilizacao_sistema_SCRIPT_FILENAME ,
                     tb_utilizacao_sistema_REQUEST_METHOD,
                     tb_utilizacao_sistema_HTTP_USER_AGENT,
                     tb_utilizacao_sistema_retorno_ok)
                    VALUES (''," . $dados['cnpjEmpresa'] . ",'','','',$cpfPostados,'Webservice'," . time() . ",'','','','','')";

            $db_retornoInsert = $db->pdo->exec($sqlInsertUtilizacaoSistema);

            if (!$db_retornoInsert) {
                return '000';
            }
        }


        return json_encode($fetch_user);
    } else {
        return json_encode('003');
    }
}

$server->wsdl->addComplexType(
        'arrConsultaCpf', 'complextType', 'struct', 'sequence', '', array(
    'login' => array('name' => 'login', 'type' => 'xsd:string'),
    'cnpjEmpresa' => array('name' => 'cnpjEmpresa', 'type' => 'xsd:string'),
    'cpf' => array('name' => 'cpf', 'type' => 'xsd:string')
        )
);

$server->register('consultaCpf', array('parametros' => 'tns:arrConsultaCpf'), array('return' => 'xsd:string'), 'urn:dataWeb', 'urn:dataWeb#consultaCnpj', 'rpc', 'encoded', '');

//----------------------------------//

function consultaTelefone($dados) {

    //return json_encode($dados); //nenhum encontrado 


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

        $telefone = $dados['telefone'];
        $ddd = $dados['ddd'];

        if ($ddd) {
            $whereDddPf = "AND tb_pessoa_fisica_fones.tb_pessoa_fisica_fones_ddd = '$ddd'";
            $whereDddPj = "AND tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_ddd = '$ddd'";
        }
        $filtro = "SELECT tb_pessoa_fisica_cpf as doc,tb_pessoa_fisica_nome as nome,tb_pessoa_fisica_fones_ddd as ddd,tb_pessoa_fisica_fones_fone as fone,'pf' as tipo  
                                  FROM  tb_pessoa_fisica
                                  LEFT JOIN  tb_pessoa_fisica_fones 
                                  ON tb_pessoa_fisica.tb_pessoa_fisica_cpf = tb_pessoa_fisica_fones.tb_pessoa_fisica_fones_cpf
                                  WHERE tb_pessoa_fisica_fones.tb_pessoa_fisica_fones_fone LIKE  ('%$telefone%')
                                  $whereDddPf
                                  LIMIT 20
                                      UNION
                                  SELECT tb_pessoa_juridica_cnpj as doc,tb_pessoa_juridica_nome as nome,tb_pessoa_juridica_fones_ddd as ddd,tb_pessoa_juridica_fones_fone as fone,'pj' as tipo  
                                  FROM  tb_pessoa_juridica
                                  LEFT JOIN  tb_pessoa_juridica_fones 
                                  ON tb_pessoa_juridica.tb_pessoa_juridica_cnpj = tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_cnpj
                                  WHERE tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_fone LIKE ('%$telefone%')" .
                $whereDddPj .
                "LIMIT 20";

        $db_retorno = $db->query($filtro);

        if ($db_retorno != NULL) {
            // Obtém os dados da base de dados MySQL
            $fetch_user = $db_retorno->fetchAll();


// Configura o ID do usuário
            return json_encode($fetch_user);
        } else {
            return json_encode('002'); //nenhum encontrado
        }




//return ($fetch_user);
    } else {
        return '003';
    }
}

$server->wsdl->addComplexType(
        'arrConsultaTelefone', 'complextType', 'struct', 'sequence', '', array(
    'login' => array('name' => 'login', 'type' => 'xsd:string'),
    'cnpjEmpresa' => array('name' => 'cnpjEmpresa', 'type' => 'xsd:string'),
    'telefone' => array('name' => 'telefone', 'type' => 'xsd:string'),
    'ddd' => array('name' => 'ddd', 'type' => 'xsd:string')
        )
);

$server->register('consultaTelefone', array('parametros' => 'tns:arrConsultaTelefone'), array('return' => 'xsd:string'), 'urn:dataWeb', 'urn:dataWeb#consultaTelefone', 'rpc', 'encoded', '');

//----------------------------------//

function consultaNome($dados) {




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

        $nome = $dados['nome'];

        $filtro = "SELECT tb_pessoa_fisica_cpf as doc,tb_pessoa_fisica_nome as nome,'pf' as tipo,
                                    tb_pessoa_fisica_end_cidade as cidade,
                                    tb_pessoa_fisica_end_uf as uf
                                  FROM tb_pessoa_fisica
                                  LEFT JOIN  tb_pessoa_fisica_end 
                                  ON tb_pessoa_fisica.tb_pessoa_fisica_cpf = tb_pessoa_fisica_end.tb_pessoa_fisica_end_cpf
                                  WHERE tb_pessoa_fisica.tb_pessoa_fisica_nome LIKE  ('%$nome%')
                                  LIMIT 20
                                  UNION
                                  SELECT tb_pessoa_juridica_cnpj as doc,tb_pessoa_juridica_nome as nome,'pj' as tipo,
                                    tb_pessoa_juridica_end_cidade as cidade,
                                    tb_pessoa_juridica_end_uf as uf

                                  FROM tb_pessoa_juridica
                                  LEFT JOIN tb_pessoa_juridica_end
                                  ON tb_pessoa_juridica.tb_pessoa_juridica_cnpj = tb_pessoa_juridica_end.tb_pessoa_juridica_end_cnpj
                                  WHERE tb_pessoa_juridica.tb_pessoa_juridica_nome LIKE ('%$nome%')
                                  LIMIT 20 ";

        $db_retorno = $db->query($filtro);

        if ($db_retorno != NULL) {
            // Obtém os dados da base de dados MySQL
            $fetch_user = $db_retorno->fetchAll();

// Configura o ID do usuário
            return json_encode($fetch_user);
        } else {
            return json_encode('002'); //nenhum encontrado
        }

//return ($fetch_user);
    } else {
        return '003';
    }
}

$server->wsdl->addComplexType(
        'arrConsultaNome', 'complextType', 'struct', 'sequence', '', array(
    'login' => array('name' => 'login', 'type' => 'xsd:string'),
    'cnpjEmpresa' => array('name' => 'cnpjEmpresa', 'type' => 'xsd:string'),
    'nome' => array('name' => 'nome', 'type' => 'xsd:string')
        )
);

$server->register('consultaNome', array('parametros' => 'tns:arrConsultaNome'), array('return' => 'xsd:string'), 'urn:dataWeb', 'urn:dataWeb#consultaNome', 'rpc', 'encoded', '');

//----------------------------------//

function consultaEndereco($dados) {



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

        $endereco = $dados['endereco'];
        $numero = $dados['numero'];
        $bairro = $dados['bairro'];
        $cidade = $dados['cidade'];
        $uf = $dados['uf'];
        $cep = $dados['cep'];

        if ($numero) {
            $whereNumeroPf = "AND tb_pessoa_fisica_end.tb_pessoa_fisica_end_num  like ('$numero')";
            $whereNumeroPj = "AND tb_pessoa_juridica_end.tb_pessoa_juridica_end_num like ('$numero')";
        }

        $filtro = "SELECT tb_pessoa_fisica_cpf as doc,tb_pessoa_fisica_nome as nome,'pf' as tipo,
                                  tb_pessoa_fisica_end_end as endereco,tb_pessoa_fisica_end_num as numero,tb_pessoa_fisica_end_bairro as bairro,
                                  tb_pessoa_fisica_end_cidade as cidade,tb_pessoa_fisica_end_cep as cep
                                  FROM tb_pessoa_fisica
                                  LEFT JOIN  tb_pessoa_fisica_end 
                                  ON tb_pessoa_fisica.tb_pessoa_fisica_cpf = tb_pessoa_fisica_end.tb_pessoa_fisica_end_cpf
                                  WHERE tb_pessoa_fisica_end.tb_pessoa_fisica_end_end LIKE  ('%$endereco%')                                  
				  AND tb_pessoa_fisica_end.tb_pessoa_fisica_end_bairro LIKE ('%$bairro%')
                                      AND tb_pessoa_fisica_end.tb_pessoa_fisica_end_uf LIKE ('%$uf%')
                                  $whereNumeroPf
                                  AND tb_pessoa_fisica_end.tb_pessoa_fisica_end_cidade LIKE ('%$cidade%')
                                  AND tb_pessoa_fisica_end.tb_pessoa_fisica_end_cep LIKE ('%$cep%')
                                  LIMIT 20
                                      UNION
                                  SELECT tb_pessoa_juridica_cnpj as doc,tb_pessoa_juridica_nome as nome,'pj' as tipo,
                                  tb_pessoa_juridica_end_end as endereco,tb_pessoa_juridica_end_num as numero,tb_pessoa_juridica_end_bairro as bairro,
                                  tb_pessoa_juridica_end_cidade as cidade,tb_pessoa_juridica_end_cep as cep
                                  FROM tb_pessoa_juridica 
                                  LEFT JOIN tb_pessoa_juridica_end
                                  ON tb_pessoa_juridica.tb_pessoa_juridica_cnpj = tb_pessoa_juridica_end.tb_pessoa_juridica_end_cnpj
                                  WHERE tb_pessoa_juridica_end.tb_pessoa_juridica_end_end LIKE ('%$endereco%')
                                  AND tb_pessoa_juridica_end.tb_pessoa_juridica_end_bairro LIKE ('%$bairro%')
                                  AND tb_pessoa_juridica_end.tb_pessoa_juridica_end_uf LIKE ('%$uf%')                                      
                                  AND tb_pessoa_juridica_end.tb_pessoa_juridica_end_cep LIKE ('%$cep%')
                                  $whereNumeroPj
                                  AND tb_pessoa_juridica_end.tb_pessoa_juridica_end_bairro LIKE ('%$cidade%')"
                . "LIMIT 20";

        $db_retorno = $db->query($filtro);

        if ($db_retorno != NULL) {


            // Obtém os dados da base de dados MySQL
            $fetch_user = $db_retorno->fetchAll();


// Configura o ID do usuário
            return json_encode($fetch_user);
        } else {
            return json_encode('002'); //nenhum encontrado
        }

//return ($fetch_user);
    } else {
        return '003';
    }
}

$server->wsdl->addComplexType(
        'arrConsultaEndereco', 'complextType', 'struct', 'sequence', '', array(
    'login' => array('name' => 'login', 'type' => 'xsd:string'),
    'cnpjEmpresa' => array('name' => 'cnpjEmpresa', 'type' => 'xsd:string'),
    'endereco' => array('name' => 'endereco', 'type' => 'xsd:string'),
    'numero' => array('name' => 'numero', 'type' => 'xsd:string'),
    'bairro' => array('name' => 'bairro', 'type' => 'xsd:string'),
    'cidade' => array('name' => 'cidade', 'type' => 'xsd:string'),
    'uf' => array('name' => 'uf', 'type' => 'xsd:string'),
    'cep' => array('name' => 'cep', 'type' => 'xsd:string'),
        )
);

$server->register('consultaEndereco', array('parametros' => 'tns:arrConsultaEndereco'), array('return' => 'xsd:string'), 'urn:dataWeb', 'urn:dataWeb#consultaEndereco', 'rpc', 'encoded', '');

//--------------------------------------------//



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

        $filtro = "SELECT * FROM tb_cnfnew where tb_cnfnew_cpf = '$cnf'";
        $db_retorno = $db->query($filtro);
        $result = $db_retorno->fetchAll();

        if ($result) {

            $sqlInsertUtilizacaoSistema = "INSERT INTO tb_utilizacao_sistema
                    ( idtb_utilizacao_sistema ,
                     tb_utilizacao_sistema_empresa_user ,
                     tb_utilizacao_sistema_idtb_user,
                     tb_utilizacao_sistema_session_user ,
                     tb_utilizacao_sistema_ip_user ,
                     tb_utilizacao_sistema_busca ,
                     tb_utilizacao_sistema_filtro ,
                     tb_utilizacao_sistema_data_hora ,
                     tb_utilizacao_sistema_HTTP_COOKIE ,
                     tb_utilizacao_sistema_SCRIPT_FILENAME ,
                     tb_utilizacao_sistema_REQUEST_METHOD,
                     tb_utilizacao_sistema_HTTP_USER_AGENT,
                     tb_utilizacao_sistema_retorno_ok)
                    VALUES (''," . $dados['cnpjEmpresa'] . ",'','','',$cnf,'Webservice'," . time() . ",'','','','','')";

            $db_retornoInsert = $db->pdo->exec($sqlInsertUtilizacaoSistema);

            return json_encode($result);
        } else {
            return json_encode('002'); //nenhum encontrado
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



