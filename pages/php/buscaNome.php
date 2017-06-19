
<?php

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

$nome = $db->anti_injection($_GET['nome']);
$loginEmpresa = $db->anti_injection($_GET['loginEmpresa']);
$cnpjEmpresa = $db->anti_injection($_GET['cnpjEmpresa']);
$idVendedor = $db->anti_injection($_GET['idtbVendedor']);
$pessoa = $db->anti_injection($_GET['pessoa']);
$nomeFantasia = $db->anti_injection($_GET['nomeFantasia']);

$server = array();
$user = array();

$expNome = explode(' ', $nome);

foreach ($expNome as $key => $value) {
    $nom .= $value . "%";
}

if ($nomeFantasia == 'nome') {
    $where = "WHERE tb_pessoa_juridica.tb_pessoa_juridica_nome LIKE ('$nom') LIMIT 200";
} else {
    $where = "WHERE tb_pessoa_juridica.tb_pessoa_juridica_fantasia LIKE ('$nom') LIMIT 200";
}

if ($pessoa == 'fisica') {


    $sql = "SELECT DISTINCT (tb_pessoa_fisica_cpf) as doc,tb_pessoa_fisica_nome as nome,'pf' as tipo,
                            tb_pessoa_fisica_end_cidade as cidade,
                            tb_pessoa_fisica_end_uf as uf
                            FROM tb_pessoa_fisica
                            LEFT JOIN  tb_pessoa_fisica_end
                            ON tb_pessoa_fisica.tb_pessoa_fisica_cpf = tb_pessoa_fisica_end.tb_pessoa_fisica_end_cpf
                            WHERE tb_pessoa_fisica.tb_pessoa_fisica_nome LIKE ('$nom') 
                            -- GROUP BY tb_pessoa_fisica_cpf
            LIMIT 200";

    $db_retorno = $db->query($sql);
} else {

    $sql = "SELECT tb_pessoa_juridica_cnpj as doc,tb_pessoa_juridica_nome as nome,'pj' as tipo,
                                  tb_pessoa_juridica_end_cidade as cidade,
                                  tb_pessoa_juridica_end_uf as uf

                                  FROM tb_pessoa_juridica
                                  LEFT JOIN tb_pessoa_juridica_end
                                  ON tb_pessoa_juridica.tb_pessoa_juridica_cnpj = tb_pessoa_juridica_end.tb_pessoa_juridica_end_cnpj
                                  $where";
    $db_retorno = $db->query($sql);
}



if ($db_retorno != NULL) {

    $fetch_user = $db_retorno->fetchAll();

// Configura o ID do usuário
    echo json_encode($fetch_user);
} else {
    echo json_encode('002'); //nenhum encontrado
}





