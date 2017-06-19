<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 * 
 */

require_once '../../classes/class-TutsupDB.php';


$db = new TutsupDB();


$usuario = $db->anti_injection($_GET['usuario']);
$dataInicial = ($db->anti_injection($_GET['dataInicial']));
$dataFinal = ($db->anti_injection($_GET['dataFinal']));
$empresa = $db->anti_injection($_GET['empresaCnpj']);

if ($empresa != '0') {
    $empresa = "AND tb_empresa_cnpj = '$empresa' ";
} else {
    $empresa = "";
}

if ($usuario == '0' || empty($usuario)) {
    $usuario = "";
} else {
    $usuario = "AND idtb_usuario = '$usuario'";
}


//echo 
$sql = "/*Cria tabela temporaria com todas as usuarios */
                      create temporary table usuario(
                       SELECT  * FROM dataWebProducao.tb_usuario
                        LEFT JOIN tb_utilizacao_sistema
                        ON tb_usuario.idtb_usuario = tb_utilizacao_sistema_idtb_user);";

$result = $db->query($sql);

if (!$result) {
    die('Invalid query: err-->' . mysql_error());
}

//echo 
$sql = "/*Cria tabela temporaria com todas as empresa */
                       create temporary table empresa(SELECT  * 
                       FROM dataWebProducao.tb_empresa
                       LEFT JOIN tb_usuario   
                       ON tb_usuario.tb_usuario_cnpj_empresa = tb_empresa.tb_empresa_cnpj);";

$result = $db->query($sql);

if (!$result) {
    die('Invalid query: err-->' . mysql_error());
}

//echo
$sql = "/*Cria tabela temporaria para a consulta web_service */                                                                         
                       create temporary table webservice(
                       select
                        tb_utilizacao_sistema_empresa_user as cnpj,
                        tb_empresa.tb_empresa_nome as nome,
                        tb_credito_custo_empresa_produtos_web_service as val_unitario_webservice,
                        count(1) as totalWebService,
                        tb_credito_custo_empresa_produtos_web_service * count(1) as val_total_webservice
                        FROM dataWebProducao.tb_utilizacao_sistema
                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_utilizacao_sistema.tb_utilizacao_sistema_empresa_user
                        
                       
                       
                        LEFT JOIN tb_credito_custo_empresa_produtos
                        ON tb_credito_custo_empresa_produtos.tb_credito_custo_empresa_produtos_cnpj = tb_utilizacao_sistema.tb_utilizacao_sistema_empresa_user
                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal' 
                        AND tb_utilizacao_sistema_filtro LIKE 'webService%'
                         group by tb_utilizacao_sistema_empresa_user);";


$result = $db->query($sql);

if (!$result) {
    die('Invalid query: err-->' . mysql_error());
}

//echo 
$sql = " create temporary table on_line(
                        select
                       tb_usuario.idtb_usuario,
                       tb_usuario.tb_usuario_nome,
                       
                       tb_utilizacao_sistema_empresa_user as cnpj,
                       tb_empresa.tb_empresa_nome as nome,
                       tb_credito_custo_empresa_produtos_online as val_unitario_online,
                                                                                 count(1) as totalOnline,
                       tb_credito_custo_empresa_produtos_online * count(1) as val_total_online
 
                        FROM dataWebProducao.tb_utilizacao_sistema
                        
                         LEFT JOIN tb_usuario
                        ON tb_usuario.idtb_usuario = tb_utilizacao_sistema_idtb_user
                        
                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_utilizacao_sistema.tb_utilizacao_sistema_empresa_user
                        
                        
                        LEFT JOIN tb_credito_custo_empresa_produtos
                        ON tb_credito_custo_empresa_produtos.tb_credito_custo_empresa_produtos_cnpj = tb_utilizacao_sistema.tb_utilizacao_sistema_empresa_user
                       
                        WHERE 1=1 
                        and  tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal' 
                        AND tb_utilizacao_sistema_busca LIKE '%/php/buscaCpfCnpj.php?busca=%'
                        $empresa
                       
                         group by tb_utilizacao_sistema_idtb_user);";



$result = $db->query($sql);

if (!$result) {
    die('Invalid query: err-->' . mysql_error());
}

