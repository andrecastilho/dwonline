<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL);
 * */
 
  
  
require_once 'vendor/autoload.php';

use Aws\Ses\SesClient;

/**
 * Classe para registros de usuários
 *
 * @package DataWeb
 * @since 0.1
 */
class UserRegisterModel {

    public $enviaEmailSes;

    /**
     * $form_data
     *
     * Os dados do formulário de envio.
     *
     * @access public
     */
    public $form_data;

    /**
     * $form_msg
     *
     * As mensagens de feedback para o usuário.
     *
     * @access public
     */
    public $form_msg;

    /**
     * $db
     *
     * O objeto da nossa conexão PDO
     *
     * @access public
     */
    public $db;

    /**
     * $qtd_user_utilizado_cnpj
     *
     * quantidade de usuários utulizadas pelo cnpj
     *
     * @access public
     */
    public $qtd_user_utilizado_cnpj;

    /**
     * Construtor
     * 
     * Carrega  o DB.
     *
     * @since 0.1
     * @access public
     */
    public function __construct($db = false) {
        $this->db = $db;

        if ($_SESSION['userdata']['tb_usuario_id_perfil'] == '1') { //SISTEMA DM
            $vendedor = "<div class='form-group has-feedback'>" .
                    "<label for='tb_usuario_e_vendedor'>É vendedor ?</label>" .
                    "<input type='checkbox'  name='tb_usuario_e_vendedor'class='minimal' checked/>" .
                    "</div>";

            $option = '         <option value="1">Sistema - DM</option>
                        <option value="2">Master - DM</option>
                        <option value="3">Administrador - Empresa</option>
                        <option value="4">Operacional - Empresa</option>';
        } elseif ($_SESSION['userdata']['tb_usuario_id_perfil'] == '2') {//MASTER DM
            $option = '         <option value="2">Master - DM</option>
                        <option value="3">Administrador - Empresa</option>
                        <option value="4">Operacional - Empresa</option>';
        } elseif ($_SESSION['userdata']['tb_usuario_id_perfil'] == '3') {//MASTER DM
            $option = '         <option value="3">Administrador - Empresa</option>
                        <option value="4">Operacional - Empresa</option>';
        } elseif ($_SESSION['userdata']['tb_usuario_id_perfil'] > '2') {

            $option = '<option value="4">Operacional - Empresa</option>';
        }



//busca quantidade de utuarios utilizados pela empresa
        $db_check_qtd_user_cnpj = $this->db->query(
                'SELECT count(*) as contador FROM tb_usuario where tb_usuario_cnpj_empresa= ?', array($_SESSION['userdata']['tb_empresa_cnpj'])
        );

// Obtém os dados da base de dados MySQL
        $fetch_user = $db_check_qtd_user_cnpj->fetch();
// Configura o ID do usuário
        $this->qtd_user_utilizado_cnpj = $fetch_user['contador'];
    }

    /**
     * Valida o formulário de envio
     * 
     * Este método pode inserir ou atualizar dados dependendo do campo de
     * usuário.
     *
     * @since 0.1
     * @access public
     */
    public function validate_register_form() {

// Configura os dados do formulário
        $this->form_data = array();

// Verifica se algo foi postado
        if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST)) {

// Faz o loop dos dados do post
            foreach ($_POST as $key => $value) {

// Configura os dados do post para a propriedade $form_data
                $this->form_data[$key] = $value;
            }
        } else {

// Termina se nada foi enviado
            return;
        }

// Verifica se a propriedade $form_data foi preenchida
        if (empty($this->form_data)) {
            return;
        }



// Verifica se o usuário existe
        $db_check_user = $this->db->query(
                'SELECT * FROM `tb_usuario` WHERE `tb_usuario_username_email` = ?', array(
            chk_array($this->form_data, 'tb_usuario_username_email'))
        );

// Verifica se a consulta foi realizada com sucesso
        if (!$db_check_user) {
            $this->form_msg = '<p class="form_error">Internal error.</p>';
            return;
        }

// Obtém os dados da base de dados MySQL
        $fetch_user = $db_check_user->fetch();

// Configura o ID do usuário
        $user_id = $fetch_user['tb_usuario_cpf'];

