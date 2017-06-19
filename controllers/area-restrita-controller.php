<?php

/**
 * UserRegisterController - Controller de exemplo
 *
 * @package DataWeb
 * @since 0.1
 */
class AreaRestritaController extends MainController {

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
    public $permission_required = 'area-restrita';

    /**
     * Carrega a página "/views/user-register/index.php"
     */
    public function index() {
        // Page title
        $this->title = 'Área Restrita';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
        
        // Carrega o modelo para este view
        //$modelo = $this->load_model('area-restrita/area-restrita-model');
        
        /** Carrega os arquivos do view * */
        // /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';

        // /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';

        // /views/user-register/index.php
        require ABSPATH . '/views/area-restrita/area-restrita-view.php';

        // /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';
    }

// index
}

// class home