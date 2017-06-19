<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL); 
 * 
 */
set_time_limit(0);

require_once '/var/www/html/classes/class-ValidaCpfCnpj.php';
require_once '/var/www/html/classes/class-ManipulaArquivo.php';

class ProcessaArquivoExtracao {

    public $db;
    public $processaArquivoExtracao;

    function __construct() {
        
    }

    public function qtdExtracao($idExtracao, $empresaCnpj) {

        echo "Id Extração >>>>>> " . $idExtracao . "\n";

        $this->db = new TutsupDB();
        $this->processaArquivoExtracao = new ProcessaArquivoExtracao();


        $buscaFiltroEx = $this->buscaFiltroExtracao($idExtracao);


        foreach ($buscaFiltroEx as $key => $value) {



            if ($value['tb_extracao_filtros_nome_campo'] == 'tipoArquivo') {

                if ($value['tb_extracao_filtros_filtro'] == 'cpf') {
                    $tipoArquivo = $value['tb_extracao_filtros_filtro'];
                    $nomeTabela = "Extracao_" . $idExtracao . "_" . $empresaCnpj . "_cpf";
                }
                if ($value['tb_extracao_filtros_filtro'] == 'cnpj') {
                    $tipoArquivo = $value['tb_extracao_filtros_filtro'];
                    $nomeTabela = "Extracao_" . $idExtracao . "_" . $empresaCnpj . "_cnpj";
                }
            }
        }


        $queryExtracao = $this->processaArquivoExtracao->geraQueryExtracao($buscaFiltroEx, $tipoArquivo, $idExtracao);
        $db_retorno = $this->db->query($queryExtracao);

        $ret = $db_retorno->rowCount();

        return $ret;
    }

    public function geraQueryExtracao($buscaFiltroEx, $tipoArquivo, $idExtracao) {

        foreach ($buscaFiltroEx as $key => $value) {


            if ($tipoArquivo == 'cpf') {

//-------------------------------------pf---------------------------------------------------//
//
// //Estados TESTAR *
                if ($value['tb_extracao_filtros_nome_campo'] == 'estado') {
                    $ex = "'" . str_replace(",", "','", $value['tb_extracao_filtros_filtro']) . "'";
                    if (!empty($value['tb_extracao_filtros_filtro']) || $value['tb_extracao_filtros_filtro'] != '') {
                        if (strripos($ex, '*') || $ex == "'',''" || ex == "'',") {
                            $pfEstados = '';
                        } else {
                            $pfEstados = "AND endereco.tb_pessoa_fisica_end_uf in ($ex)";
                        }
                    } else {

                        $pfEstados = '';
                    }
                    $leftEndereco = 'left join tb_pessoa_fisica_end as endereco
                                       ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf';
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'cidade') {
                    $ex = "'" . str_replace(",", "','", $value['tb_extracao_filtros_filtro']) . "'";
                    if (!empty($value['tb_extracao_filtros_filtro']) || $value['tb_extracao_filtros_filtro'] != '') {
                        if (strripos($ex, '*') || $ex == "'',''" || ex == "'',") {
                            $pfCidades = '';
                        } else {
                            $pfCidades = "AND endereco.tb_pessoa_fisica_end_cidade in ($ex)";
                        }
                    } else {

                        $pfCidades = '';
                    }
                    $leftEndereco = 'left join tb_pessoa_fisica_end as endereco
                                       ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf';
                }

                // //ddd TESTAR *
                if ($value['tb_extracao_filtros_nome_campo'] == 'fone1') {
                    $ex = "'" . str_replace(",", "','", $value['tb_extracao_filtros_filtro']) . "'";

                    if (!empty($value['tb_extracao_filtros_filtro']) || $value['tb_extracao_filtros_filtro'] != '') {
                        if (strripos($ex, '*') || $ex == "'',''" || ex == "'',") {
                            $pfFonesDDD = '';
                            $pfFonesDDDCont = '';
                        } else {
                            $pfFonesDDD = "and  fone.tb_pessoa_fisica_fones_ddd in ($ex)";
                            $pfFonesDDDCont = "and  fone.tb_pessoa_fisica_fones_ddd in ($ex)";
                            ;
                        }
                    } else {

                        $pfFonesDDD = '';
                        $pfFonesDDDCont = '';
                    }
                }


//DATA NASCIMENTO
                if ($value['tb_extracao_filtros_nome_campo'] == 'nascimento') {

                    $ex = explode(",", $value['tb_extracao_filtros_filtro']);

                    if (empty($ex[0])) {
                        $dado1 = 0;
                    } else {
                        $dado1 = $ex[0];
                    }
                    if (empty($ex[1])) {
                        $dado2 = 2000;
                    } else {
                        $dado2 = $ex[1];
                    }

                    if ($value['tb_extracao_filtros_filtro'] != ',') {
                        $btAniversarioCpf = "AND (DATE_FORMAT(NOW(),'%Y')-SUBSTRING(pf.tb_pessoa_fisica_data_nascimento,1,4)) between $dado1 and $dado2";
                    } else {
                        $btAniversarioCpf = "";
                    }
                }


//RENDA ESTIMADA
                if ($value['tb_extracao_filtros_nome_campo'] == 'rendaEstimada') {

                    $ex = explode(",", $value['tb_extracao_filtros_filtro']);

                    if (empty($ex[0])) {
                        $dado1 = 0;
                    } else {
                        $dado1 = $ex[0];
                    }
                    if (empty($ex[1])) {
                        $dado2 = 2000000000000;
                    } else {
                        $dado2 = $ex[1];
                    }

                    if ($value['tb_extracao_filtros_filtro'] != ',') {
                        $btRendaEstimada = "and social.tb_pessoa_fisica_social_renda_estimada  between $dado1 and $dado2";
                        $leftSocial = "left join tb_pessoa_fisica_social as social
                                   ON social.tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf";
                    } else {
                        $btRendaEstimada = "";
                    }
                }

//ESCOLARIDADE TESTAR *
                if ($value['tb_extracao_filtros_nome_campo'] == 'escolaridade') {
                    $ex = "'" . str_replace(",", "','", $value['tb_extracao_filtros_filtro']) . "'";
                    if (!empty($value['tb_extracao_filtros_filtro']) || $value['tb_extracao_filtros_filtro'] != '') {

                        if (strripos($ex, '*') || $ex == "'',''" || ex == "'',") {
                            $btEscolaridade = '';
                        } else {
                            $btEscolaridade = "AND social.tb_pessoa_fisica_social_escolaridade in ($ex)";
                            $leftSocial = "left join tb_pessoa_fisica_social as social
                                   ON social.tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf";
                        }
                    } else {
                        $btEscolaridade = "";
                    }
                }


//CLASSE SOCIAL TESTAR *
                if ($value['tb_extracao_filtros_nome_campo'] == 'classeSocial') {
                    $ex = "'" . str_replace(",", "','", $value['tb_extracao_filtros_filtro']) . "'";
                    if (!empty($value['tb_extracao_filtros_filtro']) || $value['tb_extracao_filtros_filtro'] != '') {
                        if (strripos($ex, '*') || $ex == "'',''" || ex == "'',") {
                            $btClasseSocial = '';
                        } else {
                            $btClasseSocial = "AND social.tb_pessoa_fisica_social_classe_social  in ($ex)";
                            $leftSocial = "left join tb_pessoa_fisica_social as social
                                   ON social.tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf";
                        }
                    } else {

                        $btClasseSocial = '';
                    }
                }
//--------------------------------------------------------//--------------------------------------------------//

                if ($value['tb_extracao_filtros_nome_campo'] == 'procon' && $value['tb_extracao_filtros_desejado'] == 'on,') {
                    /*
                      $pfProcon = 'procon.idtb_pessoa_fisica_fones as procon,';
                      if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                      $camposObrigatorio ['procon'] = 'tb_pessoa_fisica_fones_procon';
                      } else {
                      $camposObrigatorio ['procon'] = '';
                      }

                      if ($value['tb_extracao_filtros_filtro'] == 'on') {
                      $nullProconPf = 'AND procon.tb_procon_telefone IS NOT NULL';
                      } else {
                      $nullProconPf = '';
                      }
                      $leftFones = 'left join tb_pessoa_fisica_fones as fone
                      ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf';

                      $leftProcon = 'left join tb_procon as procon
                      ON procon.tb_procon_telefone = fone.tb_pessoa_fisica_fones_fone
                      AND procon.tb_procon_ddd = fone.tb_pessoa_fisica_fones_ddd';
                     * 
                     */
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'cpf' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pfCpf = 'pf.tb_pessoa_fisica_cpf as cpf,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [0] = 'tb_pessoa_fisica_cpf';
                    } else {
                        $camposObrigatorio [0] = '';
                    }
                }
                if ($value['tb_extracao_filtros_nome_campo'] == 'nome' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pfNome = 'pf.tb_pessoa_fisica_nome as nome,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [1] = 'tb_pessoa_fisica_nome';
                    }
                }
                if ($value['tb_extracao_filtros_nome_campo'] == 'sexo' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pfSexo = 'pf.tb_pessoa_fisica_sexo as sexo,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [2] = 'tb_pessoa_fisica_sexo';
                    }
                }
                if ($value['tb_extracao_filtros_nome_campo'] == 'nascimento' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pfNascimento = 'pf.tb_pessoa_fisica_data_nascimento as data_nascimento,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [3] = 'tb_pessoa_fisica_data_nascimento';
                    }
                }


                if ($value['tb_extracao_filtros_nome_campo'] == 'mae' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pfNomeMae = '(SELECT tb_pessoa_fisica_mae_nome_mae 
                        FROM tb_pessoa_fisica_mae where tb_pessoa_fisica_mae_cpf = pf.tb_pessoa_fisica_cpf)as nome_mae,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [4] = 'tb_pessoa_fisica_mae_nome_mae';
                    }
                }
                if ($value['tb_extracao_filtros_nome_campo'] == 'cbo' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pfIdCbo = '(SELECT tb_pessoa_fisica_social_id_cbo FROM tb_pessoa_fisica_social
                       LEFT JOIN tb_cbo 
                       ON tb_cbo.tb_cbo_id_cbo = tb_pessoa_fisica_social.tb_pessoa_fisica_social_id_cbo
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) as id_cbo,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [5] = 'tb_pessoa_fisica_social_id_cbo';
                    }
                }
                if ($value['tb_extracao_filtros_nome_campo'] == 'descCbo' && $value['tb_extracao_filtros_desejado'] == 'on') {

                    $pfDesCbo = "(SELECT tb_cbo_mostrar FROM tb_cbo 
                            where tb_cbo_id_cbo = pf.tb_pessoa_fisica_cbo limit 1) as descricao_cbo,";
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [6] = 'tb_cbo_mostrar';
                    }
                }
                if ($value['tb_extracao_filtros_nome_campo'] == 'rendaEstimada' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pfRendaEstimada = '(SELECT tb_pessoa_fisica_social_renda_estimada FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) as renda_estimada,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [7] = 'tb_pessoa_fisica_social_renda_estimada';
                    }
                }
                if ($value['tb_extracao_filtros_nome_campo'] == 'escolaridade' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pfEscolaridade = '(SELECT tb_pessoa_fisica_social_escolaridade FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) as escolaridade,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [8] = 'tb_pessoa_fisica_social_escolaridade';
                    }
                }
                if ($value['tb_extracao_filtros_nome_campo'] == 'classeSocial' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pfClasseSocial = '(SELECT tb_pessoa_fisica_social_classe_social FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) as classe_social,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [9] = 'tb_pessoa_fisica_social_classe_social';
                    }
                }
                if ($value['tb_extracao_filtros_nome_campo'] == 'perfilConsumo' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pfPerfilConsumo = '(SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf 
                                        where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf 
                                        LIMIT 0,1) as perfil_consumo1,

                                        (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf
                                         where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf 
                                        LIMIT 1,1) as perfil_consumo2,

                                        (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf 
                                        where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf
                                        LIMIT 2,1) as prefil_consumo3,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [10] = 'tb_perfil_consumo_descricao';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'fone1' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $fone1 = '( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS ddd1,
                                 
    
                        ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS fone1,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [15] = 'fone1';
                    }
                    $leftFones = 'left join tb_pessoa_fisica_fones as fone
                                              ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf_2';
                }


                if ($value['tb_extracao_filtros_nome_campo'] == 'fone2' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $fone2 = '( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) AS ddd2,
                                 
                        
                        ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) AS fone2,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [17] = 'fone2';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'fone3' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $fone3 = '( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) AS ddd3,
                                 
                        ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) AS fone3,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [19] = 'fone3';
                    }
                }


                if ($value['tb_extracao_filtros_nome_campo'] == 'cel1' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $cel1 = '( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS dddCel1,

( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS cel1,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [21] = 'Cel1';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'cel2' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $cel2 = '( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) AS dddCel2,

                                 
( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) AS cel2,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [23] = 'Cel2';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'cel3' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $cel3 = '( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) AS dddCel3,

                                 
( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) AS cel3,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [25] = 'Cel3';
                    }
                }
