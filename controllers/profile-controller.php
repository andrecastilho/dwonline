<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
/**
 * profile
 *
 * @package DataWeb
 * @since 0.1
 */
//require_once '../classes/class-TutsupDB.php';

class ProfileController extends MainController {

    
    public function __construct($db = false) {
        $this->db = $db;
    }

    public function index() {

      // Título da página
		$this->title = 'Profile';
                
	
		/** Carrega os arquivos do view **/
		
		// /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';
		
		// /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';
		
		
        require ABSPATH . '/views/profile/profile-view.php';
		
		// /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';
    }

// index
}

// class HomeController