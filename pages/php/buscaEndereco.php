<?php

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();


$endereco = $db->anti_injection($_GET['endereco']);
$numero = $db->anti_injection($_GET['numero']);
$bairro = $db->anti_injection($_GET['bairro']);
$cidade = $db->anti_injection($_GET['cidade']);
$uf = $db->anti_injection($_GET['uf']);
$cep = $db->anti_injection($_GET['cep']);
$pessoa ='fisica';

//print_r($_GET);
//die(".");

$numero = str_replace("'", '', $numero);
$numero = explode(',', $numero);
$i = 0;

for ($i; $i < count($numero); $i++) {
    $numeros .= "'" . $numero[$i] . "',";
}

$numeros = substr($numeros, 0, -1);

if ($numero) {
    $whereNumeroPf = "AND ende.tb_pessoa_fisica_end_num  in ($numeros)";
    $whereNumeroPj = "AND ende.tb_pessoa_juridica_end_num in ($numeros)";
}

if ($bairro) {
    $bairroPf = "AND ende.tb_pessoa_fisica_end_bairro = ('$bairro')";
    $bairroPj = "AND ende.tb_pessoa_juridica_end_bairro = ('$bairro')";
}

if ($uf) {
    $ufPf = "AND ende.tb_pessoa_fisica_end_uf = ('$uf')";
    $ufPj = "AND ende.tb_pessoa_juridica_end_uf = ('$uf')";
}

if ($cidade) {
    $cidadePf = "AND ende.tb_pessoa_fisica_end_cidade = ('$cidade')";
    $cidadePj = "AND ende.tb_pessoa_juridica_end_bairro = ('$cidade')";
}

if ($cep) {
    $cepPf = "AND ende.tb_pessoa_fisica_end_cep = ('$cep')";
    $cepPj = "AND ende.tb_pessoa_juridica_end_cep = ('$cep')";
}

if ($endereco) {
    $enderecoPf = "ende.tb_pessoa_fisica_end_end LIKE  ('%$endereco%')";
    $enderecoPj = "ende.tb_pessoa_juridica_end_end LIKE ('%$endereco%')";
} else {

    $whereNumeroPf = "ende.tb_pessoa_fisica_end_num  in ($numeros)";
    $whereNumeroPj = "ende.tb_pessoa_juridica_end_num in ($numeros)";
}

if ($pessoa == 'fisica') {
    
    $db_retorno = $db->query("SELECT pf.tb_pessoa_fisica_cpf as doc,
									pf.tb_pessoa_fisica_nome as nome,'pf' as tipo,
                                  ende.tb_pessoa_fisica_end_end as endereco,
                                  ende.tb_pessoa_fisica_end_num as numero,tb_pessoa_fisica_end_bairro as bairro,
                                  ende.tb_pessoa_fisica_end_cidade as cidade,tb_pessoa_fisica_end_cep as cep
                                  
                                  FROM tb_pessoa_fisica as pf
                                  
                                  LEFT JOIN   tb_pessoa_fisica_end as ende
                                  ON ende.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                  
                                  WHERE $enderecoPf    
                                       $whereNumeroPf
                                       $cepPf
                                       $bairroPf
                                       $cidadePf
                                       ORDER BY tb_pessoa_fisica_nome 
                                  ");
} else if ($pessoa == 'juridica') {

    $db_retorno = $db->query("SELECT tb_pessoa_juridica_cnpj as doc,tb_pessoa_juridica_nome as nome,'pj' as tipo,
                                  tb_pessoa_juridica_end_end as endereco,tb_pessoa_juridica_end_num as numero,tb_pessoa_juridica_end_bairro as bairro,
                                  tb_pessoa_juridica_end_cidade as cidade,tb_pessoa_juridica_end_cep as cep
                                  FROM  tb_pessoa_juridica_end
                                  LEFT JOIN tb_pessoa_juridica
                                  ON tb_pessoa_juridica.tb_pessoa_juridica_cnpj = tb_pessoa_juridica_end.tb_pessoa_juridica_end_cnpj
                                  WHERE $enderecoPj
                                        $whereNumeroPj
                                        $cepPj
                                        $bairroPj
                                        $cidadePj
                                        ORDER BY tb_pessoa_juridica_nome
                                  ");
} else {


    $db_retorno = $db->query("SELECT tb_pessoa_fisica_cpf as doc,tb_pessoa_fisica_nome as nome,'pf' as tipo,
                                  tb_pessoa_fisica_end_end as endereco,tb_pessoa_fisica_end_num as numero,tb_pessoa_fisica_end_bairro as bairro,
                                  tb_pessoa_fisica_end_cidade as cidade,tb_pessoa_fisica_end_cep as cep
                                  FROM tb_pessoa_fisica_end 
                                  LEFT JOIN  tb_pessoa_fisica
                                  ON tb_pessoa_fisica.tb_pessoa_fisica_cpf = tb_pessoa_fisica_end.tb_pessoa_fisica_end_cpf
                                  WHERE $enderecoPf    
                                        $whereNumeroPf
                                        $cepPf
                                        $bairroPf
                                        $cidadePf
                                    LIMIT 500
                                      UNION
                                SELECT tb_pessoa_juridica_cnpj as doc,tb_pessoa_juridica_nome as nome,'pj' as tipo,
                                      tb_pessoa_juridica_end_end as endereco,tb_pessoa_juridica_end_num as numero,tb_pessoa_juridica_end_bairro as bairro,
                                      tb_pessoa_juridica_end_cidade as cidade,tb_pessoa_juridica_end_cep as cep
                                      FROM tb_pessoa_juridica_end
                                      LEFT JOIN tb_pessoa_juridica 
                                      ON tb_pessoa_juridica.tb_pessoa_juridica_cnpj = tb_pessoa_juridica_end.tb_pessoa_juridica_end_cnpj
                                      WHERE $enderecoPj
                                            $whereNumeroPj
                                            $cepPj
                                            $bairroPj
                                            $cidadePj
                                                
                                      LIMIT 500                                    
                                  ");
}





if ($db_retorno != NULL) {
    $fetch_user = $db_retorno->fetchAll();
    echo json_encode($fetch_user);
} else {
    echo json_encode('002'); //nenhum encontrado
}






