<?php

error_reporting(0); // sem msg de erro
/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 * 
 */
die(".");
require_once '/var/www/html/classes/class-TutsupDB.php';
require_once '/var/www/html/classes/class-EnviaEmailSes.php';
require_once '/var/www/html/classes/class-ValidaCpfCnpj.php';
require_once '/var/www/html/classes/class-ManipulaArquivo.php';
require_once '/var/www/html/vendor/autoload.php';
require_once '/var/www/html/classes/class-controleCustos.php';

class ProcessaArquivo extends TutsupDB {

    protected $arquivoArray;
    protected $busca;
    protected $db;
    public $porte;
    public $processaArquivo;
    public $validaCpfCnpj;
    public $enviaEmailSes;
    public $controleCustos;

    public function leArquivo($arquivo, $idEmriquecimeto, $empresaCnpj) {
//die("...");

        $this->enviaEmailSes = new enviaEmailSes();
        $this->db = new TutsupDB();
        $this->controleCustos = new controleCustos();
        $this->processaArquivo = new ProcessaArquivo();

        $this->arquivoArray = file($arquivo);

        //$this->atualizaArquivoEmProcesamento($idEmriquecimeto); 

                    
        $nomeTabela = "tabelaGeracao_" . $idEmriquecimeto;

        $query = "SELECT * FROM dataWebProducao.tb_enriquecimento_filtros
                    WHERE tb_enriquecimento_filtros_idtb_enriquecimento =$idEmriquecimeto";

        $db_retornoQuery = $this->db->query($query);
        $fetch_query = $db_retornoQuery->fetchAll();

        foreach ($fetch_query as $key => $value) {
            if ($value['tb_enriquecimento_filtros_nome_campo'] == 'tipoArquivoEntrada') {
                $tipoArquivoEntradaArquivo = $value['tb_enriquecimento_filtros_filtro'];
            }
        }

        $tipoEntrada = is_numeric($tipoArquivoEntradaArquivo);
        echo ">>id - " . $idEmriquecimeto . "\n";
        echo ">>>Tipo de Arquivo - " . $tipoArquivoEntradaArquivo . "\n";
        

        if ($tipoEntrada) {
            for ($i = 0; $i < count($this->arquivoArray); $i++) {
                if ($i == 0) {
                    for ($i2 = 0; $i2 < count($this->arquivoArray[$i]); $i2++) {
                        $cabecalhoArquivo = (explode(',', $this->arquivoArray[$i2]));
                        $cabecalhoArquivoSeparado = $this->arquivoArray[$i2];
                    }
                } else {
                    for ($i3 = 0; $i3 < count($this->arquivoArray[$i3]); $i3++) {
                        $corpoArquivo = (explode(',', $this->arquivoArray[$i]));
                    }
                }
                $arrayArquivo[] = (array_combine($cabecalhoArquivo, $corpoArquivo));
            }
        } else {
            $cabecalhoArquivoSeparado = $this->arquivoArray;
        }



        $qtdMaxRegistros = "SELECT tb_empresa_qtd_max_registros,tb_empresa_permite_excedente,tb_empresa_qtd_contratada FROM tb_empresa where tb_empresa_cnpj = '$empresaCnpj'";
        $db_retornoMR = $this->db->query($qtdMaxRegistros);
        $fetch_userMR = $db_retornoMR->fetchAll();
        $qtdProcessar = count($this->arquivoArray);


        if ($tipoEntrada) {

            echo ">>>>>>>>>>>>>>> Entrada" . $tipoArquivoEntradaArquivo . "\n";

            for ($i = 1; $i < count($arrayArquivo); $i++) {

                switch ($tipoArquivoEntradaArquivo) {
                    case 0:

                        break;
                    case 1:
                        $arrayArc = $arrayArquivo[$i]['CPF_CNPJ'];
                        $chaveAtualiza = 'CPF_CNPJ';
                        $tabelaCsv = $nomeTabela . "_csv";
                        $tabelaBanco = $nomeTabela . "_banco";

                        $campoFixo1 = 'FIXO1';
                        $campoFixo2 = 'FIXO2';
                        $campoFixo3 = 'FIXO3';
//die(".");
                        $campoCel1 = 'CEL1';
                        $campoCel2 = 'CEL2';
                        $campoCel3 = 'CEL3';
                        $celEntrada = "($campoCel1,$campoCel2,$campoCel3)";

                        $telEntrada = "
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo1,1,2),substr($campoFixo1,3) FROM $tabelaCsv WHERE CAST($campoFixo1 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo2,1,2),substr($campoFixo2,3) FROM $tabelaCsv WHERE CAST($campoFixo2 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo3,1,2),substr($campoFixo3,3) FROM $tabelaCsv WHERE CAST($campoFixo3 AS signed) > 0;

                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel1,1,2),substr($campoCel1,3) FROM $tabelaCsv WHERE CAST($campoCel1 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel2,1,2),substr($campoCel2,3) FROM $tabelaCsv WHERE CAST($campoCel2 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel3,1,2),substr($campoCel3,3) FROM $tabelaCsv WHERE CAST($campoCel3 AS signed) > 0;";


                        $cepCsv = 'CEP';
                        $numeroCsv = 'NÚMERO';
                        $enderecoCsv = 'ENDEREÇO';
                        $complementoCsv = 'COMPLEMENTO';
                        $bairroCsv = 'BAIRRO';
                        $cidadeCsv = 'CIDADE';
                        $ufCsv = 'UF';


                        break;
                    case 2:
                        $arrayArc = $arrayArquivo[$i]['CPF_CNPJ'];
                        $chaveAtualiza = 'CPF_CNPJ';
                        $tabelaCsv = $nomeTabela . "_csv";
                        $tabelaBanco = $nomeTabela . "_banco";

                        $campoFixo1 = 'CONCAT(DDD_COM1,FONE_COM1)';
                        $campoFixo2 = 'CONCAT(DDD_COM2,FONE_COM2)';
                        $campoFixo3 = 'CONCAT(DDD_COM3,FONE_COM3)';
                        $telEntrada = "
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo1,1,2),substr($campoFixo1,3) FROM $tabelaCsv WHERE CAST($campoFixo1 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo2,1,2),substr($campoFixo2,3) FROM $tabelaCsv WHERE CAST($campoFixo2 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo3,1,2),substr($campoFixo3,3) FROM $tabelaCsv WHERE CAST($campoFixo3 AS signed) > 0;";

                        $cepCsv = 'CEP';
                        $numeroCsv = 'NUMERO';
                        $enderecoCsv = 'END_LOGRADOURO';
                        $complementoCsv = 'COMPLEMENTO';
                        $bairroCsv = 'BAIRRO';
                        $cidadeCsv = 'CIDADE';
                        $ufCsv = 'UF';

                        break;
                    case 3:
                        $arrayArc = $arrayArquivo[$i]['CPF'];
                        $chaveAtualiza = 'CPF';
                        $tabelaCsv = $nomeTabela . "_csv";
                        $tabelaBanco = $nomeTabela . "_banco";

                        $tel1 = 'Telefone_Fixo_01';
                        $tel2 = 'Telefone_Fixo_02';
                        $tel3 = 'Telefone_Fixo_03';
                        $tel4 = 'Telefone_Fixo_04';
                        $tel5 = 'Telefone_Fixo_05';

                        $campoFixo1 = 'Telefone_01';
                        $campoFixo2 = 'Telefone_02';
                        $campoFixo3 = 'Telefone_03';
                        $campoFixo4 = 'Telefone_04';
                        $campoFixo5 = 'Telefone_05';

                        $campoCel1 = 'Telefone_Celular_01';
                        $operadoraCel1 = 'Telefone_Operadora_01';
                        $campoCel2 = 'Telefone_Celular_02';
                        $operadoraCel2 = 'Telefone_Operadora_02';
                        $campoCel3 = 'Telefone_Celular_03';
                        $operadoraCel3 = 'Telefone_Operadora_03';
                        $campoCel4 = 'Telefone_Celular_04';
                        $operadoraCel4 = 'Telefone_Operadora_04';
                        $campoCel5 = 'Telefone_Celular_05';
                        $operadoraCel5 = 'Telefone_Operadora_05';


                        $telEntrada = "
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo1,1,2),substr($campoFixo1,3) FROM $tabelaCsv WHERE CAST($campoFixo1 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo2,1,2),substr($campoFixo2,3) FROM $tabelaCsv WHERE CAST($campoFixo2 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo3,1,2),substr($campoFixo3,3) FROM $tabelaCsv WHERE CAST($campoFixo3 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo4,1,2),substr($campoFixo4,3) FROM $tabelaCsv WHERE CAST($campoFixo4 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo5,1,2),substr($campoFixo5,3) FROM $tabelaCsv WHERE CAST($campoFixo5 AS signed) > 0;

                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel1,1,2),substr($campoCel1,3) FROM $tabelaCsv WHERE CAST($campoCel1 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel2,1,2),substr($campoCel2,3) FROM $tabelaCsv WHERE CAST($campoCel2 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel3,1,2),substr($campoCel3,3) FROM $tabelaCsv WHERE CAST($campoCel3 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel4,1,2),substr($campoCel4,3) FROM $tabelaCsv WHERE CAST($campoCel4 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel5,1,2),substr($campoCel5,3) FROM $tabelaCsv WHERE CAST($campoCel5 AS signed) > 0;
                                        ";

                        break;
                    case 4:
                        $arrayArc = $arrayArquivo[$i]['CPF'];
                        $chaveAtualiza = 'CPF';
                        $tabelaCsv = $nomeTabela . "_csv";
                        $tabelaBanco = $nomeTabela . "_banco";

                        $campoFixo1 = 'CONCAT(01_DDD,01_FONE)';
                        $campoFixo2 = 'CONCAT(02_DDD,02_FONE)';
                        $campoFixo3 = 'CONCAT(03_DDD,03_FONE)';
                        $campoFixo4 = 'CONCAT(04_DDD,04_FONE)';
                        $campoFixo5 = 'CONCAT(05_DDD,05_FONE)';
                        $campoFixo6 = 'CONCAT(06_DDD,06_FONE)';
                        $campoFixo7 = 'CONCAT(07_DDD,07_FONE)';
                        $campoFixo8 = 'CONCAT(08_DDD,08_FONE)';


                        $cepCsv = 'CEP';
                        $numeroCsv = "'' as NUMERO";
                        $enderecoCsv = 'ENDERECO';
                        $complementoCsv = 'COMPLEMENTO';
                        $bairroCsv = 'BAIRRO';
                        $cidadeCsv = 'CIDADE';
                        $ufCsv = 'UF';

                        $cepCsv2 = 'CEP2';
                        $numeroCsv2 = "'' as NUMERO";
                        $enderecoCsv2 = 'ENDERECO2';
                        $complementoCsv2 = 'COMPLEMENTO';
                        $bairroCsv2 = 'BAIRRO2';
                        $cidadeCsv2 = 'CIDADE2';
                        $ufCsv2 = 'UF2';

                        $telEntrada = "
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo1,1,2),substr($campoFixo1,3) FROM $tabelaCsv WHERE CAST($campoFixo1 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo2,1,2),substr($campoFixo2,3) FROM $tabelaCsv WHERE CAST($campoFixo2 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo3,1,2),substr($campoFixo3,3) FROM $tabelaCsv WHERE CAST($campoFixo3 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo4,1,2),substr($campoFixo4,3) FROM $tabelaCsv WHERE CAST($campoFixo4 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo5,1,2),substr($campoFixo5,3) FROM $tabelaCsv WHERE CAST($campoFixo5 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo6,1,2),substr($campoFixo6,3) FROM $tabelaCsv WHERE CAST($campoFixo6 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo7,1,2),substr($campoFixo7,3) FROM $tabelaCsv WHERE CAST($campoFixo7 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo8,1,2),substr($campoFixo8,3) FROM $tabelaCsv WHERE CAST($campoFixo8 AS signed) > 0;

                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel1,1,2),substr($campoCel1,3) FROM $tabelaCsv WHERE CAST($campoCel1 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel2,1,2),substr($campoCel2,3) FROM $tabelaCsv WHERE CAST($campoCel2 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel3,1,2),substr($campoCel3,3) FROM $tabelaCsv WHERE CAST($campoCel3 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel4,1,2),substr($campoCel4,3) FROM $tabelaCsv WHERE CAST($campoCel4 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel5,1,2),substr($campoCel5,3) FROM $tabelaCsv WHERE CAST($campoCel5 AS signed) > 0;
                                        ";

                        break;
                    case 5:
                        $arrayArc = $arrayArquivo[$i]['Documento'];
                        $chaveAtualiza = 'Documento';
                        $tabelaCsv = $nomeTabela . "_csv";
                        $tabelaBanco = $nomeTabela . "_banco";
                        break;
                    case 6:
                        $arrayArc = $arrayArquivo[$i]['C02_CPF'];
                        $chaveAtualiza = 'C02_CPF';
                        $tabelaCsv = $nomeTabela . "_csv";
                        break;
                    case 7:
                        $arrayArc = $arrayArquivo[$i]['tb_pessoa_fisica_cpf'];
                        $chaveAtualiza = 'tb_pessoa_fisica_cpf';
                        $tabelaCsv = $nomeTabela . "_csv";
                        $tabelaBanco = $nomeTabela . "_banco";

                        $campoFixo1 = 'CONCAT(ddd1,fone1)';
                        $campoFixo2 = 'CONCAT(ddd2,fone2)';
                        $campoFixo3 = 'CONCAT(ddd3,fone3)';


                        $campoCel1 = 'CONCAT(ddd_cel1,fone_cel1)';
                        $campoCel2 = 'CONCAT(ddd_cel2,fone_cel2)';
                        $campoCel3 = 'CONCAT(ddd_cel3,fone_cel3)';

                        $telEntrada = "
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo1,1,2),substr($campoFixo1,3) FROM $tabelaCsv WHERE CAST($campoFixo1 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo2,1,2),substr($campoFixo2,3) FROM $tabelaCsv WHERE CAST($campoFixo2 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo3,1,2),substr($campoFixo3,3) FROM $tabelaCsv WHERE CAST($campoFixo3 AS signed) > 0;

                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel1,1,2),substr($campoCel1,3) FROM $tabelaCsv WHERE CAST($campoCel1 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel2,1,2),substr($campoCel2,3) FROM $tabelaCsv WHERE CAST($campoCel2 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel3,1,2),substr($campoCel3,3) FROM $tabelaCsv WHERE CAST($campoCel3 AS signed) > 0;";


                        break;
                    case 8:
                        $arrayArc = $arrayArquivo[$i]['tb_pessoa_fisica_cpf'];
                        $chaveAtualiza = 'tb_pessoa_fisica_cpf';
                        $tabelaCsv = $nomeTabela . "_csv";
                        $tabelaBanco = $nomeTabela . "_banco";

                        $campoFixo1 = 'CONCAT(DDD_RESIDENCIAL,FONE_RESIDENCIAL)';
                        $campoFixo2 = 'CONCAT(DDD_OUTROS_1,FONE_OUTROS_1)';
                        $campoFixo3 = 'CONCAT(DDD_OUTROS_2,FONE_OUTROS_2)';
                        $campoFixo4 = 'CONCAT(DDD_OUTROS_3,FONE_OUTROS_3)';
                        $campoFixo5 = 'CONCAT(DDD_OUTROS_4,FONE_OUTROS_4)';
                        $campoFixo6 = 'CONCAT(DDD_OUTROS_5,FONE_OUTROS_5)';
                        $campoFixo7 = 'CONCAT(DDD_OUTROS_6,FONE_OUTROS_6)';
                        $campoFixo8 = 'CONCAT(DDD_OUTROS_7,FONE_OUTROS_7)';


                        $campoCel1 = 'CONCAT(DDD_CELULAR,FONE_CELULAR)';
                        $campoCel2 = 'CONCAT(DDD_CELULAR,FONE_CELULAR)';
                        $campoCel3 = 'CONCAT(DDD_CELULAR,FONE_CELULAR)';
                        $telEntrada = "
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo1,1,2),substr($campoFixo1,3) FROM $tabelaCsv WHERE CAST($campoFixo1 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo2,1,2),substr($campoFixo2,3) FROM $tabelaCsv WHERE CAST($campoFixo2 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo3,1,2),substr($campoFixo3,3) FROM $tabelaCsv WHERE CAST($campoFixo3 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo4,1,2),substr($campoFixo4,3) FROM $tabelaCsv WHERE CAST($campoFixo4 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo5,1,2),substr($campoFixo5,3) FROM $tabelaCsv WHERE CAST($campoFixo5 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo6,1,2),substr($campoFixo6,3) FROM $tabelaCsv WHERE CAST($campoFixo6 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo7,1,2),substr($campoFixo7,3) FROM $tabelaCsv WHERE CAST($campoFixo7 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoFixo8,1,2),substr($campoFixo8,3) FROM $tabelaCsv WHERE CAST($campoFixo8 AS signed) > 0;

                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel1,1,2),substr($campoCel1,3) FROM $tabelaCsv WHERE CAST($campoCel1 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel2,1,2),substr($campoCel2,3) FROM $tabelaCsv WHERE CAST($campoCel2 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel3,1,2),substr($campoCel3,3) FROM $tabelaCsv WHERE CAST($campoCel3 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel4,1,2),substr($campoCel4,3) FROM $tabelaCsv WHERE CAST($campoCel4 AS signed) > 0;
                INSERT INTO TEL1 (CPF,DDD,FONE) SELECT $chaveAtualiza,substr($campoCel5,1,2),substr($campoCel5,3) FROM $tabelaCsv WHERE CAST($campoCel5 AS signed) > 0;
                                        ";

                        break;
                }


                $cpfs .="'" . trim($arrayArc) . "',";
            }