//Verifica se empresa existe
        $db_check_user_empresa = $this->db->query(
                'SELECT * FROM `tb_empresa` WHERE `tb_empresa_cnpj` = ?', array(
            chk_array($this->form_data, 'tb_usuario_cnpj_empresa'))
        );
        if (!$db_check_user) {
            $this->form_msg = '<p class="form_error">Internal error.</p>';
            echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
                              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                              <span class='sr-only'>Error:</span>
                                $this->form_msg
                             </div>";
            return;
        }

        $fetch_user_empresa = $db_check_user_empresa->fetch();
        $user_empresa = $fetch_user_empresa['tb_empresa_cnpj'];

// Cria o hash da senha
        $password = ($this->form_data['tb_usuario_senha']);


// Se o ID do usuário não estiver vazio, atualiza os dados
        if (!empty($user_id)) {

            $this->form_msg = " Usuário já cadastrado";
        } else {

            if (empty($user_empresa)) {

                $this->form_msg = "Empresa não cadastrada";
            } else {


                if ($this->form_data['tb_usuario_senha'] != $this->form_data['confirma_password']) {

                    $this->form_msg = '<p class="form_error">Senhas devem ser iguais.</p>';
                    echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
                              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                              <span class='sr-only'>Error:</span>
                                $this->form_msg
                             </div>";
//exit();
                } else {
// Executa a consulta 

                    $temCpf = chk_array($this->form_data, 'tb_usuario_cpf');

                    if ($temCpf) {
                        $query = $this->db->insert('tb_usuario', array(
                            'tb_usuario_cpf' => chk_array($this->form_data, 'tb_usuario_cpf'),
                            'tb_usuario_cnpj_empresa' => chk_array($this->form_data, 'tb_usuario_cnpj_empresa'),
                            'tb_usuario_password' => $password,
                            'tb_usuario_nome' => chk_array($this->form_data, 'tb_usuario_nome'),
                            'tb_usuario_id_perfil' => chk_array($this->form_data, 'tb_usuario_id_perfil'),
                            'tb_usuario_username_email' => chk_array($this->form_data, 'tb_usuario_username_email'),
                            'tb_usuario_validade' => chk_array($this->form_data, 'tb_usuario_validade'),
                            'tb_usuario_ativo' => chk_array($this->form_data, 'tb_usuario_ativo'),
                            'tb_usuario_e_vendedor' => chk_array($this->form_data, 'tb_usuario_e_vendedor'),
                            'tb_usuario_data_cadastro' => date('d/m/Y'),
                        ));
                    } else {
                        $query = $this->db->insert('tb_usuario', array(
                            'tb_usuario_cnpj_empresa' => chk_array($this->form_data, 'tb_usuario_cnpj_empresa'),
                            'tb_usuario_password' => $password,
                            'tb_usuario_nome' => chk_array($this->form_data, 'tb_usuario_nome'),
                            'tb_usuario_id_perfil' => chk_array($this->form_data, 'tb_usuario_id_perfil'),
                            'tb_usuario_username_email' => chk_array($this->form_data, 'tb_usuario_username_email'),
                            'tb_usuario_validade' => chk_array($this->form_data, 'tb_usuario_validade'),
                            'tb_usuario_ativo' => chk_array($this->form_data, 'tb_usuario_ativo'),
                            'tb_usuario_e_vendedor' => chk_array($this->form_data, 'tb_usuario_e_vendedor'),
                            'tb_usuario_data_cadastro' => date('d/m/Y'),
                        ));
                    }



                    if ($query) {
                        
                    }

// Verifica se a consulta está OK e configura a mensagem
                    if (!$query) {
                        $this->form_msg = '<p class="form_error">Erro ao inserir .</p>';
                        echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
                              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                              <span class='sr-only'>Error:</span>
                                $this->form_msg
                             </div>";


// Termina
//return;
                    } else {


                        $novaSenha = $this->form_data['tb_usuario_senha'];
                        $enviarPara = chk_array($this->form_data, 'tb_usuario_username_email');
                        $assunto = 'Cadastramento DWOnline online';
                        $corpo = 'Senha criada ' . $novaSenha;
                        $htmlEmail = '<b>Senha criada com sucesso  - </b>' . $novaSenha;

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
            .pedido{color:000; font-size:25px; font-weight:bold;}
            .pedidoAtive{color:red; font-size:25px; font-weight:bold;}
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
                <td><span class='pedido'>Olá </span><span class='pedido_numero'>" . $_POST['tb_usuario_nome'] . "</span></td>
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
                <td class='pedido'></strong > Email:<strong><span class='pedido_numero'>" . $_POST['tb_usuario_username_email'] . "</span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><a href='http://dwonline.com.br/desenv/verificaEmail.php?email=" . $_POST['tb_usuario_username_email'] . "'><span class='pedidoAtive'>Ative seu cadastro : </span><span class='pedido_numero'></span></a></td>
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


                        //$this->enviaEmailSes = new enviaEmailSes();
                        //$this->enviaEmailSes->enviarEmail($enviarPara, $assunto, $corpo, $htmlEmail);

                        $this->form_msg = '<p class="form_success">Cadastro efetuado com sucesso .</p>';
                        echo "<div style='text-align:center;' class='alert alert-success' role='alert'>
                              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                              <span class='sr-only'>Error:</span>
                                $this->form_msg
                             </div>";
// Termina
                        return;
                    }
                }
            }
        }
    }

