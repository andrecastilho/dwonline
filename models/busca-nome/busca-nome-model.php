<?php

/**
 * Classe para registros de usuários
 *
 * @package DataWeb
 * @since 0.1
 */
class BuscaNomeModel {

    /**
     * $form_data
     *
     * Os dados do formulário de envio.
     *
     * @access public
     */
    public $form_data;

    /**
     * $form_msg
     *
     * As mensagens de feedback para o usuário.
     *
     * @access public
     */
    public $form_msg;
    public $option;

    /**
     * $db
     *
     * O objeto da nossa conexão PDO
     *
     * @access public
     */
    public $db;
    public $qtd_user_utilizado_cnpj;

    /**
     * Construtor
     * 
     * Carrega  o DB.
     *
     * @since 0.1
     * @access public
     */
    public function __construct($db = false) {
        
    }

}
