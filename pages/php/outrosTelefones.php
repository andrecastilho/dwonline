<?php

require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();

$dadosBusca = $db->anti_injection($_GET['busca']);
$dadosTamanho = strlen($dadosBusca);

$buscaTelefonesPj = array();

switch ($dadosTamanho) {

    case $dadosTamanho == 11:

        $cpfPostados = ($dadosBusca);

        if ($cpfPostados != NULL) {

            //empresas do cpf 
            $buscaCnpjAsociado = "SELECT tb_pessoa_juridica_socio_cnpj_id from tb_pessoa_juridica_socio
                                where tb_pessoa_juridica_socio.tb_pessoa_juridica_socio_cpf_id  = '$cpfPostados'";
            $db_retorno = $db->query($buscaCnpjAsociado);
            $fetch_retornaCnpjSocios = $db_retorno->fetchAll();

            foreach ($fetch_retornaCnpjSocios as $key => $value) {

                //todos socios das empresas do cpf
                $sociosEmpresa = "SELECT tb_pessoa_juridica_socio_cpf_id as cpfSocios from tb_pessoa_juridica_socio
                                  where tb_pessoa_juridica_socio.tb_pessoa_juridica_socio_cnpj_id  = '" . $value['tb_pessoa_juridica_socio_cnpj_id'] . "'";
                $db_retornoTodosSociosDasEmpresas = $db->query($sociosEmpresa);
                $fetch_retornaCpfSociosEmpresa = $db_retornoTodosSociosDasEmpresas->fetchAll();

                foreach ($fetch_retornaCpfSociosEmpresa as $keyS => $valueS) {

                    if ($valueS['cpfSocios'] != $cpfPostados) {
                        $socios .= "'" . $valueS['cpfSocios'] . "',";
                        $empresas .="'" . $fetch_retornaCnpjSocios[$key]['tb_pessoa_juridica_socio_cnpj_id'] . "',";
                    }
                }
            }

            $empresasFind = substr($empresas, 0, -1);
            $empresasFind = str_replace('"', '', $empresasFind);

            $sociosFind = substr($socios, 0, -1);
            $sociosFind = str_replace('"', '', $sociosFind);


            $buscaTelefonesPj = "SELECT tb_pessoa_juridica_fones_ddd AS ddd,tb_pessoa_juridica_fones_fone as fone 
                                      FROM tb_pessoa_juridica_fones 
                                      WHERE tb_pessoa_juridica_fones_cnpj IN (" . $empresasFind . ")
                                        UNION
                                SELECT tb_pessoa_fisica_fones_ddd as ddd,tb_pessoa_fisica_fones_fone as fone 
                                      FROM tb_pessoa_fisica_fones 
                                      where tb_pessoa_fisica_fones_cpf IN (" . $sociosFind . ")
                                      -- ORDER BY tb_pessoa_fisica_fones_data";

            $db_retornoTels = $db->query($buscaTelefonesPj);
            $fetch_telefonesPj = $db_retornoTels->fetchAll();


            if ($fetch_telefonesPj != null) {

                $server = $_SERVER;
                $user['cnpjEmpresa'] = $cnpjEmpresa;
                $user['idtbVendedor'] = $idVendedor;
                $user['filtro'] = $filtro;


                echo json_encode($fetch_telefonesPj);
            }
        } else {
            return json_encode('002'); //nenhum encontrado
        }

        break;

    case $dadosTamanho == 14;


        $cnpjPostados = ($dadosBusca);

        if ($cnpjPostados != NULL) {

            //busca socios
            $filtro = "SELECT * FROM tb_pessoa_juridica_socio WHERE tb_pessoa_juridica_socio_cnpj_id = ('$cnpjPostados')";
            $db_retorno = $db->query($filtro);
            $fetch_user = $db_retorno->fetchAll();

            foreach ($fetch_user as $keyS => $valueS) {
                $socios .= "'" . $valueS['tb_pessoa_juridica_socio_cpf_id'] . "',";
            }

            $sociosFind = substr($socios, 0, -1);
            $sociosFind = str_replace('"', '', $sociosFind);

            $buscaTelefonesPj = "SELECT tb_pessoa_fisica_fones_ddd as ddd,tb_pessoa_fisica_fones_fone as fone 
                                      FROM tb_pessoa_fisica_fones 
                                      where tb_pessoa_fisica_fones_cpf IN (" . $sociosFind . ")";

            $db_retorno2 = $db->query($buscaTelefonesPj);
            $fetch_telefonesPj = $db_retorno2->fetchAll();

            echo json_encode($fetch_telefonesPj);
        } else {
            return json_encode('002'); //nenhum encontrado
        }
        break;
}