//die(".");

            $cpfsSaida = str_replace("''", "", $cpfs);
            $cpfsSaida = substr($cpfsSaida, 0, -2);


//$cpfsSaida = substr($cpfsSaida, 1);
        } else {

            $tabelaCsv = $nomeTabela . "_csv";
            $tabelaBanco = $nomeTabela . "_banco";

            foreach ($this->arquivoArray as $key => $value) {

                $cpfs .="'" . trim($value) . "',";
            }
            $cpfsSaida = str_replace("''", "", $cpfs);
            $cpfsSaida = substr($cpfsSaida, 0, -2);

            if (substr($cpfsSaida, -1) == "'") {
                //retira ultimo caracter
                echo substr($cpfsSaida, -1) . "chegou";
                $cpfsSaida = substr($cpfsSaida, 0, -2);
            }
            //print_r($cpfsSaida);
            //die('\n');
        }


//LIBERA MEMORIA
        unset($this->arquivoArray);
        unset($cpfs);

//$this->processaArquivo->atualizaArquivoEmProcesamento($idEmriquecimeto);

        $query = "SELECT * FROM dataWebProducao.tb_enriquecimento
                    LEFT JOIN tb_enriquecimento_filtros
                    ON tb_enriquecimento_filtros.tb_enriquecimento_filtros_idtb_enriquecimento = tb_enriquecimento.idtb_enriquecimento
                    WHERE tb_enriquecimento_filtros_idtb_enriquecimento =$idEmriquecimeto";

        $db_retornoQuery = $this->db->query($query);
        $fetch_query = $db_retornoQuery->fetchAll();

        $camposSelect = array();

        foreach ($fetch_query as $key => $value) {

            if ($value['tb_enriquecimento_filtros_nome_campo'] == 'tipoArquivo') {
                $tipoArquivo = $value['tb_enriquecimento_filtros_filtro'];
            }

            switch ($tipoArquivo) {
                case 0:

                    break;
                case 1:

                    $chaveAtualizaSaida = 'CPF_CNPJ';

                    break;
                case 2:

                    $chaveAtualizaSaida = 'CPF_CNPJ';

//die("..");
                    break;
                case 3:

                    $chaveAtualizaSaida = 'CPF';

                    break;
                case 4:

                    $chaveAtualizaSaida = 'CPF';
                    break;
                case 5:

                    $chaveAtualizaSaida = 'Documento';
                    break;
                case 6:

                    $chaveAtualizaSaida = 'C02_CPF';
                    break;
                case 7:

                    $chaveAtualizaSaida = 'tb_pessoa_fisica_cpf';
                    break;
                case 8:

                    $chaveAtualizaSaida = 'tb_pessoa_fisica_cpf';
                    break;
            }
        }
//echo ">>>".$chaveAtualizaSaida."\n";
//die(".");
        foreach ($fetch_query as $key => $value) {

//procon
            if ($value['tb_enriquecimento_filtros_nome_campo'] == 'procon') {

                if (!empty($value['tb_enriquecimento_filtros_filtro']) || $value['tb_enriquecimento_filtros_filtro'] != '' || $value['tb_enriquecimento_filtros_filtro'] = 'Sem') {

                    $joinSemProcon = "   
                              left join tb_procon 
                              ON tb_procon.tb_procon_ddd = $tabelaBanco.tb_pessoa_fisica_fones_ddd
                              AND tb_procon.tb_procon_fone = $tabelaBanco.tb_pessoa_fisica_fones_fone";

                    $semProcon = 'AND tb_procon.tb_procon_fone IS NULL';

                    if ($tipoArquivo == 'cpf') {

                        $joinSemProcon = "   
                              left join tb_procon 
                              ON tb_procon.tb_procon_ddd = tb_pessoa_fisica_fones_ddd
                              AND tb_procon.tb_procon_fone = tb_pessoa_fisica_fones_fone";

                        $semProcon = 'AND tb_procon.tb_procon_fone IS NULL';
                    }

                    if ($tipoArquivo == 'cnpj') {

                        $joinSemProcon = "   
                              left join tb_procon 
                              ON tb_procon.tb_procon_ddd = tb_pessoa_juridica_fones_ddd
                              AND tb_procon.tb_procon_fone = tb_pessoa_juridica_fones_fone";

                        $semProcon = 'AND tb_procon.tb_procon_fone IS NULL';
                    }
                }
            }

            if ($tipoArquivo == 'cpf') {

//-------------------------------------pf---------------------------------------------------//
//
// //Estados TESTAR *
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'estado') {
                    $ex = "'" . str_replace(",", "','", $value['tb_enriquecimento_filtros_filtro']) . "'";
                    if (!empty($value['tb_enriquecimento_filtros_filtro']) || $value['tb_enriquecimento_filtros_filtro'] != '') {
                        if (strripos($ex, '*') || $ex == "'',''" || ex == "'',") {
                            $pfEstados = '';
                        } else {
                            $pfEstados = "AND endereco.tb_pessoa_fisica_end_uf in ($ex)";
                        }
                    } else {

                        $pfEstados = '';
                    }
                }

// //ddd TESTAR *
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'fone1') {
                    $ex = "'" . str_replace(",", "','", $value['tb_enriquecimento_filtros_filtro']) . "'";
                    if (!empty($value['tb_enriquecimento_filtros_filtro']) || $value['tb_enriquecimento_filtros_filtro'] != '') {
                        if (strripos($ex, '*') || $ex == "'',''" || ex == "'',") {
                            $pfFonesDDD = '';
                        } else {
                            $pfFonesDDD = " AND (select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) in ($ex)
                                 AND (select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) in ($ex)
                                     AND (select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) in ($ex)";
                        }
                    } else {

                        $pfFonesDDD = '';
                    }
                }


//DATA NASCIMENTO
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'nascimento') {

                    $ex = explode(",", $value['tb_enriquecimento_filtros_filtro']);

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

                    if ($value['tb_enriquecimento_filtros_filtro'] != ',') {
                        $btAniversarioCpf = "AND (DATE_FORMAT(NOW(),'%Y')-SUBSTRING((SELECT tb_pessoa_fisica_data_nascimento FROM tb_pessoa_fisica where tb_pessoa_fisica_cpf = pf.tb_pessoa_fisica_cpf LIMIT 1),1,4)) between $dado1 and $dado2";
                    } else {
                        $btAniversarioCpf = "";
                    }
                }


//RENDA ESTIMADA
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'rendaEstimada') {

                    $ex = explode(",", $value['tb_enriquecimento_filtros_filtro']);

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

                    if ($value['tb_enriquecimento_filtros_filtro'] != ',') {
                        $btRendaEstimada = "AND (SELECT tb_pessoa_fisica_social_renda_estimada FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf LIMIT 1) between $dado1 and $dado2";
                    } else {
                        $btRendaEstimada = "";
                    }
                }

//ESCOLARIDADE TESTAR *
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'escolaridade') {
                    $ex = "'" . str_replace(",", "','", $value['tb_enriquecimento_filtros_filtro']) . "'";
                    if (!empty($value['tb_enriquecimento_filtros_filtro']) || $value['tb_enriquecimento_filtros_filtro'] != '') {

                        if (strripos($ex, '*') || $ex == "'',''" || ex == "'',") {
                            $btEscolaridade = '';
                        } else {
                            $btEscolaridade = "AND (SELECT tb_pessoa_fisica_social_escolaridade FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf LIMIT 1) in ($ex)";
                        }
                    } else {
                        $btEscolaridade = "";
                    }
                }


//CLASSE SOCIAL TESTAR *
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'classeSocial') {
                    $ex = "'" . str_replace(",", "','", $value['tb_enriquecimento_filtros_filtro']) . "'";
                    if (!empty($value['tb_enriquecimento_filtros_filtro']) || $value['tb_enriquecimento_filtros_filtro'] != '') {
                        if (strripos($ex, '*') || $ex == "'',''" || ex == "'',") {
                            $btClasseSocial = '';
                        } else {
                            $btClasseSocial = "AND (SELECT tb_pessoa_fisica_social_classe_social FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf  = pf.tb_pessoa_fisica_cpf) in ($ex)";
                        }
                    } else {

                        $btClasseSocial = '';
                    }
                }


//--------------------------------------------------------//--------------------------------------------------//

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'cpf' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pfCpf = 'pf.tb_pessoa_fisica_cpf as cpf,';
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [0] = 'tb_pessoa_fisica_cpf';
                    } else {
                        $camposObrigatorio [0] = '';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'nome' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pfNome = 'pf.tb_pessoa_fisica_nome as nome,';
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [1] = 'tb_pessoa_fisica_nome';
                    }
                }
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'sexo' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pfSexo = 'pf.tb_pessoa_fisica_sexo as sexo,';
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [2] = 'tb_pessoa_fisica_sexo';
                    }
                }
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'nascimento' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pfNascimento = 'pf.tb_pessoa_fisica_data_nascimento as data_nascimento,';
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [3] = 'tb_pessoa_fisica_data_nascimento';
                    }
                }


                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'mae' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pfNomeMae = '(SELECT tb_pessoa_fisica_mae_nome_mae 
                        FROM tb_pessoa_fisica_mae where tb_pessoa_fisica_mae_cpf = pf.tb_pessoa_fisica_cpf limit 1)as nome_mae,';
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [4] = 'tb_pessoa_fisica_mae_nome_mae';
                    }
                }
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'cbo' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pfIdCbo = '(SELECT tb_pessoa_fisica_social_id_cbo FROM tb_pessoa_fisica_social
                       LEFT JOIN tb_cbo 
                       ON tb_cbo.tb_cbo_id_cbo = tb_pessoa_fisica_social.tb_pessoa_fisica_social_id_cbo
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) as id_cbo,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [5] = 'tb_pessoa_fisica_social_id_cbo';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'descCbo' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {

                    $pfDesCbo = "(SELECT tb_cbo_mostrar FROM tb_cbo
                                       where tb_cbo_id_cbo = (SELECT tb_pessoa_fisica_social_id_cbo FROM tb_pessoa_fisica_social
                       LEFT JOIN tb_cbo
                       ON tb_cbo.tb_cbo_id_cbo = tb_pessoa_fisica_social.tb_pessoa_fisica_social_id_cbo
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) limit 1) as descricao_cbo,";

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [6] = 'tb_cbo_mostrar';
                    }
                }
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'rendaEstimada' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pfRendaEstimada = '(SELECT tb_pessoa_fisica_social_renda_estimada FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) as renda_estimada,';
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [7] = 'tb_pessoa_fisica_social_renda_estimada';
                    }
                }
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'escolaridade' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pfEscolaridade = '(SELECT tb_pessoa_fisica_social_escolaridade FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) as escolaridade,';
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [8] = 'tb_pessoa_fisica_social_escolaridade';
                    }
                }
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'classeSocial' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pfClasseSocial = '(SELECT tb_pessoa_fisica_social_classe_social FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) as classe_social,';
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [9] = 'tb_pessoa_fisica_social_classe_social';
                    }
                }
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'perfilConsumo' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pfPerfilConsumo = '(SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf 
                                        where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf 
                                        LIMIT 0,1) as perfil_consumo1,

                                        (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf
                                         where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf 
                                        LIMIT 1,1) as perfil_consumo2,

                                        (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf 
                                        where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf
                                        LIMIT 2,1) as prefil_consumo3,
                                       
                                        (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf 
                                        where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf
                                        LIMIT 3,1) as prefil_consumo4,
                                        
                                        (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf 
                                        where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf
                                        LIMIT 4,1) as prefil_consumo5,
                                        
                                        (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf 
                                        where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf
                                        LIMIT 5,1) as prefil_consumo6,
                                        
                                        (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf 
                                        where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf
                                        LIMIT 6,1) as prefil_consumo7,
                                        
                                        (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf 
                                        where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf
                                        LIMIT 7,1) as prefil_consumo8,
                                        
                                        (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf 
                                        where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf
                                        LIMIT 8,1) as prefil_consumo9,
                                        
                                        (SELECT tb_perfil_consumo_descricao FROM dataWebProducao.tb_perfil_consumo_pf 
                                        where tb_perfil_consumo_cpf =pf.tb_pessoa_fisica_cpf
                                        LIMIT 9,1) as prefil_consumo10,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [10] = 'tb_perfil_consumo_descricao';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'fone1' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $fone1 = "( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS ddd1,
                                 
    
                        ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS fone1,";



                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [15] = 'fone1';
                    }
                }


                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'fone2' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $fone2 = "( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) AS ddd2,
                                 
                        
                        ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) AS fone2,";


                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [17] = 'fone2';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'fone3' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $fone3 = "( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) AS ddd3,
                                 
                        ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) AS fone3,";


                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [19] = 'fone3';
                    }
                }


                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'cel1' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $cel1 = "( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS dddCel1,

                                ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS cel1,";



                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [21] = 'Cel1';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'cel2' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $cel2 = "( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) AS dddCel2,

                                 
( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) AS cel2,";


                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [23] = 'Cel2';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'cel3' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $cel3 = "( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) AS dddCel3,

                                 
( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) AS cel3,";

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [25] = 'Cel3';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'endereco' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {

                    $logradouro = "(SELECT tb_pessoa_fisica_end_end FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS logradouro,";
                    $numero = " (SELECT tb_pessoa_fisica_end_num
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS numero,";
                    $complemento = "  (SELECT tb_pessoa_fisica_end_compl
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS complemento,";

                    $bairro = "(SELECT tb_pessoa_fisica_end_bairro
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS bairro,";

                    $cidade = "(SELECT tb_pessoa_fisica_end_cidade
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS cidade,";
                    $uf = "  (SELECT tb_pessoa_fisica_end_uf
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS uf,";

                    $cep = "(SELECT tb_pessoa_fisica_end_cep
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS cep,";


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

                    switch ($value['tb_enriquecimento_filtros_filtro']) {
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
                    }


                    $camposSelect ['qtdEnd'] = $value['tb_enriquecimento_filtros_filtro'];
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [26] = 'end';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'email' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $camposSelect [27] = 'email';
                    $camposSelect['qtdEmail'] = $value['tb_enriquecimento_filtros_filtro'];


                    $Pfemail = "(SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email 
                        where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                        GROUP BY tb_pessoa_fisica_email_email
                        LIMIT 0,1) AS email1,";


                    switch ($value['tb_enriquecimento_filtros_filtro']) {
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
                            break;
                        default:

                            $Pfemail = "(SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email 
                        where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                        GROUP BY tb_pessoa_fisica_email_email
                        LIMIT 0,1) AS email1,";

                            break;
                    }


                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [27] = 'email';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'dataObito' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pfDataFalecimento = "(SELECT DATE_FORMAT(tb_cnfnew_dtobito,'%m-%d-%Y') FROM tb_cnfnew where tb_cnfnew_cpf = pf.tb_pessoa_fisica_cpf LIMIT 1) as data_falecimento,";
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [28] = 'dataObito';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'cidadeObito' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pfCidadeFalecimento = '(SELECT tb_cnfnew_cidadecartorio FROM tb_cnfnew where tb_cnfnew_cpf = pf.tb_pessoa_fisica_cpf LIMIT 1) as cidade_falecimento,';
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [29] = 'cidadeObito';
                    }
                }
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'participacaoEmpresarial' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {


                    $pfSocio = "(SELECT tb_pessoa_juridica_socio_cnpj_id FROM tb_pessoa_juridica_socio 
                                        where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf LIMIT 0,1) as socio1,

                                        (SELECT tb_pessoa_juridica_socio_cnpj_id FROM tb_pessoa_juridica_socio 
                                        where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf LIMIT 1,1) as socio2,

                                        (SELECT tb_pessoa_juridica_socio_cnpj_id FROM tb_pessoa_juridica_socio 
                                        where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf LIMIT 2,1) as socio3,";


                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $camposObrigatorio [30] = 'socio';
                    }
                }

//--------------------OBRIGATORIOS PF--------------------------------------------------------//


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
                        FROM tb_pessoa_fisica_mae where tb_pessoa_fisica_mae_cpf = pf.tb_pessoa_fisica_cpf) IS NOT NULL";
                }

                if ($camposObrigatorio[5] == 'tb_pessoa_fisica_social_id_cbo') {

                    $notIdCbo = "AND  (SELECT tb_pessoa_fisica_social_id_cbo FROM tb_pessoa_fisica_social
                       LEFT JOIN tb_cbo 
                       ON tb_cbo.tb_cbo_id_cbo = tb_pessoa_fisica_social.tb_pessoa_fisica_social_id_cbo
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf limit 1) <> ''";
                }
                if ($camposObrigatorio[6] == 'tb_cbo_mostrar') {
// $notCboMostra = "AND tb_pessoa_fisica_cbo IS NOT ";
                }
                if ($camposObrigatorio[7] == 'tb_pessoa_fisica_social_renda_estimada') {
                    $notRendaEstimada = "AND  (SELECT tb_pessoa_fisica_social_renda_estimada FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf) <>'' ";
                }
                if ($camposObrigatorio[8] == 'tb_pessoa_fisica_social_escolaridade') {
                    $notEscolaridade = "AND  (SELECT tb_pessoa_fisica_social_escolaridade FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf) <> ''";
                }
                if ($camposObrigatorio[9] == 'tb_pessoa_fisica_social_classe_social') {
                    $notClasseSocial = "AND  (SELECT tb_pessoa_fisica_social_classe_social FROM tb_pessoa_fisica_social
                       WHERE tb_pessoa_fisica_social_cpf = pf.tb_pessoa_fisica_cpf)  <>''";
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

                    switch ($value['tb_enriquecimento_filtros_filtro']) {
                        case 1:

                            $notEmail = "AND  (SELECT tb_pessoa_fisica_email_email FROM tb_pessoa_fisica_email where tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_email_email limit 0,1 ) IS NOT NULL";

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
                }

                if ($camposObrigatorio[28] == 'dataObito') {
                    $notDataObito = "AND  (SELECT tb_cnf_data_falecimento FROM tb_cnf where tb_cnf_cpf = pf.tb_pessoa_fisica_cpf) IS NOT NULL";
                }

                if ($camposObrigatorio[29] == 'cidadeObito') {
                    $notCidadeObito = "AND  (SELECT tb_cnf_cidade FROM tb_cnf where tb_cnf_cpf = pf.tb_pessoa_fisica_cpf) IS NOT NULL";
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

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'tableFiltroQueryBairros') {
                    $pjLocal = $value['tb_enriquecimento_filtros_filtro'];
                }