//echo 
$sql = "create temporary table enriq(           
                         SELECT
            tb_utilizacao_contagem_cnpj_empresa as cnpj,
            tb_empresa.tb_empresa_nome as nome,
            tb_credito_custo_empresa_produtos_enriquecimento as val_unitario,
            sum(tb_utilizacao_contagem_total_enriquecido) as totalEnriquecimento,
            tb_credito_custo_empresa_produtos_enriquecimento * sum(tb_utilizacao_contagem_total_enriquecido) as val_total_enriquecimento
               
            
            FROM dataWebProducao.tb_utilizacao_contagem
           
            LEFT JOIN tb_empresa
            ON tb_empresa.tb_empresa_cnpj = lpad(tb_utilizacao_contagem.tb_utilizacao_contagem_cnpj_empresa,14,'0')
           
            LEFT JOIN tb_credito_custo_empresa_produtos
            ON tb_credito_custo_empresa_produtos.tb_credito_custo_empresa_produtos_cnpj = tb_utilizacao_contagem.tb_utilizacao_contagem_cnpj_empresa
           
            where tb_utilizacao_contagem_data >='$dataInicial'
            and tb_utilizacao_contagem_data<='$dataFinal'
 
            group by tb_utilizacao_contagem_cnpj_empresa);";


$result = $db->query($sql);

if (!$result) {
    die('Invalid query: err-->' . mysql_error());
}

//echo 
$sql = "create temporary table cnf(                                     
                                                                                
SELECT
idtb_usuario,
tb_usuario_nome,                                               
tb_utilizacao_sistema_empresa_user as cnpj,
tb_empresa_nome as nome,
tb_credito_custo_empresa_produtos_cnf_simples as vl_unitario_cnf_simples,
count(tb_utilizacao_sistema_idtb_user) as totalClikSimples,
tb_credito_custo_empresa_produtos_cnf_simples * count(tb_utilizacao_sistema_idtb_user) as vl_total_cnfsimples,
tb_credito_custo_empresa_produtos_cnf_detalhado as vl_unitario_cnpf_detalhado,
           
                        (SELECT count(*) FROM dataWebProducao.tb_utilizacao_sistema
                        LEFT JOIN tb_usuario
                        ON tb_utilizacao_sistema.tb_utilizacao_sistema_idtb_user = tb_usuario.idtb_usuario
                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_usuario.tb_usuario_cnpj_empresa
                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal'            
                        AND tb_utilizacao_sistema_empresa_user = tb_util.tb_utilizacao_sistema_empresa_user
                        AND   tb_utilizacao_sistema_filtro like '%tb_cnfnew  tb_cnfnew_cpf =%'
                      
                        ) as totalClikDetalhado,
                       
                      tb_credito_custo_empresa_produtos_cnf_detalhado *
                      
                      (SELECT count(*) FROM dataWebProducao.tb_utilizacao_sistema
                        LEFT JOIN tb_usuario
                        ON tb_utilizacao_sistema.tb_utilizacao_sistema_idtb_user = tb_usuario.idtb_usuario
                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_usuario.tb_usuario_cnpj_empresa
                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal'            
                        AND tb_utilizacao_sistema_empresa_user = tb_util.tb_utilizacao_sistema_empresa_user
                        AND   tb_utilizacao_sistema_filtro like '%tb_cnfnew  tb_cnfnew_cpf =%'
                      
                        )
                     
                      as vl_total_cnfdetalhado
             
              
                        FROM dataWebProducao.tb_utilizacao_sistema as tb_util
 
                        LEFT JOIN tb_usuario
                        ON tb_util.tb_utilizacao_sistema_idtb_user = tb_usuario.idtb_usuario
 
                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_usuario.tb_usuario_cnpj_empresa
                       
                        LEFT JOIN tb_credito_custo_empresa_produtos p
                        ON p.tb_credito_custo_empresa_produtos_cnpj = tb_empresa.tb_empresa_cnpj
 
                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal'
                        AND   tb_utilizacao_sistema_filtro like '%liObitoDetalhes%'
                    
                        GROUP BY idtb_usuario
                        ORDER BY tb_empresa_nome);";

$result = $db->query($sql);

if (!$result) {
    die('Invalid query: err-->' . mysql_error());
}

