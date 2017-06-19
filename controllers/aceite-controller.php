<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL); 
/**
 * home - Controller de exemplo
 *
 * @package DataWeb
 * @since 0.1
 */
require_once './classes/class-TutsupDB.php';

class AceiteController extends MainController {

    /**
     * Carrega a página "/views/home/index.php"
     */
    public function __construct($db = false) {
        $this->db = $db;
    }

    public function index() {

        $this->db = new TutsupDB();

        $query = $this->db->update('tb_usuario', 'tb_usuario_username_email', $_SESSION['userdata']['tb_usuario_username_email'], array(
            'tb_usuario_aceite' => '1',
            'tb_usuario_data_aceite' => date('Ymd'),
        ));

        if (defined('HOME_URI')) {
            // Configura a URL de login
            $login_uri = HOME_URI . '/home/';

            // A página em que o usuário estava
            $_SESSION['goto_url'] = urlencode($_SERVER['REQUEST_URI']);

            // Redireciona
            header('location: ' . $login_uri);
        }
    }

// index
}

// class HomeController