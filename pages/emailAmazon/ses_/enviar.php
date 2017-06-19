<?php

//include phpmailer
require_once('./class.phpmailer.php');

//SMTP Settings
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Host = "email-smtp.us-east-1.amazonaws.com";
$mail->Username = "AKIAJUARX7MUORQT3CEA";
$mail->Password = "ntNmSwegPKUkaU5HsWH/eoRMvoYkrRTeKyQnQ/CF";
//

$mail->SetFrom('andrecastilho007@hotmail.com.com', 'André Castilho'); //from (verified email address)
$mail->Subject = "Email Subject"; //subject
//message
$body = "This is a test message.333333333333333333333333333333333333";
//$body = eregi_replace("[]", '', $body);
$mail->MsgHTML($body);
//
//recipient
$mail->AddAddress("andxuxa@gmail.com", "Test Recipient");

//Success
if ($mail->Send()) {
    echo "Message sent!";
    die;
}

//Error
if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
?>
 