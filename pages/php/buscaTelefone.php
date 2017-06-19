<?php

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();


$telefone = $db->anti_injection($_GET['telefone']);
$ddd = $db->anti_injection($_GET['ddd']);
$loginEmpresa = $db->anti_injection($_GET['loginEmpresa']);
$cnpjEmpresa = $db->anti_injection($_GET['cnpjEmpresa']);
$dadosTamanho = $db->anti_injection(strlen($dadosBusca));
$pessoa = $db->anti_injection($_GET['pessoa']);

if ($ddd) {
    $whereDddPf = "AND tb_pessoa_fisica_fones.tb_pessoa_fisica_fones_ddd = ? ";
    $whereDddPj = "AND tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_ddd = ? ";
}

if ($pessoa == 'fisica') {

    $db_retorno = $db->query("SELECT tb_pessoa_fisica_cpf as doc,tb_pessoa_fisica_nome as nome,tb_pessoa_fisica_fones_ddd as ddd,tb_pessoa_fisica_fones_fone as fone,'pf' as tipo  
                                        FROM  tb_pessoa_fisica
                                        LEFT JOIN  tb_pessoa_fisica_fones 
                                        ON tb_pessoa_fisica.tb_pessoa_fisica_cpf = tb_pessoa_fisica_fones.tb_pessoa_fisica_fones_cpf
                                        WHERE tb_pessoa_fisica_fones.tb_pessoa_fisica_fones_fone LIKE  ? 
                                        $whereDddPf 
                                        ORDER BY    tb_pessoa_fisica_nome
                                        LIMIT 500", array($telefone . "%", $ddd));
} else if ($pessoa == 'juridica') {

    $db_retorno = $db->query("SELECT tb_pessoa_juridica_cnpj as doc,tb_pessoa_juridica_nome as nome,tb_pessoa_juridica_fones_ddd as ddd,tb_pessoa_juridica_fones_fone as fone,'pj' as tipo  
                                        FROM  tb_pessoa_juridica
                                        LEFT JOIN  tb_pessoa_juridica_fones 
                                        ON tb_pessoa_juridica.tb_pessoa_juridica_cnpj = tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_cnpj
                                        WHERE tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_fone LIKE ?
                                        $whereDddPj 
                                        ORDER BY    tb_pessoa_juridica_nome
                                        LIMIT 500", array($telefone . "%", $ddd));
} else {

    $db_retorno = $db->query("SELECT tb_pessoa_fisica_cpf as doc,tb_pessoa_fisica_nome as nome,tb_pessoa_fisica_fones_ddd as ddd,tb_pessoa_fisica_fones_fone as fone,'pf' as tipo  
                                        FROM  tb_pessoa_fisica
                                        LEFT JOIN  tb_pessoa_fisica_fones 
                                        ON tb_pessoa_fisica.tb_pessoa_fisica_cpf = tb_pessoa_fisica_fones.tb_pessoa_fisica_fones_cpf
                                        WHERE tb_pessoa_fisica_fones.tb_pessoa_fisica_fones_fone =  ? 
                                        $whereDddPf 
                                        LIMIT 4000
                                            
                                        UNION
                                        
                            SELECT tb_pessoa_juridica_cnpj as doc,tb_pessoa_juridica_nome as nome,tb_pessoa_juridica_fones_ddd as ddd,tb_pessoa_juridica_fones_fone as fone,'pj' as tipo  
                                        FROM  tb_pessoa_juridica
                                        LEFT JOIN  tb_pessoa_juridica_fones 
                                        ON tb_pessoa_juridica.tb_pessoa_juridica_cnpj = tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_cnpj
                                        WHERE tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_fone = ?
                                        $whereDddPj 
                                        LIMIT 4000

                                        ", array($telefone, $ddd, $telefone, $ddd));
}



if ($db_retorno != NULL) {
    // Obtém os dados da base de dados MySQL
    $fetch_user = $db_retorno->fetchAll();

// Configura o ID do usuário
    echo json_encode($fetch_user);
} else {
    echo json_encode('002'); //nenhum encontrado
}






