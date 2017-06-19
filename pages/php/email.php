Formulário em HTML:
<form name='envia_mail' method="post"action='../../pages/php/email.php   '>
 nome<input type='text' name='nome'><br>
 email<input type='text' name='email'><br>
 msg<input type='text' name='mensagem'><br>
 <button type="submit">enviar</button>
</form>


<?php
$nome     = $_POST['nome'];
$email    = $_POST['email'];
$mensagem = $_POST['mensagem'];
$corpo  = "Nome: ".$nome."<BR>\n";
$corpo .= "Email: ".$email."<BR>\n";
$corpo .= "Mensagem: ".$mensagem."<BR>\n";
if(mail("andrecastilho007@hotmail.com","Assunto",$corpo)){
  echo("email enviado com sucesso");
} else {
    print_r(error_get_last());
  echo("Erro ao enviar e-mail");
}
?>