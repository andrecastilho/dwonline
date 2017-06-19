<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 */

require_once '../../classes/class-TutsupDB.php';
require_once '../../classes/class-controleCustos.php';


$db = new TutsupDB();
$controleCustos = new controleCustos();


$dadosBusca = $db->anti_injection($_GET['busca']);
$loginEmpresa = $db->anti_injection($_GET['loginEmpresa']);
$cnpjEmpresa = $db->anti_injection($_GET['cnpjEmpresa']);
$dadosTamanho = strlen($dadosBusca);
$idVendedor = $db->anti_injection($_GET['idtbVendedor']);


echo $controleCustos->debitarDw($cnpjEmpresa,'online');


switch ($dadosTamanho) {

    case $dadosTamanho == 11:

        $cpfPostados = ($dadosBusca);

        if ($cpfPostados != NULL) {

            $filtro = "SELECT * 
                                        FROM tb_pessoa_fisica 

                                         left join tb_pessoa_fisica_fones 
                                         ON tb_pessoa_fisica_fones.tb_pessoa_fisica_fones_cpf = tb_pessoa_fisica.tb_pessoa_fisica_cpf

					left join tb_pessoa_fisica_end 
					ON tb_pessoa_fisica_end.tb_pessoa_fisica_end_cpf = tb_pessoa_fisica.tb_pessoa_fisica_cpf

					

					left join tb_pessoa_fisica_email
					ON tb_pessoa_fisica_email.tb_pessoa_fisica_email_cpf = tb_pessoa_fisica.tb_pessoa_fisica_cpf
                                        
                                        left join tb_cnf
					ON tb_cnf.tb_cnf_cpf = tb_pessoa_fisica.tb_pessoa_fisica_cpf
                                        
                                        left join tb_procon
                                        ON tb_procon.tb_procon_fone = tb_pessoa_fisica_fones_fone
                                                        
					where tb_pessoa_fisica.tb_pessoa_fisica_cpf  = '$cpfPostados'
                                        -- GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                        -- HAVING COUNT(tb_pessoa_fisica_end_end) = 1
                                        ORDER BY tb_pessoa_fisica_end.tb_pessoa_fisica_end_data DESC
                                        ";
            try {
                $db_retorno = $db->query($filtro);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
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
                                        
                                        left join tb_cnae_nivel_sete
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

//else {

  //  echo "Seus créditos acabaram. Favor providenciar nova carga !";
//}