//Estados TESTAR *
                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'estadoPj') {
                    $ex = "'" . str_replace(",", "','", $value['tb_enriquecimento_filtros_filtro']) . "'";
                    if (!empty($value['tb_enriquecimento_filtros_filtro']) || $value['tb_enriquecimento_filtros_filtro'] != '') {
                        if (strripos($ex, '*') || $ex == "'',''" || ex == "'',") {
                            $pjEstados = '';
                        } else {
                            $pjEstados = "AND ende.tb_pessoa_juridica_end_uf in ($ex)";
                        }
                    } else {

                        $pjEstados = '';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'cnpj' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
//$cnpjCnpj = 'jr.tb_pessoa_juridica_cnpj,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notCnpj = "AND  jr.tb_pessoa_juridica_cnpj IS NOT NULL";
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'nomePj' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjNome = 'jr.tb_pessoa_juridica_nome,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjNome = 'AND  jr.tb_pessoa_juridica_nome IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'fantasiaPj' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjFantasia = 'jr.tb_pessoa_juridica_fantasia,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjFantasia = 'AND  jr.tb_pessoa_juridica_fantasia IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'matriz' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjMatriz = 'jr.tb_pessoa_juridica_matriz,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjMatriz = 'AND  jr.tb_pessoa_juridica_matriz IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'nascimentoPj' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjNascimento = 'jr.tb_pessoa_juridica_data_nascimento,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjNascimento = 'AND  jr.tb_pessoa_juridica_data_nascimento IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'qtdEmpregados' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjQtdEmpregados = 'jr.tb_pessoa_juridica_qtd_empregados,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjQtdEmpregados = 'AND  jr.tb_pessoa_juridica_qtd_empregados IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'cnae' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjCnae = 'jr.tb_pessoa_juridica_cnae,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjCnae = 'AND  jr.tb_pessoa_juridica_cnae IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'desCnae' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjDescCnae = 'cnae.tb_cnae_desc_secao,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notDescPjCnae = 'AND  cnae.tb_cnae_desc_secao IS NOT NULL';
                    }
                }


                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'natureza' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjNatureza = 'jr.tb_pessoa_juridica_id_natureza,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjNatureza = 'AND  jr.tb_pessoa_juridica_id_natureza IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'desNatureza' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjDescNatureza = 'nat.tb_natureza_descricao,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjDescNatureza = 'AND  nat.tb_natureza_descricao IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'enderecoPj' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {


                    $pjEndereco = "(SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS end1,

                    (SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS num1,


                    (SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS compl1,


                    (SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS bairro1,

                    (SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS cidade1,

                    (SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS uf1,

                    (SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS cep1,
                    ";
                    switch ($value['tb_enriquecimento_filtros_filtro']) {
                        case 1:
                            $pjEndereco = "(SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS end1,

                    (SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS num1,


                    (SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS compl1,


                    (SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS bairro1,

                    (SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS cidade1,

                    (SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS uf1,

                    (SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS cep1,
                    ";
                            break;
                        case 2:
                            $pjEndereco = "(SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS end1,

                    (SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS num1,


                    (SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS compl1,


                    (SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS bairro1,

                    (SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS cidade1,

                    (SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS uf1,

                    (SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 0,1) AS cep1,


                    (SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 1,1) AS end2,

                    (SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 1,1) AS num2,


                    (SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 1,1) AS compl2,


                    (SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 1,1) AS bairro2,

                    (SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 1,1) AS cidade2,

                    (SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 1,1) AS uf2,

                    (SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 1,1) AS cep2,


                    (SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
                    where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                    GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                    ORDER BY tb_pessoa_juridica_end_data DESC
                    LIMIT 2,1) AS end3,";
                            break;
                        case 3:
                            $pjEndereco = "(SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS end1,

                        (SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS num1,


                        (SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS compl1,


                        (SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS bairro1,

                        (SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS cidade1,

                        (SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS uf1,

                        (SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS cep1,


                        (SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 1,1) AS end2,

                        (SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 1,1) AS num2,


                        (SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 1,1) AS compl2,


                        (SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 1,1) AS bairro2,

                        (SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 1,1) AS cidade2,

                        (SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 1,1) AS uf2,

                        (SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 1,1) AS cep2,


                        (SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 2,1) AS end3,

                        (SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 2,1) AS num3,


                        (SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 2,1) AS compl3,


                        (SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 2,1) AS bairro3,

                        (SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 2,1) AS cidade3,

                        (SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 2,1) AS uf3,

                        (SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 2,1) AS cep3,";
                            break;

                        default :

                            $pjEndereco = "(SELECT tb_pessoa_juridica_end_end  FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS end1,

                        (SELECT tb_pessoa_juridica_end_num FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS num1,


                        (SELECT tb_pessoa_juridica_end_compl FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS compl1,


                        (SELECT tb_pessoa_juridica_end_bairro FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS bairro1,

                        (SELECT tb_pessoa_juridica_end_cidade FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS cidade1,

                        (SELECT tb_pessoa_juridica_end_uf FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC
                        LIMIT 0,1) AS uf1,

                        (SELECT tb_pessoa_juridica_end_cep FROM dataWebProducao.tb_pessoa_juridica_end 
                        where tb_pessoa_juridica_end_cnpj = jr.tb_pessoa_juridica_cnpj 
                        GROUP BY tb_pessoa_juridica_end_cep,tb_pessoa_juridica_end_num
                        ORDER BY tb_pessoa_juridica_end_data DESC  LIMIT 0,1) AS cep1,
                        ";
                            break;
                    }


                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjEndereco = 'AND  ende.tb_pessoa_juridica_end_end IS NOT NULL';
                    }
                }



                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'situacao' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjSituacao = '(SELECT tb_pessoa_juridica_situacao FROM dataWebProducao.tb_pessoa_juridica_situacao
                                                WHERE tb_pessoa_juridica_situacao_cnpj = jr.tb_pessoa_juridica_cnpj 
                                                ORDER BY idtb_situacao DESC
                                                LIMIT 0,1) as tb_pessoa_juridica_situacao,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjSituacao = 'AND  (SELECT tb_pessoa_juridica_situacao FROM dataWebProducao.tb_pessoa_juridica_situacao
                                                WHERE tb_pessoa_juridica_situacao_cnpj = jr.tb_pessoa_juridica_cnpj 
                                                ORDER BY idtb_situacao DESC
                                                LIMIT 0,1) IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'dataSituacao' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjDataSituacao = '(SELECT tb_pessoa_juridica_data_situacao FROM dataWebProducao.tb_pessoa_juridica_situacao
                                        WHERE tb_pessoa_juridica_situacao_cnpj = jr.tb_pessoa_juridica_cnpj
                                        ORDER BY idtb_situacao DESC
                                        LIMIT 0,1) as tb_pessoa_juridica_data_situacao,';
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjDataSituacao = 'AND  (SELECT tb_pessoa_juridica_data_situacao FROM dataWebProducao.tb_pessoa_juridica_situacao
                                                WHERE tb_pessoa_juridica_situacao_cnpj = jr.tb_pessoa_juridica_cnpj
                                                ORDER BY idtb_situacao DESC
                                                LIMIT 0,1) IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'porte' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
//$this->processaArquivo->porteReceita($pjQtdEmpregados, $pjCnae);
                    $pjPorte = "IF(substring(tb_pessoa_juridica_cnae,1,2) >= '5' and  substring(tb_pessoa_juridica_cnae,1,2) <= '43'
    
    , CASE 

WHEN tb_pessoa_juridica_qtd_empregados >= 1 and tb_pessoa_juridica_qtd_empregados <= 19 THEN 
'Micro (Industria) - ate R$1.2 MM'
WHEN tb_pessoa_juridica_qtd_empregados >= 20 and tb_pessoa_juridica_qtd_empregados <= 99 THEN
'Pequena (Industria) -  De R$1.2 MM a R$10.5 MM'
WHEN tb_pessoa_juridica_qtd_empregados >= 100 and tb_pessoa_juridica_qtd_empregados <= 499 THEN
'Média (Industria) -  De R$10.5 MM a R$60 MM'
WHEN tb_pessoa_juridica_qtd_empregados > 499 THEN
'Grande (Industria) -  Acima de R$60 MM' end ,

 IF(substring(tb_pessoa_juridica_cnae,1,2) >= '45' and  substring(tb_pessoa_juridica_cnae,1,2) <= '47'
    
    , CASE 

WHEN tb_pessoa_juridica_qtd_empregados >= 1 and tb_pessoa_juridica_qtd_empregados <= 9 THEN 
'Micro (Comercio) - ate R$1.2 MM'
WHEN tb_pessoa_juridica_qtd_empregados >= 10 and tb_pessoa_juridica_qtd_empregados <= 49 THEN
'Pequena (Comercio) -  De R$1.2 MM a R$10.5 MM'
WHEN tb_pessoa_juridica_qtd_empregados >= 50 and tb_pessoa_juridica_qtd_empregados <= 99 THEN
'Média (Comercio) -  De R$10.5 MM a R$60 MM'
WHEN tb_pessoa_juridica_qtd_empregados > 99 THEN
'Grande (Comercio) -  Acima R$60 MM' end ,


IF(substring(tb_pessoa_juridica_cnae,1,2) >= '90' and  substring(tb_pessoa_juridica_cnae,1,2) <= '99'
    
    , CASE 

WHEN tb_pessoa_juridica_qtd_empregados >= 1 and tb_pessoa_juridica_qtd_empregados <= 9 THEN 
'Micro (Demais Atividades) - ate R$1.2 MM'
WHEN tb_pessoa_juridica_qtd_empregados >= 10 and tb_pessoa_juridica_qtd_empregados <= 49 THEN
'Pequena (Demais Atividades) -  De R$1.2 MM a R$10.5 MM'
WHEN tb_pessoa_juridica_qtd_empregados >= 50 and tb_pessoa_juridica_qtd_empregados <= 99 THEN
'Média (Demais Atividades) -  De R$10.5 MM a R$60 MM'
WHEN tb_pessoa_juridica_qtd_empregados > 99 THEN
'Grande (Demais Atividades) -  Acima R$60 MM' end ,

IF(substring(tb_pessoa_juridica_cnae,1,2) >= '49' and  substring(tb_pessoa_juridica_cnae,1,2) <= '88'
    
    , CASE 

WHEN tb_pessoa_juridica_qtd_empregados >= 1 and tb_pessoa_juridica_qtd_empregados <= 9 THEN 
'Micro (Servicos) - ate R$1.2 MM'
WHEN tb_pessoa_juridica_qtd_empregados >= 10 and tb_pessoa_juridica_qtd_empregados <= 49 THEN
'Pequena (Servicos) -  De R$1.2 MM a R$10.5 MM'
WHEN tb_pessoa_juridica_qtd_empregados >= 50 and tb_pessoa_juridica_qtd_empregados <= 99 THEN
'Média (Servicos) -  De R$10.5 MM a R$60 MM'
WHEN tb_pessoa_juridica_qtd_empregados > 99 THEN
'Grande (Servicos) -  Acima R$60 MM' end ,

IF(substring(tb_pessoa_juridica_cnae,1,2) >= '1' and  substring(tb_pessoa_juridica_cnae,1,2) <= '3'
    
    , CASE 

WHEN tb_pessoa_juridica_qtd_empregados >= 1 and tb_pessoa_juridica_qtd_empregados <= 9 THEN 
'Micro (Agropecuaria) - ate R$1.2 MM'
WHEN tb_pessoa_juridica_qtd_empregados >= 10 and tb_pessoa_juridica_qtd_empregados <= 49 THEN
'Pequena (Agropecuaria) -  De R$1.2 MM a R$10.5 MM'
WHEN tb_pessoa_juridica_qtd_empregados >= 50 and tb_pessoa_juridica_qtd_empregados <= 99 THEN
'Média (Agropecuaria) -  De R$10.5 MM a R$60 MM'
WHEN tb_pessoa_juridica_qtd_empregados > 99 THEN
'Grande (Agropecuaria) -  Acima R$60 MM' end ,''
  
  )
	)
		)
			)
				) as porte_faturamento_presumido ,";

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
//$notPjDataSituacao = 'AND  IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'faturamentoPresumido' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
//$this->processaArquivo->porteReceita($pjQtdEmpregados, $pjCnae);
                    $pjFaturamento = '';
                    $camposSelect [50] = 'tb_pessoa_juridica_faturamento_presumido';
                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
// $camposObrigatorio [50] = 'tb_pessoa_juridica_faturamento_presumido';
                    }
                }


                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'qtdProprietarios' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjQtdProprietarios = '  (select count(so.tb_pessoa_juridica_socio_cnpj_id)
                                                from tb_pessoa_juridica_socio as soc
                                                where soc.tb_pessoa_juridica_socio_cnpj_id = jr.tb_pessoa_juridica_cnpj 
                                                group by soc.tb_pessoa_juridica_socio_cnpj_id) as qtdProprietarios,';


                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjQtdProprietario = 'AND  (select count(so.tb_pessoa_juridica_socio_cnpj_id)
                                                from tb_pessoa_juridica_socio as soc
                                                where soc.tb_pessoa_juridica_socio_cnpj_id = jr.tb_pessoa_juridica_cnpj 
                                                group by soc.tb_pessoa_juridica_socio_cnpj_id) IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'perfilConsumo' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjPerfilConsumo = '(SELECT tb_perfil_consumo_descricao FROM tb_perfil_consumo_pJ where tb_perfil_consumo_cnpj = jr.tb_pessoa_juridica_cnpj
                                        LIMIT 0,1) as tb_perfil_consumo_descricaoPj1,

                                        (SELECT tb_perfil_consumo_descricao FROM tb_perfil_consumo_pJ where tb_perfil_consumo_cnpj =jr.tb_pessoa_juridica_cnpj
                                        LIMIT 1,1) as tb_perfil_consumo_descricaoPj2,

                                        (SELECT tb_perfil_consumo_descricao FROM tb_perfil_consumo_pJ where tb_perfil_consumo_cnpj =jr.tb_pessoa_juridica_cnpj 
                                        LIMIT 2,1) as tb_perfil_consumo_descricaoPj3,';

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjPerfilConsumo = 'AND  (SELECT tb_perfil_consumo_descricao 
                                                 FROM tb_perfil_consumo_pJ where tb_perfil_consumo_cnpj = jr.tb_pessoa_juridica_cnpj
                                                 LIMIT 0,1) IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'fone1Pj' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjFone1 = "( select tb_pessoa_juridica_fones_ddd
                                 from tb_pessoa_juridica_fones
                                 $joinSemProcon
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 $semProcon
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
                                ";


                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjFone1 = 'AND  ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 0,1) IS NOT NULL';
                    }
                }


                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'fone2Pj' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjFone2 = "
 ( select tb_pessoa_juridica_fones_ddd
                                 from tb_pessoa_juridica_fones
                                 $joinSemProcon
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 $semProcon
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 1,1) AS ddd2,

 ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 $joinSemProcon
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 $semProcon
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 1,1) AS fone2,";

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjFone2 = 'AND  ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 1,1) IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'fone3Pj' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjFone3 = "
 ( select tb_pessoa_juridica_fones_ddd
                                 from tb_pessoa_juridica_fones
                                $joinSemProcon
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                $semProcon 
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 2,1) AS ddd3,
                        
                                ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 $joinSemProcon
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 $semProcon
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 2,1) AS fone3,";

                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjFone3 = 'AND  ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 1
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 2,1) IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'cel1Pj' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjCel1 = "( select tb_pessoa_juridica_fones_ddd
                                 from tb_pessoa_juridica_fones
                                 $joinSemProcon
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 $semProcon
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 0,1) AS dddCel1,
                                 
( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 $joinSemProcon
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 $semProcon
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 0,1) AS cel1,";


                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjCel1 = 'AND  ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 0,1) IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'cel2Pj' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjCel2 = "  
( select tb_pessoa_juridica_fones_ddd
                                 from tb_pessoa_juridica_fones
                                 $joinSemProcon
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 $semProcon
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 1,1) AS dddCel2,
                                 
( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 $joinSemProcon
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 $semProcon
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 1,1) AS cel2,";


                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjCel2 = 'AND  ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 1,1) IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'cel3Pj' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
                    $pjCel3 = " 
( select tb_pessoa_juridica_fones_ddd
                                 from tb_pessoa_juridica_fones
                                 $joinSemProcon
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 $semProcon
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 2,1) AS dddCel3,
                                 
( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 $joinSemProcon
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 $semProcon 
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 2,1) AS cel3,";


                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
                        $notPjCel3 = 'AND  ( select tb_pessoa_juridica_fones_fone
                                 from tb_pessoa_juridica_fones
                                 where tb_pessoa_juridica_fones_cnpj= jr.tb_pessoa_juridica_cnpj
                                 AND tb_pessoa_juridica_fones_tipo = 2
                                 GROUP BY tb_pessoa_juridica_fones_fone
                                 ORDER BY tb_pessoa_juridica_fones_data 
                                 LIMIT 2,1) IS NOT NULL';
                    }
                }

                if ($value['tb_enriquecimento_filtros_nome_campo'] == 'socios' && $value['tb_enriquecimento_filtros_desejado'] == 'on') {
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


                    if ($value['tb_enriquecimento_filtros_obrigatorio'] == 'on') {
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

        if ($tipoArquivo == 'cpf') {

            $nomeArquivoCpf = date('d_m_Y') . "_" . $empresaCnpj . "_" . $idEmriquecimeto . "_cpf.csv";


            //echo "<pre>";
            // echo
            $sqlCreateTable = "CREATE  TABLE  IF NOT EXISTS $nomeTabela SELECT 
            
                pf.tb_pessoa_fisica_cpf,
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
                                     
               
                                 '' as termino
    
                                 
                                 FROM tb_pessoa_fisica as pf

                                left join tb_pessoa_fisica_fones as fone
                                ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf

                                left join tb_pessoa_fisica_end as endereco
                                ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf

                                

                                where (1=1)
                                AND pf.tb_pessoa_fisica_cpf  IN ($cpfsSaida')
                                    
    
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

                                             $btAniversarioCpf
                                             $btRendaEstimada
                                             $btEscolaridade
                                             $btClasseSocial
                                             $pfEstados
                                             $pfFonesDDD
                                        

                                           
        
                                        GROUP BY pf.tb_pessoa_fisica_cpf ";


            //echo "</pre>";
//echo $sqlCreateTable;
//die(".");
//LIBERANDO MEMORIA
//unset($cpfsSaida);
        } else {

            if ($pjLocal) {
                $pjEstados = "";
            }

            $nomeArquivoCnpj = date('d_m_Y') . "_" . $empresaCnpj . "_" . $idEmriquecimeto . "_cnpj.csv";

            $sqlCreateTable = "CREATE  TABLE  IF NOT EXISTS $nomeTabela SELECT tb_pessoa_juridica_cnpj,tb_pessoa_juridica_nome,
                    
                          
                                        $pjFantasia
                                        $pjMatriz
                                        $pjNascimento
                                        $pjQtdEmpregados    
                                        $pjCnae
                                        $pjDescCnae
                                        $pjNatureza
                                        $pjDescNatureza
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

                                           '' as termino

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

                                        
					where jr.tb_pessoa_juridica_cnpj in ($cpfsSaida')
                                            

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
                        $pjLocal

                                        GROUP BY jr.tb_pessoa_juridica_cnpj ";

//echo $sqlCreateTable;
//die("..");
//LIBERA MEMORIA
        }



        if ($tipoArquivo == '1') {

//die(".");
            $nomeArquivoCnpj = date('d_m_Y') . "_" . $empresaCnpj . "_" . $idEmriquecimeto . "_LayoutCobTotal.csv";


            //if (!$tipoArquivo == 'cpf' || !$tipoArquivo == 'cnpj') {


            echo "cria tabela csv \n";
            $cabecalhoArquivoSeparado = (str_replace(" ", "_", $cabecalhoArquivoSeparado));
            $cabecalhoArquivoSeparado = (str_replace(",", " varchar(45) DEFAULT NULL , ", $cabecalhoArquivoSeparado . " varchar(45) DEFAULT NULL"));


            $sqlCriarTabelaCsv = "CREATE TABLE  IF NOT EXISTS `$tabelaCsv`   ($cabecalhoArquivoSeparado) ;";
            $this->db->pdo->exec($sqlCriarTabelaCsv);

            echo "Popula tabela csv (LOAD) \n";
            $csvPathAndFile = str_replace('http://dwonline.com.br/desenv/', '/var/www/html/', $arquivo);
            $resultado = shell_exec("/var/www/html/exec/execCriaTemp.sh $csvPathAndFile $tabelaCsv");

            echo "Cria tabela telefones do banco de dados \n";
            $sqlCriaTabelaBancoTel = "SELECT * FROM tb_pessoa_fisica_fones
                                        WHERE tb_pessoa_fisica_fones_cpf   IN ($cpfsSaida') group by tb_pessoa_fisica_fones_fone,tb_pessoa_fisica_fones_cpf
                                        ";


            $sqlCriarTabelaBancoTelefones = "CREATE TABLE  IF NOT EXISTS `$tabelaBanco`   ($sqlCriaTabelaBancoTel) ;";
            $this->db->pdo->exec($sqlCriarTabelaBancoTelefones);

            echo "Cria tabela TEL1 \n";
            $sqlCriarTabelaTEL1 = "CREATE TABLE  IF NOT EXISTS TEL1(
                                                    CPF VARCHAR(20),
                                                    DDD VARCHAR(4),
                                                    FONE VARCHAR(9));";
            $this->db->pdo->exec($sqlCriarTabelaTEL1);

            $sqlInsertTelefones = $telEntrada;
            $this->db->pdo->exec($sqlInsertTelefones);

            echo "Deleta da tabela tabelaGeracao_ telefones que estão na tabela \n";
            $sqlDeletaFones = "DELETE FROM $tabelaBanco
                        WHERE CONCAT(tb_pessoa_fisica_fones_cpf,' ',tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone) 
                        IN (SELECT CONCAT(CPF,' ',DDD,FONE) FROM TEL1 GROUP BY FONE) ;";
            $this->db->pdo->exec($sqlDeletaFones);


//contabilidade
            $sqlTotalEnriquecidosTel = "SELECT count(distinct(tb_pessoa_fisica_fones_cpf )) FROM dataWebProducao.$tabelaBanco ";
            $db_retornoTotalEnriquecidosTel = $this->db->query($sqlTotalEnriquecidosTel);
            $fetch_totalEnriquedidosTel = $db_retornoTotalEnriquecidosTel->fetchAll();
            $totalCpfEnriquecido = ($fetch_totalEnriquedidosTel[0][0]);
//die(".");


            $sqlCreateTable = "CREATE  TABLE  IF NOT EXISTS $nomeTabela  SELECT
 
                pf.tb_pessoa_fisica_cpf as CPF_CNPJ,
                pf.tb_pessoa_fisica_nome as PROPRIETÁRIO,
                                
(SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                            $joinSemProcon 
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) as FIXO1,
                            
 (SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                            $joinSemProcon 
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1) as FIXO2,                            
                            
(SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1) as FIXO3,
                            
(SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) as CEL1,
                            
 (SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1) as CEL2,                            
                            
(SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1) as CEL3,
                                 

                 '                    ' as COMERCIAL1,
                 '                    ' as COMERCIAL2,
                 '                    ' as COMERCIAL3,
                 '                    ' as RESTRITIVO,
                 '                    ' as VEICULO1,
                 '                    ' as VEICULO2,
                 '                    ' as VEICULO3,
                pf.tb_pessoa_fisica_data_nascimento as DATANASC,
                '                    ' AS email1,

                                '                    ' AS email2,

                                '                    ' AS email3,
                                
                '                    ' as CBO,
                       
                 '                    ' as DESCRICAO_CBO,
                                       
                (SELECT tb_cnf_data_falecimento FROM tb_cnf where tb_cnf_cpf = pf.tb_pessoa_fisica_cpf) as OBITO,
                pf.tb_pessoa_fisica_sexo as SEXO,
                
                '                    ' as RENDA,
                
                (SELECT tb_pessoa_fisica_mae_nome_mae
                        FROM tb_pessoa_fisica_mae where tb_pessoa_fisica_mae_cpf = pf.tb_pessoa_fisica_cpf limit 1)as NOME_MÃE,
                        
                 '                    ' as POSSUI_RESIDENCIA,
                 
                 (SELECT tb_pessoa_juridica_socio_cnpj_id
                                        FROM tb_pessoa_juridica_socio as so
                                        left join tb_pessoa_juridica_fones soFones
                                        on soFones.tb_pessoa_juridica_fones_cnpj=so.tb_pessoa_juridica_socio_cnpj_id
                                        where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf LIMIT 0,1) as SOCIEDADE1 ,

                                        (SELECT concat( soFones.tb_pessoa_juridica_fones_ddd, soFones.tb_pessoa_juridica_fones_fone)
                                        FROM tb_pessoa_juridica_socio as so
                                        left join tb_pessoa_juridica_fones soFones
                                        on soFones.tb_pessoa_juridica_fones_cnpj=so.tb_pessoa_juridica_socio_cnpj_id
                                        where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf LIMIT 0,1) as TELSOCIEDADE1 ,


                                        (SELECT tb_pessoa_juridica_socio_cnpj_id
                                        FROM tb_pessoa_juridica_socio as so
                                        left join tb_pessoa_juridica_fones soFones
                                        on soFones.tb_pessoa_juridica_fones_cnpj=so.tb_pessoa_juridica_socio_cnpj_id
                                        where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf LIMIT 1,1)  as SOCIEDADE2 ,

                                        (SELECT concat( soFones.tb_pessoa_juridica_fones_ddd, soFones.tb_pessoa_juridica_fones_fone)
                                        FROM tb_pessoa_juridica_socio as so
                                        left join tb_pessoa_juridica_fones soFones
                                        on soFones.tb_pessoa_juridica_fones_cnpj=so.tb_pessoa_juridica_socio_cnpj_id
                                        where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf LIMIT 1,1) as TELSOCIEDADE2 ,


                                       (SELECT tb_pessoa_juridica_socio_cnpj_id
                                        FROM tb_pessoa_juridica_socio as so
                                        left join tb_pessoa_juridica_fones soFones
                                        on soFones.tb_pessoa_juridica_fones_cnpj=so.tb_pessoa_juridica_socio_cnpj_id
                                        where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf LIMIT 2,1) as SOCIEDADE3,

                                        (SELECT concat( soFones.tb_pessoa_juridica_fones_ddd, soFones.tb_pessoa_juridica_fones_fone)
                                        FROM tb_pessoa_juridica_socio as so
                                        left join tb_pessoa_juridica_fones soFones
                                        on soFones.tb_pessoa_juridica_fones_cnpj=so.tb_pessoa_juridica_socio_cnpj_id
                                        where tb_pessoa_juridica_socio_cpf_id=pf.tb_pessoa_fisica_cpf LIMIT 2,1) as TELSOCIEDADE3 ,
                 '                    ' as QTDSOCIOS,
                 '                    ' as QTD_FUNCIONARIOS,
                 '                    ' as CNAE,
                 '                    ' as DESCRICAO_CNAE


                                 FROM tb_pessoa_fisica as pf

                                left join tb_pessoa_fisica_fones as fone
                                ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf

                                left join tb_pessoa_fisica_end as endereco
                                ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf

                                left join tb_pessoa_fisica_email as email
                                ON email.tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf
                    
                                where (1=1)

                                AND pf.tb_pessoa_fisica_cpf  IN ($cpfsSaida')
                                GROUP BY pf.tb_pessoa_fisica_cpf 
                                ORDER BY fone.tb_pessoa_fisica_fones_fone";





// echo $sqlCreateTable;
// die(".");
        }

        if ($tipoArquivo == '2') {

            $nomeArquivoCnpj = date('d_m_Y') . "_" . $empresaCnpj . "_" . $idEmriquecimeto . "_LayoutDataCob.csv";


//------------------recupera csv --------------------------------------//

            echo "cria tabela csv \n";
            $cabecalhoArquivoSeparado = (str_replace(" ", "_", $cabecalhoArquivoSeparado));
            $cabecalhoArquivoSeparado = (str_replace(",", " varchar(45) DEFAULT NULL , ", $cabecalhoArquivoSeparado . " varchar(45) DEFAULT NULL"));

            $sqlCriarTabelaCsv = "CREATE TABLE  IF NOT EXISTS `$tabelaCsv`   ($cabecalhoArquivoSeparado) ;";
            $this->db->pdo->exec($sqlCriarTabelaCsv);

            echo "Popula tabela csv (LOAD) \n";
            $csvPathAndFile = str_replace('http://dwonline.com.br/desenv/', '/var/www/html/', $arquivo);
            $resultado = shell_exec("/var/www/html/exec/execCriaTemp.sh $csvPathAndFile $tabelaCsv");


//------------------endereço --------------------------------------//


            echo "Cria tabela endereço do banco de dados \n";
            $tabelaBancoEnd = $tabelaBanco . "_end";
            $sqlCriaTabelaBancoEnd = "SELECT * FROM tb_pessoa_fisica_end
                                        WHERE tb_pessoa_fisica_end_cpf   IN ($cpfsSaida')
                                        group by tb_pessoa_fisica_end_cpf";
//die(".");

            $sqlCriarTabelaBancoEnd = "CREATE TABLE  IF NOT EXISTS $tabelaBancoEnd  ($sqlCriaTabelaBancoEnd) ;";
            $this->db->pdo->exec($sqlCriarTabelaBancoEnd);

            echo "Cria tabela END1 \n";
            $sqlCriarTabelaEnd = "CREATE TABLE  IF NOT EXISTS END1(
                                        CPF VARCHAR(20),
                                        ENDERECO VARCHAR(80),
                                        NUM VARCHAR(10),
                                        COMPL VARCHAR(40),
                                        BAIRRO VARCHAR(40),
                                        CIDADE VARCHAR(40),
                                        UF VARCHAR(2),
                                        CEP INT);";
            $this->db->pdo->exec($sqlCriarTabelaEnd);

            $sqlInsertEnd = "INSERT INTO END1 (CPF,ENDERECO,NUM,COMPL,BAIRRO,CIDADE,UF,CEP) SELECT $chaveAtualiza,$enderecoCsv,$numeroCsv,$complementoCsv,$bairroCsv,$cidadeCsv,$ufCsv,$cepCsv FROM $tabelaCsv ;";
            $this->db->pdo->exec($sqlInsertEnd);

            echo "Deleta da tabela tabelaGeracao endereços que estão na tabela \n";
            $sqlDeletaEnd = "DELETE FROM $tabelaBancoEnd
                        WHERE  CONCAT(tb_pessoa_fisica_end_cpf,' ',substr(tb_pessoa_fisica_end_cep,2),tb_pessoa_fisica_end_num)
                        IN (SELECT CONCAT(CPF,' ',CEP,NUM) FROM END1 GROUP BY CEP) ;";
            $this->db->pdo->exec($sqlDeletaEnd);
            //}
//die(".");
//contabilidade
            $sqlTotalEnriquecidosEnd = "SELECT count(distinct(tb_pessoa_fisica_end_cpf )) FROM dataWebProducao.$tabelaBancoEnd ";
            $db_retornoTotalEnriquecidosEnd = $this->db->query($sqlTotalEnriquecidosEnd);
            $fetch_totalEnriquedidosEnd = $db_retornoTotalEnriquecidosEnd->fetchAll();

            $totalCpfEnriquecido = ($fetch_totalEnriquedidosEnd[0][0]);

// die(".");

            $sqlCreateTable = "CREATE  TABLE  IF NOT EXISTS $nomeTabela SELECT 
            
                pf.tb_pessoa_fisica_cpf as CPF_CNPJ,
                '' as TIPO,
                '' as PROCESSADO,
                '' as RAZAO_SOCIAL,
                '' as NOME_FANTASIA,
                pf.tb_pessoa_fisica_sexo as SEXO,
                '' as ENDERECO_COMPLETO,
                '' as END_TIPO,
                '' as END_TITULO,
                
(SELECT tb_pessoa_fisica_end_end
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1) as END_LOGRADOURO,

(SELECT tb_pessoa_fisica_end_num
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1) as NUMERO,
                            
(SELECT tb_pessoa_fisica_end_compl
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1) as COMPLEMENTO,
                            
(SELECT tb_pessoa_fisica_end_bairro
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1) as BAIRRO,
                            
(SELECT tb_pessoa_fisica_end_cidade
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1) as CIDADE,
                            
(SELECT tb_pessoa_fisica_end_uf
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1) as UF,
                            
(SELECT tb_pessoa_fisica_end_cep
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1) as CEP,
                            
                            
'' AS END_SCORE,
'' AS END_RANK,
'' AS DDD_COM1,
'' AS FONE_COM1,
'' AS FONE_SCORE1,
'' AS FONE_RANK1,
'' AS DDD_COM2,
'' AS FONE_COM2,
'' AS FONE_SCORE2,
'' AS FONE_RANK2,
'' AS DDD_COM3,
'' AS FONE_COM3,
'' AS FONE_SCORE3,
'' AS FONE_RANK3,

                
                '                                                                                                   ' AS email1,

                '                                                                                                   ' AS email2,

                '                                                                                                   ' AS email3,

                            '' as SOCIO1_CPF,
                            '' as SOCIO1_NOME,
                            '' as SOCIO1_DDD1_RES,
                            '' as SOCIO1_FONE1_RES,
                            '' as SOCIO1_DDD2_RES,
                            '' as SOCIO1_FONE2_RES,
                            '' as SOCIO1_DDD3_RES,
                            '' as SOCIO1_FONE3_RES,
                            '' as SOCIO1_DDD1_CEL,
                            '' as SOCIO1_FONE1_CEL,
                            '' as SOCIO1_DDD2_CEL,
                            '' as SOCIO1_FONE2_CEL,
                            '' as SOCIO1_DDD3_CEL,
                            '' as SOCIO1_FONE3_CEL,
                            '' as SOCIO1_SCORE,
                            '' as SOCIO1_HH1_NOME,
                            '' as SOCIO1_HH1_DDD,
                            '' as SOCIO1_HH1_FONE,
                            '' as SOCIO1_HH2_NOME,
                            '' as SOCIO1_HH2_DDD,
                            '' as SOCIO1_HH2_FONE,
                            '' as SOCIO1_HH3_NOME,
                            '' as SOCIO1_HH3_DDD,
                            '' as SOCIO1_HH3_FONE,
                            '' as SOCIO2_CPF,
                            '' as SOCIO2_NOME,
                            '' as SOCIO2_DDD1_RES,
                            '' as SOCIO2_FONE1_RES,
                            '' as SOCIO2_DDD2_RES,
                            '' as SOCIO2_FONE2_RES,
                            '' as SOCIO2_DDD3_RES,
                            '' as SOCIO2_FONE3_RES,
                            '' as SOCIO2_DDD1_CEL,
                            '' as SOCIO2_FONE1_CEL,
                            '' as SOCIO2_DDD2_CEL,
                            '' as SOCIO2_FONE2_CEL,
                            '' as SOCIO2_DDD3_CEL,
                            '' as SOCIO2_FONE3_CEL,
                            '' as SOCIO2_SCORE,
                            '' as SOCIO2_HH1_NOME,
                            '' as SOCIO2_HH1_DDD,
                            '' as SOCIO2_HH1_FONE,
                            '' as SOCIO2_HH2_NOME,
                            '' as SOCIO2_HH2_DDD,
                            '' as SOCIO2_HH2_FONE,
                            '' as SOCIO2_HH3_NOME,
                            '' as SOCIO2_HH3_DDD,
                            '' as SOCIO2_HH3_FONE ,
                            '' as SOCIO3_CPF,
                            '' as SOCIO3_NOME,
                            '' as SOCIO3_DDD1_RES,
                            '' as SOCIO3_FONE1_RES,
                            '' as SOCIO3_DDD2_RES,
                            '' as SOCIO3_FONE2_RES,
                            '' as SOCIO3_DDD3_RES,
                            '' as SOCIO3_FONE3_RES,
                            '' as SOCIO3_DDD1_CEL,
                            '' as SOCIO3_FONE1_CEL,
                            '' as SOCIO3_DDD2_CEL,
                            '' as SOCIO3_FONE2_CEL,
                            '' as SOCIO3_DDD3_CEL,
                            '' as SOCIO3_FONE3_CEL,
                            '' as SOCIO3_SCORE,
                            '' as SOCIO3_HH1_NOME,
                            '' as SOCIO3_HH1_DDD,
                            '' as SOCIO3_HH1_FONE,
                            '' as SOCIO3_HH2_NOME,
                            '' as SOCIO3_HH2_DDD,
                            '' as SOCIO3_HH2_FONE,
                            '' as SOCIO3_HH3_NOME,
                            '' as SOCIO3_HH3_DDD,
                            '' as SOCIO3_HH3_FONE,
                            '' as SCORE


                                 FROM tb_pessoa_fisica as pf

                                left join tb_pessoa_fisica_fones as fone
                                ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf

                                left join tb_pessoa_fisica_end as endereco
                                ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf

                                left join tb_pessoa_fisica_email as email
                                ON email.tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf

                                where (1=1)

                                AND pf.tb_pessoa_fisica_cpf  IN ($cpfsSaida')
                                  
        
                                GROUP BY pf.tb_pessoa_fisica_cpf ";

//echo $sqlCreateTable;
//die(".");
        }


        if ($tipoArquivo == '3') {

            $nomeArquivoCnpj = date('d_m_Y') . "_" . $empresaCnpj . "_" . $idEmriquecimeto . "_LayoutVendas.csv";


            //if (!$tipoArquivo == 'cpf' || !$tipoArquivo == 'cnpj') {
            echo "cria tabela csv \n";
            $cabecalhoArquivoSeparado = (str_replace(" ", "_", $cabecalhoArquivoSeparado));
            $cabecalhoArquivoSeparado = (str_replace(",", " varchar(45) DEFAULT NULL , ", $cabecalhoArquivoSeparado . " varchar(45) DEFAULT NULL"));

            $sqlCriarTabelaCsv = "CREATE TABLE  IF NOT EXISTS `$tabelaCsv`   ($cabecalhoArquivoSeparado) ;";
            $this->db->pdo->exec($sqlCriarTabelaCsv);

            echo "Popula tabela csv (LOAD) \n";
            $csvPathAndFile = str_replace('http://dwonline.com.br/desenv/', '/var/www/html/', $arquivo);
            $resultado = shell_exec("/var/www/html/exec/execCriaTemp.sh $csvPathAndFile $tabelaCsv");

            echo "Cria tabela telefones do banco de dados \n";
            $sqlCriaTabelaBancoTel = "SELECT * FROM tb_pessoa_fisica_fones
                                        WHERE tb_pessoa_fisica_fones_cpf   IN ($cpfsSaida') group by tb_pessoa_fisica_fones_fone,tb_pessoa_fisica_fones_cpf
                                        ";


            $sqlCriarTabelaBancoTelefones = "CREATE TABLE  IF NOT EXISTS `$tabelaBanco`   ($sqlCriaTabelaBancoTel) ;";
            $this->db->pdo->exec($sqlCriarTabelaBancoTelefones);

            echo "Cria tabela TEL1 \n";
            $sqlCriarTabelaTEL1 = "CREATE TABLE  IF NOT EXISTS TEL1(
                                                    CPF VARCHAR(20),
                                                    DDD VARCHAR(4),
                                                    FONE VARCHAR(9));";
            $this->db->pdo->exec($sqlCriarTabelaTEL1);

            $sqlInsertTelefones = $telEntrada;
            $this->db->pdo->exec($sqlInsertTelefones);

            echo "Deleta da tabela tabelaGeracao_ telefones que estão na tabela \n";
            $sqlDeletaFones = "DELETE FROM $tabelaBanco
                        WHERE CONCAT(tb_pessoa_fisica_fones_cpf,' ',tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone) 
                        IN (SELECT CONCAT(CPF,' ',DDD,FONE) FROM TEL1 GROUP BY FONE) ;";
            $this->db->pdo->exec($sqlDeletaFones);
            // }
//contabilidade
            $sqlTotalEnriquecidosTel = "SELECT count(distinct(tb_pessoa_fisica_fones_cpf )) FROM dataWebProducao.$tabelaBanco ";
            $db_retornoTotalEnriquecidosTel = $this->db->query($sqlTotalEnriquecidosTel);
            $fetch_totalEnriquedidosTel = $db_retornoTotalEnriquecidosTel->fetchAll();

            $totalCpfEnriquecido = ($fetch_totalEnriquedidosTel[0][0]);

//die(".");


            $sqlCreateTable = "CREATE  TABLE  IF NOT EXISTS $nomeTabela SELECT 
            
                pf.tb_pessoa_fisica_cpf as CPF,
                pf.tb_pessoa_fisica_nome,
                
(SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                            $joinSemProcon 
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) as Telefone_01,
               
                            
 (SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1) as  Telefone_02,                            
                            
(SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1) as  Telefone_03,
                            
(SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 3,1) as  Telefone_04,
                            
(SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 4,1) as  Telefone_05,
                                     
                    '' as Telefone_com_Whatsapp_01,
                    '' as Telefone_com_Whatsapp_02,
                    '' as Telefone_com_Whatsapp_03,
                    '' as Telefone_com_Whatsapp_04,
                    '' as Telefone_com_Whatsapp_05,
                    '' as Telefone_Comercial,
                             '' AS Telefone_Fixo_01,
                             '' AS Telefone_Fixo_02,
                             '' AS Telefone_Fixo_03,
                             ''AS Telefone_Fixo_04,
                             '' AS Telefone_Fixo_05,
                                 
 (SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) as Telefone_Celular_01,
                              
 (SELECT tb_pessoa_fisica_fones_operadora
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) Telefone_Operadora_01,
                            
 (SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1) as Telefone_Celular_02,   
                            
 (SELECT tb_pessoa_fisica_fones_operadora
                            FROM dataWebProducao.$tabelaBanco
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1) Telefone_Operadora_02,
                            
(SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1) as Telefone_Celular_03,
                            
 (SELECT tb_pessoa_fisica_fones_operadora
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1) Telefone_Operadora_03,
                                 
(SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 3,1) as Telefone_Celular_04,
                            
 (SELECT tb_pessoa_fisica_fones_operadora
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 3,1) Telefone_Operadora_04,
                                 
(SELECT CONCAT(tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone)
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 4,1) as Telefone_Celular_05,
                            
 (SELECT tb_pessoa_fisica_fones_operadora
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 4,1) Telefone_Operadora_05,
                     
                    
                                '' as Telefone_Operadora,
                                '' as CCF,
                                '' as data_obito,
                                '' as escolaridade,
                                '' as renda_estimada
    
                                 
                                 FROM tb_pessoa_fisica as pf

                                left join tb_pessoa_fisica_fones as fone
                                ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf

                                left join tb_pessoa_fisica_end as endereco
                                ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                
                                left join tb_pessoa_fisica_email as email
                                ON email.tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf

                                where (1=1)
                                AND pf.tb_pessoa_fisica_cpf  IN ($cpfsSaida')
                                                                                
        
                                GROUP BY pf.tb_pessoa_fisica_cpf ";

//echo $sqlCreateTable;
//die(".");
        }

        if ($tipoArquivo == '4') {

            $nomeArquivoCnpj = date('d_m_Y') . "_" . $empresaCnpj . "_" . $idEmriquecimeto . "_LayoutVivo.csv";

            echo "cria tabela csv \n";
            $cabecalhoArquivoSeparado = (str_replace(" ", "_", $cabecalhoArquivoSeparado));
            $cabecalhoArquivoSeparado = (str_replace(",", " varchar(45) DEFAULT NULL , ", $cabecalhoArquivoSeparado . " varchar(45) DEFAULT NULL"));

            $sqlCriarTabelaCsv = "CREATE TABLE  IF NOT EXISTS `$tabelaCsv`   ($cabecalhoArquivoSeparado) ;";
            $this->db->pdo->exec($sqlCriarTabelaCsv);

            echo "Popula tabela csv (LOAD) \n";
            $csvPathAndFile = str_replace('http://dwonline.com.br/desenv/', '/var/www/html/', $arquivo);
            $resultado = shell_exec("/var/www/html/exec/execCriaTemp.sh $csvPathAndFile $tabelaCsv");

            echo "Cria tabela telefones do banco de dados \n";
            $sqlCriaTabelaBancoTel = "SELECT * FROM tb_pessoa_fisica_fones
                                        WHERE tb_pessoa_fisica_fones_cpf   IN ($cpfsSaida') group by tb_pessoa_fisica_fones_fone,tb_pessoa_fisica_fones_cpf
                                        ";


            $sqlCriarTabelaBancoTelefones = "CREATE TABLE  IF NOT EXISTS `$tabelaBanco`   ($sqlCriaTabelaBancoTel) ;";
            $this->db->pdo->exec($sqlCriarTabelaBancoTelefones);

            echo "Cria tabela TEL1 \n";
            $sqlCriarTabelaTEL1 = "CREATE TABLE  IF NOT EXISTS TEL1(
                                                    CPF VARCHAR(20),
                                                    DDD VARCHAR(4),
                                                    FONE VARCHAR(9));";
            $this->db->pdo->exec($sqlCriarTabelaTEL1);

            $sqlInsertTelefones = $telEntrada;
            $this->db->pdo->exec($sqlInsertTelefones);

            echo "Deleta da tabela tabelaGeracao_ telefones que estão na tabela \n";
            $sqlDeletaFones = "DELETE FROM $tabelaBanco
                        WHERE CONCAT(tb_pessoa_fisica_fones_cpf,' ',tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone) 
                        IN (SELECT CONCAT(CPF,' ',DDD,FONE) FROM TEL1 GROUP BY FONE) ;";
            $this->db->pdo->exec($sqlDeletaFones);

//die(".");
//------------------endereço --------------------------------------//


            echo "Cria tabela endereço do banco de dados \n";
            $tabelaBancoEnd = $tabelaBanco . "_end";
            $sqlCriaTabelaBancoEnd = "SELECT * FROM tb_pessoa_fisica_end
                                        WHERE tb_pessoa_fisica_end_cpf   IN ($cpfsSaida')
                                        group by tb_pessoa_fisica_end_cpf";


            $sqlCriarTabelaBancoEnd = "CREATE TABLE  IF NOT EXISTS $tabelaBancoEnd  ($sqlCriaTabelaBancoEnd) ;";
            $this->db->pdo->exec($sqlCriarTabelaBancoEnd);

            echo "Cria tabela END1 \n";
            $sqlCriarTabelaEnd = "CREATE TABLE  IF NOT EXISTS END1(
                                        CPF VARCHAR(20),
                                        ENDERECO VARCHAR(80),
                                        NUM VARCHAR(10),
                                        COMPL VARCHAR(40),
                                        BAIRRO VARCHAR(40),
                                        CIDADE VARCHAR(40),
                                        UF VARCHAR(2),
                                        CEP INT);";
            $this->db->pdo->exec($sqlCriarTabelaEnd);

            $sqlInsertEnd = "INSERT INTO END1 (CPF,ENDERECO,NUM,COMPL,BAIRRO,CIDADE,UF,CEP) SELECT $chaveAtualiza,$enderecoCsv,$numeroCsv,$complementoCsv,$bairroCsv,$cidadeCsv,$ufCsv,$cepCsv FROM $tabelaCsv ;";
            $this->db->pdo->exec($sqlInsertEnd);

            echo "Deleta da tabela tabelaGeracao endereços que estão na tabela \n";
            $sqlDeletaEnd = "DELETE FROM $tabelaBancoEnd
                        WHERE  CONCAT(tb_pessoa_fisica_end_cpf,' ',substr(tb_pessoa_fisica_end_cep,2),tb_pessoa_fisica_end_num)
                        IN (SELECT CONCAT(CPF,' ',CEP,NUM) FROM END1 GROUP BY CEP) ;";
            $this->db->pdo->exec($sqlDeletaEnd);

//contabilidade
            $sqlTotalEnriquecidos = "SELECT count(distinct(tb_pessoa_fisica_fones_cpf )) FROM dataWebProducao.$tabelaBanco as b
                                    left join $tabelaBancoEnd as e
                                    on e.tb_pessoa_fisica_end_cpf = b.tb_pessoa_fisica_fones_cpf";
            $db_retornoTotalEnriquecidos = $this->db->query($sqlTotalEnriquecidos);
            $fetch_totalEnriquedidos = $db_retornoTotalEnriquecidos->fetchAll();

            $totalCpfEnriquecido = ($fetch_totalEnriquedidos[0][0]);
//die(".");


            $sqlCreateTable = "CREATE  TABLE  IF NOT EXISTS $nomeTabela SELECT 
            
                pf.tb_pessoa_fisica_cpf as CPF,
                               
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) AS 01_DDD,
    
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1)  AS 01_FONE,
                                 
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1) AS 02_DDD,
    
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1)  AS 02_FONE,
                                 
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1) AS 03_DDD,
    
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1)  AS 03_FONE,
                                 
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 3,1) AS 04_DDD,
    
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 3,1)  AS 04_FONE,
                                 
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 4,1) AS 05_DDD,
    
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 4,1)  AS 05_FONE,
                                 
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 5,1) AS 06_DDD,
    
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 5,1)  AS 06_FONE,
                                 
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 6,1) AS 07_DDD,
    
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 6,1)  AS 07_FONE,
                                 
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 7,1) AS 08_DDD,
    
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 7,1)  AS 08_FONE,

                                 
(SELECT CONCAT(tb_pessoa_fisica_end_end,' ',tb_pessoa_fisica_end_num,' ',tb_pessoa_fisica_end_compl)
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1)  AS ENDERECO,
                                
      (SELECT tb_pessoa_fisica_end_bairro
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1) as BAIRRO,
                                
