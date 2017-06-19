<?php

/**
 * BuscaTelController - Controller de exemplo
 *
 * @package DataWeb
 * @since 0.1
 */
class BuscaTelController extends MainController {

    /**
     * $login_required
     *
     * Se a página precisa de login
     *
     * @access public
     */
    public $login_required = true;

    /**
     * $permission_required
     *
     * Permissão necessária
     *
     * @access public
     */
    public $permission_required = 'busca-tel';

    /**
     * Carrega a página "/views/busca-empresa/"
     */
    public function index() {
        
        // Page title
        $this->title = 'Buscar Telefone';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
        
        // Carrega o modelo para este view
        $modelo = $this->load_model('busca-tel/busca-tel-model');
        
        /** Carrega os arquivos do view * */
        // /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';

        // /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';

        // /views/user-register/index.php
        require ABSPATH . '/views/busca-tel/busca-tel-view.php';

        // /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';
    }

// index
}

// class home