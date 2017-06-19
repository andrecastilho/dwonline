<?php

require_once '/var/www/html/classes/class-TutsupDB.php';
require_once '/var/www/html/classes/class-EnviaEmailSes.php';



$enviaEmailSes = new enviaEmailSes();
$db = new TutsupDB();

  $enviarPara = "andrecastilho007@hotmail.com";
        $assunto = "Erro Enriquecimento";
        $corpo = " teste ";

        $db_retornoHtml = $db->query("SELECT tb_html_email_html FROM tb_html_email
                                                    where tb_html_email_nome_layout like 'ERRO ENRIQUECIMENTO'");

        $fetch_html = $db_retornoHtml->fetchAll();


        //die(".");

        $htmlEmail = html_entity_decode($fetch_html[0]['tb_html_email_html']);

        $enviaEmailSes->enviarEmail($enviarPara, $assunto, $corpo, $htmlEmail);
        