// validate_register_form

    /**
     * Obtém os dados do formulário
     * 
     * Obtém os dados para usuários registrados
     *
     * @since 0.1
     * @access public
     */
    public function get_register_form($user_id = false) {

// O ID de usuário que vamos pesquisar
        $s_user_id = false;

// Verifica se você enviou algum ID para o método
        if (!empty($user_id)) {
            $s_user_id = (int) $user_id;
        }

// Verifica se existe um ID de usuário
        if (empty($s_user_id)) {
            return;
        }

// Verifica na base de dados
        $query = $this->db->query('SELECT * FROM `tb_usuario` WHERE `user_id` = ?', array($s_user_id));

// Verifica a consulta
        if (!$query) {
            $this->form_msg = '<p class="form_error">Usuário não existe.</p>';
            return;
        }

// Obtém os dados da consulta
        $fetch_userdata = $query->fetch();

// Verifica se os dados da consulta estão vazios
        if (empty($fetch_userdata)) {
            $this->form_msg = '<p class="form_error">User do not exists.</p>';
            return;
        }

// Configura os dados do formulário
        foreach ($fetch_userdata as $key => $value) {
            $this->form_data[$key] = $value;
        }

// Por questões de segurança, a senha só poderá ser atualizada
        $this->form_data['user_password'] = null;

// Remove a serialização das permissões
        $this->form_data['user_permissions'] = unserialize($this->form_data['user_permissions']);

// Separa as permissões por vírgula
        $this->form_data['user_permissions'] = implode(',', $this->form_data['user_permissions']);
    }

// get_register_form

    /**
     * Apaga usuários
     * 
     * @since 0.1
     * @access public
     */
    public function del_user($parametros = array()) {

// O ID do usuário
        $user_id = null;

// Verifica se existe o parâmetro "del" na URL
        if (chk_array($parametros, 0) == 'del') {

// Mostra uma mensagem de confirmação
            echo '<p class="alert">Tem certeza que deseja apagar este valor?</p>';
            echo '<p><a href="' . $_SERVER['REQUEST_URI'] . '/confirma">Sim</a> | 
			<a href="' . HOME_URI . '/user-register">Não</a> </p>';

// Verifica se o valor do parâmetro é um número
            if (
                    is_numeric(chk_array($parametros, 1)) && chk_array($parametros, 2) == 'confirma'
            ) {
// Configura o ID do usuário a ser apagado
                $user_id = chk_array($parametros, 1);
            }
        }

// Verifica se o ID não está vazio
        if (!empty($user_id)) {

// O ID precisa ser inteiro
            $user_id = (int) $user_id;

// Deleta o usuário
            $query = $this->db->delete('tb_usuario', 'user_id', $user_id);

// Redireciona para a página de registros
            echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/user-register/">';
            echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/user-register/";</script>';
            return;
        }
    }

// del_user

    /**
     * Obtém a lista de usuários
     * 
     * @since 0.1
     * @access public
     */
    public function get_user_list() {

// Simplesmente seleciona os dados na base de dados 
        $query = $this->db->query('SELECT * FROM `tb_usuario` ORDER BY user_id DESC');

// Verifica se a consulta está OK
        if (!$query) {
            return array();
        }
// Preenche a tabela com os dados do usuário
        return $query->fetchAll();
    }

// get_user_list
}
