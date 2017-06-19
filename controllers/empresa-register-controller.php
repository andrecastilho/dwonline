<?php

/**
 * UserRegisterController - Controller de exemplo
 *
 * @package DataWeb
 * @since 0.1
 */
class EmpresaRegisterController extends MainController {

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
    public $permission_required = 'empresa-register';

    /**
     * Carrega a página "/views/user-register/index.php"
     */
    public function index() {
        // Page title
        $this->title = 'Registro de Empresa';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
        
        //session_start();
        //print_r($_SESSION);
        //echo "<br>";
        //print_r($_COOKIE);
        //die(">>");
        // Carrega o modelo para este view
        $modelo = $this->load_model('empresa-register/empresa-register-model');

        /** Carrega os arquivos do view * */
        // /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';

        // /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';

        // /views/user-register/index.php
        require ABSPATH . '/views/empresa-register/empresa-register-view.php';

        // /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';
    }

// index
}

// class home