<?php

class APOIO {

    var $query, $result, $retorno, $data_inicial, $data_final;

    public function __construct() {
        
    }

    public function fechaConexao() {
        mysql_close();
    }

    public function Exec() {

        //$result = mysql_query($this->query);

        $this->result = mysql_query($this->query);

        if (!$this->result) {
            die('Invalid query: err-->' . mysql_error());
        }

        return;
    }

    public function Fetch() {

        $this->retorno = array();

        while ($dados = mysql_fetch_assoc($this->result)) {
            array_push($this->retorno, $dados);
        }

        return $this->retorno;
    }

    public function real($valor) {
        return number_format($valor, 2, ",", ".");
    }

    public function debug($value) {

        echo "<PRE>";
        print_r($value);
        die(".");
    }

    public function saidaUtilizacaoSistemaDetalhado() {

        $this->Fetch();

//var_dump($this->retorno);

        foreach ($this->retorno as $value) {

            if ($value['tb_utilizacao_sistema_busca']) {
                $mostraBuscaFiltro = $value['tb_utilizacao_sistema_busca'];
            } else {
                $mostraBuscaFiltro = $value['tb_utilizacao_sistema_filtro'];
            }
            echo "<tr>
                <td >" . $value['tb_utilizacao_sistema_empresa_user'] . "</td>
                <td >" . $value['tb_utilizacao_sistema_idtb_user'] . "</td>
                <td >" . $value['tb_usuario_nome'] . "</td>
                <td >" . $value['tb_utilizacao_sistema_ip_user'] . "</td>                    
                <td >" . $mostraBuscaFiltro . "</td>                    
                <td >" . $value['tb_utilizacao_sistema_HTTP_USER_AGENT'] . "</td>
                 <td >" . date('d/m/Y h:00:00', $value['tb_utilizacao_sistema_data_hora']) . "</td> 
                </tr>";
        }

        return;
    }

    public function saidaUtilizacaoSistemaDetalhadoWebService() {

        $this->Fetch();

//var_dump($this->retorno);

        foreach ($this->retorno as $value) {


            echo "<tr>
                <td >" . $value['tb_utilizacao_sistema_empresa_user'] . "</td>
                <td >" . $value['tb_empresa_nome'] . "</td>
                <td >" . $value['tb_utilizacao_sistema_busca'] . "</td>                    
                 <td >" . date('d/m/Y h:00:00', $value['tb_utilizacao_sistema_data_hora']) . "</td> 
                </tr>";
        }

        return;
    }

    public function saidaUtilizacaoSistemaQuantitativoWebService() {

        $this->Fetch();

//var_dump($this->retorno);

        foreach ($this->retorno as $value) {

            echo "<tr>
                    <td >" . $value['tb_utilizacao_sistema_empresa_user'] . "</td>
                    <td >" . $value['tb_empresa_nome'] . "</td>
                    <td >" . $value['total'] . "</td>
                    <td >" . $value['total'] * $value['tb_credito_custo_empresa_produtos_web_service'] . "</td>
                    <td >" . $value['tb_credito_custo_empresa_produtos_web_service'] . "</td>
                  </tr>";
        }

        return;
    }

    public function saidaUtilizacaoSistemaQuantitativoCnf() {

        $this->Fetch();

//var_dump($this->retorno);

        foreach ($this->retorno as $value) {

            $qtdExcedente = ($value['total'] - $value['tb_empresa_qtd_contratada']);
            $totalComExcedente = (($qtdExcedente) * $value['tb_empresa_unitario_execedente']);

            if ($qtdExcedente <= 0) {
                $qtdExcedente = "";
            }

            if ($totalComExcedente <= 0) {
                $totalComExcedente = $value['tb_empresa_valor_pacote'];
            } else {
                $totalComExcedente = $totalComExcedente + $value['tb_empresa_valor_pacote'];
            }

            echo "<tr>
                    <td >" . $value['tb_utilizacao_sistema_empresa_user'] . "</td>
                    <td >" . $value['tb_empresa_nome'] . "</td>
                    <td >" . $value['totalClikSimples'] . "</td>
                    <td >" . $value['totalClikSimples'] * $value['tb_credito_custo_empresa_produtos_cnf_simples'] . "</td>
                    <td >" . $value['total'] . "</td>
                    <td >" . $value['totalClikSimples'] * $value['tb_credito_custo_empresa_produtos_cnf_detalhado'] . "</td>
                </tr>";
        }

        return;
    }

    public function saidaUtilizacaoSistemaDetalhadoCnf() {

        $this->Fetch();

        foreach ($this->retorno as $value) {

            echo "<tr>
                        <td >" . $value['tb_utilizacao_sistema_empresa_user'] . "</td>
                        <td >" . $value['tb_empresa_nome'] . "</td>
                        <td >" . $value['tb_utilizacao_sistema_idtb_user'] . "</td>
                        <td >" . $value['tb_usuario_nome'] . "</td>
                        <td >" . $value['tb_utilizacao_sistema_ip_user'] . "</td>
                        <td >" . date('d/m/Y h:m:s', $value['tb_utilizacao_sistema_data_hora']) . "</td>
                        <td >" . $value['tb_utilizacao_sistema_filtro'] . "</td>
                </tr>";
        }

        return;
    }