//echo 
$sql = "create temporary table pacote(
            SELECT tb_empresa_permite_excedente,
            tb_empresa_cnpj as cnpj,
            tb_empresa_nome as nome,
            tb_empresa_valor_pacote,
           
            (select sum(tb_creditos_valor) from tb_creditos
            where tb_creditos.tb_creditos_empresa = tb_empresa.tb_empresa_cnpj)as totalCreditos
               FROM dataWebProducao.tb_utilizacao_sistema as tb_util
 
                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_empresa.tb_empresa_cnpj
                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal'
 
                        GROUP BY tb_empresa_cnpj
                        ORDER BY tb_empresa_nome);";

$result = $db->query($sql);

if (!$result) {
    die('Invalid query: err-->' . mysql_error());
}

//echo
$sql = "  
                                               /*finaliza dados retorno geral*/
                        
 
select

usuario.tb_usuario_nome,
empresa.tb_empresa_cnpj,
empresa.tb_empresa_nome,
webservice.val_unitario_webservice,
webservice.totalWebService,
webservice.val_total_webservice,
on_line.val_unitario_online,
on_line.totalOnline,
on_line.val_total_online,
enriq.val_unitario,
enriq.totalEnriquecimento,
enriq.val_total_enriquecimento,
cnf.vl_unitario_cnf_simples,
cnf.totalClikSimples,
cnf.vl_total_cnfsimples,
cnf.vl_unitario_cnpf_detalhado,
cnf.totalClikDetalhado,
cnf.vl_total_cnfdetalhado,
pacote.tb_empresa_valor_pacote,
pacote.totalCreditos,
(ifnull(webservice.val_total_webservice,0)+
ifnull(on_line.val_total_online,0)+
ifnull(enriq.val_total_enriquecimento,0)+
ifnull(cnf.vl_total_cnfsimples,0)+
ifnull(cnf.vl_total_cnfdetalhado,0)) as total_acumulado,
case
when (ifnull(webservice.val_total_webservice,0)+
ifnull(on_line.val_total_online,0)+
ifnull(enriq.val_total_enriquecimento,0)+
ifnull(cnf.vl_total_cnfsimples,0)+
ifnull(cnf.vl_total_cnfdetalhado,0)) > (ifnull(pacote.tb_empresa_valor_pacote,0)+ifnull(pacote.totalCreditos,0))
then (ifnull(webservice.val_total_webservice,0)+
ifnull(on_line.val_total_online,0)+
ifnull(enriq.val_total_enriquecimento,0)+
ifnull(cnf.vl_total_cnfsimples,0)+
ifnull(cnf.vl_total_cnfdetalhado,0))
when (ifnull(webservice.val_total_webservice,0)+
ifnull(on_line.val_total_online,0)+
ifnull(enriq.val_total_enriquecimento,0)+
ifnull(cnf.vl_total_cnfsimples,0)+
ifnull(cnf.vl_total_cnfdetalhado,0)) <= (ifnull(pacote.tb_empresa_valor_pacote,0)+ifnull(pacote.totalCreditos,0))
then (ifnull(pacote.tb_empresa_valor_pacote,0)+ifnull(pacote.totalCreditos,0))
end as VALOR_A_FATURAR

  
from empresa
 
left join webservice on convert(webservice.cnpj, signed)= convert(empresa.tb_empresa_cnpj, signed)
left join on_line on convert(on_line.idtb_usuario, signed) = convert(empresa.idtb_usuario, signed)
left join enriq on convert(enriq.cnpj, signed) = convert(empresa.tb_empresa_cnpj, signed)
left join cnf on convert(cnf.idtb_usuario, signed) = convert(empresa.idtb_usuario, signed)
left join pacote on convert(pacote.cnpj, signed) = convert(empresa.tb_empresa_cnpj, signed) 
left join usuario on convert(usuario.idtb_usuario, signed) = convert(empresa.idtb_usuario, signed)

where 1=1

$empresa
    
group by usuario.idtb_usuario
";
$db_retorno = $db->query($sql);

if ($db_retorno != NULL) {
    // Obtém os dados da base de dados MySQL
    $fetch_user = $db_retorno->fetchAll();

// Configura o ID do usuário
    echo json_encode($fetch_user);
} else {
    echo json_encode('002'); //nenhum encontrado
}






