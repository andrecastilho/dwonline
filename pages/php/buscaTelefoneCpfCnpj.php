<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
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

            $filtro = "SELECT * 
                                        FROM tb_pessoa_fisica_fones 
                                                        
					where tb_pessoa_fisica.tb_pessoa_fisica_cpf  = '$cpfPostados'
                                        GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                        
                                        ORDER BY tb_pessoa_fisica_end.idtb_pessoa_fisica_fones DESC  ";

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

    case $dadosTamanho == 14;


        $cnpjPostados = ($dadosBusca);

        if ($cnpjPostados != NULL) {

            $filtro = "SELECT *,
                    
                                (select count(tb_pessoa_juridica_socio.tb_pessoa_juridica_socio_cnpj_id)
                                 from tb_pessoa_juridica_socio 
                                 where tb_pessoa_juridica_socio_cnpj_id = '$cnpjPostados') as qtdProprietarios
                                    
                                        FROM tb_pessoa_juridica 
                
					left join tb_pessoa_juridica_end 
					ON tb_pessoa_juridica_end.tb_pessoa_juridica_end_cnpj = tb_pessoa_juridica.tb_pessoa_juridica_cnpj

					left join tb_pessoa_juridica_fones 
                                        ON tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_cnpj = tb_pessoa_juridica.tb_pessoa_juridica_cnpj

					left join tb_pessoa_juridica_situacao
					ON tb_pessoa_juridica_situacao.tb_pessoa_juridica_situacao_cnpj = tb_pessoa_juridica.tb_pessoa_juridica_cnpj

					-- left join tb_pessoa_juridica_socio
					-- ON tb_pessoa_juridica_socio.tb_pessoa_juridica_socio_cnpj_id = tb_pessoa_juridica.tb_pessoa_juridica_cnpj
                                        
                                        left join tb_cnae_nivel_sete as tb_cnae
					ON tb_pessoa_juridica.tb_pessoa_juridica_cnae = tb_cnae_id_cnae
                                        
                                        left join tb_natureza
					ON tb_pessoa_juridica.tb_pessoa_juridica_id_natureza = tb_natureza.tb_natureza_id
                
                
					where tb_pessoa_juridica.tb_pessoa_juridica_cnpj = ('$cnpjPostados')
                                        -- GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                                        ORDER BY tb_pessoa_juridica_end.idtb_pessoa_juridica_end ,
                                        tb_pessoa_juridica_end.tb_pessoa_juridica_end_data ,
                                        tb_pessoa_juridica_fones.tb_pessoa_juridica_fones_data
                                        LIMIT 15";


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

            $db->utilizacaoSistema($server, $user);

            echo json_encode($fetch_user);
        } else {
            return json_encode('000'); //nenhum encontrado
        }
}
