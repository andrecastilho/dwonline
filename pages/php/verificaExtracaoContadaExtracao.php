<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


require_once '../../classes/class-TutsupDB.php';
require_once '../../vendor/autoload.php';

use Aws\Ses\SesClient;

$db = new TutsupDB();

$userEmail = $db->anti_injection($_GET['userEmail']);

$sql = "SELECT idtb_extracao,tb_extracao_msg_visualizada FROM  tb_extracao 
WHERE  tb_extracao_qtd_linhas IS NOT NULL
AND  tb_extracao_msg_visualizada IS NULL
AND tb_extracao_empresa_envio = " . $db->anti_injection($_GET['empresaEnvio']);

$db_retorno = $db->query($sql);

// Obtém os dados da base de dados MySQL
$fetch = $db_retorno->fetchAll();

if ($fetch) {
    $idtbExtração = $fetch[0]['idtb_extracao'];


    $sqlEnrioEmail = "select * from tb_extracao
where idtb_extracao =" . $idtbExtração;

    $db_retornoEmailEnviado = $db->query($sqlEnrioEmail);

// Obtém os dados da base de dados MySQL
    $fetchEmailEnviado = $db_retornoEmailEnviado->fetchAll();

//print_r($fetchEmailEnviado);



    if ($fetch & $fetchEmailEnviado[0]['tb_extracao_envio_email_contagem'] == null) {

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
                <td><img src='http://dwonline.com.br/desenv/dist/img/logo.png' width='184' height='63' alt='datamailing' ></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><span class='pedido'>Olá </span><span class='pedido_numero'>" . $userEmail . "</span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Seu arquivo de extração foi contado com sucesso  <br>
                Logue no sistema verifique a quantidade e clique em processar ou refazer filtro para nova contagem</td>
            </tr>
           
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><span class='pedido'>Empresa : </span><span class='pedido_numero'>" . $db->anti_injection($_GET['empresaEnvio']) . "</span></td>
            </tr>
             <tr>
                <td><span class='pedido'>Id Processo : </span><span class='pedido_numero'>" .$fetchEmailEnviado[0]['idtb_extracao']. "</span></td>
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
                'ToAddresses' => array($userEmail)
            ),
            // Message is required
            'Message' => array(
                // Subject is required
                'Subject' => array(
                    // Data is required
                    'Data' => 'Extração - Finalizada Contagem',
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

        //atualiza campo

        $query = $db->update('tb_extracao', 'idtb_extracao', $idtbExtração, array(
            'tb_extracao_envio_email_contagem' => '1'));
    }
}

echo json_encode($fetch);