//print_r($camposSelect);
                if ($value['tb_extracao_filtros_nome_campo'] == 'endereco' && $value['tb_extracao_filtros_filtro'] > 0 && $value['tb_extracao_filtros_desejado'] == 'on') {
                    switch ($value['tb_extracao_filtros_filtro']) {
                        case 1:

                            $end = '(SELECT tb_pessoa_fisica_end_end FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS end1,

                                (SELECT tb_pessoa_fisica_end_num
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS numero1,

                                (SELECT tb_pessoa_fisica_end_compl
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS complemento1,

                                (SELECT tb_pessoa_fisica_end_bairro
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS bairro1,

                                (SELECT tb_pessoa_fisica_end_cidade
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS cidade1,

                                (SELECT tb_pessoa_fisica_end_uf
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS uf1,

                                (SELECT tb_pessoa_fisica_end_cep
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS cep1,';


                            break;
                        case 2:
                            $end = "(SELECT tb_pessoa_fisica_end_end FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS end1,

                                    (SELECT tb_pessoa_fisica_end_num
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS numero1,

                                    (SELECT tb_pessoa_fisica_end_compl
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS complemento1,

                                    (SELECT tb_pessoa_fisica_end_bairro
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS bairro1,

                                    (SELECT tb_pessoa_fisica_end_cidade
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS cidade1,

                                    (SELECT tb_pessoa_fisica_end_uf
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS uf1,

                                    (SELECT tb_pessoa_fisica_end_cep
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS cep1,


                                    (SELECT tb_pessoa_fisica_end_end FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS end2,

                                    (SELECT tb_pessoa_fisica_end_num
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS numero2,

                                    (SELECT tb_pessoa_fisica_end_compl
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS complemento2,

                                    (SELECT tb_pessoa_fisica_end_bairro
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS bairro2,

                                    (SELECT tb_pessoa_fisica_end_cidade
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS cidade2,

                                    (SELECT tb_pessoa_fisica_end_uf
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS uf2,

                                    (SELECT tb_pessoa_fisica_end_cep
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS cep2,";
                            break;
                        case 3:

                            $end = "(SELECT tb_pessoa_fisica_end_end FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS end1,

                                    (SELECT tb_pessoa_fisica_end_num
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS numero1,

                                    (SELECT tb_pessoa_fisica_end_compl
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS complemento1,

                                    (SELECT tb_pessoa_fisica_end_bairro
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS bairro1,

                                    (SELECT tb_pessoa_fisica_end_cidade
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS cidade1,

                                    (SELECT tb_pessoa_fisica_end_uf
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS uf1,

                                    (SELECT tb_pessoa_fisica_end_cep
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 0,1) AS cep1,


                                    (SELECT tb_pessoa_fisica_end_end FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS end2,

                                    (SELECT tb_pessoa_fisica_end_num
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS numero2,

                                    (SELECT tb_pessoa_fisica_end_compl
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS complemento2,

                                    (SELECT tb_pessoa_fisica_end_bairro
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS bairro2,

                                    (SELECT tb_pessoa_fisica_end_cidade
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS cidade2,

                                    (SELECT tb_pessoa_fisica_end_uf
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS uf2,

                                    (SELECT tb_pessoa_fisica_end_cep
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 1,1) AS cep2,



                                    (SELECT tb_pessoa_fisica_end_end FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 2,1) AS end3,

                                    (SELECT tb_pessoa_fisica_end_num
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 2,1) AS numero3,

                                    (SELECT tb_pessoa_fisica_end_compl
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 2,1) AS complemento3,

                                    (SELECT tb_pessoa_fisica_end_bairro
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 2,1) AS bairro3,

                                    (SELECT tb_pessoa_fisica_end_cidade
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 2,1) AS cidade3,

                                    (SELECT tb_pessoa_fisica_end_uf
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 2,1) AS uf3,

                                    (SELECT tb_pessoa_fisica_end_cep
                                    FROM dataWebProducao.tb_pessoa_fisica_end 
                                    where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                    GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                    ORDER BY tb_pessoa_fisica_end_data DESC
                                    LIMIT 2,1) AS cep3,";
                            break;

                        default:
                            break;
                    }


                    $camposSelect ['qtdEnd'] = $value['tb_extracao_filtros_filtro'];
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [26] = 'end';
                    }

                    $leftEndereco = 'left join tb_pessoa_fisica_end as endereco
                                       ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf_2';
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'email' && $value['tb_extracao_filtros_filtro'] > 0 && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $camposSelect [27] = 'email';
                    $camposSelect['qtdEmail'] = $value['tb_extracao_filtros_filtro'];
                    switch ($value['tb_extracao_filtros_filtro']) {
                        case 1:
                            $Pfemail = "(SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email 
                        where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                        GROUP BY tb_pessoa_fisica_email_email
                        LIMIT 0,1) AS email1,";
                            break;
                        case 2:
                            $Pfemail = "(SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email 
                                where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_email_email
                                LIMIT 0,1) AS email1,

                                (SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email 
                                where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_email_email
                                LIMIT 1,1) AS email2,";
                            break;
                        case 3:
                            $Pfemail = "(SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email 
                                where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_email_email
                                LIMIT 0,1) AS email1,

                                (SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email 
                                where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_email_email
                                LIMIT 1,1) AS email2,

                                (SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email 
                                where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_email_email
                                LIMIT 2,1) AS email3,";

                        default:
                            break;
                    }
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [27] = 'email';
                    }

                    $leftEmail = 'left join tb_pessoa_fisica_email as email
                                  on email.tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf_2';
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'dataObito' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pfDataFalecimento = '(SELECT tb_cnf_data_falecimento FROM tb_cnf where tb_cnf_cpf = pf.tb_pessoa_fisica_cpf) as data_falecimento,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [28] = 'dataObito';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'cidadeObito' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pfCidadeFalecimento = '(SELECT tb_cnf_cidade FROM tb_cnf where tb_cnf_cpf = pf.tb_pessoa_fisica_cpf) as cidade_falecimento,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [29] = 'cidadeObito';
                    }
                }
                if ($value['tb_extracao_filtros_nome_campo'] == 'participacaoEmpresarial' && $value['tb_extracao_filtros_desejado'] == 'on') {


                    $pfSocio = "(SELECT tb_pessoa_juridica_socio_cnpj_id FROM tb_pessoa_juridica_socio 
                                        where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf LIMIT 0,1) as socio1,

                                        (SELECT tb_pessoa_juridica_socio_cnpj_id FROM tb_pessoa_juridica_socio 
                                        where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf LIMIT 1,1) as socio2,

                                        (SELECT tb_pessoa_juridica_socio_cnpj_id FROM tb_pessoa_juridica_socio 
                                        where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf LIMIT 2,1) as socio3,";

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [30] = 'socio';
                    }
                }

//--------------------OBRIGATORIOS PF--------------------------------------------------------//



                if ($camposObrigatorio['procon'] == 'tb_pessoa_fisica_fones_procon') {
                    /*
                      $notProcon = "'AND procon.tb_procon_telefone IS NOT NULL";
                      $leftFones = 'left join tb_pessoa_fisica_fones as fone
                      ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf';

                      $leftProcon = 'left join tb_procon as procon
                      ON procon.tb_procon_telefone = fone.tb_pessoa_fisica_fones_fone
                      AND procon.tb_procon_ddd = fone.tb_pessoa_fisica_fones_ddd';
                     * 
                     */
                }
                if ($camposObrigatorio[0] == 'tb_pessoa_fisica_cpf') {
                    $notCpf = "AND  tb_pessoa_fisica_cpf IS NOT NULL";
                }
                if ($camposObrigatorio[1] == 'tb_pessoa_fisica_nome') {
                    $notNome = "AND  tb_pessoa_fisica_nome IS NOT NULL";
                }
                if ($camposObrigatorio[2] == 'tb_pessoa_fisica_sexo') {
                    $notSexo = "AND  tb_pessoa_fisica_sexo IS NOT NULL";
                }

                if ($camposObrigatorio[3] == 'tb_pessoa_fisica_data_nascimento') {
                    $notNascimento = "AND  tb_pessoa_fisica_data_nascimento IS NOT NULL";
                }
                if ($camposObrigatorio[4] == 'tb_pessoa_fisica_mae_nome_mae') {
                    $notNomeMae = "AND  (SELECT tb_pessoa_fisica_mae_nome_mae 
                        FROM tb_pessoa_fisica_mae where tb_pessoa_fisica_mae_cpf = pf.tb_pessoa_fisica_cpf limit 1) IS NOT NULL";
                }

                if ($camposObrigatorio[5] == 'tb_pessoa_fisica_social_id_cbo') {
                    $notIdCbo = "AND  (SELECT tb_pessoa_fisica_social_id_cbo FROM tb_pessoa_fisica_social
                       LEFT JOIN tb_cbo 
                       ON tb_cbo.tb_cbo_id_cbo = tb_pessoa_fisica_social.tb_pessoa_fisica_social_id_cbo
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) <>'' ";
                }
                if ($camposObrigatorio[6] == 'tb_cbo_mostrar') {
                    $notCboMostra = "";
                }
                if ($camposObrigatorio[7] == 'tb_pessoa_fisica_social_renda_estimada') {
                    $notRendaEstimada = "AND  (SELECT tb_pessoa_fisica_social_renda_estimada FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) <>'' ";
                }
                if ($camposObrigatorio[8] == 'tb_pessoa_fisica_social_escolaridade') {
                    $notEscolaridade = "AND  (SELECT tb_pessoa_fisica_social_escolaridade FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) <> ''";
                }
                if ($camposObrigatorio[9] == 'tb_pessoa_fisica_social_classe_social') {
                    $notClasseSocial = "AND  (SELECT tb_pessoa_fisica_social_classe_social FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1)  <>'' ";
                }
                if ($camposObrigatorio[10] == 'tb_perfil_consumo_descricao') {
                    $notPerfilConsumo1 = "AND  (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf 
                                    LIMIT 0,1) IS NOT NULL";
                    $notPerfilConsumo2 = "AND  (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf 
                                    LIMIT 1,1) IS NOT NULL";
                    $notPerfilConsumo3 = "AND  (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf 
                                    LIMIT 2,1) IS NOT NULL";
                }
                if ($camposObrigatorio[15] == 'fone1') {
                    $notFone1 = "AND                 ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY tb_pessoa_fisica_fones_data desc
                                 LIMIT 0,1) IS NOT NULL";
                }
                if ($camposObrigatorio[17] == 'fone2') {
                    $notFone2 = "AND                 ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY tb_pessoa_fisica_fones_data desc
                                 LIMIT 1,1) IS NOT NULL";
                }
                if ($camposObrigatorio[19] == 'fone3') {
                    $notFone3 = "AND                 ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY tb_pessoa_fisica_fones_data desc
                                 LIMIT 2,1) IS NOT NULL";
                }

                if ($camposObrigatorio[21] == 'Cel1') {
                    $notCel1 = "AND ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY tb_pessoa_fisica_fones_data desc
                                 LIMIT 0,1) IS NOT NULL";
                }
                if ($camposObrigatorio[23] == 'Cel2') {
                    $notCel2 = "AND ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY tb_pessoa_fisica_fones_data desc
                                 LIMIT 1,1) IS NOT NULL";
                }

                if ($camposObrigatorio[25] == 'Cel3') {
                    $notCel3 = "AND ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY tb_pessoa_fisica_fones_data desc
                                 LIMIT 2,1) IS NOT NULL";
                }

                if ($camposObrigatorio[26] == 'end') {
                    $notEnd = "AND  tb_pessoa_fisica_end_end IS NOT NULL";
                }

                if ($camposObrigatorio[27] == 'email') {
                    $notEmail = "AND  email.tb_pessoa_fisica_email_cpf is not null";
                    /*
                      switch ($value['tb_extracao_filtros_filtro']) {
                      case 1:



                      break;
                      case 2:
                      $notEmail = "AND  (SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                      GROUP BY tb_pessoa_fisica_email_email limit 0,1 ) IS NOT NULL
                      AND  (SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                      GROUP BY tb_pessoa_fisica_email_email limit 1,1 ) IS NOT NULL";
                      break;
                      case 3:
                      $notEmail = "AND  (SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                      GROUP BY tb_pessoa_fisica_email_email limit 0,1 ) IS NOT NULL
                      AND  (SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                      GROUP BY tb_pessoa_fisica_email_email limit 1,1 ) IS NOT NULL
                      AND  (SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                      GROUP BY tb_pessoa_fisica_email_email limit 2,1 ) IS NOT NULL";
                      break;
                      }
                     * 
                     */
                }

                if ($camposObrigatorio[28] == 'dataObito') {
                    $notDataObito = "AND  (SELECT tb_cnf_data_falecimento FROM tb_cnf where tb_cnf_cpf = pf.tb_pessoa_fisica_cpf limit 1) IS NOT NULL";
                }

                if ($camposObrigatorio[29] == 'cidadeObito') {
                    $notCidadeObito = "AND  (SELECT tb_cnf_cidade FROM tb_cnf where tb_cnf_cpf = pf.tb_pessoa_fisica_cpf limit 1) IS NOT NULL";
                }

                if ($camposObrigatorio[30] == 'socio') {
                    $notSocio = "   AND  (SELECT concat(tb_pessoa_juridica_socio_cnpj_id) FROM tb_pessoa_juridica_socio 
                                    where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf limit 0,1 ) IS NOT NULL
                                              AND  (SELECT concat(tb_pessoa_juridica_socio_cnpj_id) FROM tb_pessoa_juridica_socio 
                                    where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf limit 1,1 ) IS NOT NULL      
                                                        AND  (SELECT concat(tb_pessoa_juridica_socio_cnpj_id) FROM tb_pessoa_juridica_socio 
                                    where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf limit 2,1 ) IS NOT NULL";
                }
                //cnpj-----------------------------------------------------------------------------///
                //***
                //---------------------------------------------------------------------------------///
            } else {



                if ($value['tb_extracao_filtros_nome_campo'] == 'tableFiltroQueryBairros') {
                    $pjLocal = $value['tb_extracao_filtros_filtro'];
                }
                if ($value['tb_extracao_filtros_nome_campo'] == 'procon') {
                    /*
                      if ($value['tb_extracao_filtros_desejado'] == 'on,')
                      $pjProcon = 'fone.tb_pessoa_juridica_fones_procon as procon,';
                      if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                      $notProconPj = 'AND tb_pessoa_juridica_fones_procon IS NOT NULL';
                      } else {
                      $notProconPj = '';
                      }

                      if ($value['tb_extracao_filtros_filtro'] == 'on') {
                      $nullProconPj = 'AND procon.tb_procon_telefone IS NOT NULL';
                      } else {
                      $nullProconPj = '';
                      }
                      $leftFonesPj = 'left join tb_pessoa_juridica_fones as fone
                      ON fone.tb_pessoa_juridica_fones_cnpj = jr.tb_pessoa_juridica_cnpj';
                      $leftProconPj = 'left join tb_procon as procon
                      ON procon.tb_procon_telefone = fone.tb_pessoa_juridica_fones_fone
                      AND procon.tb_procon_ddd = fone.tb_pessoa_juridica_fones_ddd';
                     * 
                     */
                }
                //Estados TESTAR *
                if ($value['tb_extracao_filtros_nome_campo'] == 'estadoPj') {
                    $ex = "'" . str_replace(",", "','", $value['tb_extracao_filtros_filtro']) . "'";
                    if (empty($ex)) {
                        
                    } else {
                        $pjEstados = "AND ende.tb_pessoa_juridica_end_uf in ($ex)";
                    }
                }

                //bairro TESTAR *
                if ($value['tb_extracao_filtros_nome_campo'] == 'bairroPj') {
                    $ex = "'" . str_replace(",", "','", $value['tb_extracao_filtros_filtro']) . "'";


                    if ($ex == "'',''" || $ex == "''," || $ex = 'undefined' || empty($ex)) {
                        $pjBairro = '';
                    } else {
                        $pjBairro = "AND ende.tb_pessoa_juridica_end_bairro in ($ex)";
                    }
                }

                //cidade TESTAR *
                if ($value['tb_extracao_filtros_nome_campo'] == 'cidadePj') {

                    $ex = "'" . str_replace(",", "','", $value['tb_extracao_filtros_filtro']) . "'";

                    if ($ex == "'',''" || $ex == "''," || $ex == 'undefined' || empty($ex)) {
                        $pjCidade = '';
                    } else {
                        $pjCidade = "AND ende.tb_pessoa_juridica_end_cidade in ($ex)";
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'cnpj' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $cnpjCnp = 'jr.tb_pessoa_juridica_cnpj,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notCnpj = "AND  jr.tb_pessoa_juridica_cnpj IS NOT NULL";
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'nomePj' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjNome = 'jr.tb_pessoa_juridica_nome,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjNome = 'AND  jr.tb_pessoa_juridica_nome IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'fantasiaPj' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjFantasia = 'jr.tb_pessoa_juridica_fantasia,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjFantasia = 'AND  jr.tb_pessoa_juridica_fantasia IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'matriz' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjMatriz = 'jr.tb_pessoa_juridica_matriz,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjMatriz = 'AND  jr.tb_pessoa_juridica_matriz IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'nascimentoPj' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjNascimento = 'jr.tb_pessoa_juridica_data_nascimento,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjNascimento = 'AND  jr.tb_pessoa_juridica_data_nascimento IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'qtdEmpregados' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjQtdEmpregados = 'jr.tb_pessoa_juridica_qtd_empregados;';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjQtdEmpregados = 'AND  jr.tb_pessoa_juridica_qtd_empregados IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'cnae' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjCnae = 'jr.tb_pessoa_juridica_cnae,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjCnae = 'AND  jr.tb_pessoa_juridica_cnae IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'desCnae' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjDescCnae = 'cnae.tb_cnae_desc_secao,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notDescPjCnae = 'AND  cnae.tb_cnae_desc_secao IS NOT NULL';
                    }
                }


                if ($value['tb_extracao_filtros_nome_campo'] == 'natureza' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjNatureza = 'jr.tb_pessoa_juridica_id_natureza,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjNatureza = 'AND  jr.tb_pessoa_juridica_id_natureza IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'desNatureza' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjDescNatureza = 'nat.tb_natureza_descricao,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjDescNatureza = 'AND  nat.tb_natureza_descricao IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'enderecoPj' && $value['tb_extracao_filtros_desejado'] == 'on') {

                    switch ($value['tb_extracao_filtros_filtro']) {
                        case 1:
                            $pjEndereco = "(SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- -- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS end1,

(SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- -- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS num1,


(SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- -- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS compl1,


(SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- -- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS bairro1,

(SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- -- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS cidade1,

(SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS uf1,

(SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS cep1,
";
                            break;
                        case 2:
                            $pjEndereco = "(SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS end1,

(SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS num1,


(SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS compl1,


(SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS bairro1,

(SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS cidade1,

(SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS uf1,

(SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS cep1,


(SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS end2,

(SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS num2,


(SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS compl2,


(SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS bairro2,

(SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS cidade2,

(SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS uf2,

(SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS cep2,


(SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 2,1) AS end3,";
                            break;
                        case 3:
                            $pjEndereco = "(SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS end1,

(SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS num1,


(SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS compl1,


(SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS bairro1,

(SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS cidade1,

(SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS uf1,

(SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 0,1) AS cep1,


(SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS end2,

(SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS num2,


(SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS compl2,


(SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS bairro2,

(SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS cidade2,

(SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS uf2,

(SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 1,1) AS cep2,


(SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 2,1) AS end3,

(SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 2,1) AS num3,


(SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 2,1) AS compl3,


(SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 2,1) AS bairro3,

(SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 2,1) AS cidade3,

(SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 2,1) AS uf3,

(SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
-- GROUP BYtb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
ORDER BY tb_pessoa_juridica_end_data DESC
LIMIT 2,1) AS cep3,";
                            break;
                    }


                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjEndereco = 'AND  ende.tb_pessoa_juridica_end_end IS NOT NULL';
                    }
                }



                if ($value['tb_extracao_filtros_nome_campo'] == 'situacao' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjSituacao = '(SELECT tb_pessoa_juridica_situacao FROM dataWebProducao.tb_pessoa_juridica_situacao
                                                WHERE tb_pessoa_juridica_situacao_cnpj = jr.tb_pessoa_juridica_cnpj 
                                                ORDER BY idtb_situacao DESC
                                                LIMIT 0,1) as tb_pessoa_juridica_situacao,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjSituacao = 'AND  (SELECT tb_pessoa_juridica_situacao FROM dataWebProducao.tb_pessoa_juridica_situacao
                                                WHERE tb_pessoa_juridica_situacao_cnpj = jr.tb_pessoa_juridica_cnpj 
                                                ORDER BY idtb_situacao DESC
                                                LIMIT 0,1) IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'dataSituacao' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjDataSituacao = '(SELECT tb_pessoa_juridica_data_situacao FROM dataWebProducao.tb_pessoa_juridica_situacao
                                        WHERE tb_pessoa_juridica_situacao_cnpj = jr.tb_pessoa_juridica_cnpj
                                        ORDER BY idtb_situacao DESC
                                        LIMIT 0,1) as tb_pessoa_juridica_data_situacao,';
                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjDataSituacao = 'AND  (SELECT tb_pessoa_juridica_data_situacao FROM dataWebProducao.tb_pessoa_juridica_situacao
                                                WHERE tb_pessoa_juridica_situacao_cnpj = jr.tb_pessoa_juridica_cnpj
                                                ORDER BY idtb_situacao DESC
                                                LIMIT 0,1) IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'porte' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    //$this->processaArquivo->porteReceita($pjQtdEmpregados, $pjCnae);
                    $pjPorte = "CASE substring(tb_pessoa_juridica_cnae,0,1) >= '5' and  substring(tb_pessoa_juridica_cnae,0,1) <= '43' WHEN 
                        tb_pessoa_juridica_qtd_empregados >= 1 and tb_pessoa_juridica_qtd_empregados <= 19 THEN 
                        'Micro (Industria) - ate R$1200 mil'
                        WHEN tb_pessoa_juridica_qtd_empregados >= 20 and tb_pessoa_juridica_qtd_empregados <= 99 THEN
                        'Pequena (Industria) -  De R$1200 mil a R$10500 mil'
                        WHEN tb_pessoa_juridica_qtd_empregados >= 100 and tb_pessoa_juridica_qtd_empregados <= 499 THEN
                        'Média (Industria) -  De R$10500 mil a R$60 milhões'
                        WHEN tb_pessoa_juridica_qtd_empregados > 499 THEN
                        'Média (Industria) -  De R$10500 mil a R$60 milhões'

                        ELSE

                        CASE substring(tb_pessoa_juridica_cnae,0,1) >= '45' and  substring(tb_pessoa_juridica_cnae,0,1) <= '47'|| substring(tb_pessoa_juridica_cnae,0,1) >= '90' and  substring(tb_pessoa_juridica_cnae,0,1) <= '99' WHEN 
                        tb_pessoa_juridica_qtd_empregados >= 1 and tb_pessoa_juridica_qtd_empregados <= 9 THEN 
                        'Micro (Comercio) -  Até R$1200 mil'
                        WHEN tb_pessoa_juridica_qtd_empregados >= 10 and tb_pessoa_juridica_qtd_empregados <= 49 THEN 
                        'Pequena (Comercio) -  De R$1200 mil a R$10500 mil'
                        WHEN tb_pessoa_juridica_qtd_empregados >= 50 and tb_pessoa_juridica_qtd_empregados <= 99 THEN 
                        'Media (Comercio) - De R$10500 mil a R$60 milhões'
                        WHEN tb_pessoa_juridica_qtd_empregados > 99 THEN 
                        'Grande (Comercio) - Acima de  R$60 milhões'
                        ELSE

                        CASE substring(tb_pessoa_juridica_cnae,0,1) >= '49' and  substring(tb_pessoa_juridica_cnae,0,1) <= '88'|| substring(tb_pessoa_juridica_cnae,0,1) >= '1' and  substring(tb_pessoa_juridica_cnae,0,1) <= '3' WHEN 
                        tb_pessoa_juridica_qtd_empregados >= 1 and tb_pessoa_juridica_qtd_empregados <= 9 THEN 
                        'Micro (Comercio) -  Até R$1200 mil'
                        WHEN tb_pessoa_juridica_qtd_empregados >= 10 and tb_pessoa_juridica_qtd_empregados <= 49 THEN 
                        'Pequena (Comercio) -  De R$1200 mil a R$10500 mil'
                        WHEN tb_pessoa_juridica_qtd_empregados >= 50 and tb_pessoa_juridica_qtd_empregados <= 99 THEN 
                        'Media (Comercio) - De R$10500 mil a R$60 milhões'
                        WHEN tb_pessoa_juridica_qtd_empregados > 99 THEN 
                        'Grande (Comercio) - Acima de  R$60 milhões'

                        end
                        end
                        end as portePresumido ,";

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        //$notPjDataSituacao = 'AND  IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'faturamentoPresumido' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    //$this->processaArquivo->porteReceita($pjQtdEmpregados, $pjCnae);
                    $pjFaturamento = '';
                    $camposSelect [50] = 'tb_pessoa_juridica_faturamento_presumido';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {

                        $notPjPorte = "and tb_pessoa_juridica_cnae  IS NOT NULL";
                    }
                }


                if ($value['tb_extracao_filtros_nome_campo'] == 'qtdProprietarios' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    // $pjQtdProprietarios = '  (select count(so.tb_pessoa_juridica_socio_cnpj_id)
                    //                             from tb_pessoa_juridica_socio as soc
                    //                            where soc.tb_pessoa_juridica_socio_cnpj_id = jr.tb_pessoa_juridica_cnpj 
                    //                            group by soc.tb_pessoa_juridica_socio_cnpj_id) as qtdProprietarios,';


                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjQtdProprietario = 'AND  (select count(so.tb_pessoa_juridica_socio_cnpj_id)
                                                from tb_pessoa_juridica_socio as soc
                                                where soc.tb_pessoa_juridica_socio_cnpj_id = jr.tb_pessoa_juridica_cnpj 
                                                group by soc.tb_pessoa_juridica_socio_cnpj_id) IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'perfilConsumo' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjPerfilConsumo = '(SELECT tb_perfil_consumo_descricao FROM tb_perfil_consumo_pJ where tb_perfil_consumo_cnpj = jr.tb_pessoa_juridica_cnpj
                                        LIMIT 0,1) as tb_perfil_consumo_descricaoPj1,

                                        (SELECT tb_perfil_consumo_descricao FROM tb_perfil_consumo_pJ where tb_perfil_consumo_cnpj =jr.tb_pessoa_juridica_cnpj
                                        LIMIT 1,1) as tb_perfil_consumo_descricaoPj2,

                                        (SELECT tb_perfil_consumo_descricao FROM tb_perfil_consumo_pJ where tb_perfil_consumo_cnpj =jr.tb_pessoa_juridica_cnpj 
                                        LIMIT 2,1) as tb_perfil_consumo_descricaoPj3,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjPerfilConsumo = 'AND  (SELECT tb_perfil_consumo_descricao 
                                                 FROM tb_perfil_consumo_pJ where tb_perfil_consumo_cnpj = jr.tb_pessoa_juridica_cnpj
                                                 LIMIT 0,1) IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'fone1Pj' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjFone1 = '( select tb_pessoa_juridica_fones_ddd
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 0,1) AS ddd1,


       ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 0,1) AS fone1,
                                ';


                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjFone1 = 'AND  ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 0,1) IS NOT NULL';
                    }
                }


                if ($value['tb_extracao_filtros_nome_campo'] == 'fone2Pj' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjFone2 = '
 ( select tb_pessoa_juridica_fones_ddd
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 1,1) AS ddd2,

 ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 1,1) AS fone2,
';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjFone2 = 'AND  ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 1,1) IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'fone3Pj' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjFone3 = '
 ( select tb_pessoa_juridica_fones_ddd
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 2,1) AS ddd3,
                        
                                ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 2,1) AS fone3,';

                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjFone3 = 'AND  ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 2,1) IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'cel1Pj' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjCel1 = '( select tb_pessoa_juridica_fones_ddd
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 0,1) AS dddCel1,
                                 
( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 0,1) AS cel1,
                                 ';


                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjCel1 = 'AND  ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 0,1) IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'cel2Pj' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjCel2 = '
                                 
( select tb_pessoa_juridica_fones_ddd
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 1,1) AS dddCel2,
                                 
( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 1,1) AS cel2,
                                 ';


                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjCel2 = 'AND  ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 1,1) IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'cel3Pj' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjCel3 = '
( select tb_pessoa_juridica_fones_ddd
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 2,1) AS dddCel3,
                                 
( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 2,1) AS cel3,';


                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjCel3 = 'AND  ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 2,1) IS NOT NULL';
                    }
                }

                if ($value['tb_extracao_filtros_nome_campo'] == 'socios' && $value['tb_extracao_filtros_desejado'] == 'on') {
                    $pjSocio = ' 
                        
                            (SELECT tb_pessoa_juridica_socio_cpf_id FROM tb_pessoa_juridica_socio 
                                            where tb_pessoa_juridica_socio_cnpj_id=jr.tb_pessoa_juridica_cnpj LIMIT 0,1) as IdSocio1,
                            (SELECT tb_pessoa_juridica_socio_participacao FROM tb_pessoa_juridica_socio 
                                            where tb_pessoa_juridica_socio_cnpj_id=jr.tb_pessoa_juridica_cnpj LIMIT 0,1) as ParticipSocio1,
                            (SELECT tb_pessoa_juridica_socio_tipo FROM tb_pessoa_juridica_socio 
                                            where tb_pessoa_juridica_socio_cnpj_id=jr.tb_pessoa_juridica_cnpj LIMIT 0,1) as TipoSocio1,
                                            
                            (SELECT tb_pessoa_juridica_socio_cpf_id FROM tb_pessoa_juridica_socio 
                                            where tb_pessoa_juridica_socio_cnpj_id=jr.tb_pessoa_juridica_cnpj LIMIT 1,1) as IdSocio2,
                            (SELECT tb_pessoa_juridica_socio_participacao FROM tb_pessoa_juridica_socio 
                                            where tb_pessoa_juridica_socio_cnpj_id=jr.tb_pessoa_juridica_cnpj LIMIT 1,1) as ParticipSocio2,
                            (SELECT tb_pessoa_juridica_socio_tipo FROM tb_pessoa_juridica_socio 
                                            where tb_pessoa_juridica_socio_cnpj_id=jr.tb_pessoa_juridica_cnpj LIMIT 1,1) as TipoSocio2,
                                            
                            (SELECT tb_pessoa_juridica_socio_cpf_id FROM tb_pessoa_juridica_socio 
                                            where tb_pessoa_juridica_socio_cnpj_id=jr.tb_pessoa_juridica_cnpj LIMIT 2,1) as IdSocio3,
                            (SELECT tb_pessoa_juridica_socio_participacao FROM tb_pessoa_juridica_socio 
                                            where tb_pessoa_juridica_socio_cnpj_id=jr.tb_pessoa_juridica_cnpj LIMIT 2,1) as ParticipSocio3,
                            (SELECT tb_pessoa_juridica_socio_tipo FROM tb_pessoa_juridica_socio 
                                            where tb_pessoa_juridica_socio_cnpj_id=jr.tb_pessoa_juridica_cnpj LIMIT 2,1) as TipoSocio3,';


                    if ($value['tb_extracao_filtros_obrigatorio'] == 'on') {
                        $notPjSocio = 'AND  (SELECT tb_pessoa_juridica_socio_cpf_id FROM tb_pessoa_juridica_socio 
                                            where tb_pessoa_juridica_socio_cnpj_id=jr.tb_pessoa_juridica_cnpj LIMIT 0,1) IS NOT NULL
                                            AND  (SELECT tb_pessoa_juridica_socio_cpf_id FROM tb_pessoa_juridica_socio 
                                            where tb_pessoa_juridica_socio_cnpj_id=jr.tb_pessoa_juridica_cnpj LIMIT 1,1) IS NOT NULL
                                            AND  (SELECT tb_pessoa_juridica_socio_cpf_id FROM tb_pessoa_juridica_socio 
                                            where tb_pessoa_juridica_socio_cnpj_id=jr.tb_pessoa_juridica_cnpj LIMIT 2,1) IS NOT NULL';
                    }
                }
            }
        }



        /*
         * 
          left join tb_pessoa_fisica_fones as fone
          ON fone.tb_pessoa_fisica_cpf_2 = pf.tb_pessoa_fisica_cpf_2

          left join tb_pessoa_fisica_end as endereco
          ON endereco.tb_pessoa_fisica_cpf_2 = pf.tb_pessoa_fisica_cpf_2

          left join tb_pessoa_fisica_email as email
          on email.tb_pessoa_fisica_cpf_2 = pf.tb_pessoa_fisica_cpf_2
         */

        if ($tipoArquivo == 'cpf') {

            echo $sqlCreateTable = "SELECT  pf.tb_pessoa_fisica_cpf  as totalLinhas
    
                                 
                                 FROM tb_pessoa_fisica as pf 
                                 
                                 left join tb_pessoa_fisica_fones as fone
                                              ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf
                                              
                                left join tb_pessoa_fisica_end as endereco
                                       ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                       
                                left join tb_pessoa_fisica_email as email
                                  on email.tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                                  
                                  
                                $leftSocial

 
                                where 1=1
                                    
                                        $notCpf    
                                        $notNome 
                                        $notSexo 
                                        $notNascimento
                                        $notNomeMae 
                                        $notIdCbo 
                                        $notCboMostra 
                                        $notRendaEstimada 
                                        $notEscolaridade 
                                        $notClasseSocial 
                                        $notPerfilConsumo1 
                                        $notFone1 
                                        $notFone2 
                                        $notFone3 
                                        $notCel1 
                                        $notCel2 
                                        $notCel3 
                                        $notEnd 
                                        $notEmail 
                                        $notDataObito 
                                        $notCidadeObito
                                        $notCidadeObito
                                        $notSocio
                                        $notProcon
                                        $nullProconPf
                                        $btAniversarioCpf
                                        $btRendaEstimada
                                        $btEscolaridade
                                        $btClasseSocial
                                        $pfEstados
                                        $pfCidades
                                        $pfFonesDDDCont

                                           
        
                                         GROUP BY pf.tb_pessoa_fisica_cpf
        
                                        ";

            


            $sqlCreateTableAtualiza = "CREATE  TABLE  IF NOT EXISTS extracao_$idExtracao SELECT 
            
                                $pfCpf
                                $pfNome
                                $pfSexo
                                $pfNascimento
                                $pfNomeMae
                                $fone1
                                $fone2
                                $fone3
                                $cel1
                                $cel2
                                $cel3
                                 $end
                                 $pfRendaEstimada
                                 $pfEscolaridade
                                 $pfClasseSocial
                                 $pfIdCbo
                                 $pfDesCbo
                                 $Pfemail
                                 $pfDataFalecimento
                                 $pfCidadeFalecimento
                                 $pfPerfilConsumo
                                 $pfSocio
                                 $pfProcon
                                     
               
                                 1 as termino
    
                                 
                                 FROM tb_pessoa_fisica as pf
                    
                                left join tb_pessoa_fisica_fones as fone
                                       ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf
                                left join tb_pessoa_fisica_end as endereco
                                       ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                left join tb_pessoa_fisica_email as email
                                       ON email.tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                                  
                                $leftSocial
                                $leftProcon
                               
                                   where 1=1
                                    
    
                                        $notCpf    
                                        $notNome 
                                        $notSexo 
                                        $notNascimento
                                        $notNomeMae 
                                        $notIdCbo 
                                        $notCboMostra 
                                        $notRendaEstimada 
                                        $notEscolaridade 
                                        $notClasseSocial 
                                        $notPerfilConsumo1 
                                        $notFone1 
                                        $notFone2 
                                        $notFone3 
                                        $notCel1 
                                        $notCel2 
                                        $notCel3 
                                        $notEnd 
                                        $notEmail 
                                        $notDataObito 
                                        $notCidadeObito
                                        $notCidadeObito
                                        $notSocio
                                        $notProcon
                                        $nullProconPf
                                        $btAniversarioCpf
                                        $btRendaEstimada
                                        $btEscolaridade
                                        $btClasseSocial
                                        $pfEstados
                                        $pfCidades
                                        $pfFonesDDDCont

                                           
        
                                         GROUP BY pf.tb_pessoa_fisica_cpf ";




            $criaTabelaTelefones = "CREATE  TABLE  IF NOT EXISTS TELEFONES  
                                    SELECT 
                                idtb_pessoa_fisica_fones,
                                tb_pessoa_fisica_fones_cpf,
                                tb_pessoa_fisica_fones_ddd,
                                tb_pessoa_fisica_fones_fone,
                                tb_pessoa_fisica_fones_tipo,
                                tb_pessoa_fisica_fones_operadora,
                                tb_pessoa_fisica_fones_procon,
                                tb_pessoa_fisica_fones_data,
                                idtb_pessoa_fisica_end,
                                tb_pessoa_fisica_end_cpf,
                                tb_pessoa_fisica_end_end,
                                tb_pessoa_fisica_end_num,
                                tb_pessoa_fisica_end_compl,
                                tb_pessoa_fisica_end_bairro,
                                tb_pessoa_fisica_end_zona,
                                tb_pessoa_fisica_end_cidade,
                                tb_pessoa_fisica_end_cod_ibge,
                                tb_pessoa_fisica_end_uf,
                                tb_pessoa_fisica_end_cep,
                                tb_pessoa_fisica_end_nota,
                                tb_pessoa_fisica_end_data 

                            FROM tb_pessoa_fisica_fones as fone

                             
                               $notFone1
                               $notFone2
                               $notFone3
                               $notCel1
                               $notCel2
                               $notCel3
                               $pfFonesDDDCont";



            //$this->db = new TutsupDB(); 
            //print_r($criaTabelaTelefones);
            //$db_retorno = $this->db->exec($criaTabelaTelefones);
            //$fetch_retorno = $db_retorno->fetchAll();
            //echo $criaTabelaTelefones;
            //echo $sqlCreateTableAtualiza;
            echo $sqlCreateTable;
            //die("aqui");
            //LIBERANDO MEMORIA
            //unset($cpfsSaida);
            unset($notCpf);
            unset($notNome);
            unset($notSexo);
            unset($notNascimento);
            unset($notNomeMae);
            unset($notIdCbo);
            unset($notCboMostra);
            unset($notRendaEstimada);
            unset($notEscolaridade);
            unset($notClasseSocial);
            unset($notPerfilConsumo1);
            unset($notFone1);
            unset($notFone2);
            unset($notFone3);
            unset($notCel1);
            unset($notCel2);
            unset($notCel3);
            unset($notEnd);
            unset($notEmail);
            unset($notDataObito);
            unset($notCidadeObito);
            unset($notCidadeObito);
            unset($btAniversarioCpf);
            unset($btRendaEstimada);
            unset($btEscolaridade);
            unset($btClasseSocial);
            unset($btClasseSocial);
            unset($pfEstados);

            $this->atualizaArquivoExtracaoQuery($sqlCreateTableAtualiza, $idExtracao);
            //echo $sqlCreateTable;

            return $sqlCreateTable;
        } else {

            if ($pjLocal) {
                $pjEstados = "";
            }
            $sqlCreateTable = "SELECT jr.tb_pessoa_juridica_cnpj as totalLinhas

                                        FROM tb_pessoa_juridica as jr

					left join tb_pessoa_juridica_socio as so
					on so.tb_pessoa_juridica_socio_cnpj_id = jr.tb_pessoa_juridica_cnpj


					left join tb_pessoa_juridica_end as ende
					ON ende.tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj

					left join tb_cnae_nivel_sete as cnae
					ON jr.tb_pessoa_juridica_cnae = cnae.tb_cnae_id_cnae
                                        
					left join tb_natureza as nat
					ON jr.tb_pessoa_juridica_id_natureza = nat.tb_natureza_id
                                        
                                       left join tb_pessoa_juridica_fones as fonesPj
                                       on fonesPj.tb_pessoa_juridica_fones_cnpj = jr.tb_pessoa_juridica_cnpj
                                        

                                        
					where 1=1
                                            

                        $notCnpj
                        $notPjNome 
                        $notPjFantasia 
                        $notPjMatriz
                        $notPjNascimento
                        $notPjQtdEmpregados
                        $notPjCnae
                        $notDescPjCnae
                        $notPjNatureza
                        $notPjDescNatureza 
                        $notPjEndereco
                        $notPjSituacao
                        $notPjDataSituacao
                        $notPjQtdProprietario
                        $notPjPerfilConsumo
                        $notPjFone1
                        $notPjFone2
                        $notPjFone3
                        $notPjCel1
                        $notPjCel2
                        $notPjCel3
                        $notPjCel2
                        $notPjSocio
                        $pjEstados
                        $notPjPorte
                        $notProconPj
                        $nullProconPj
                       
                        
                            $pjLocal
                            

                                        GROUP BY jr.tb_pessoa_juridica_cnpj ";
            //die($sqlCreateTable);

            $sqlCreateTableAtualiza = " CREATE  TABLE  IF NOT EXISTS extracao_$idExtracao SELECT 
                
                                        tb_pessoa_juridica_cnpj,
                                        tb_pessoa_juridica_nome,
                          
                                        $pjQtdProprietarios
                                        $pjEndereco
                                        $pjSituacao
                                        $pjDataSituacao
                                        $pjFone1
                                        $pjFone2
                                        $pjFone3
                                        $pjCel1
                                        $pjCel2
                                        $pjCel3
                                        $pjPorte
                                        $pjPerfilConsumo
                                        $pjSocio
                                        $pjProcon

                                           1 as termino

                                        FROM tb_pessoa_juridica as jr

                                        left join tb_pessoa_juridica_socio as so
					on so.tb_pessoa_juridica_socio_cnpj_id = jr.tb_pessoa_juridica_cnpj


					left join tb_pessoa_juridica_end as ende
					ON ende.tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj

					left join tb_pessoa_juridica_fones as fone
                                        ON fone.tb_pessoa_juridica_fones_cnpj = jr.tb_pessoa_juridica_cnpj
                                        
					left join tb_cnae_nivel_sete as cnae
					ON jr.tb_pessoa_juridica_cnae = cnae.tb_cnae_id_cnae
                                        
					left join tb_natureza as nat
					ON jr.tb_pessoa_juridica_id_natureza = nat.tb_natureza_id

                                        
					 where 1=1
                                            

                        $notCnpj
                        $notPjNome 
                        $notPjFantasia 
                        $notPjMatriz
                        $notPjNascimento
                        $notPjQtdEmpregados
                        $notPjCnae
                        $notDescPjCnae
                        $notPjNatureza
                        $notPjDescNatureza 
                        $notPjEndereco
                        $notPjSituacao
                        $notPjDataSituacao
                        $notPjQtdProprietario
                        $notPjPerfilConsumo
                        $notPjFone1
                        $notPjFone2
                        $notPjFone3
                        $notPjCel1
                        $notPjCel2
                        $notPjCel3
                        $notPjCel2
                        $notPjSocio
                        $pjEstados
                        $notPjPorte   
                        $notProconPj
                        $nullProconPj
                                    
                   
                        
                            $pjLocal
        
                                    
                            

                                         GROUP BY jr.tb_pessoa_juridica_cnpj
                                        
                                        -- ORDER BY ende.idtb_pessoa_juridica_end ,
                                        -- ende.tb_pessoa_juridica_end_data ,
                                        -- fone.tb_pessoa_juridica_fones_data";
            //echo $sqlCreateTable;
            //die(">.");
            //LIBERA MEMORIA
            unset($pjQtdProprietarios);
            unset($pjEndereco);
            unset($pjSituacao);
            unset($pjDataSituacao);
            unset($pjFone1);
            unset($pjFone2);
            unset($pjFone3);
            unset($pjCel1);
            unset($pjCel2);
            unset($pjCel3);
            unset($pjPerfilConsumo);
            unset($pjSocio);
            unset($notPjQtdEmpregados);
            unset($notPjCnae);
            unset($notDescPjCnae);
            unset($notPjNatureza);
            unset($notPjDescNatureza);
            unset($notPjEndereco);
            unset($notPjSituacao);
            unset($notPjDataSituacao);
            unset($notPjQtdProprietario);
            unset($notPjPerfilConsumo);
            unset($notPjFone1);
            unset($notPjFone2);
            unset($notPjFone3);
            unset($notPjCel1);
            unset($notPjCel2);
            unset($notPjCel3);
            unset($notPjCel2);

            $this->atualizaArquivoExtracaoQuery($sqlCreateTableAtualiza, $idExtracao);

            return $sqlCreateTable;
        }
    }

    public function atualizaQtdLinhasExtracao($idExtracao, $qtdLinhas) {
        //die($idExtracao . "....." . $qtdLinhas);
        $this->db = new TutsupDB();
        $query = $this->db->update('tb_extracao', 'idtb_extracao', $idExtracao, array(
            'tb_extracao_qtd_linhas' => $qtdLinhas,
            'tb_extracao_msg_visualizada' => null
        ));

        return $query;
    }

    public function atualizaArquivoExtracaoQuery($query, $idExtracao) {

        $this->db = new TutsupDB();
        $query = $this->db->update('tb_extracao', 'idtb_extracao', $idExtracao, array(
            'tb_extracao_query' => $query
        ));
        return $query;
    }

    public function buscaFiltroExtracao($idExtracao) {

        $this->db = new TutsupDB();

        $filtro = "SELECT * FROM dataWebProducao.tb_extracao_filtros
                    WHERE tb_extracao_filtros_idtb_extracao = $idExtracao";

        $db_retornoFiltro = $this->db->query($filtro);
        $fetch_userFiltro = $db_retornoFiltro->fetchAll();
        return $fetch_userFiltro;
    }

//--------------------------------------------------------------------------------------------------------------------//


    public function atualizaArquivoEmProcesamentoEx($idExtracao) {

        $this->db = new TutsupDB();
        $query = $this->db->update('tb_extracao', 'idtb_extracao', $idExtracao, array(
            'tb_extracao_em_procesamento' => '1'));
        if ($query) {
            echo"Processo Atualizado \n";
        }
    }

    public function atualizaExtracaoGerada($nomeArquivoCpf, $nomeArquivoCnpj, $idExtracao) {

        $this->db = new TutsupDB();
        $query = $this->db->update('tb_extracao', 'idtb_extracao', $idExtracao, array(
            'tb_extracao_arquivo_cpf' => $nomeArquivoCpf,
            'tb_extracao_arquivo_cnpj' => $nomeArquivoCnpj,
            'tb_extracao_msg_visualizada' => null,
            'tb_extracao_data_finalizado' => time()));
        if ($query) {
            echo"Processo Atualizado Gerada\n";
        }
    }

    public function atualizaExtracaoContada($idExtracao, $qtd) {

        $this->db = new TutsupDB();
        $query = $this->db->update('tb_extracao', 'idtb_extracao', $idExtracao, array(
            'tb_extracao_processar_contada' => '1',
            'tb_extracao_qtd_total_registros' => $qtd));
        if ($query) {
            echo"Processo Atualizado Contada\n id=" . $idExtracao . " -- qtd=" . $qtd . "--data=" . time();
        }
    }

    public function excluiTabelaExtracao($nomeTabela) {

        $this->db = new TutsupDB();
        $query = $this->db->pdo->exec("DROP TABLE `dataWebProducao`.`$nomeTabela`;");
        if ($query) {
            echo"Tabela Excluida \n";
        } else {
            echo "erro exclusão";
        }
    }

    public function processarExtracao($sqlCreateTable, $empresaCnpj, $idExtracao, $tipoArquivo, $qtd) {


        $this->processaArquivoExtracao = new ProcessaArquivoExtracao();
        $this->db = new TutsupDB();

        //atualizar aqui 
        $this->processaArquivoExtracao->atualizaExtracaoContada($idExtracao, $qtd);

        if (!empty($idExtracao)) {
            $resultCreateTableExtracao = $this->db->pdo->exec($sqlCreateTable);
        } else {
            exit();
        }

        $nomeTabela = "extracao_" . "$idExtracao";
        $pastaUpload = "/var/www/html/$empresaCnpj/";




// Pasta onde o arquivo vai ser salvo
        if (file_exists($pastaUpload)) {
            
        } else {

            $cridou = mkdir("$pastaUpload", 0777); // Cria uma nova pasta dentro do diretório atual
            if (!$cridou) {
                echo "Pasta não criada";
                die("Erro");
            }
        }



        //echo $sqlCreateTable;
        //die("l.");

        if ($tipoArquivo == 'cpf') {

            $nomeArquivoCpf = date('d_m_Y_h_m_s') . "_" . $empresaCnpj . "_" . $idExtracao . "_cpfExtracao.csv";
            $pastaENomeArquivoCpf = $pastaUpload . $nomeArquivoCpf;
            $nomeArquivoCnpj = '';
            $resultado = shell_exec("/var/www/html/exec/execExtracao.sh '$nomeTabela' '$pastaENomeArquivoCpf'");
            echo(">>>----PF " . $resultado);
        } else {

            $nomeArquivoCnpj = date('d_m_Y_h_m_s') . "_" . $empresaCnpj . "_" . $idExtracao . "_cnpjExtracao.csv";
            $pastaENomeArquivoCnpj = $pastaUpload . $nomeArquivoCnpj;
            $nomeArquivoCpf = '';
            $resultado = shell_exec("/var/www/html/exec/execExtracao.sh 'extracao_$idExtracao' '$pastaENomeArquivoCnpj'");
            echo(">>>----PJ " . $resultado);
        }

        $this->processaArquivoExtracao->atualizaExtracaoGerada($nomeArquivoCpf, $nomeArquivoCnpj, $idExtracao);
        $this->processaArquivoExtracao->excluiTabelaExtracao($nomeTabela);



        $this->db->fecharConexao();
    }

}