    public function saidaConsumoCreditosTotal() {

        $this->Fetch();

        echo "
            <thead>
                  <tr style='background-color: ;text-align: center;' >
                                <th>
                                <td rowspan='6'>
                                    <br><h4> Totais</h4>
                                </td>
                                </th>
                            </tr>           
                </thead>
            <thead>
            <thead>
                                <tr>
                                <th>CNPJ Empresa</th>
                                <th>Nome Empresa</th>
                                <th>Total de Pesquisas</th>
                                <th>Vlr. Total</th>
                            </tr>
                        </thead>";

        foreach ($this->retorno as $value) {
            echo "
                
                <tr>
                    <td >" . $value['tb_empresa_cnpj'] . "</td>
                    <td >" . $value['tb_empresa_nome'] . "</td>
                    <td >" . $value['total'] . "</td>
                </tr>";
        }

        return;
    }

    public function saidaConsumoCreditosContratadoInseridosTotal() {

        $this->Fetch();

        echo "<thead>
                  <tr style='background-color: ;text-align: center;' >
                                <th>
                                <td rowspan='6'>
                                    <br><h4> Créditos / Contratados</h4>
                                </td>
                                </th>
                            </tr>           
                </thead>
            <thead>
            <thead>
                                <tr>
                                <th>CNPJ Empresa</th>
                                <th>Nome Empresa</th>
                                <th>Vlr. Contratado</th>
                                <th>Excedente</th>
                                <th>Vlr. Total Créditos Inseridos</th>
                            </tr>
                        </thead>";

        foreach ($this->retorno as $value) {
            if ($value['totalCreditos']) {
                echo "
                <tr>
                <td >" . $value['tb_empresa_cnpj'] . "</td>
                    <td >" . $value['tb_empresa_nome'] . "</td>
                    <td >" . $value['tb_empresa_qtd_contratada'] . "</td>
                        <td >" . $value['tb_empresa_permite_excedente'] . "</td>
                    <td >" . ($value['totalCreditos']) . "</td>
                </tr>";
            }
        }

        return;
    }

    public function saidaConsumoCreditosCnfSimples() {



        $this->Fetch();

        echo " <thead>
                  <tr style='background-color: ;text-align: center;' >
                                <th>
                                <td rowspan='6'>
                                    <br><h4> Cnf</h4>
                                </td>
                                </th>
                            </tr>           
                </thead>
            <thead>
            <thead>
                                <tr>
                                <th>CNPJ Empresa</th>
                                <th>Nome Empresa</th>
                                <th>Qtd. Total Clik Simples</th>
                                <th>Vlr. Total Click Simples</th>
                                <th>Qtd. Total Clik Detalhado</th>
                                <th>Vlr. Total Click Detalhado</th>

                            </tr>
                        </thead>";

        foreach ($this->retorno as $value) {
            echo "
                
                <tr>
                <td >" . $value['tb_empresa_cnpj'] . "</td>
                    <td >" . $value['tb_empresa_nome'] . "</td>
                    <td >" . $value['totalClikSimples'] . "</td>
                    <td >" . ($value['totalClikSimples'] * $value['tb_credito_custo_empresa_produtos_cnf_simples']) . "</td>
                     <td >" . $value['totalClikDetalhado'] . "</td>
                    <td >" . ($value['totalClikDetalhado'] * $value['tb_credito_custo_empresa_produtos_cnf_detalhado']) . "</td>
                </tr>";
        }

        return;
    }

    public function saidaConsumoCreditosEnriquecimento() {


        $this->Fetch();

        echo "
              <thead>
                           <tr style='background-color: ;text-align: center;' >
                                <th>
                                <td rowspan='6'>
                                    <br><h4> Enriquecimento</h4>
                                </td>
                                </th>
                            </tr>
            <thead>
                                <tr>
                                <th>CNPJ Empresa</th>
                                <th>Nome Empresa</th>
                                <th>Qtd. Total Enriquecimento</th>
                                <th>Vlr. Total Enriquecimento</th>

                            </tr>
                        </thead>";

        foreach ($this->retorno as $value) {
            echo "
                
                <tr>
                <td >" . $value['tb_utilizacao_contagem_cnpj_empresa'] . "</td>
                    <td >" . $value['tb_empresa_nome'] . "</td>
                    <td >" . $value['totalEnriquecimento'] . "</td>
                    <td >" . ($value['totalEnriquecimento'] * $value['tb_credito_custo_empresa_produtos_enriquecimento']) . "</td>
                </tr>";
        }

        return;
    }

