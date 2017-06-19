<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 * 
 */


require_once '/var/www/html/classes/class-TutsupDB.php';
require_once '/var/www/html/ses.php';
$db = new TutsupDB();
$ses = new SimpleEmailService('AKIAJLVK7BU2KZOXVTOQ', 'b0V/gB1ZeZ8km3E07TQdPk/DkvwmHYUH3tGS6Sm4');

$nome = $db->anti_injection($_GET['nome']);
$email = $db->anti_injection($_GET['email']);
$cpfCnpj = $db->anti_injection($_GET['cpf']);
$cnpjEmpresa = $db->anti_injection($_GET['cnpjEmpresa']);
$idtbVendedor = $db->anti_injection($_GET['idtbVendedor']);


//definimos destinatário, remetente, assunto e mensagem
$from = 'dwonline@dwonline.com.br';

$assunto = 'Informações DwOnline.com.br';


if (count($cpfCnpj) == 11) {
    $sql = "SELECT * FROM tb_pessoa_fisica pf
         left join tb_pessoa_fisica_end as endereco
        ON endereco.tb_pessoa_fisica_end_cpf = pf.tb_pessoa_fisica_cpf
      where tb_pessoa_fisica_cpf = '$cpfCnpj'";

    $db_busca = $db->query($sql);
    $fetch_busca = $db_busca->fetchAll();

    $mensagem = "<html>
    <head><title>Envio Dw Online</title></head>
    <body>
        <table>
            <tr>
                <td>
                    Nome: " . $fetch_busca[0]['tb_pessoa_fisica_nome'] . "  
                </td>
            </tr>
                     <tr>
                <td>
                    Cpf: " . $fetch_busca[0]['tb_pessoa_fisica_cpf'] . "
                </td>
            </tr>
                 <tr>
                <td>
                    Sexo: " . $fetch_busca[0]['tb_pessoa_fisica_sexo'] . "
                </td>
            </tr>
             <tr>
                <td>
                    Data de nacimento: " . date("d-m-Y", $fetch_busca[0]['tb_pessoa_fisica_data_nascimento']) . "
                </td>
            </tr>
           ";

    for ($i = 0; $i < count($fetch_busca); $i++) {

        $mensagem.=" 
             <tr>
                <td>
                    Rua: " . $fetch_busca[$i]['tb_pessoa_fisica_end_end'] . " Numero: " . $fetch_busca[0]['tb_pessoa_fisica_end_numero'] . " 
                </td>
            </tr>
             <tr>
                <td>
                    Bairro: " . $fetch_busca[$i]['tb_pessoa_fisica_end_bairro'] . " Cidade: " . $fetch_busca[$i]['tb_pessoa_fisica_end_cidade'] . " 
                </td>
            </tr>
               <tr>
                <td>
                    Uf: " . $fetch_busca[$i]['tb_pessoa_fisica_end_uf'] . " Cep: " . $fetch_busca[$i]['tb_pessoa_fisica_end_cep'] . " 
                </td>
            </tr>";
    }

    $mensagem.="</table></body></html>";
} else {

    $sql = "SELECT * FROM tb_pessoa_juridica pj
         left join tb_pessoa_juridica_end as endereco
        ON endereco.tb_pessoa_juridica_end_cnpj = pj.tb_pessoa_juridica_cnpj
      where tb_pessoa_juridica_cnpj = '$cpfCnpj'";

    $db_busca = $db->query($sql);
    $fetch_busca = $db_busca->fetchAll();

    $mensagem = "<html>
    <head><title>Envio Dw Online</title></head>
    <body>
        <table>
            <tr>
                <td>
                    Nome: " . $fetch_busca[0]['tb_pessoa_juridica_nome'] . "  
                </td>
            </tr>
                     <tr>
                <td>
                    Cpf: " . $fetch_busca[0]['tb_pessoa_juridica_cnpj'] . "
                </td>
            </tr>
                 <tr>
                <td>
                    Fantasia: " . $fetch_busca[0]['tb_pessoa_juridica_fantasia'] . "
                </td>
            </tr>
             <tr>
                <td>
                    Data de nacimento: " . date("d-m-Y", $fetch_busca[0]['tb_pessoa_juridica_data_nascimento']) . "
                </td>
            </tr>
          ";

    for ($i = 0; $i < count($fetch_busca); $i++) {

        $mensagem.=" 
              <tr>
                <td>
                    Rua: " . $fetch_busca[$i]['tb_pessoa_juridica_end_end'] . " Numero: " . $fetch_busca[0]['tb_pessoa_juridica_end_num'] . " 
                </td>
            </tr>
             <tr>
                <td>
                    Bairro: " . $fetch_busca[$i]['tb_pessoa_juridica_end_bairro'] . " Cidade: " . $fetch_busca[$i]['tb_pessoa_juridica_end_cidade'] . " 
                </td>
            </tr>
               <tr>
                <td>
                    Uf: " . $fetch_busca[$i]['tb_pessoa_juridica_end_uf'] . " Cep: " . $fetch_busca[$i]['tb_pessoa_juridica_end_cep'] . " 
                </td>
            </tr>";
    }

    $mensagem.="</table></body></html>";
}


/*
  echo "<pre>";
  echo $mensagem;
  echo "</pre>";
 * 
 */


$m = new SimpleEmailServiceMessage();
//seta valores definidos nas variaveis acima
$m->addTo($email);
$m->setFrom($from);
$m->setSubjectCharset('ISO-8859-1');
$m->setMessageCharset('ISO-8859-1');
$m->setSubject('=?UTF-8?B?' . base64_encode($assunto) . '?= ');
$m->setMessageFromString(NULL, $mensagem);

//envia email
$ses->sendEmail($m);


echo "\n";
//print_r($ses);


$user['cnpjEmpresa'] = $cnpjEmpresa;
$user['filtro'] = 'envio email - busca por :' . $cpfCnpj;
$user['tb_utilizacao_sistema_idtb_user'] = $idtbVendedor;
$server = '';
$retornoOk = 1;

print_r($user);
echo ">> utilização sistema \n" . $db->utilizacaoSistema($server, $user, $retornoOk);
?>