(SELECT tb_pessoa_fisica_end_cep
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1) as CEP,
                                

(SELECT tb_pessoa_fisica_end_uf
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1) as UF,
                           

(SELECT CONCAT(tb_pessoa_fisica_end_end,' ',tb_pessoa_fisica_end_num,' ',tb_pessoa_fisica_end_compl)
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 1,1) as END_ENDERECO2,                              
 
(SELECT tb_pessoa_fisica_end_bairro
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 1,1) as BAIRRO2,

(SELECT tb_pessoa_fisica_end_cidade
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 1,1) as CIDADE2,
                      
(SELECT tb_pessoa_fisica_end_uf
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 1,1) as UF2,

                              
'                                                             ' AS email1
                                 
                                 FROM tb_pessoa_fisica as pf

                                left join tb_pessoa_fisica_fones as fone
                                ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf

                                left join tb_pessoa_fisica_end as endereco
                                ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                
                                left join tb_pessoa_fisica_email as email
                                ON email.tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf

                                where (1=1)
                                AND pf.tb_pessoa_fisica_cpf  IN ($cpfsSaida')
                                                                                
        
                                GROUP BY pf.tb_pessoa_fisica_cpf ";

//echo $sqlCreateTable;
//die(".");
        }

        if ($tipoArquivo == '5') {

            $nomeArquivoCnpj = date('d_m_Y') . "_" . $empresaCnpj . "_" . $idEmriquecimeto . "_LayoutEscob.csv";

            $sqlCreateTable = "CREATE  TABLE  IF NOT EXISTS $nomeTabela SELECT 
                    
                'c' as TipoLinha1,
                '' as IdDoarquivo,
                '' as DataDegeração,
                'dataWeb' as EPS,

                'd' as TipoLinha2,
                '' as CodigoDevedor,
                 pf.tb_pessoa_fisica_cpf as Documento,

                'R' as TipoTelefone1,
                ( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS ddd1,
    
                ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS fone1,
                                 
'R' as TipoTelefone2,                                 
( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) AS ddd2,
    
                ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) AS fone2,
'R' as TipoTelefone3,                                 
( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) AS ddd3,
    
                ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) AS fone3,