    public function saidaConsumoCreditosOnline() {

        $this->Fetch();

        echo "
              <thead>
               <tr style='background-color: ;text-align: center;' >
                                <th>
                                <td rowspan='6'>
                                    <br><h4> Online</h4>
                                </td>
                                </th>
                            </tr>
              </thead>
            <thead>
                                <tr>
                                <th>CNPJ Empresa</th>
                                <th>Nome Empresa</th>
                                <th>Qtd. Total Online</th>
                                <th>Vlr. Total Online</th>

                            </tr>
                        </thead>";

        foreach ($this->retorno as $value) {
            echo "
                
                <tr>
                <td >" . $value['tb_empresa_cnpj'] . "</td>
                    <td >" . $value['tb_empresa_nome'] . "</td>
                    <td >" . $value['totalOnline'] . "</td>
                    <td >" . ($value['totalOnline'] * $value['tb_credito_custo_empresa_produtos_online']) . "</td>
                </tr>";
        }

        return;
    }

    public function saidaConsumoCreditosWebService($empresa) {


        $this->Fetch();

        if ($empresa) {
            $colocaInput = "<td ><input  type='button'  value ='+'onclick=chama('" . $empresa . "');></td>";
        }

        foreach ($this->retorno as $value) {
            $empresa = $value['tb_empresa_cnpj'];
            echo " 
               
                <tr>
                    $colocaInput
                    <td >" . $value['tb_empresa_cnpj'] . "</td>
                    <td >" . $value['tb_empresa_nome'] . "</td>
                    <td >" . number_format($value['totalOnline'], 0, '', '.') . "</td>
                    <td >" . number_format($value['val_total_online'], 2, ',', '.') . "</td>
                    <td >" . number_format($value['totalEnriquecimento'], 0, '', '.') . "</td>
                    <td >" . number_format($value['val_total_enriquecimento'], 2, ',', '.') . "</td>
                    <td >" . number_format($value['totalWebService'], 0, '', '.') . "</td>
                    <td >" . number_format($value['val_total_webservice'], 2, ',', '.') . "</td>
                    <td >" . number_format($value['totalClickSimples'], 0, '', '.') . "</td>
                    <td >" . number_format($value['val_total_cnfsimples'], 2, ',', '.') . "</td>
                    <td >" . number_format($value['totalClickDetalhado'], 0, '', '.') . "</td>
                    <td >" . number_format($value['val_total_cnfdetalhado'], 2, ',', '.') . "</td>
                    <td >" . number_format($value['tb_empresa_valor_pacote'], 0, '', '.') . "</td>
                    <td >" . number_format($value['totalCreditos'], 2, ',', '.') . "</td>
                    <td >" . number_format($value['total_acumulado'], 0, '', '.') . "</td>
                    <td >" . number_format($value['VALOR_A_FATURAR'], 2, ',', '.') . "</td>
                </tr>
                               
                ";
        }

        return;
    }

    public function saidaUtilizacaoSistemaQuantitativoPorEmpresa() {

        $this->Fetch();

//var_dump($this->retorno);

        foreach ($this->retorno as $value) {

            $qtdExcedente = ($value['total'] - $value['tb_empresa_qtd_contratada']);
            $totalComExcedente = (($qtdExcedente) * $value['tb_empresa_unitario_execedente']);

            if ($qtdExcedente <= 0) {
                $qtdExcedente = "";
            }

            if ($totalComExcedente <= 0) {
                $totalComExcedente = $value['tb_empresa_valor_pacote'];
            } else {
                $totalComExcedente = $totalComExcedente + $value['tb_empresa_valor_pacote'];
            }

            echo "<tr>
                <td >" . $value['tb_credito_atual_cnpj'] . "</td>
                <td >" . $value['tb_empresa_nome'] . "</td>
                <td >" . $value['tb_empresa_qtd_contratada'] . "</td>
                <td >" . $value['tb_credito_atual_saldo'] . "</td>
                <td >" . $value['tb_empresa_permite_excedente'] . "</td>
              
                </tr>";
        }

        return;
    }

    public function saidaUtilizacaoSistemaQuantitativoPorEmail() {

        $this->Fetch();

//var_dump($this->retorno);

        foreach ($this->retorno as $value) {


            echo "<tr>
                <td >" . $value['tb_utilizacao_sistema_empresa_user'] . "</td>
                <td >" . $value['tb_empresa_nome'] . "</td>
                <td >" . $value['tb_utilizacao_sistema_filtro'] . "</td>    
                <td >" . $value['total'] . "</td>
                </tr>";
        }

        return;
    }

    public function saidaUtilizacaoSistemaQuantitativoPorUser() {

        $this->Fetch();

//var_dump($this->retorno);

        foreach ($this->retorno as $value) {
            echo "<tr>
                <td >" . $value['tb_utilizacao_sistema_empresa_user'] . "</td>
                <td >" . $value['tb_empresa_nome'] . "</td>
                <td >" . $value['tb_utilizacao_sistema_idtb_user'] . "</td>
                <td >" . $value['tb_usuario_nome'] . "</td>
                <td >" . $value['total'] . "</td>      
                <td >" . ($value['tb_credito_custo_empresa_produtos_online'] * $value['total']) . "</td>      
                </tr>";
        }

        return;
    }

