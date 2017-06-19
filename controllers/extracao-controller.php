<?php

/**
 * home - Controller de exemplo
 *
 * @package DataWeb
 * @since 0.1
 */
/*
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
 * error_reporting(E_ALL);
 * 
 */


class ExtracaoController extends MainController {

    /**
     * Carrega a página "/views/home/index.php"
     */
    public function index() {
        // Título da página
        $this->title = 'Extração';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();


        $this->check_userlogin();

        $modelo = $this->load_model('extracao/extracao-model');

        /** Carrega os arquivos do view * */
        // /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';

        // /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';

        // /views/home/home-view.php
        require ABSPATH . '/views/extracao/extracao-view.php';

        // /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';
    }

// index
}

// class HomeController