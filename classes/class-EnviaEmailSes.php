<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
  */
require_once '/var/www/html/classes/class-TutsupDB.php';

 

//require 'vendor/autoload.php';

 use Aws\Ses\SesClient;

class enviaEmailSes {
    
   

    public $emailDeEnvio = 'dwonline@dwonline.com.br';
    public $enviarPara;
    public $assunto;
    public $corpo;
    public $htmlEmail;

    public function enviarEmail($enviarPara, $assunto, $corpo, $htmlEmai) {

        $this->enviarPara = $enviarPara;
        $this->assunto = $assunto;
        $this->corpo = $corpo;
        $this->htmlEmail = $htmlEmai;


        $client = SesClient::factory(array(
                    'key' => 'AKIAJLVK7BU2KZOXVTOQ',
                    'secret' => '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',
                    'region' => 'us-east-1',
        ));


        $emailSentId = $client->sendEmail(array(
// Source is required
            'Source' => $this->emailDeEnvio,
            // Destination is required
            'Destination' => array(
                'ToAddresses' => array($this->enviarPara)
            ),
            // Message is required
            'Message' => array(
// Subject is required
                'Subject' => array(
// Data is required
                    'Data' => $this->assunto,
                    'Charset' => 'UTF-8',
                ),
                // Body is required
                'Body' => array(
                    'Text' => array(
// Data is required
                        'Data' => $this->corpo,
                        'Charset' => 'UTF-8',
                    ),
                    'Html' => array(
// Data is required
                        'Data' => $this->htmlEmail,
                        'Charset' => 'UTF-8',
                    ),
                ),
            ),
            'ReplyToAddresses' => array('dwonline@dwonline.com.br'),
            'ReturnPath' => 'dwonline@dwonline.com.br'
        ));

        return $emailSentId;
    }

    public function buscaHtmlEmail() {
        
    }

}