    public function saidaBuscaEmpresas() {


        $this->Fetch();
        var_dump($this->retorno);

        for ($i = 0; $i < count($this->retorno); $i++) {
            echo '<option value="' . $this->retorno[$i]['tb_empresa_cnpj'] . '">' . $this->retorno[$i]['tb_empresa_nome'] . '</option>';
        }
    }

    public function buscaUtilizacaoDetalhado($dataInicial, $dataFinal, $usuario, $empresa) {


        if ($usuario == '0' || empty($usuario)) {
            $usuario = "";
        } else {
            $usuario = "AND idtb_usuario = '$usuario'";
        }

        if ($empresa != '0') {
            $empresa = "AND tb_usuario_cnpj_empresa = '$empresa' ";
        } else {
            $empresa = "";
        }


        $this->query = "SELECT * FROM dataWebProducao.tb_utilizacao_sistema 
                        LEFT JOIN tb_usuario 
                        ON tb_utilizacao_sistema.tb_utilizacao_sistema_idtb_user = tb_usuario.idtb_usuario
                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal'  
                        AND tb_utilizacao_sistema_busca LIKE '%/pages/php/buscaCpfCnpj.php?busca=%'    
                        -- OR tb_utilizacao_sistema_ip_user =''    
                        $empresa
                        $usuario
                        group by tb_utilizacao_sistema_data_hora                        
                        ORDER BY tb_utilizacao_sistema_data_hora        
                        ";
    }

    public function buscaUtilizacaoDetalhadoWebService($dataInicial, $dataFinal, $usuario, $empresa) {


        if ($usuario == '0' || empty($usuario)) {
            $usuario = "";
        } else {
            $usuario = "AND idtb_usuario = '$usuario'";
        }

        if ($empresa != '0') {
            $empresa = "AND tb_usuario_cnpj_empresa = '$empresa' ";
        } else {
            $empresa = "";
        }

        //echo "<pre>";
        //echo
        $this->query = "SELECT * FROM dataWebProducao.tb_utilizacao_sistema 
                        
                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_utilizacao_sistema.tb_utilizacao_sistema_empresa_user

                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal'  
                        AND tb_utilizacao_sistema_filtro LIKE 'webService%'    
                        -- OR tb_utilizacao_sistema_ip_user =''    
                        $empresa
                        $usuario
                        -- group by tb_utilizacao_sistema_data_hora                        
                        ORDER BY tb_utilizacao_sistema_data_hora        
                        ";
//echo "</pre>";
    }

    public function buscaEmpresas() {

        $this->query = "SELECT tb_empresa_cnpj,tb_empresa_nome FROM tb_empresa";
    }

    public function relatorioUtilizacaoSistemaDetalhado($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaUtilizacaoDetalhado($dataInicial, $dataFinal, $usuario, $empresa);

        $this->Exec();

        $this->saidaUtilizacaoSistemaDetalhado();

        return;
    }

    public function relatorioUtilizacaoSistemaDetalhadoWebService($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaUtilizacaoDetalhadoWebService($dataInicial, $dataFinal, $usuario, $empresa);

        $this->Exec();

        $this->saidaUtilizacaoSistemaDetalhadoWebService();

        return;
    }

    public function buscaUtilizacaoDetalhadoCnf($dataInicial, $dataFinal, $usuario, $empresa) {


        if ($usuario == '0' || empty($usuario)) {
            $usuario = "";
        } else {
            $usuario = "AND idtb_usuario = '$usuario'";
        }

        if ($empresa != '0') {
            $empresa = "AND tb_usuario_cnpj_empresa = '$empresa' ";
        } else {
            $empresa = "";
        }





        $this->query = "SELECT * FROM dataWebProducao.tb_utilizacao_sistema 
                        
                        LEFT JOIN tb_usuario 
                        ON tb_utilizacao_sistema.tb_utilizacao_sistema_idtb_user = tb_usuario.idtb_usuario 

                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_usuario.tb_usuario_cnpj_empresa
                        
                        
                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal'                 
                        $empresa
                        $usuario
                        AND   tb_utilizacao_sistema_filtro like '%tb_cnf  tb_cnf_cpf =%'
                        -- AND   tb_utilizacao_sistema_filtro like '%liObitoDetalhes%'
                        -- ORDER BY tb_utilizacao_sistema_data_hora
                        UNION
                        
                        SELECT * FROM dataWebProducao.tb_utilizacao_sistema 
                        
                        LEFT JOIN tb_usuario 
                        ON tb_utilizacao_sistema.tb_utilizacao_sistema_idtb_user = tb_usuario.idtb_usuario 

                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_usuario.tb_usuario_cnpj_empresa
                        
                        
                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal'                 
                        $empresa
                        $usuario
                        -- AND   tb_utilizacao_sistema_filtro like '%tb_cnf  tb_cnf_cpf =%'
                        AND   tb_utilizacao_sistema_filtro like '%liObitoDetalhes%'
                        ORDER BY tb_utilizacao_sistema_data_hora
                ";
    }