'R' as TipoTelefone4,                                 
( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 3,1) AS ddd4,
    
                ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 3,1) AS fone4,
'R' as TipoTelefone5,                                 
( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 4,1) AS ddd5,
    
                ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 4,1) AS fone5,
'R' as TipoTelefone6,                                 
( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 5,1) AS ddd6,
    
                ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 5,1) AS fone6,
'R' as TipoTelefone7,                                 
( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 6,1) AS ddd7,
    
                ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 6,1) AS fone7,
'R' as TipoTelefone8,    
( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 7,1) AS ddd8,

                ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 7,1) AS fone8,
                                 
'M' as TipoTelefone9,    
( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS ddd9,

                ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS fone9,
                                 
'M' as TipoTelefone10,    
( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) AS ddd10,

                ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 $joinSemProcon
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 $semProcon
                                 AND tb_pessoa_fisica_fones_tipo = 2
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS fone10,

                                 'R' AS TipoEndereço1,

                                 (SELECT tb_pessoa_fisica_end_end FROM dataWebProducao.tb_pessoa_fisica_end 
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
                                
    'R' AS TipoEndereço2,
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
                                LIMIT 2,1) AS complemento2,

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

                                '                                                                                      ' AS email1,
                                'P' as TipoEmail1,                                
                                '                                                                                      ' AS email2,
                                'P' as TipoEmail2,                                
                                '' as TotalDeregistros
                                 
                                 FROM tb_pessoa_fisica as pf

                                left join tb_pessoa_fisica_fones as fone
                                ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf

                                left join tb_pessoa_fisica_end as endereco
                                ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                
                                left join tb_pessoa_fisica_email as email
                                ON email.tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf

                                where (1=1)
                                AND pf.tb_pessoa_fisica_cpf  IN ($cpfsSaida')
                                                                                
        
                                GROUP BY pf.tb_pessoa_fisica_cpf ";

// echo $sqlCreateTable;
// die(".");
        }

        if ($tipoArquivo == '6') {

            $nomeArquivoCnpj = date('d_m_Y') . "_" . $empresaCnpj . "_" . $idEmriquecimeto . "_LayoutIntersic.csv";

            $sqlCreateTable = "CREATE  TABLE  IF NOT EXISTS $nomeTabela SELECT 
                    pf.tb_pessoa_fisica_cpf as C02_CPF,
                    
'' as C01_CHAVE,
'' as C02_STATUS,
'' as C03_TP_LOGR,

 (SELECT tb_pessoa_fisica_end_end FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS C04_NOME_LOGR,

                                (SELECT tb_pessoa_fisica_end_num
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS C05_NUM_LOGR,

                                (SELECT tb_pessoa_fisica_end_compl
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS C06_COMPL_LOGR,
                                
(SELECT tb_pessoa_fisica_end_bairro
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS C07_BAIRRO,
                                
   (SELECT tb_pessoa_fisica_end_cep
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS C08_CEP,
                                
                                (SELECT tb_pessoa_fisica_end_cidade
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS C09_CIDADE,

                                (SELECT tb_pessoa_fisica_end_uf
                                FROM dataWebProducao.tb_pessoa_fisica_end 
                                where tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                GROUP BY tb_pessoa_fisica_end_cep,tb_pessoa_fisica_end_num
                                ORDER BY tb_pessoa_fisica_end_data DESC
                                LIMIT 0,1) AS C10_UF,
                                
  ( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS C11_DDD,
    
                ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 0,1) AS C12_TELEFONE,

( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) as C13_DDD_FONE_ADIC_1,
                                 
 ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 1,1) AS C14_FONE_ADIC_1,
                                 
'L' as C15_TP_FONE_ADIC_1,

( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) as C16_DDD_FONE_ADIC_2,
                                 
 ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 2,1) AS C17_FONE_ADIC_2,
'L' as C18_TP_FONE_ADIC_2,                     

( select tb_pessoa_fisica_fones_ddd
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 3,1) as C19_DDD_FONE_ADIC_3,
                                 
 ( select tb_pessoa_fisica_fones_fone
                                 from tb_pessoa_fisica_fones
                                 where tb_pessoa_fisica_fones_cpf= pf.tb_pessoa_fisica_cpf
                                 AND tb_pessoa_fisica_fones_tipo = 1
                                 GROUP BY tb_pessoa_fisica_fones_fone
                                 ORDER BY idtb_pessoa_fisica_fones,tb_pessoa_fisica_fones_data 
                                 LIMIT 3,1) AS C20_FONE_ADIC_3,
                                 
'L' as C21_TP_FONE_ADIC_3,
'' as C22_EMAIL,
'' as C23_FORMA_LOC,
'' aS C99_CRLF
                                 
                                 FROM tb_pessoa_fisica as pf

                                left join tb_pessoa_fisica_fones as fone
                                ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf

                                left join tb_pessoa_fisica_end as endereco
                                ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                
                                left join tb_pessoa_fisica_email as email
                                ON email.tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf

                                where (1=1)
                                AND pf.tb_pessoa_fisica_cpf  IN ($cpfsSaida')
                                                                                
        
                                GROUP BY pf.tb_pessoa_fisica_cpf ";

//echo $sqlCreateTable;
// die(".");
        }


        if ($tipoArquivo == '7') {


            $nomeArquivoCnpj = date('d_m_Y') . "_" . $empresaCnpj . "_" . $idEmriquecimeto . "_LayoutSomenteTelefones.csv";

            // if (!$tipoArquivo == 'cpf' || !$tipoArquivo == 'cnpj') {
            echo "cria tabela csv \n";
            $cabecalhoArquivoSeparado = (str_replace(" ", "_", $cabecalhoArquivoSeparado));
            $cabecalhoArquivoSeparado = (str_replace(",", " varchar(45) DEFAULT NULL , ", $cabecalhoArquivoSeparado . " varchar(45) DEFAULT NULL"));

            $sqlCriarTabelaCsv = "CREATE TABLE  IF NOT EXISTS `$tabelaCsv`   ($cabecalhoArquivoSeparado) ;";
            $this->db->pdo->exec($sqlCriarTabelaCsv);

            echo "Popula tabela csv (LOAD) \n";
            $csvPathAndFile = str_replace('http://dwonline.com.br/desenv/', '/var/www/html/', $arquivo);
            $resultado = shell_exec("/var/www/html/exec/execCriaTemp.sh $csvPathAndFile $tabelaCsv");

            echo "Cria tabela telefones do banco de dados \n";
            $sqlCriaTabelaBancoTel = "SELECT * FROM tb_pessoa_fisica_fones
                                        WHERE tb_pessoa_fisica_fones_cpf   IN ($cpfsSaida') group by tb_pessoa_fisica_fones_fone,tb_pessoa_fisica_fones_cpf";


            $sqlCriarTabelaBancoTelefones = "CREATE TABLE  IF NOT EXISTS `$tabelaBanco`   ($sqlCriaTabelaBancoTel) ;";
            $this->db->pdo->exec($sqlCriarTabelaBancoTelefones);

            echo "Cria tabela TEL1 \n";
            $sqlCriarTabelaTEL1 = "CREATE TABLE  IF NOT EXISTS TEL1(
                                                    CPF VARCHAR(20),
                                                    DDD VARCHAR(4),
                                                    FONE VARCHAR(9));";
            $this->db->pdo->exec($sqlCriarTabelaTEL1);

            $sqlInsertTelefones = $telEntrada;
            $this->db->pdo->exec($sqlInsertTelefones);

            echo "Deleta da tabela tabelaGeracao_ telefones que estão na tabela \n";
            $sqlDeletaFones = "DELETE FROM $tabelaBanco
                        WHERE CONCAT(tb_pessoa_fisica_fones_cpf,' ',tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone) 
                        IN (SELECT CONCAT(CPF,' ',DDD,FONE) FROM TEL1 GROUP BY FONE) ;";

            $this->db->pdo->exec($sqlDeletaFones);
            //}
//contabilidadede verificar

            $sqlCreateTable = "CREATE  TABLE  IF NOT EXISTS $nomeTabela SELECT 
                    
                            pf.tb_pessoa_fisica_cpf,


(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) as  ddd1,
                            
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) as  fone1,
                            
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1) as  ddd2,
                            
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1) as  fone2,
                            
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1) as  ddd3,
                            
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1) as  fone3,
              
                                 
 (SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) as ddd_cel1,
                            
 (SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) as fone_cel1,
                            
 (SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1) as ddd_cel2,
                            
 (SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1) as fone_cel2,
                            
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1) as ddd_cel3,
                            
 (SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1) as fone_cel3
                                 

                                 FROM tb_pessoa_fisica as pf

                                left join tb_pessoa_fisica_fones as fone
                                ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf

                                left join tb_pessoa_fisica_end as endereco
                                ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                
                                left join tb_pessoa_fisica_email as email
                                ON email.tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf

                                where (1=1)
                                AND pf.tb_pessoa_fisica_cpf  IN ($cpfsSaida')
                                                                                
        
                                GROUP BY pf.tb_pessoa_fisica_cpf ";

//echo $sqlCreateTable;
//die(".");
        }

        if ($tipoArquivo == '8') {

            $nomeArquivoCnpj = date('d_m_Y') . "_" . $empresaCnpj . "_" . $idEmriquecimeto . "_LayoutExternoBia.txt";

            if (!$tipoArquivo == 'cpf' || !$tipoArquivo == 'cnpj') {

                echo "cria tabela csv \n";
                $cabecalhoArquivoSeparado = (str_replace(" ", "_", $cabecalhoArquivoSeparado));
                $cabecalhoArquivoSeparado = (str_replace(",", " varchar(45) DEFAULT NULL , ", $cabecalhoArquivoSeparado . " varchar(45) DEFAULT NULL"));

                $sqlCriarTabelaCsv = "CREATE TABLE  IF NOT EXISTS `$tabelaCsv`   ($cabecalhoArquivoSeparado) ;";
                $this->db->pdo->exec($sqlCriarTabelaCsv);

                echo "Popula tabela csv (LOAD) \n";
                $csvPathAndFile = str_replace('http://dwonline.com.br/desenv/', '/var/www/html/', $arquivo);
                $resultado = shell_exec("/var/www/html/exec/execCriaTemp.sh $csvPathAndFile $tabelaCsv");

                echo "Cria tabela telefones do banco de dados \n";
                $sqlCriaTabelaBancoTel = "SELECT * FROM tb_pessoa_fisica_fones
                                        WHERE tb_pessoa_fisica_fones_cpf   IN ($cpfsSaida') group by tb_pessoa_fisica_fones_fone,tb_pessoa_fisica_fones_cpf
                                        ";


                $sqlCriarTabelaBancoTelefones = "CREATE TABLE  IF NOT EXISTS `$tabelaBanco`   ($sqlCriaTabelaBancoTel) ;";
                $this->db->pdo->exec($sqlCriarTabelaBancoTelefones);

                echo "Cria tabela TEL1 \n";
                $sqlCriarTabelaTEL1 = "CREATE TABLE  IF NOT EXISTS TEL1(
                                                    CPF VARCHAR(20),
                                                    DDD VARCHAR(4),
                                                    FONE VARCHAR(9));";
                $this->db->pdo->exec($sqlCriarTabelaTEL1);

                $sqlInsertTelefones = $telEntrada;
                $this->db->pdo->exec($sqlInsertTelefones);

                echo "Deleta da tabela tabelaGeracao_ telefones que estão na tabela \n";
                $sqlDeletaFones = "DELETE FROM $tabelaBanco
                        WHERE CONCAT(tb_pessoa_fisica_fones_cpf,' ',tb_pessoa_fisica_fones_ddd,tb_pessoa_fisica_fones_fone) 
                        IN (SELECT CONCAT(CPF,' ',DDD,FONE) FROM TEL1 GROUP BY FONE) ;";
                $this->db->pdo->exec($sqlDeletaFones);

//die(".");
//------------------endereço --------------------------------------//


                echo "Cria tabela endereço do banco de dados \n";
                $tabelaBancoEnd = $tabelaBanco . "_end";
                $sqlCriaTabelaBancoEnd = "SELECT * FROM tb_pessoa_fisica_end
                                        WHERE tb_pessoa_fisica_end_cpf   IN ($cpfsSaida')
                                        group by tb_pessoa_fisica_end_cpf";


                $sqlCriarTabelaBancoEnd = "CREATE TABLE  IF NOT EXISTS $tabelaBancoEnd  ($sqlCriaTabelaBancoEnd) ;";
                $this->db->pdo->exec($sqlCriarTabelaBancoEnd);

                echo "Cria tabela END1 \n";
                $sqlCriarTabelaEnd = "CREATE TABLE  IF NOT EXISTS END1(
                                        CPF VARCHAR(20),
                                        ENDERECO VARCHAR(80),
                                        NUM VARCHAR(10),
                                        COMPL VARCHAR(40),
                                        BAIRRO VARCHAR(40),
                                        CIDADE VARCHAR(40),
                                        UF VARCHAR(2),
                                        CEP INT);";
                $this->db->pdo->exec($sqlCriarTabelaEnd);

                $sqlInsertEnd = "INSERT INTO END1 (CPF,ENDERECO,NUM,COMPL,BAIRRO,CIDADE,UF,CEP) SELECT $chaveAtualiza,$enderecoCsv,$numeroCsv,$complementoCsv,$bairroCsv,$cidadeCsv,$ufCsv,$cepCsv FROM $tabelaCsv ;";
                $this->db->pdo->exec($sqlInsertEnd);

                echo "Deleta da tabela tabelaGeracao endereços que estão na tabela \n";
                $sqlDeletaEnd = "DELETE FROM $tabelaBancoEnd
                        WHERE  CONCAT(tb_pessoa_fisica_end_cpf,' ',substr(tb_pessoa_fisica_end_cep,2),tb_pessoa_fisica_end_num)
                        IN (SELECT CONCAT(CPF,' ',CEP,NUM) FROM END1 GROUP BY CEP) ;";
                $this->db->pdo->exec($sqlDeletaEnd);
            }
//die(".");
//contabilidade
            $sqlTotalEnriquecidos = "SELECT count(distinct(tb_pessoa_fisica_fones_cpf )) FROM dataWebProducao.$tabelaBanco as b
                                    left join $tabelaBancoEnd as e
                                    on e.tb_pessoa_fisica_end_cpf = b.tb_pessoa_fisica_fones_cpf";
            $db_retornoTotalEnriquecidos = $this->db->query($sqlTotalEnriquecidos);
            $fetch_totalEnriquedidos = $db_retornoTotalEnriquecidos->fetchAll();

            $totalCpfEnriquecido = ($fetch_totalEnriquedidos[0][0]);

            $sqlCreateTable = "CREATE  TABLE  IF NOT EXISTS $nomeTabela SELECT 
                    
pf.tb_pessoa_fisica_cpf,
                                
 

pf.tb_pessoa_fisica_nome as NOME_COMPLETO,
pf.tb_pessoa_fisica_data_nascimento as DATA_DE_NASCIMENTO,
pf.tb_pessoa_fisica_sexo as SEXO,
'' as ESTADO_CIVIL,
pf.tb_pessoa_fisica_nome_mae as NOME_DA_MAE,
'' AS STATUS_NA_BASE,
'' AS FAIXA_DE_RENDA,
'' as PESSOAS_POLITICAMENTE_ESPOSTAS,


(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) as  DDD_RESIDENCIAL,
                            
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) as  FONE_RESIDENCIAL,
                            
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) as  DDD_CELULAR,
                            
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=2
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 0,1) as  FONE_CELULAR,


