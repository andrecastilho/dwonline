<?php

/**
 * Classe para registros de usuários
 *
 * @package DataWeb
 * @since 0.1
 */
class ImportaArquivoModel { 

    public $db;

    public function __construct($db = false) {
        $this->db = $db;
    }

     /**
     * Busca enriquecidos
     * 
     * @since 0.1
     * @access public
     */
    public function buscaEnriquecidos() {

        //busca quantidade de utuarios utilizados pela empresa
        $db_check_qtd_user_cnpj = $this->db->query(
                "SELECT * FROM dataWebProducao.tb_enriquecimento where tb_enriquecimento_empresa_envio = ? ORDER BY idtb_enriquecimento DESC", array($_SESSION['userdata']['tb_empresa_cnpj']));

        // Obtém os dados da base de dados MySQL
        return $fetch_user = $db_check_qtd_user_cnpj->fetchAll();
        
    }
    
    /**
     * Atualiza tabela de enriquecimento como visualizada nas mensagens
     * 
     * @since 0.1
     * @access public
     */
    public function atualizaMsgVisualizadaEnriquecimento() {
        $query = $this->db->pdo->exec('UPDATE `dataWebProducao`.`tb_enriquecimento`
    SET
    `tb_enriquecimento_msg_visualizada` = 1');
    }


}
