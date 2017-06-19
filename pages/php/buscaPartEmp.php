<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 * 
 */


require_once '../../classes/class-TutsupDB.php';


$db = new TutsupDB();


$dadosBusca = $db->anti_injection($_GET['busca']);
$dadosTamanho = strlen($dadosBusca);
$idVendedor = $db->anti_injection($_GET['idtbVendedor']);



switch ($dadosTamanho) {

    case $dadosTamanho == 11:

        $cpfPostados = ($dadosBusca);

        if ($cpfPostados != NULL) {

            $filtro = "SELECT  *,tb_pessoa_juridica_nome AS nomeEmpresa FROM  tb_pessoa_juridica
                        LEFT JOIN tb_pessoa_juridica_socio
                        ON tb_pessoa_juridica.tb_pessoa_juridica_cnpj = tb_pessoa_juridica_socio_cnpj_id
                        WHERE tb_pessoa_juridica_socio_cpf_id  = '$cpfPostados' 
                        ORDER BY idtb_pessoa_juridica";

            $db_retorno = $db->query($filtro);
        } else {
            return json_encode('002'); //nenhum encontrado
        }

        $db_retorno = $db->query($filtro);

        $fetch_user = $db_retorno->fetchAll();

        if ($fetch_user != null) {

            $server = $_SERVER;
            $user['cnpjEmpresa'] = $cnpjEmpresa;
            $user['idtbVendedor'] = $idVendedor;
            $user['filtro'] = $filtro;

            $db->utilizacaoSistema($server, $user, '1');

            echo json_encode($fetch_user);
        }

        break;

    case $dadosTamanho == 14;

        $cnpjPostados = ($dadosBusca);

        if ($cnpjPostados != NULL) {

            $filtro = "SELECT *,tb_pessoa_fisica_nome AS nomeSocio,
                                (select count(tb_pessoa_juridica_socio.tb_pessoa_juridica_socio_cnpj_id)
                                 from tb_pessoa_juridica_socio 
                                 where tb_pessoa_juridica_socio_cnpj_id = '$cnpjPostados') as qtdProprietarios
                
                        FROM tb_pessoa_juridica_socio

                        LEFT JOIN tb_pessoa_fisica
                        ON tb_pessoa_fisica.tb_pessoa_fisica_cpf = tb_pessoa_juridica_socio_cpf_id
                        WHERE tb_pessoa_juridica_socio_cnpj_id = '$cnpjPostados'";


            $db_retorno = $db->query($filtro);

            $fetch_user = $db_retorno->fetchAll();

            if ($fetch_user != null) {

                $server = $_SERVER;
                $user['cnpjEmpresa'] = $cnpjEmpresa;
                $user['idtbVendedor'] = $idVendedor;
                $user['filtro'] = $filtro;

                $db->utilizacaoSistema($server, $user, '1');

                echo json_encode($fetch_user);
            }
        } else {
            return json_encode('002'); //nenhum encontrado
        }
// Obtém os dados da base de dados MySQL
}