'' as DDD_COMERCIAL,
'' as FONE_COMERCIAL,


                      
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1) as  DDD_OUTROS_1,
                            
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 1,1) as  FONE_OUTROS_1,
                            
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1) as  DDD_OUTROS_2,
                            
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 2,1) as  FONE_OUTROS_2,
                            
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 3,1) as  DDD_OUTROS_3,
                            
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 3,1) as  FONE_OUTROS_3,
                            
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 4,1) as  DDD_OUTROS_4,
                            
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 4,1) as  FONE_OUTROS_4,
                            
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 5,1) as  DDD_OUTROS_5,
                            
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 5,1) as  FONE_OUTROS_5,
                            
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 6,1) as  DDD_OUTROS_6,
                            
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 6,1) as  FONE_OUTROS_6,
                            
(SELECT tb_pessoa_fisica_fones_ddd
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 7,1) as  DDD_OUTROS_7,
                            
(SELECT tb_pessoa_fisica_fones_fone
                            FROM dataWebProducao.$tabelaBanco
                                $joinSemProcon
                            WHERE tb_pessoa_fisica_fones_cpf=pf.tb_pessoa_fisica_cpf
                            $semProcon
                            AND tb_pessoa_fisica_fones_tipo=1
                            order by tb_pessoa_fisica_fones_cpf,tb_pessoa_fisica_fones_data desc limit 7,1) as  FONE_OUTROS_7,

