<!DOCTYPE html>
<html style="text-align: center;">
    <head>
        <meta charset="UTF-8">
        <title>DataWeb | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">


        <style type="text/css">
            #div {

                width:500px; /* Tamanho da Largura da Div */
                height:200px; /* Tamanho da Altura da Div */
                position:absolute; 
                top:50%; 
                margin-top:-100px; /* ou seja ele pega 50% da altura tela e sobe metade do valor da altura no caso 100 */
                left:50%;
                margin-left:-250px; /* ou seja ele pega 50% da largura tela e diminui  metade do valor da largura no caso 250 */

            }
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <div class="wrapper" >



            <div id="div">
                <div class="register-box">
                    <div class="register-logo">
                        <a href="./index.php"><b>Data</b>Web</a>
                    </div>


                    <form method="post" action="recuperaSenha.php">

                        <div class="register-box-body">
                            <p class="login-box-msg">Enviar senha para email</p>

                            <div class="form-group has-feedback">
                                <input type="text" class="form-control"  name="tb_usuario_username_email" placeholder="Email "/>
                                <span class="glyphicon glyphicon-envelope  form-control-feedback"></span>
                            </div>

                            <div class="col" style="text-align: right">
                                <button  id="btnInsertUserLogar" type="submit" class="btn btn-primary btn-block btn-flat">Recuperar</button>
                            </div><!-- /.col -->
                            <div class="col" style="text-align: right">
                                <a href="./index.php" >Voltar</button>
                            </div><!-- /.col -->

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </body>
</html>

<?php
//enviar
// emails para quem será enviado o formulário

/*
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
 * 
 */


require_once 'classes/class-TutsupDB.php';

$db = new TutsupDB();

require 'vendor/autoload.php';

use Aws\Ses\SesClient;

$novaSenha = rand();


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
                <td><span class='pedido'>Olá </span><span class='pedido_numero'>".$_POST['tb_usuario_nome']."</span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Sua senha de acesso ao sistema DWOnline foi reemitida com sucesso!</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class='pedido'></strong > Email:<strong><span class='pedido_numero'>" . $_POST['tb_usuario_username_email'] . "</span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><span class='pedido'>Nova senha: </span><span class='pedido_numero'>$novaSenha</span></td>
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


if (($_POST)) {
    
    $query = $db->update('tb_usuario', 'tb_usuario_username_email', $_POST['tb_usuario_username_email'], array(
        'tb_usuario_password' => md5($novaSenha),
    ));

    $client = SesClient::factory(array(
                'key' => 'AKIAJLVK7BU2KZOXVTOQ',
                'secret' => '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',
                'region' => 'us-east-1',
    ));

    $emailSentId = $client->sendEmail(array(
        // Source is required
        'Source' => 'dwonline@dwonline.com.br',
        // Destination is required
        'Destination' => array(
            'ToAddresses' => array($_POST['tb_usuario_username_email'])
        ),
        // Message is required
        'Message' => array(
            // Subject is required
            'Subject' => array(
                // Data is required
                'Data' => 'Reemissão de senha DWOnline',
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



//$result = $client->verifyEmailAddress(array(
    // EmailAddress is required
//    'EmailAddress' => 'andrecastilho007@hotmail.com',
//));
    if ($emailSentId) {
        echo "Senha enviada ao email " . $_POST['tb_usuario_username_email'];
    }
//var_dump($emailSentId);
}