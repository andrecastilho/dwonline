<?php

//enviar
// emails para quem será enviado o formulário
$emailenviar = "andrecastilho007@hotmail.com";
$destino = 'andrecastilho007@hotmail.com';
$assunto = "Contato pelo Site";

$corpo = 'Teste teste teste';

// É necessário indicar que o formato do e-mail é html
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: andre <andrecastilho007@hotmail.com>';
//$headers .= "Bcc: $EmailPadrao\r\n";

$enviaremail = mail($destino, $assunto, $corpo, $headers);

if ($enviaremail) {
    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
    echo "email enviado";
} else {
    $mgm = "ERRO AO ENVIAR E-MAIL!";
    echo "erro";
}