'' as END_1_TIPO,

(SELECT tb_pessoa_fisica_end_end
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1) AS END_1_LOUGRADOURO,

(SELECT tb_pessoa_fisica_end_num
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1)  AS END_1_NÚMERO,
                                
          (SELECT tb_pessoa_fisica_end_compl
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1)  AS END_1_COMPLEMENTO,
                                
           (SELECT tb_pessoa_fisica_end_cep
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1)  AS END_1_CEP,
                                
(SELECT tb_pessoa_fisica_end_bairro
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1)  AS END_1_BAIRRO,
                                
                                      
(SELECT tb_pessoa_fisica_end_cidade
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1)  AS END_1_CIDADE,
                                
                                    
(SELECT tb_pessoa_fisica_end_uf
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 0,1)  AS END_1_ESTADO,
                                
                 
                                
'' as END_2_TIPO,

(SELECT tb_pessoa_fisica_end_end
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 1,1) AS END_2_LOUGRADOURO,
                                
(SELECT tb_pessoa_fisica_end_num
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 1,1) AS END_2_NÚMERO,
                                
(SELECT tb_pessoa_fisica_end_compl
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 1,1) AS END_2_COMPLEMENTO,

                                
      (SELECT tb_pessoa_fisica_end_cep
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 1,1)  AS END_2_CEP,
                                
 (SELECT tb_pessoa_fisica_end_bairro
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 1,1)  AS END_2_BAIRRO,
   
(SELECT tb_pessoa_fisica_end_cidade
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 1,1)  AS END_2_CIDADE,
                                
(SELECT tb_pessoa_fisica_end_uf
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 1,1) AS END_2_ESTADO,   
           
                                
'' as END_3_TIPO,

(SELECT tb_pessoa_fisica_end_end
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 2,1) AS END_3_LOUGRADOURO,
                                
(SELECT tb_pessoa_fisica_end_num
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 2,1) AS END_3_NÚMERO,
                                
(SELECT tb_pessoa_fisica_end_compl
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 2,1) AS END_3_COMPLEMENTO,

                                
      (SELECT tb_pessoa_fisica_end_cep
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 2,1)  AS END_3_CEP,
                                
 (SELECT tb_pessoa_fisica_end_bairro
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 2,1)  AS END_3_BAIRRO,
   
(SELECT tb_pessoa_fisica_end_cidade
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 2,1)  AS END_3_CIDADE,
                                
(SELECT tb_pessoa_fisica_end_uf
                            FROM dataWebProducao.$tabelaBancoEnd
                            WHERE tb_pessoa_fisica_end_cpf=pf.tb_pessoa_fisica_cpf
                            order by tb_pessoa_fisica_end_cpf,tb_pessoa_fisica_end_data desc limit 2,1) AS END_3_ESTADO, 
                 
 
'' as email1,
'' as email2,
'' as email3,
'' as email4,
'' as email5,

'' as CAMPO_TEXTO_GENÉRICO_1,
'' as CAMPO_TEXTO_GENÉRICO_2,
'' as CAMPO_TEXTO_GENÉRICO_3,
'' as CAMPO_TEXTO_GENÉRICO_4,
'' as CAMPO_TEXTO_GENÉRICO_5
                                 

                                 FROM tb_pessoa_fisica as pf

                                left join tb_pessoa_fisica_fones as fone
                                ON fone.tb_pessoa_fisica_fones_cpf = pf.tb_pessoa_fisica_cpf

                                left join tb_pessoa_fisica_end as endereco
                                ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
                                
                                left join tb_pessoa_fisica_email as email
                                ON email.tb_pessoa_fisica_email_cpf = pf.tb_pessoa_fisica_cpf

                                where (1=1)
                                AND pf.tb_pessoa_fisica_cpf  IN ($cpfsSaida')
                                                                                
        
                                GROUP BY pf.tb_pessoa_fisica_cpf ";

//echo $sqlCreateTable;
//die(".");
        }
        unset($cpfsSaida);
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


//Gravar query executada
        $query = $this->db->update('tb_enriquecimento', 'idtb_enriquecimento', $idEmriquecimeto, array(
            'tb_enriquecimento_query' => $sqlCreateTable));

        echo "Executando query geradora \n";
        //echo $sqlCreateTable;
        //die(".");
        $db_retornoMR = $this->db->pdo->exec($sqlCreateTable);
        $qtdProcessada = count($db_retornoMR);

        $pastaUpload = "/var/www/html/$empresaCnpj/";





//contabilidade-------------------------------------------------------------------------------------------------//

        if ($tipoArquivo == 'cpf') {
//contabilidade

            $sqlTotalEnriquecidos = "SELECT count(distinct(tb_pessoa_fisica_cpf)) FROM dataWebProducao.$nomeTabela ";
            $db_retornoTotalEnriquecidos = $this->db->query($sqlTotalEnriquecidos);

            $fetch_totalEnriquedidos = $db_retornoTotalEnriquecidos->fetchAll();
            $totalCpfEnriquecido = ($fetch_totalEnriquedidos[0][0]);
        }

        if ($tipoArquivo == 'cnpj') {
//contabilidade

            $sqlTotalEnriquecidos = "SELECT count(distinct(tb_pessoa_juridica_cnpj)) FROM dataWebProducao.$nomeTabela ";
            $db_retornoTotalEnriquecidos = $this->db->query($sqlTotalEnriquecidos);

            $fetch_totalEnriquedidos = $db_retornoTotalEnriquecidos->fetchAll();
            $totalCpfEnriquecido = ($fetch_totalEnriquedidos[0][0]);
        }

        $db_retornoQueryIdUser = $this->db->query("SELECT * FROM tb_usuario
            where tb_usuario_username_email like '" . $fetch_query[0]['tb_enriquecimento_user_envio'] . "'");
        $fetch_queryIdUser = $db_retornoQueryIdUser->fetchAll();



        $totalCpfEnriquecidoGeral = $totalCpfEnriquecido;



//verifica creditos
        //if ((($fetch_userMR[0]['tb_empresa_qtd_contratada'] - $fetch_userMR[0]['tb_empresa_qtd_max_registros']) >= $totalCpfEnriquecidoGeral) || $fetch_userMR[0]['tb_empresa_permite_excedente'] == 'on') {

        echo"debitaDw-->" . $this->controleCustos->debitaMultiplosDw($empresaCnpj, 'enriquecimento', $totalCpfEnriquecidoGeral) . "\n \n";
        die(".");
        $query0 = $this->db->update('tb_empresa', 'tb_empresa_cnpj', $empresaCnpj, array(
            'tb_empresa_qtd_max_registros' => ($fetch_userMR[0]['tb_empresa_qtd_max_registros'] + $qtdProcessar)));

        if ($query0) {

            $user['cnpjEmpresa'] = $empresaCnpj;
            $user['filtro'] = $idEmriquecimeto;
            $user['tb_utilizacao_sistema_idtb_user'] = $fetch_queryIdUser[0]['idtb_usuario'];
            $server = '';
            $retornoOk = 1;

            //for ($i = 0; $i < $totalCpfEnriquecidoGeral; $i++) {

            echo ">> utilização sistema \n" . $this->utilizacaoSistemaTabelaContagem($server, $user, $totalCpfEnriquecidoGeral, $idEmriquecimeto);
            //}


            echo("Processo Atualizado em créditos para empresa " . $empresaCnpj . " qtd:" . $totalCpfEnriquecidoGeral . " Data:" . date('d/m/Y h:m:s', time()));
        }
        //     } else {
        //        echo "Creditos insuficientes \n";
        //       die("Finalizando \n");
        //  }
//--------------------------------------fim contabilidade------------------------------------------------------//

        if (!$db_retornoMR) {

// Configura o erro
            $error = $this->db->pdo->errorInfo();

            print_r($error);

            if ($error[2] = "Illegal mix of collations for operation ' IN '") {
                echo "Illegal mix of collations for operation ' IN ' \n";
                $query = $this->db->update('tb_enriquecimento', 'idtb_enriquecimento', $idEmriquecimeto, array(
                    'tb_enriquecimento_erro' => $error[2]));
            } else {
                $query = $this->db->update('tb_enriquecimento', 'idtb_enriquecimento', $idEmriquecimeto, array(
                    'tb_enriquecimento_erro' => $error[2]));
            }
            if ($error[0] != '00000') {

//ok testado
                $enviarPara = "andrecastilho007@hotmail.com";
                $assunto = "Erro Enriquecimento";
                $corpo = " teste ";

                $db_retornoHtml = $this->db->query("SELECT tb_html_email_html FROM tb_html_email
                                                    where tb_html_email_nome_layout like 'ERRO ENRIQUECIMENTO'");

                $fetch_html = $db_retornoHtml->fetchAll();

                $htmlEmail = html_entity_decode($fetch_html[0]['tb_html_email_html']);

                $this->enviaEmailSes->enviarEmail($enviarPara, $assunto, $corpo, $htmlEmail);

                die('..erro query - id = ' . $idEmriquecimeto);
            } else {
                $query0 = $this->db->update('tb_enriquecimento', 'idtb_enriquecimento', $idEmriquecimeto, array(
                    'tb_enriquecimento_qtd_total_registros' => '0'));
            }
        }


// Pasta onde o arquivo vai ser salvo
        if (file_exists($pastaUpload)) {
            
        } else {

            $cridou = mkdir("$pastaUpload", 0777); // Cria uma nova pasta dentro do diretório atual
            shell_exec("chmod -R 777 $pastaUpload");
            if (!$cridou) {
                echo "Pasta não criada";
                die("Erro ao criar arquivo \n");
            }
        }


        if ($tipoArquivo == 'cpf') {
//echo "/var/www/html/exec/exec.sh '$nomeTabela' '/var/www/html/$empresaCnpj/$nomeArquivoCpf'";
//die(".");

            $resultado = shell_exec("/var/www/html/exec/exec.sh '$nomeTabela' '/var/www/html/$empresaCnpj/$nomeArquivoCpf'");
// echo (">>>----> " . $resultado);
        } else {
            $resultado = shell_exec("/var/www/html/exec/exec.sh '$nomeTabela' '/var/www/html/$empresaCnpj/$nomeArquivoCnpj'");
//die(">>>---- " . $resultado);
        }


        $this->processaArquivo->atualizaArquivo($nomeArquivoCpf, $nomeArquivoCnpj, $idEmriquecimeto, $qtdProcessada);
        if ($nomeTabela)
            $this->processaArquivo->excluiTabela($nomeTabela);



        if ($tipoArquivo != 'cnpj' || !$tipoArquivo != 'cpf') {
            $this->processaArquivo->excluiTabela($tabelaCsv);
            $this->processaArquivo->excluiTabela($tabelaBanco);
            $this->processaArquivo->excluiTabela($tabelaBancoEnd);
            $this->processaArquivo->excluiTabela('TEL1');
            $this->processaArquivo->excluiTabela('END1');
        }
        $this->db->fecharConexao();
    }

    public function utilizacaoSistemaTabelaContagem($server, $user, $totalCpfEnriquecidoGeral, $idEmriquecimeto) {



        $sqlInsert = "INSERT INTO tb_utilizacao_contagem
                            (tb_utilizacao_contagem_cnpj_empresa,tb_utilizacao_contagem_id_enriquecimento,tb_utilizacao_contagem_idtb_usuario,tb_utilizacao_contagem_data,tb_utilizacao_contagem_total_enriquecido,tb_utilizacao_contagem_idtb_enriquecimento)
                            values(" . $user['cnpjEmpresa'] . " ,'" . $user['filtro'] . "'," . $user['tb_utilizacao_sistema_idtb_user'] . "," . time() . ",$totalCpfEnriquecidoGeral,$idEmriquecimeto)";

        $this->db->pdo->exec($sqlInsert);
    }

    public function atualizaArquivo($arquivoCpf, $arquivoCnpj, $idArquivo, $qtd) {

        $this->db = new TutsupDB();
        $query = $this->db->update('tb_enriquecimento', 'idtb_enriquecimento', $idArquivo, array(
            'tb_enriquecimento_arquivo_cpf' => $arquivoCpf,
            'tb_enriquecimento_arquivo_cnpj' => $arquivoCnpj,
            'tb_enriquecimento_msg_visualizada' => null,
            'tb_enriquecimento_qtd_total_registros' => $qtd - 1,
            'tb_enriquecimento_data_final_processamento' => time("d/m/Y G:i:s")
        ));
    }

    public function atualizaArquivoEmProcesamento($idArquivo, $semCredito = null) {

        $this->db = new TutsupDB();

        if ($semCredito) {
            echo "\n sem credito atualizado \n";

            $query = $this->db->update('tb_enriquecimento', 'idtb_enriquecimento', $idArquivo, array(
                'tb_enriquecimento_em_procesamento' => '1',
                'tb_enriquecimento_sem_credito' => '1'));
        } else {
            $query = $this->db->update('tb_enriquecimento', 'idtb_enriquecimento', $idArquivo, array(
                'tb_enriquecimento_em_procesamento' => '1'));
        }
        if ($query) {
            echo"Processo Atualizado \n";
        } else {
            echo "Erro na atualização de estado - Em processamento \n";
        }
    }

    public function excluiTabela($nomeTabela) {

        $this->db = new TutsupDB();
        $query = $this->db->pdo->exec("DROP TABLE `dataWebProducao`.`$nomeTabela`;");
        if ($query) {
            echo"Tabela Excluida \n";
        }
    }

}