    public function buscaConsumoCreditoEnriquecimento($dataInicial, $dataFinal, $usuario, $empresa) {


        if ($empresa != '0') {
            $empresa = "AND tb_usuario_cnpj_empresa = '$empresa' ";
        } else {
            $empresa = "";
        }


        //echo "<pre>";
        //echo
        $this->query = "SELECT 
            tb_utilizacao_contagem_cnpj_empresa,
            tb_empresa.tb_empresa_nome,
            tb_credito_custo_empresa_produtos_enriquecimento,
            sum(tb_utilizacao_contagem_total_enriquecido) as totalEnriquecimento
                
            
            FROM dataWebProducao.tb_utilizacao_contagem
            
            LEFT JOIN tb_empresa
            ON tb_empresa.tb_empresa_cnpj = lpad(tb_utilizacao_contagem.tb_utilizacao_contagem_cnpj_empresa,14,'0')
            
            LEFT JOIN tb_credito_custo_empresa_produtos
            ON tb_credito_custo_empresa_produtos.tb_credito_custo_empresa_produtos_cnpj = tb_utilizacao_contagem.tb_utilizacao_contagem_cnpj_empresa
            
            where tb_utilizacao_contagem_data >='$dataInicial'
            and tb_utilizacao_contagem_data<='$dataFinal'

            group by tb_utilizacao_contagem_cnpj_empresa
            -- order by idtb_utilizacao_contagem desc";
        //echo "<pre>";
    }

    public function buscaConsumoCreditosOnline($dataInicial, $dataFinal, $usuario, $empresa) {

        if ($usuario == '0' || empty($usuario)) {
            $usuario = "";
        } else {
            $usuario = "AND idtb_usuario = '$usuario'";
        }

        if ($empresa != '0') {
            $empresa = "AND tb_usuario_cnpj_empresa = '$empresa' ";
        } else {
            $empresa = "";
        }


        //echo "<pre>";
        //echo 
        $this->query = "select tb_credito_custo_empresa_produtos_online,
                             tb_empresa.tb_empresa_nome,tb_utilizacao_sistema_empresa_user,tb_credito_custo_empresa_produtos_web_service,
                             count(1) as totalOnline
            

                        FROM dataWebProducao.tb_utilizacao_sistema 
                        
                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_utilizacao_sistema.tb_utilizacao_sistema_empresa_user
                        
                        LEFT JOIN tb_credito_custo_empresa_produtos
                        ON tb_credito_custo_empresa_produtos.tb_credito_custo_empresa_produtos_cnpj = tb_utilizacao_sistema.tb_utilizacao_sistema_empresa_user
                        
                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal'  
                        AND tb_utilizacao_sistema_busca LIKE '%/php/buscaCpfCnpj.php?busca=%'
                        
                         group by tb_utilizacao_sistema_empresa_user";
        //echo "<pre>";
    }

    public function buscaConsumoCreditosWebService($dataInicial, $dataFinal, $usuario, $empresa) {

        if ($usuario == '0' || empty($usuario)) {
            $usuario = "";
        } else {
            $usuario = "AND idtb_usuario = '$usuario'";
        }

        if ($empresa != '0') {
            $empresa = "AND empresa.tb_empresa_cnpj= '$empresa' ";
        } else {
            $empresa = "";
        }

        $sql = "/*Cria tabela temporaria com todas as usuarios */
                       create temporary table usuario(
                       SELECT distinct * FROM dataWebProducao.tb_usuario);";

        $this->result = mysql_query($sql);

        if (!$this->result) {
            die('Invalid query: err-->' . mysql_error());
        }

        $sql = "/*Cria tabela temporaria com todas as empresa */
                       create temporary table empresa(
                       SELECT distinct tb_empresa.tb_empresa_cnpj,tb_empresa_nome FROM dataWebProducao.tb_empresa);";

        $this->result = mysql_query($sql);

        if (!$this->result) {
            die('Invalid query: err-->' . mysql_error());
        }

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


        $this->result = mysql_query($sql);

        if (!$this->result) {
            die('Invalid query: err-->' . mysql_error());
        }

        $sql = "create temporary table on_line(
                       select
                       tb_utilizacao_sistema_empresa_user as cnpj,
                       tb_empresa.tb_empresa_nome as nome,
                       tb_credito_custo_empresa_produtos_online as val_unitario_online,
                                                                                 count(1) as totalOnline,
                       tb_credito_custo_empresa_produtos_online * count(1) as val_total_online
 
                        FROM dataWebProducao.tb_utilizacao_sistema
                        
                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_utilizacao_sistema.tb_utilizacao_sistema_empresa_user
                       
                        LEFT JOIN tb_credito_custo_empresa_produtos
                        ON tb_credito_custo_empresa_produtos.tb_credito_custo_empresa_produtos_cnpj = tb_utilizacao_sistema.tb_utilizacao_sistema_empresa_user
                       
                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal' 
                        AND tb_utilizacao_sistema_busca LIKE '%/php/buscaCpfCnpj.php?busca=%'
                       
                         group by tb_utilizacao_sistema_empresa_user);";



        $this->result = mysql_query($sql);

        if (!$this->result) {
            die('Invalid query: err-->' . mysql_error());
        }

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


