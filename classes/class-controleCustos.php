<?php

/**
 * controleCustos - Classe para gerenciamento creditos e custos do sistema
 *
 * @package DataWeb
 * @since 0.1
 */
class controleCustos extends TutsupDB {

    protected $db;

    function __construct() {
        $this->db = new TutsupDB();
    }

    function buscaCustoOperacao($produto, $cnpjEmpresa) {

        $sql = "SELECT * FROM tb_credito_custo_empresa_produtos where tb_credito_custo_empresa_produtos_cnpj	 = '$cnpjEmpresa'";
        $db_retorno = $this->db->query($sql);
        $fetch = $db_retorno->fetchAll();

        return $fetch;
    }

    function permiteExcedente($cnpjEmpresa) {

        $sql = "SELECT tb_empresa_permite_excedente FROM tb_empresa where tb_empresa_cnpj	 = '$cnpjEmpresa'";
        $db_retorno = $this->db->query($sql);
        $fetch = $db_retorno->fetchAll();

        return $fetch;
    }

    function valorContratado($cnpjEmpresa) {

        $sql = "SELECT tb_empresa_qtd_contratada FROM tb_empresa where tb_empresa_cnpj	 = '$cnpjEmpresa'";
        $db_retorno = $this->db->query($sql);
        $fetch = $db_retorno->fetchAll();

        return $fetch;
    }

    function debitarDw($cnpjEmpresa, $tipo) {

        $saldoAtual = $this->retornaSaldoAtual($cnpjEmpresa);
        $valorProduto = $this->buscaCustoOperacao($tipo, $cnpjEmpresa);
        $premiteExcedente = $this->permiteExcedente($cnpjEmpresa);
        $valorContratado = $this->valorContratado($cnpjEmpresa);

        if ($tipo == 'online') {
            $custoOnlineEmpresa = $valorProduto[0]['tb_credito_custo_empresa_produtos_online'];
        }
        if ($tipo == 'webservice') {
            $custoOnlineEmpresa = $valorProduto[0]['tb_credito_custo_empresa_produtos_web_service'];
        }
        if ($tipo == 'cnf_simples') {
            $custoOnlineEmpresa = $valorProduto[0]['tb_credito_custo_empresa_produtos_cnf_simples'];
        }
        if ($tipo == 'cnf_detalhado') {
            $custoOnlineEmpresa = $valorProduto[0]['tb_credito_custo_empresa_produtos_cnf_detalhado'];
        }

        //verificar Saldo
        if ($saldoAtual >= 0 || $saldoAtual <= $valorContratado || $premiteExcedente[0]['tb_empresa_permite_excedente'] == 'on') {
            $atualizaSaldo = (($saldoAtual) - $custoOnlineEmpresa);
            $query = $this->db->update('tb_credito_atual', 'tb_credito_atual_cnpj', $cnpjEmpresa, array(
                'tb_credito_atual_saldo' => $atualizaSaldo));
        } else {

            if ($tipo == 'webservice') {
                return '003';
            }

            echo "Sem Saldo para esta operação. Seu saldo é de R$ " . $saldoAtual;
            die(".");
        }
    }

    function debitaMultiplosDw($cnpjEmpresa, $tipo, $qtd, $idEmriquecimeto) {

        $saldoAtual = $this->retornaSaldoAtual($cnpjEmpresa);
        $valorProduto = $this->buscaCustoOperacao($tipo, $cnpjEmpresa);
        $premiteExcedente = $this->permiteExcedente($cnpjEmpresa);
        $valorContratado = $this->valorContratado($cnpjEmpresa);

        if ($tipo == 'enriquecimento') {
            $custoEnriquecimentoEmpresa = $valorProduto[0]['tb_credito_custo_empresa_produtos_enriquecimento'];
        }
        if ($tipo == 'extracao') {
            $custoEnriquecimentoEmpresa = $valorProduto[0][''];
        }

        $custoOperacao = $custoEnriquecimentoEmpresa * $qtd . "\n";
        $atualizaSaldo = $saldoAtual - $custoOperacao . "\n ";

        if ($atualizaSaldo >= 0 || $saldoAtual <= $valorContratado || $premiteExcedente[0]['tb_empresa_permite_excedente'] == 'on') {

            $query = $this->db->update('tb_credito_atual', 'tb_credito_atual_cnpj', $cnpjEmpresa, array(
                'tb_credito_atual_saldo' => $atualizaSaldo));
        } else {

            $query = $this->db->update('tb_enriquecimento', 'idtb_enriquecimento', $idEmriquecimeto, array(
                'tb_enriquecimento_erro' => 'Sem Saldo, para esta operação serão necessários R$ ' . $atualizaSaldo * (-1),
                'tb_enriquecimento_sem_credito' => '1',));

            echo "Sem Saldo para esta operação. Seu saldo é de R$ " . $saldoAtual;
            die("\n ----->para processamento......");
        }
    }

    function retornaSaldoAtual($cnpjEmpresa) {

        $saldo = "SELECT tb_credito_atual_saldo FROM tb_credito_atual where tb_credito_atual_cnpj = '$cnpjEmpresa'";
        $db_retornoMR = $this->db->query($saldo);
        $fetch_userMR = $db_retornoMR->fetchAll();

        return $fetch_userMR[0]['tb_credito_atual_saldo'];
    }

    function insereCreditoAtualizaSaldoAtual($valor, $vendedor, $cnpjEmpresa, $saldo, $usuario) {

        $sqlInsert = "INSERT INTO `dataWebProducao`.`tb_creditos`
                        (`idtb_creditos`,
                        `tb_creditos_empresa`,
                        `tb_creditos_usuario`,
                        `tb_creditos_vendedor`,
                        `tb_creditos_valor`,
                        `tb_creditos_qtd_max_registros`,
                        `tb_creditos_data`)
                        VALUES
                        ('',
                        '$cnpjEmpresa',
                        '$usuario',
                        '$vendedor',
                        '$valor',
                        '',
                        " . time() . ");";

        $inseriu = $this->db->pdo->exec($sqlInsert);

        if ($inseriu) {

            $atualCredito = $saldo + $valor;

            $empresaExiste = "SELECT tb_credito_atual_cnpj FROM tb_credito_atual where tb_credito_atual_cnpj = '$cnpjEmpresa'";
            $db_retornoEE = $this->db->query($empresaExiste);
            $fetch_userEE = $db_retornoEE->fetchAll();


            if (!$fetch_userEE) {

                $sqlInsert = "INSERT INTO `dataWebProducao`.`tb_credito_atual`
                                (`idtb_credito_atual`,
                                `tb_credito_atual_cnpj`,
                                `tb_credito_atual_saldo`)
                                VALUES
                                ('',
                                '$cnpjEmpresa',
                                '');";

                $inseriu = $this->db->pdo->exec($sqlInsert);
            }
        }

        $query = $this->db->update('tb_credito_atual', 'tb_credito_atual_cnpj', $cnpjEmpresa, array(
            'tb_credito_atual_saldo' => $atualCredito));

        if ($query) {
            echo "<div class='alert alert-success' style='text-align: center' role='alert'>
                      <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                      <span class='sr-only'>Error:</span>
                        Crédido inserido com sucesso.
                      </div>";
        } else {

            echo "<div class='alert alert-danger' style='text-align: center' role='alert'>
                      <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                      <span class='sr-only'>Error:</span>
                        Erro na inserção.
                      </div>";
        }
    }

}
