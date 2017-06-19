<?php

/**
 * Classe para registros de usuários
 *
 * @package DataWeb
 * @since 0.1
 */
class ExtracaoModel {

    public $db;

    public function __construct($db = false) {
        $this->db = $db;
    }

    public function inserirExtracao($idtbUsuario, $nomeExtracao, $cnpjEmpresa) {

        $extracaoParaProcessar = "SELECT *,count(1)as total FROM tb_extracao where  tb_extracao_empresa_envio = '$cnpjEmpresa'  ";
        $db_retorno = $this->db->query($extracaoParaProcessar);
        $fetch = $db_retorno->fetchAll();
        //print_r($fetch);
        //die(".");
        if ($fetch[0]['total'] > 4 & $fetch[0]['tb_extracao_processar_contada'] == null) {

            echo "<div class='alert alert-warning' style='text-align: center' role='alert'>
                      <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                      <span class='sr-only'>Error:</span>
                        Extração em andamento, termine o processamento para gerar nova extração 
                      </div>";
        } else {


            $data_array = array('', // idtb_utilizacao_sistema
                $this->db->anti_injection($cnpjEmpresa),
                $this->db->anti_injection($idtbUsuario),
                $this->db->anti_injection($nomeExtracao),
                $this->db->anti_injection(''),
                $this->db->anti_injection(''),
                $this->db->anti_injection(time()));


            $query1 = ("INSERT INTO `dataWebProducao`.`tb_extracao`
                    (`idtb_extracao`,
                    `tb_extracao_empresa_envio`,
                    `tb_extracao_user_envio`,
                    `tb_extracao_arquivo_enviado`,
                    `tb_extracao_arquivo_cpf`,
                    `tb_extracao_arquivo_cnpj`,
                    `tb_extracao_data_envio`)
                    VALUES(?,?,?,?,?,?,?)");

// Prepara e executa

            $query = $this->db->pdo->prepare($query1);

            if (!$query) {
                return false;
            }
            $check_exec = $query->execute($data_array);
// Verifica se a consulta aconteceu
            if (!$check_exec) {
                // Configura o erro
                $error = $query->errorInfo();
                print_r($error);
                $db->error = $error[2];
                // Retorna falso
                return false;
            }
        }
    }

    public function atualizaMsgVisualizada() {
        $query = $this->db->pdo->exec('UPDATE `dataWebProducao`.`tb_extracao`
    SET
    `tb_extracao_msg_visualizada` = 1');
    }

    function buscaExtracoes() {

        //busca quantidade de utuarios utilizados pela empresa
        $db_check_qtd_user_cnpj = $this->db->query(
                "SELECT * FROM dataWebProducao.tb_extracao where tb_extracao_empresa_envio = ? ORDER BY idtb_extracao DESC", array($_SESSION['userdata']['tb_empresa_cnpj']));

        // Obtém os dados da base de dados MySQL
        return $fetch_user = $db_check_qtd_user_cnpj->fetchAll();
    }

    public function buscaExtraidos() {

        //busca quantidade de utuarios utilizados pela empresa
        $db_check_qtd_user_cnpj = $this->db->query(
                "SELECT * FROM dataWebProducao.tb_extracao where tb_extracao_empresa_envio = ? ORDER BY idtb_extracao DESC", array($_SESSION['userdata']['tb_empresa_cnpj']));

        // Obtém os dados da base de dados MySQL
        return $fetch_user = $db_check_qtd_user_cnpj->fetchAll();
    }

}
