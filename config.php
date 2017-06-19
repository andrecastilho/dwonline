<?php
// **PREVENTING SESSION HIJACKING**

ini_set('session.cookie_httponly', 1);

// **PREVENTING SESSION FIXATION**

ini_set('session.use_only_cookies', 1);


/** 
 * Configuração geral
 */
// Caminho para a raiz
define('ABSPATH', dirname(__FILE__));

// Caminho para a pasta de uploads
define('UP_ABSPATH', ABSPATH . '/views/_uploads');

// URL da home
define('HOME_URI', 'http://dwonline.com.br/desenv');

// Nome do host da base de dados 
define('HOSTNAME', 'prosp.chl209etmtnz.sa-east-1.rds.amazonaws.com');

// Nome do DB
define('DB_NAME', 'dataWebProducao'); 

// Usuário do DB
define('DB_USER', 'sistema');

// Senha do DB
define('DB_PASSWORD', 'somethingsecure');

// Charset da conexão PDO
define('DB_CHARSET', 'utf8');

// Se você estiver desenvolvendo, modifique o valor para true
define('DEBUG', false);

/**
 * Não edite daqui em diante
 */
// Carrega o loader, que vai carregar a aplicação inteira
require_once ABSPATH . '/loader.php';
?> 