        $this->result = mysql_query($sql);

        if (!$this->result) {
            die('Invalid query: err-->' . mysql_error());
        }

        $sql = "create temporary table cnf(                                     
                                               SELECT
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
                    
                        GROUP BY tb_empresa_cnpj
                        ORDER BY tb_empresa_nome);";

        $this->result = mysql_query($sql);

        if (!$this->result) {
            die('Invalid query: err-->' . mysql_error());
        }

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

        $this->result = mysql_query($sql);

        if (!$this->result) {
            die('Invalid query: err-->' . mysql_error());
        }
        //echo "<pre>";
        //echo
        $this->query = " 
                                               /*finaliza dados retorno geral*/
                        
 
select
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
left join on_line on convert(on_line.cnpj, signed) = convert(empresa.tb_empresa_cnpj, signed)
left join enriq on convert(enriq.cnpj, signed) = convert(empresa.tb_empresa_cnpj, signed)
left join cnf on convert(cnf.cnpj, signed) = convert(empresa.tb_empresa_cnpj, signed)
left join pacote on convert(pacote.cnpj, signed) = convert(empresa.tb_empresa_cnpj, signed)

 
where 1=1
 $empresa
 $usuario
";
        //echo "<pre>";
    }

    public function buscaConsumoCreditoTotal($dataInicial, $dataFinal, $usuario, $empresa) { {

            if ($usuario == '0' || empty($usuario)) {
                $usuario = "";
            } else {
                $usuario = "AND idtb_usuario = '$usuario'";
            }

            if ($empresa != '0') {
                $empresa = "AND tb_usuario_cnpj_empresa = '$empresa' ";
            } else {
                $empresa = "";
            }


            //echo "<pre>";
            //echo
            $this->query = "select tb_empresa_cnpj,tb_empresa_nome,count(1)as total                    
              
              
                        FROM dataWebProducao.tb_utilizacao_sistema as tb_util


                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_util.tb_utilizacao_sistema_empresa_user
                        
                        LEFT JOIN tb_utilizacao_contagem
                        ON tb_utilizacao_contagem.tb_utilizacao_contagem_cnpj_empresa=tb_empresa.tb_empresa_cnpj
                        

                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal' 
                        $usuario
                        $empresa
                        
                        GROUP BY tb_utilizacao_sistema_empresa_user
                        ORDER BY tb_empresa_nome";
            //echo "<pre>";
        }
    }

    public function buscaConsumoCreditoContratadoInseridosTotal($dataInicial, $dataFinal, $usuario, $empresa) {

        if ($empresa != '0') {
            $empresa = "AND tb_usuario_cnpj_empresa = '$empresa' ";
        } else {
            $empresa = "";
        }

        //echo "<pre>";
        //echo
        $this->query = "SELECT tb_empresa_permite_excedente,
            tb_empresa_cnpj,
            tb_empresa_nome,
            tb_empresa_qtd_contratada,
            
            (select sum(tb_creditos_valor) from tb_creditos
            where tb_creditos.tb_creditos_empresa = tb_empresa.tb_empresa_cnpj)as totalCreditos
              
              
                        FROM dataWebProducao.tb_utilizacao_sistema as tb_util

                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_empresa.tb_empresa_cnpj
                       

                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal' 
                        
                        $empresa
                        
                        GROUP BY tb_empresa_cnpj
                        ORDER BY tb_empresa_nome";
        //echo "<pre>";
    }

    public function buscaConsumoCreditoCnfSimples($dataInicial, $dataFinal, $usuario, $empresa) {


        if ($usuario == '0' || empty($usuario)) {
            $usuario = "";
        } else {
            $usuario = "AND idtb_usuario = '$usuario'";
        }

        if ($empresa != '0') {
            $empresa = "AND tb_usuario_cnpj_empresa = '$empresa' ";
        } else {
            $empresa = "";
        }


//echo "<pre>";
//echo
        $this->query = "SELECT *,count(tb_utilizacao_sistema_idtb_user) as totalClikSimples,
            
                        (SELECT count(*) FROM dataWebProducao.tb_utilizacao_sistema 
                        LEFT JOIN tb_usuario 
                        ON tb_utilizacao_sistema.tb_utilizacao_sistema_idtb_user = tb_usuario.idtb_usuario 
                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_usuario.tb_usuario_cnpj_empresa
                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal'             
                        AND tb_utilizacao_sistema_empresa_user = tb_util.tb_utilizacao_sistema_empresa_user
                        AND   tb_utilizacao_sistema_filtro like '%tb_cnfnew  tb_cnfnew_cpf =%'
                         $empresa
                        $usuario
                        ) as totalClikDetalhado
                      
              
              
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
                        $empresa
                        $usuario
                        GROUP BY tb_empresa_cnpj
                        ORDER BY tb_empresa_nome";
        //echo "<pre>";
    }

    public function buscaUtilizacaoQuantitativoPorUser($dataInicial, $dataFinal, $usuario, $empresa) {


        if ($usuario == '0' || empty($usuario)) {
            $usuario = "";
        } else {
            $usuario = "AND idtb_usuario = '$usuario'";
        }

        if ($empresa != '0') {
            $empresa = "AND tb_usuario_cnpj_empresa = '$empresa' ";
        } else {
            $empresa = "";
        }


// echo "<pre>";
        $this->query = "SELECT *,count(tb_utilizacao_sistema_idtb_user) as total FROM dataWebProducao.tb_utilizacao_sistema 

                        LEFT JOIN tb_usuario 
                        ON tb_utilizacao_sistema.tb_utilizacao_sistema_idtb_user = tb_usuario.idtb_usuario 

                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_usuario.tb_usuario_cnpj_empresa
                        
                        LEFT JOIN tb_credito_custo_empresa_produtos
                        ON tb_credito_custo_empresa_produtos.tb_credito_custo_empresa_produtos_cnpj = tb_empresa.tb_empresa_cnpj

                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal' 
                        AND tb_utilizacao_sistema_busca LIKE '%/php/buscaCpfCnpj.php?busca=%' 
                        -- OR tb_utilizacao_sistema_ip_user =''
                        $empresa
                        $usuario
                        GROUP BY tb_utilizacao_sistema_idtb_user
                        ORDER BY tb_empresa_nome";
        //echo "<pre>";
    }

    public function buscaUtilizacaoQuantitativoPorEmpresa($dataInicial, $dataFinal, $usuario, $empresa) {



        if ($empresa != '0') {
            $empresa = "AND tb_credito_atual_cnpj = '$empresa' ";
        } else {
            $empresa = "";
        }



        $this->query = "SELECT *
            
                         FROM dataWebProducao.tb_credito_atual

                       

                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_credito_atual.tb_credito_atual_cnpj
                        
                        where 1=1
                        $empresa

                        ORDER BY tb_credito_atual_cnpj";
    }

    public function buscaUtilizacaoQuantitativoPorEmail($dataInicial, $dataFinal, $usuario, $empresa) {



        if ($usuario == '0' || empty($usuario)) {
            $usuario = "";
        } else {
            $usuario = "AND idtb_usuario = '$usuario'";
        }

        if ($empresa != '0') {
            $empresa = "AND tb_utilizacao_sistema_empresa_user = '$empresa' ";
        } else {
            $empresa = "";
        }
        echo "<pre>";


        $this->query = "SELECT *,count(tb_utilizacao_sistema_empresa_user) as total FROM dataWebProducao.tb_utilizacao_sistema 

                        LEFT JOIN tb_usuario 
                        ON tb_utilizacao_sistema.tb_utilizacao_sistema_idtb_user = tb_usuario.idtb_usuario 

                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_utilizacao_sistema_empresa_user

                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal' 
                            
                        $empresa
                        $usuario
                        AND tb_utilizacao_sistema_filtro LIKE 'envio email - busca por%' 
                        -- OR tb_utilizacao_sistema_ip_user =''
                       
                        GROUP BY tb_utilizacao_sistema_empresa_user
                        ORDER BY tb_empresa_nome";
    }

    public function buscaUtilizacaoQuantitativoCnf($dataInicial, $dataFinal, $usuario, $empresa) {


        if ($usuario == '0' || empty($usuario)) {
            $usuario = "";
        } else {
            $usuario = "AND idtb_usuario = '$usuario'";
        }

        if ($empresa != '0') {
            $empresa = "AND tb_usuario_cnpj_empresa = '$empresa' ";
        } else {
            $empresa = "";
        }

        //echo "<pre>";
        //echo
        $this->query = "SELECT *,count(tb_utilizacao_sistema_idtb_user) as totalClikSimples,
            
                        (SELECT count(*) FROM dataWebProducao.tb_utilizacao_sistema 
                        LEFT JOIN tb_usuario 
                        ON tb_utilizacao_sistema.tb_utilizacao_sistema_idtb_user = tb_usuario.idtb_usuario 
                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_usuario.tb_usuario_cnpj_empresa
                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal'             
                        AND tb_utilizacao_sistema_empresa_user = tb_util.tb_utilizacao_sistema_empresa_user
                        AND   tb_utilizacao_sistema_filtro like '%tb_cnfnew  tb_cnfnew_cpf =%'
                         $empresa
                        $usuario
                        ) as total
                      
              
              
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
                        $empresa
                        $usuario
                        GROUP BY tb_empresa_cnpj
                        ORDER BY tb_empresa_nome";
        //echo "</pre>";
        //die("..");
    }

    public function buscaUtilizacaoQuantitativoWebService($dataInicial, $dataFinal, $usuario, $empresa) {


        if ($empresa) {
            $empresa = "AND tb_utilizacao_sistema.tb_utilizacao_sistema_empresa_user = '$empresa' ";
        } else {

            $empresa = "";
        }

        //echo "<pre>";
        //echo
        $this->query = "SELECT *,count(1) as total 
            
                        FROM dataWebProducao.tb_utilizacao_sistema 
                        
                        LEFT JOIN tb_empresa
                        ON tb_empresa.tb_empresa_cnpj = tb_utilizacao_sistema.tb_utilizacao_sistema_empresa_user
                        
                        LEFT JOIN tb_credito_custo_empresa_produtos p 
                        ON p.tb_credito_custo_empresa_produtos_cnpj = tb_empresa.tb_empresa_cnpj

                        WHERE tb_utilizacao_sistema_data_hora >= '$dataInicial'
                        AND tb_utilizacao_sistema_data_hora <= '$dataFinal'  
                        AND tb_utilizacao_sistema_filtro LIKE 'webService%'      
			$empresa    
                        
                        
                        group by tb_utilizacao_sistema_empresa_user                        
                        ORDER BY tb_utilizacao_sistema_data_hora ";
        //echo "</pre>";
        //die("..");
    }

    public function relatorioUtilizacaoSistemaQuantitativoPorUser($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaUtilizacaoQuantitativoPorUser($dataInicial, $dataFinal, $usuario, $empresa);
        $this->Exec();
        $this->saidaUtilizacaoSistemaQuantitativoPorUser();
        return;
    }

    public function relatorioConsumoCreditosTotal($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaConsumoCreditoTotal($dataInicial, $dataFinal, $usuario, $empresa);
        $this->Exec();
        $this->saidaConsumoCreditosTotal();
    }

    public function relatorioConsumoCreditosContratadoInseridosTotal($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaConsumoCreditoContratadoInseridosTotal($dataInicial, $dataFinal, $usuario, $empresa);
        $this->Exec();
        $this->saidaConsumoCreditosContratadoInseridosTotal();
    }

    public function relatorioConsumoCreditosCnfSimples($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaConsumoCreditoCnfSimples($dataInicial, $dataFinal, $usuario, $empresa);
        $this->Exec();
        $this->saidaConsumoCreditosCnfSimples();
        return;
    }

    public function relatorioConsumoCreditosEnriquecimento($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaConsumoCreditoEnriquecimento($dataInicial, $dataFinal, $usuario, $empresa);
        $this->Exec();
        $this->saidaConsumoCreditosEnriquecimento();
        return;
    }

    public function relatorioConsumoCreditosOnline($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaConsumoCreditosOnline($dataInicial, $dataFinal, $usuario, $empresa);
        $this->Exec();
        $this->saidaConsumoCreditosOnline();
        return;
    }

    public function relatorioConsumoCreditosWebService($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaConsumoCreditosWebService($dataInicial, $dataFinal, $usuario, $empresa);
        $this->Exec();
        $this->saidaConsumoCreditosWebService($empresa);


        return true;
    }

    public function relatorioUtilizacaoSistemaQuantitativoPorEmpresa($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaUtilizacaoQuantitativoPorEmpresa($dataInicial, $dataFinal, $usuario, $empresa);
        $this->Exec();
        $this->saidaUtilizacaoSistemaQuantitativoPorEmpresa();
        return;
    }

    public function relatorioUtilizacaoSistemaDetalhadoCnf($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaUtilizacaoDetalhadoCnf($dataInicial, $dataFinal, $usuario, $empresa);
        $this->Exec();
        $this->saidaUtilizacaoSistemaDetalhadoCnf();
        return;
    }

    public function relatorioUtilizacaoSistemaQuantitativoCnf($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaUtilizacaoQuantitativoCnf($dataInicial, $dataFinal, $usuario, $empresa);
        $this->Exec();
        $this->saidaUtilizacaoSistemaQuantitativoCnf();
        return;
    }

    public function relatorioUtilizacaoSistemaQuantitativoWebService($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaUtilizacaoQuantitativoWebService($dataInicial, $dataFinal, $usuario, $empresa);

        $this->Exec();
        $this->saidaUtilizacaoSistemaQuantitativoWebService();
        return;
    }

    public function relatorioUtilizacaoSistemaQuantitativoEmail($dataInicial, $dataFinal, $usuario, $empresa) {

        $this->buscaUtilizacaoQuantitativoPorEmail($dataInicial, $dataFinal, $usuario, $empresa);
        $this->Exec();
        $this->saidaUtilizacaoSistemaQuantitativoPorEmail();
        return;
    }

    public function getAllEmpresas() {

        $this->buscaEmpresas();
        $this->Exec();

        $this->saidaBuscaEmpresas();
        return;
    }

    function converte_data($data) {

        /*
         * Caso a data tenha horas, 
         * separa a data da hora.
         */
        $hora = '';

        if (strstr($data, ' ')) {
            $data = explode(' ', $data);

            $hora = $data[1];
            $data = $data[0];
        }

        /*
         * Reorganiza a data para ficar 
         * no padrão americano.
         * yyyy-mm-dd hh:mm:ss
         */
        $data = explode('/', $data);
        $data = array_reverse($data);
        $data = implode('-', $data);

        /*
         * Se a data possui hora,
         * a função retorna a data e hora.
         * Caso não exista hora,
         * retorna apenas a data
         */
        if ($hora != '') {
            return $data . ' ' . $hora;
        } else {
            return $data;
        }
    }

}

?>