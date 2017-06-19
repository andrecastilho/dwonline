<?php

/*

  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 */
require_once 'vendor/autoload.php';
use Aws\Ses\SesClient;
require_once 'classes/class-TutsupDB.php';

$db = new TutsupDB();

$email = $db->anti_injection($_GET['email']);

$sql = "SELECT * FROM   tb_usuario 
WHERE	tb_usuario_username_email like	'$email'
AND tb_usuario_email_verificado is null";

$db_retorno = $db->query($sql);

// Obtém os dados da base de dados MySQL
$fetch = $db_retorno->fetchAll();



if (is_array($fetch)) {
    validaemail($email, $db, $fetch);
}

function validaemail($email, $db, $fetch) {
    //verifica se e-mail esta no formato correto de escrita


    if ($fetch) {
        
        $enviarPara = $email;
        $assunto = 'Cadastramento DWOnline online';


      
        $client = SesClient::factory(array(
                                    'key' => 'AKIAJLVK7BU2KZOXVTOQ',
                                    'secret' => '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',
                                    'region' => 'us-east-1',
                        ));


                        $body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>Untitled Document</title>
        <style type='text/css'>
            body{font-family:Tahoma, Geneva, sans-serif; font-size:12px; color:#000000; padding:0px; margin:0px; margin-top:15px;}
            .notice {color:#999; font-size:9px;}
            .pedido{color:000; font-size:16px; font-weight:bold;}
            .pedido_numero{color:#CC0000; font-size:16px; font-weight:bold;}
        </style>
    </head>

    <body>
        <table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
            <tr>
                <td><img src='http://dwonline.com.br/desenv/dataWebHomolog/dist/img/logo.png' width='184' height='63' alt='datamailing' ></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><span class='pedido'>Olá </span><span class='pedido_numero'>" . $fetch[0]['tb_usuario_nome'] . "</span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Seu cadastro para acesso ao sistema DWOnline foi realizado com sucesso!</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class='pedido'></strong > Email:<strong><span class='pedido_numero'>" . $fetch[0]['tb_usuario_username_email'] . "</span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><span class='pedido'>Senha  : </span><span class='pedido_numero'>" . ($fetch[0]['tb_usuario_password']) . " </span></a></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><a href='http:///www.dwonline.com.br'>www.dwonline.com.br</a></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table width='98%' border='0' align='center' cellpadding='0'>
            <tr>
                <td><p class='notice'>AVISO: A    informação contida neste e-mail, bem como em qualquer de seus anexos, é    CONFIDENCIAL e destinada ao uso exclusivo do(s) destinatário(s) acima referido(s),    podendo conter informações sigilosas e/ou legalmente protegidas. Caso você    não seja o destinatário desta mensagem, informamos que qualquer divulgação,    distribuição ou cópia deste e-mail e/ou de qualquer de seus anexos é    absolutamente proibida. Solicitamos que o remetente seja comunicado    imediatamente, respondendo esta mensagem, e que o original desta mensagem e    de seus anexos, bem como toda e qualquer cópia e/ou impressão realizada a    partir destes, sejam permanentemente apagados e/ou destruídos. Informações    adicionais sobre nossa empresa podem ser obtidas no site <a href='http://www.datamailing.com.br/'>www.datamailing.com.br</a>.<br />
                        <br />
                        NOTICE: The information contained in this    e-mail and any attachments thereto is CONFIDENTIAL and is intended only for use    by the recipient named herein and may contain legally privileged and/or    secret information.<br />
                        If you are not the e-mail´s intended recipient, you are hereby notified that    any dissemination, distribution or copy of this e-mail, and/or any    attachments thereto, is strictly prohibited. Please immediately notify the    sender replying to the above mentioned e-mail address, and permanently delete    and/or destroy the original and any copy of this e-mail and/or its    attachments, as well as any printout thereof. Additional information about    our company may be obtained through the site <a href='http://www.datamailing.com.br/'>www.datamailing.com.br</a>. </p></td>
            </tr>
        </table>
    </body>
</html>";

                        $emailSentId = $client->sendEmail(array(
                            // Source is required
                            'Source' => 'dwonline@dwonline.com.br',
                            // Destination is required
                            'Destination' => array(
                                'ToAddresses' => array($enviarPara)
                            ),
                            // Message is required
                            'Message' => array(
                                // Subject is required
                                'Subject' => array(
                                    // Data is required
                                    'Data' => $assunto,
                                    'Charset' => 'UTF-8',
                                ),
                                // Body is required
                                'Body' => array(
                                    'Text' => array(
                                        // Data is required
                                        'Data' => $body,
                                        'Charset' => 'UTF-8',
                                    ),
                                    'Html' => array(
                                        // Data is required
                                        'Data' => $body,
                                        'Charset' => 'UTF-8',
                                    ),
                                ),
                            ),
                            'ReplyToAddresses' => array('dwonline@dwonline.com.br'),
                            'ReturnPath' => 'dwonline@dwonline.com.br'
                        ));


        $queryUpdate = $db->pdo->exec("UPDATE `dataWebProducao`.`tb_usuario`
                                    SET
                                    `tb_usuario_email_verificado` =1,
                                    `tb_usuario_password` = '" . md5($fetch[0]['tb_usuario_password']) . "' 
                                     WHERE tb_usuario_username_email like '$email'");

        if (!$queryUpdate) {
            // Configura o erro
            $error = $db->pdo->errorInfo();
            echo " Erro na liberação de email .Entre em contato com administrador do sistema";
            print_r($error);
        }

        echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>Untitled Document</title>
        <style type='text/css'>
            body{font-family:Tahoma, Geneva, sans-serif; font-size:12px; color:#000000; padding:0px; margin:0px; margin-top:15px;}
            .notice {color:#999; font-size:9px;}
            .pedido{color:000; font-size:16px; font-weight:bold;}
            .pedido_numero{color:#CC0000; font-size:16px; font-weight:bold;}
        </style>
    </head>

    <body>
        <table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
            <tr>
                <td><img src='http://dwonline.com.br/desenv/dataWebHomolog/dist/img/logo.png' width='184' height='63' alt='datamailing' ></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><span class='pedido'>E-mail verificado.<br> </span><span class='pedido_numero'></span></a></td>
            </tr>
             <tr>
                <td><span class='pedido'>Password encaminhado via e-mail<br> </span><span class='pedido_numero'></span></a></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><a href='http:///www.dwonline.com.br'>www.dwonline.com.br</a></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
    </body>
</html>";
    }
}
