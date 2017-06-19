
<?php

/**
 * Classe de Apoio a conex�o banco de dados Mysql 
 * Revisado em 17/12/2008 
 * por Renato Pereira as 17:31
 *
 */
class DB {

    private $serv, $usr, $dtb, $pass, $serv1, $usr1, $dtb1, $pass1, $serv2, $usr2, $dtb2, $pass2, $serv3, $usr3, $dtb3, $pass3, $query, $string, $rs;

    /**
     * Defini��o das vari�veis de apoio do sistema 
     *
     * @param string_type $_conn
     * @param string_type $serv
     * @param string_type $usr
     * @param string_type $pass
     * @param string_type $dtb
     * @param string_type $query
     * @param string_type $string
     * @param string_type $rs
     */
    function __construct() {
        
    }

    function conexao() {


        $this->serv2 = 'prosp.chl209etmtnz.sa-east-1.rds.amazonaws.com';
        $this->usr2 = 'sistema';
        $this->pass2 = 'somethingsecure';
        $this->dtb2 = 'dataWebProducao';
        @mysql_connect($this->serv2, $this->usr2, $this->pass2) or
                die("Erro ao estabelecer a conexão com o banco de dados.");
        mysql_select_db($this->dtb2) or die("Erro ao selecionar o banco");
        return $mensagem = "";
    }

}

?>