<?php

/**
 * UserLogin - Manipula os dados de usuários
 *
 * Manipula os dados de usuários, faz login e logout, verifica permissões e 
 * redireciona página para usuários logados.
 *
 * @package DataWeb
 * @since 0.1
 */
class UserLogin {

    /**
     * Usuário logado ou não
     *
     * Verdadeiro se ele estiver logado.
     *
     * @public
     * @access public
     * @var bol
     */
    public $logged_in;

    /**
     * Dados do usuário
     *
     * @public
     * @access public
     * @var array
     */
    public $userdata;

    /**
     * Mensagem de erro para o formulário de login
     *
     * @public
     * @access public
     * @var string
     */
    public $login_error;

    /**
     * Mensagem de erro para o formulário de login
     *
     * @GET
     * @access protected
     * @var bolean
     */
    protected $sair;

    public function check_userlogin() {

        if (!empty($_GET['sair'])) {
            $this->logout();
        }
        // Verifica se existe um $_POST com a chave  
        // Tem que ser um array
        if (isset($_POST['tb_usuario_password'])) {

            $user_password = $this->db->anti_injection(($_POST['tb_usuario_password']));

            $email = $this->db->anti_injection(($_POST['tb_usuario_username_email']));

            $query = $this->db->query(
                    'SELECT * FROM tb_usuario '
                    . 'LEFT JOIN tb_empresa 
                        ON tb_empresa.tb_empresa_cnpj = tb_usuario.tb_usuario_cnpj_empresa
                        WHERE tb_usuario.tb_usuario_username_email = ? LIMIT 1', array($email));
            // Verifica a consulta
            $fetch = $query->fetch(PDO::FETCH_ASSOC);

            //print_r($fetch);
            //echo ">>".md5($_POST['tb_usuario_password']);


            if ($this->phpass->CheckPassword($user_password, $fetch['tb_usuario_password'])) {

                if ($fetch['tb_usuario_validade'] < date('Y-m-d')) {

                    // O usuário não está logado
                    $this->logged_in = false;

                    $this->login_error = "Usuario com validade expirada,favor entrar em contatado com responsavel para renovacao.Data de vencimento : " . date('d/m/Y', strtotime($fetch['tb_usuario_validade']));

                    echo "<div style='text-align:center;'class='alert alert-danger' role='alert'>
                        <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                        <span class='sr-only'>Error:</span>
                        " . $this->login_error . " 
                        </div>";

                    // Remove tudo
                    $this->logout();


                    return;
                }

                if ($fetch['tb_usuario_ativo'] == '') {

                    // O usuário não está logado
                    $this->logged_in = false;

                    $this->login_error = "Usuário não está ativado";

                    echo "<div style='text-align:center;'class='alert alert-danger' role='alert'>
                        <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                        <span class='sr-only'>Error:</span>
                        " . $this->login_error . " 
                        </div>";

                    // Remove tudo
                    $this->logout();

                    return;
                }

                // Recria o ID da sessão
                session_regenerate_id();
                $session_id = session_id();

                // Envia os dados de usuário para a sessão
                $_SESSION['userdata'] = $fetch;

                // Atualiza a senha
                //$_SESSION['userdata']['user_password'] = $user_password;
                // Atualiza o ID da sessão
                $_SESSION['userdata']['user_session_id'] = $session_id;

                $ip = $_SERVER['REMOTE_ADDR'];


                // Atualiza o ID da sessão na base de dados
                $query = $this->db->query(
                        'UPDATE tb_usuario SET tb_usuario_session_id = ?,tb_usuario_ip=?'
                        . ' WHERE tb_usuario_username_email = ?', array($session_id, $ip, $email)
                );

                setcookie("userdata", $session_id);

                $this->logged_in = true;

                // Configura os dados do usuário para $this->userdata
                $this->userdata = $_SESSION['userdata'];

                $this->goto_home();
            } else {

                // O usuário não está logado
                $this->logged_in = false;

                // A senha não bateu
                $this->login_error = 'Senha ou login incorretos !';

                echo "<div style='text-align:center;'class='alert alert-danger' role='alert'>
                        <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                        <span class='sr-only'>Error:</span>
                        $this->login_error
                        </div>";

                // Remove tudo
                $this->logout();

                return;
            }
        } else {

            //Não é post

            $query = $this->db->query(
                    'SELECT * FROM tb_usuario                   
                     WHERE tb_usuario.tb_usuario_session_id = ? LIMIT 1', array($_COOKIE['PHPSESSID']));
            // Verifica a consulta
            $fetch = $query->fetch(PDO::FETCH_ASSOC);

            $user_id_banco = ($fetch['tb_usuario_session_id']);
            //$cpf = ($fetch['tb_usuario_cpf']);
            $email = ($fetch['tb_usuario_username_email']);
            $user_id_cookie = $_COOKIE['PHPSESSID'];

            if ($this->phpass->CheckIdSession($user_id_cookie, $user_id_banco) || !empty($user_id_banco)) {


                $queryEmp = $this->db->query(
                        'SELECT * FROM tb_usuario '
                        . 'LEFT JOIN tb_empresa 
                        ON tb_empresa.tb_empresa_cnpj = tb_usuario.tb_usuario_cnpj_empresa
                        WHERE tb_usuario.tb_usuario_username_email = ? LIMIT 1', array($email));
                // Verifica a consulta
                $fetchEmp = $queryEmp->fetch(PDO::FETCH_ASSOC);

                $_SESSION['userdata']['tb_empresa_qtd_usuarios'] = $fetchEmp['tb_empresa_qtd_usuarios'];

                $session_id = session_id();

                // Atualiza o ID da sessão
                $_SESSION['userdata']['user_session_id'] = $session_id;

                // Configura a propriedade dizendo que o usuário está logado
                $this->logged_in = true;

                // Configura os dados do usuário para $this->userdata
                $this->userdata = $_SESSION['userdata'];
            } else {

                // O usuário não está logado
                $this->logged_in = false;

                // A senha não bateu
                $this->login_error = 'Senha ou login incorretos !.';

                // Remove tudo
                $this->logout();

                return;
            }
        }
    }

    /**
     * Logout
     *
     * Desconfigura tudo do usuárui.
     *
     * @param bool $redirect Se verdadeiro, redireciona para a página de login
     * @final
     */
    protected function logout($redirect = false) {

        // Remove all data from $_SESSION['userdata']
        $_SESSION = array();

        // Only to make sure (it isn't really needed)
        unset($_SESSION);

        $_SESSION['userdata'] = null;

        // Regenerates the session ID
        session_regenerate_id();

        if (true) {

            // Send the user to the login page
            $this->goto_login();
        }
    }

    /**
     * Vai para a página de login
     */
    protected function goto_login() {


        //print_r($_SERVER['QUERY_STRING'] == 'path=login/');
        //die("..");
        // Verifica se a URL da HOME está configurada
        if (defined('HOME_URI')) {
            // Configura a URL de login
            $login_uri = HOME_URI . '/login/';

            // A página em que o usuário estava
            $_SESSION['goto_url'] = urlencode($_SERVER['REQUEST_URI']);

            // Redireciona
            //echo '<meta http-equiv="Refresh" content="0; url=' . $login_uri . '">';
            //echo '<script type="text/javascript">window.location.href = "' . $login_uri . '";</script>';

            if ($_SERVER['QUERY_STRING'] != 'path=login/') {

                //die("....");
                header('location: ' . $login_uri);
            }
        }

        return;
    }

    /**
     * Vai para a página de login
     */
    protected function goto_home() {
        // Verifica se a URL da HOME está configurada
        if (defined('HOME_URI')) {
            // Configura a URL de login
            $login_uri = HOME_URI . '/home/';

            // A página em que o usuário estava
            $_SESSION['goto_url'] = urlencode($_SERVER['REQUEST_URI']);

            if ($_SESSION['userdata']['tb_usuario_aceite'] != 1) {


                echo "
<html>
    <head>
        <title>Temos de Uso</title>
        <meta charset='utf-8'/>
        <script src='//code.jquery.com/jquery-1.11.3.min.js'></script>
        <script src='//code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
        <script src='../../dist/js/jquery-ui.js'></script>
        <SCRIPT LANGUAGE='JavaScript'>   
<!-- Disable   
function disableselect(e){   
return false   
}   

function reEnable(){   
return true   
}   

//if IE4+   
document.onselectstart=new Function ('return false')   
document.oncontextmenu=new Function ('return false')   
//if NS6   
if (window.sidebar){   
document.onmousedown=disableselect   
document.onclick=reEnable   
}   
//-->   

window.onload = function() {
	document.onkeydown = function(e) {
		var code = e.keyCode || e.which;
		if(e.ctrlKey && (code == 80 || code == 112)) {
			e.preventDefault && e.preventDefault();
			return false;
		}
	}
}
</script>   
    </head>
    <!-- Logo -->
    <div style='background-color: black;'>
        <a href='' class='logo' >
            <img style='width: 30%;height: 70px;'src='../dist/img/LOGO DWONLINE.png'/>
        </a>
    </div> 
    <body style='background-color: whitesmoke' >
        <div class='alley'> <!-- Left Side -->
            <div class=''> <!-- Right Side -->
                <div class='inner'>  
                    <div class='Clear'></div>   
                    <div id='MainContent' class='Msdn'>
                        <div class='readonlymessage error' style='display:none;'>The system is currently in read-only mode. Profiles can not be modified or created.</div>
                        <form action='../aceite/'  method='post'>
                        <div style='margin-left=10px; '><br><br>
                            <h1 class='page-title'>&nbsp;&nbsp;&nbsp;Concordar com os Termos Legais</h1><br><br>
                            <p>&nbsp;&nbsp;Nossos termos legais mudaram desde sua última visita. Ao concordar com os termos e requisitos legais, você poderá continuar ou iniciar o uso do sistema DwOnline.</p>
                            &nbsp;&nbsp;Eu concordo com os termos e requisitos legais nos  <a href='#' id='trigger'>Termos de Uso</a><br><br>

                                <div id='dialog' style='display:none;'>
                                   
<br><br><br><br>
<?xml version='1.0' encoding='UTF-8'?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1 plus MathML 2.0//EN' 'http://www.w3.org/Math/DTD/mathml2/xhtml-math11-f.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><!--This file was converted to xhtml by LibreOffice - see http://cgit.freedesktop.org/libreoffice/core/tree/filter/source/xslt for the code.--><head profile='http://dublincore.org/documents/dcmi-terms/'><meta http-equiv='Content-Type' content='application/xhtml+xml; charset=utf-8'/><title xml:lang='en-US'>- no title specified</title><meta name='DCTERMS.title' content='' xml:lang='en-US'/><meta name='DCTERMS.language' content='en-US' scheme='DCTERMS.RFC4646'/><meta name='DCTERMS.source' content='http://xml.openoffice.org/odf2xhtml'/><meta name='DCTERMS.creator' content='Alexandre'/><meta name='DCTERMS.issued' content='2015-07-17T15:49:00' scheme='DCTERMS.W3CDTF'/><meta name='DCTERMS.contributor' content='Alexandre'/><meta name='DCTERMS.modified' content='2015-07-30T14:53:00' scheme='DCTERMS.W3CDTF'/><meta name='DCTERMS.provenance' content='' xml:lang='en-US'/><meta name='DCTERMS.subject' content=',' xml:lang='en-US'/><link rel='schema.DC' href='http://purl.org/dc/elements/1.1/' hreflang='en'/><link rel='schema.DCTERMS' href='http://purl.org/dc/terms/' hreflang='en'/><link rel='schema.DCTYPE' href='http://purl.org/dc/dcmitype/' hreflang='en'/><link rel='schema.DCAM' href='http://purl.org/dc/dcam/' hreflang='en'/><style type='text/css'>
	@page {  }
	table { border-collapse:collapse; border-spacing:0; empty-cells:show }
	td, th { vertical-align:top; font-size:12pt;}
	h1, h2, h3, h4, h5, h6 { clear:both }
	ol, ul { margin:0; padding:0;}
	li { list-style: none; margin:0; padding:0;}
	<!-- 'li span.odfLiEnd' - IE 7 issue-->
	li span. { clear: both; line-height:0; width:0; height:0; margin:0; padding:0; }
	span.footnodeNumber { padding-right:1em; }
	span.annotation_style_by_filter { font-size:95%; font-family:Arial; background-color:#fff000;  margin:0; border:0; padding:0;  }
	* { margin:0;}
	.Normal_20__28_Web_29_ { font-size:12pt; line-height:100%; margin-bottom:0.494cm; margin-top:0.494cm; text-align:left ! important; font-family:Times New Roman; writing-mode:lr-tb; }
	.P1 { font-size:11pt; line-height:100%; margin-bottom:0.494cm; margin-top:0.494cm; text-align:left ! important; font-family:Arial; writing-mode:lr-tb; }
	.P2 { font-size:12pt; line-height:100%; margin-bottom:0.494cm; margin-top:0.494cm; text-align:left ! important; font-family:Times New Roman; writing-mode:lr-tb; }
	.Standard { font-size:11pt; line-height:108%; margin-bottom:0.282cm; margin-top:0cm; font-family:Calibri; writing-mode:lr-tb; text-align:left ! important; }
	.Internet_20_link { color:#0000ff; text-decoration:underline; }
	.Strong { font-weight:bold; }
	.T1 { font-family:Arial; font-size:11pt; }
	.T2 { font-family:Arial; font-size:11pt; font-weight:bold; }
	.T3 { font-family:Arial; font-size:11pt; font-weight:normal; }
	<!-- ODF styles with no properties representable as CSS -->
	 { }
	</style></head><body dir='ltr' style='width: 1000px;height: 500px;'><p class='P2'><span class='Strong'><span class='T1' >CONTRATO DE PRESTAÇÃO DE SERVIÇOS E DIRETO DE USO DE SOFTWARE</span></span></p><p class='Normal_20__28_Web_29_'><span class='Strong'><span class='T1'>CONTRATADA:</span></span><span class='T1'><br/><br/></span><span class='T2'>MATRIZ - UNIDATA SERVIÇOS PROCESSAMENTO DADOS LTDA EPP</span><span class='T1'>, nome fantasia </span><span class='T2'>DATA MAILING MARKETING SOLUTION</span><span class='T1'>, com sede na AV. CRISTOVÃO COLOMBO, Nº 519, SALA 706, SAVASSI (FUNCIONÁRIOS), BELO HORIZONTE, MG, inscrita no CNPJ/MF Nº 06.976.525/0001-43, Inscrição Estadual sob Nº (Isenta) e </span><span class='T2'>FILIAL - UNIDATA SERVIÇOS PROCESSAMENTO DADOS LTDA</span><span class='T1'>, nome fantasia </span><span class='T2'>DATA MAILING MARKETING SOLUTION</span><span class='T1'>, com sede na R.  AMARAL GAMA, Nº 333, SALA 24, SANTANA, SÃO PAULO, SP, inscrita no CNPJ/MF Nº 06.976.525/0002-24, Inscrição Estadual sob Nº (Isenta), por seus representantes legais abaixo assinados, doravante denominada simplesmente CEDENTE,</span></p><p class='Normal_20__28_Web_29_'><span class='Strong'><span class='T1'>CONTRATANTE:</span></span><span class='T1'> Conforme CADASTRO preenchido pelo usuário e ACEITO ELETRONICAMENTE no sítio </span><a href='http://www.DWONLINE.com.br' class='Internet_20_link'><span class='T1'>www.</span></a><a href='http://www.DWONLINE.com.br' class='Internet_20_link'><span class='T2'>DWONLINE</span></a><a href='http://www.DWONLINE.com.br' class='Internet_20_link'><span class='T1'>.com.br</span></a><span class='T1'>.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Resolvem firmar o presente contrato de prestação de serviços, que será regido de acordo com as seguintes cláusulas e condições:</span></p><p class='Normal_20__28_Web_29_'><span class='Strong'><span class='T1'>1 - DO OBJETO</span></span></p><p class='Normal_20__28_Web_29_'><span class='T2'>OS SERVIÇOS OBJETO DESTE INSTRUMENTO SÃO DIRECIONADOS E PODERÃO SER CONTRATADOS ÚNICA E EXCLUSIVAMENTE POR PESSOAS JURÍDICAS E ESTÁ VEDADA A CONTRATAÇÃO ATRAVÉS DE PESSOAS FÍSICAS</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>UNIDATA SERVIÇOS DE PROCESSAMENTO DADOS LTDA EPP</span><span class='T1'>, pelo presente instrumento, concede a </span><span class='T2'>CONTRATANTE</span><span class='T1'>, o direito de uso do software </span><span class='T2'>“DWONLINE”</span><span class='T1'>, de maneira pessoal e intransferível, através de criação de usuários e senhas de acesso, por tempo determinado neste instrumento. </span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Os Softwares disponibilizados através do endereço eletrônico </span><a href='http://www.DWONLINE.com.br' class='Internet_20_link'><span class='T1'>www.</span></a><a href='http://www.DWONLINE.com.br' class='Internet_20_link'><span class='T2'>DWONLINE</span></a><a href='http://www.DWONLINE.com.br' class='Internet_20_link'><span class='T1'>.com.br</span></a><span class='T1'>, denominados </span><span class='T2'>“DWONLINE”</span><span class='T1'> são de propriedade </span><span class='T2'>ÚNICA</span><span class='T1'> e </span><span class='T2'>EXCLUSIVA</span><span class='T1'> de </span><span class='T2'>UNIDATA SERVIÇOS DE PROCESSAMENTO DE DADOS LTDA EPP </span><span class='T1'>E SERÃO CHAMADOS NESTE INSTRUMENTO SOMENTE DE </span><span class='T2'>“DWONLINE”</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Constitui </span><span class='T2'>OBJETO</span><span class='T1'> do presente contrato, o fornecimento pela </span><span class='T2'>CONTRATADA</span><span class='T1'> dos </span><span class='T2'>Serviços de Consulta de Dados Cadastrais</span><span class='T1'> para </span><span class='T2'>CONTRATANTE</span><span class='T1'>, por intermédio de Infraestrutura de Tecnologia da Informação e disponibilização em ambiente restrito de sistemas de </span><span class='T2'>CONSULTA REMOTA</span><span class='T1'>, aqui chamadas simplesmente de </span><span class='T2'>“DWONLINE”</span><span class='T1'>.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'> Público Alvo – Os sistemas do sítio &lt;www.DWONLINE.com.br&gt; são disponibilizadas única e exclusivamente para Pessoas Jurídicas, para fins de apoio à análise comparativa de crédito, consulta e atualização cadastral, confirmação de dados cadastrais, utilização de políticas anti-fraude, recuperação de crédito e campanhas de Marketing Direto.<br/><br/>É completamente vedada a utilização para fins diversos da cláusula acima, deste instrumento, sendo único responsável pela salvaguarda das senhas de acesso e das informações consultadas, o </span><span class='T2'>CONTRATANTE</span><span class='T1'>, devendo responder cível e criminalmente por quaisquer danos que possam ser gerados pela má utilização do sistema </span><span class='T2'>“DWONLINE” </span><span class='T1'>e/ou de suas informações disponibilizadas</span><span class='T2'>, </span><span class='T1'>devendo o </span><span class='T2'>CONTRATANTE</span><span class='T1'> tomar as devidas providências para segurança das informações e confidencialidade das mesmas.<br/><br/>A </span><span class='T2'>CONTRATADA </span><span class='T1'>não se responsabiliza , em nenhuma hipótese, por riscos e/ou prejuízos causados a este ou a terceiros por fraudes, inadimplência ou quaisquer danos relativos à MÁ UTILIZAÇÂO do sistema </span><span class='T2'>“DWONLINE”</span><span class='T1'>, independente do resultado das consultas, já que o </span><span class='T2'>CONTRATANTE</span><span class='T1'> tem completa ciência de que é o único responsável pela decisão final de conceder ou não crédito a terceiros ou de utilizar para qualquer fim, as informações consultadas.</span></p><p class='P1'> </p><p class='Normal_20__28_Web_29_'><span class='Strong'><span class='T1'>2 - DA PRESTAÇÃO DE SERVIÇOS</span></span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATADA</span><span class='T1'> colocará à disposição do </span><span class='T2'>CONTRATANTE, </span><span class='T1'>o sistema </span><span class='T2'>“DWONLINE”</span><span class='T1'>, para disponibilizar a consulta de informações cadastrais de origens seguras e de conhecimento público, ou privadas, sendo estas obtidas através de modelagem estatística, não privilegiadas, nem tão pouco de foro íntimo, para cumprimento do </span><span class='T2'>OBJETO</span><span class='T1'> deste instrumento.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATADA</span><span class='T1'> responsabiliza-se pela integridade das informações, tais como as recebe de suas fontes, ou privadas, obtidas através de modelagem estatística, não se responsabilizando pela veracidade, exatidão ou data de atualização.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATANTE</span><span class='T1'> concorda que a </span><span class='T2'>CONTRATADA</span><span class='T1'>, poderá coletar informações técnicas e cadastrais fornecidas pelos usuários do sistema, bem como coletar e utilizar informações advindas da utilização do sistema </span><span class='T2'>“DWONLINE”</span><span class='T1'>, com a finalidade de retroalimentar seu Banco de Dados utilizado em seus produtos e serviços e ocasionar melhorias de qualidade cadastral, na prestação dos serviços, melhorias de desenvolvimento de software ou ainda, para fornecer serviços personalizados.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATADA</span><span class='T1'> poderá bloquear o cadastro e acesso aos serviços ofertados ao </span><span class='T2'>CONTRATANTE</span><span class='T1'> a qualquer momento por motivo de divergência cadastral (dados informados divergentes dos órgãos oficiais), problemas com pagamentos dos créditos adquiridos no sítio &lt;www.</span><span class='T2'>”DWONLINE”</span><span class='T1'>.com.br&gt;, solicitações judiciais, ou, ainda, por constatação de uso divergente da finalidade do </span><span class='T2'>OBJETO</span><span class='T1'> deste contrato e seus anexos.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>O </span><span class='T2'>CONTRATANTE</span><span class='T1'> poderá ter seu cadastro e acesso liberado após regularização cadastral a critério da </span><span class='T2'>CONTRATADA</span><span class='T1'>, não podendo o </span><span class='T2'>CONTRATANTE</span><span class='T1'> solicitar o reembolso dos créditos não expirados caso seu cadastro não possa ser liberado.</span></p><p class='P1'> </p><p class='Normal_20__28_Web_29_'><span class='Strong'><span class='T1'>3 – TERMOS DE USO</span></span></p><p class='Normal_20__28_Web_29_'><span class='T1'>O desenvolvimento da infra estrutura e/ou aplicativos ou interface de comunicação entre o portal de  internet da </span><span class='T2'>CONTRATANTE</span><span class='T1'> para interação com o </span><span class='T2'>“DWONLINE”</span><span class='T1'>, deverá ser realizado pela </span><span class='T2'>CONTRATANTE</span><span class='T1'>, não cabendo a </span><span class='T2'>CONTRATADA</span><span class='T1'>, arcar com os custos de implantação</span><span class='T2'>.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A descrição do chamado Ambiente Operacional Básico, será composta por Micro Computadores com acesso à Rede Mundial de Computadores (WEB), Browser Google </span><span class='T1'>Chrome</span><a id='_GoBack'/><span class='T1'>, ou navegadores similares, Sistemas MS Windows(XP ou superior), MS DOS, MS Visual Basic, MS ACESS, MS SQL.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>O </span><span class='T2'>CONTRATANTE</span><span class='T1'> deverá acessar e enviar as informações à </span><span class='T2'>CONTRATADA</span><span class='T1'> por meio de recursos próprios, terminais, linhas de comunicação, modem, etc., mediante o código e senha exclusivos fornecidos pela </span><span class='T2'>CONTRATADA</span><span class='T1'> por meios automatizados, via conexão computador a computador.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A aquisição dos terminais, da linha de comunicação e demais despesas decorrentes correrão por conta do </span><span class='T2'>CONTRATANTE</span><span class='T1'>.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATANTE</span><span class='T1'> reconhece e concorda que a </span><span class='T2'>CONTRATADA</span><span class='T1'> poderá e deverá verificar e fazer alterações ou atualizações, totais ou parciais, envolvendo alteração de formato(layout), conteúdo embarcado ou qualquer outra característica de versões anteriores, sem aviso prévio (releases) na versão utilizada, com a finalidade de melhorias na prestação dos serviços.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATADA</span><span class='T1'> deverá identificar o tipo de configuração de acesso mais segura ou mais benéfica, dependendo do tipo de conexão da </span><span class='T2'>CONTRATANTE</span><span class='T1'>, no que se refere ao sistema de IP(Internet Protocol) Fixo ou IP Dinânico, devendo a </span><span class='T2'>CONTRATADA</span><span class='T1'> aceitar a forma de configuração de uso proposta.  </span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A não aceitação das configurações acima propostas poderá colocar em risco a segurança do sistema e de suas informações, ou da salvaguarda de senhas ou utilização pessoal e intransferível, ficando a </span><span class='T2'>CONTRATADA</span><span class='T1'> responsável por eventuais problemas de segurança da informação ou de software.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>As condições gerais para a execução dos serviços prestados e parametrização, </span><span class='T2'>OBJETO</span><span class='T1'> deste instrumento, bem como as condições comerciais e financeiras, quando adicionais, quando diferentes das condições comerciais disponibilizadas no sítio &lt;www.</span><span class='T2'>”DWONLINE”</span><span class='T1'>.com.br&gt;, deverão obrigatoriamente ser tratados em Proposta Comercial, que deve ser apreciada pela </span><span class='T2'>CONTRATANTE</span><span class='T1'>, e esta conceder seu 'De Acordo', através da assinatura do termo 'ACEITE'  e se tornarão parte deste instrumento através do ANEXOI.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Em caso de inadimplemento de qualquer parcela pela </span><span class='T2'>CONTRATANTE</span><span class='T1'>, esta ficará sujeita a uma multa de 2% (dois por cento), além de juros de mora de 0,5% (meio por cento) ao dia e correção monetária pelo IGPM, além da suspensão da prestação de serviços, </span><span class='T2'>OBJETO</span><span class='T1'> deste instrumento. </span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Caso o inadimplemento perdure por mais de 60 (sessenta) dias, a </span><span class='T2'>CONTRATADA</span><span class='T1'> poderá cancelar a prestação dos serviços e resolver o presente contrato, independentemente da fase em que se encontrem, de forma que, caso tenham sido realizadas tarefas por parte da </span><span class='T2'>CONTRATADA</span><span class='T1'> e que estejam pendentes de pagamento, ser-lhe-á facultado propor medida executiva judicial para recebimento dos seus créditos, que terão a atribuição prevista no Art. 585 do Código de Processo Civil, tal como Título Executivo Extrajudicial, sem prejuízo das demais penalidades e multas contratuais aplicáveis, bem assim eventuais perdas e danos.</span></p><p class='P1'> </p><p class='P1'> </p><p class='P1'> </p><p class='Normal_20__28_Web_29_'><span class='Strong'><span class='T1'>4 - DA COMERCIALIZAÇÃO</span></span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATADA</span><span class='T1'> disponibiliza os serviços ao </span><span class='T2'>CONTRATANTE</span><span class='T1'> através de um sistema de pagamento pré-pago ou pós pago, dependendo da modalidade de serviço prestado, devendo a compra de créditos ser efetuada nas formas de pagamento disponíveis no sítio &lt;www.</span><span class='T2'>”DWONLINE”</span><span class='T1'>.com.br&gt; no momento da compra.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Uma vez pagando com cartão de crédito, mesmo que de terceiros, o </span><span class='T2'>CONTRATANTE</span><span class='T1'> autoriza o armazenamento dos dados do(s) cartão(ões) de crédito, à exceção do código de segurança (CVV), para utilização em recompra automática por falta de saldo ou programada, serviços de cobrança recorrente (assinaturas, mensalidades, monitoramentos, etc.), confiando no armazenamento pela </span><span class='T2'>CONTRATADA</span><span class='T1'> em ambiente seguro com certificação PCI DSS (Payment Card Industry Data Security Standard), podendo a qualquer momento, tanto a </span><span class='T2'>CONTRATADA</span><span class='T1'> como o </span><span class='T2'>CONTRATANTE</span><span class='T1'>, excluir os dados armazenados.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Para a primeira aquisição de créditos é necessário preencher seus dados, escolher o valor, forma de pagamento e aceitar eletronicamente as condições deste contrato e seus anexos, quando houver. </span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Independente do serviço a ser utilizado pelo </span><span class='T2'>CONTRATANTE</span><span class='T1'>, haverá um valor mínimo a ser adquirido a cada compra, o qual consta no sítio &lt;www.</span><span class='T2'>”DWONLINE”</span><span class='T1'>.com.br&gt; e que poderá ser alterado a qualquer momento e com prévio aviso através de publicação de tabela de preços ou comunicação por e-mail.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>O crédito adquirido tem validade de 30 (sessenta) dias contados da data de compra e expirar-se-á após esse prazo. Não existem créditos cumulativos. </span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Pela prestação de serviços disponibilizados pela </span><span class='T2'>CONTRATADA</span><span class='T1'>, independente da data da compra do crédito, será cobrado o valor vigente no dia do acesso e/ou renovação, constante no sítio &lt;www.</span><span class='T2'>DWONLINE</span><span class='T1'>.com.br&gt; por cada serviço solicitado e/ou renovado, ou nos casos de proposta comercial, terão validade as condições comerciais negociadas na proposta comercial; valor este que será imediatamente abatido do seu saldo de créditos. </span></p><p class='P1'> </p><p class='Normal_20__28_Web_29_'><span class='T2'>5 - DAS RESPONSABILIDADES DA CONTRATADA</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATADA</span><span class='T1'> se obriga a manter, durante a vigência deste contrato, mão-de-obra especializada para a realização dos serviços que forem solicitados pela </span><span class='T2'>CONTRATANTE</span><span class='T1'>, responsabilizando-se pelo cumprimento da legislação trabalhista, previdenciária e fiscal, incidentes sobre os contratos de trabalho que mantém com os profissionais integrantes de sua equipe.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Este contrato não criará vínculo empregatício entre funcionários da </span><span class='T2'>CONTRATADA</span><span class='T1'>  e a </span><span class='T2'>CONTRATANTE</span><span class='T1'>. Todas as responsabilidades decorrentes de encargos fiscais, bem como, exigências legais ou ordens trabalhistas, previdenciárias e quaisquer outras resultantes da prestação de serviços </span><span class='T2'>OBJETO</span><span class='T1'> deste instrumento, são de exclusiva responsabilidade da </span><span class='T2'>CONTRATADA</span><span class='T1'> – quando se referir a mão-de-obra empregada por esta, que se obriga a quitá-los em seus respectivos vencimentos.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Para todos os fins de direito, fica entendido que não existe qualquer vínculo empregatício entre as PARTES, formação de grupo de empresas, holding, e que o </span><span class='T1'>presente contrato não cria nenhum vínculo societário, associativo, de representação, de agenciamento de consórcio ou assemelhados entre as partes, arcando cada qual com as suas respectivas obrigações não perfazendo qualquer outro vínculo além de prestação de serviços, de maneira que a </span><span class='T2'>CONTRATADA</span><span class='T1'> se obriga a reembolsar a </span><span class='T2'>CONTRATANTE</span><span class='T1'>  e vice versa, nas despesas ou custas processuais, honorários advocatícios, custos periciais e demais custos em que esta incorrer em decorrência  de reclamação trabalhista movida por qualquer funcionário ou ex funcionário das </span><span class='T2'>partes.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATADA</span><span class='T1'>, a seu critério, poderá aumentar, diminuir, redistribuir ou substituir os seus recursos humanos envolvidos no projeto, </span><span class='T2'>OBJETO</span><span class='T1'> do presente contrato, desde que a qualidade e os prazos dos serviços não sejam afetados e desde que as Informações confidenciais sejam devidamente protegidas.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATADA</span><span class='T1'> deverá prestar os serviços com a freqüência ajustada, devendo zelar pelo bom atendimento à </span><span class='T2'>CONTRATANTE</span><span class='T1'>, bem como pela qualidade dos serviços contratados, responsabilizando-se por todos os prejuízos que der causa, desde que não seja comprovada a culpa da </span><span class='T2'>CONTRATANTE</span><span class='T1'> na sua ocorrência.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Parágrafo único. A </span><span class='T2'>CONTRATADA</span><span class='T1'> não se responsabiliza pelos vícios provocados pela </span><span class='T2'>CONTRATANTE</span><span class='T1'>, culposa ou dolosamente</span></p><p class='P1'> </p><p class='Normal_20__28_Web_29_'><span class='T2'>6 - DAS RESPONSABILIDADES DA CONTRATANTE.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATANTE</span><span class='T1'> se obriga a fornecer à </span><span class='T2'>CONTRATADA</span><span class='T1'> os elementos, as informações, documentos e dados que eventualmente se fizerem necessários para a entrega configuração e conexão para a prestação dos serviços, bem como a permitir o levantamento de outros dados de que necessitar para a continuidade dos serviços, de forma normal e sem interrupções.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATANTE</span><span class='T1'> deverá respeitar os prazos para pagamento dos valores dos serviços, sob pena de incorrer nas penalidades previstas neste contrato.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATANTE</span><span class='T1'> se obriga a utilizar os resultados dos serviços na forma expressamente autorizada pela lei, seguindo as especificações definidas pela </span><span class='T2'>CONTRATADA</span><span class='T1'>, respondendo, integral e exclusivamente pelo uso indevido ou danos que venham causar à </span><span class='T2'>CONTRATADA</span><span class='T1'> ou terceiros;</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATANTE</span><span class='T1'> é inteiramente responsável pelo acesso as informações fornecidas em todas as modalidades de serviços constantes na solução </span><span class='T2'>“DWONLINE”</span><span class='T1'>, bem como por zelar pelas senhas de acesso, acesso as telas do sistema, e salvaguarda das informações acessadas e transmitidas, sendo o único responsável pela integridade das senhas e do acesso ao sistema.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>É expressa e totalmente vedado a </span><span class='T2'>CONTRATANTE</span><span class='T1'>, realizar engenharia reversa, descompilar, desmontar, traduzir, replicar, copiar, adaptar, readaptar ou modificar o software ou qualquer solução fornecida pela </span><span class='T2'>CONTRATADA</span><span class='T1'>, ou fazer uso de qualquer outra medida que possibilite acesso ao código fonte do software ou qualquer solução oferecida pela </span><span class='T2'>CONTRATANTE</span><span class='T1'>, estando a </span><span class='T2'>CONTRATADA</span><span class='T1'> sujeita a responsabilidade civil e penal por tais infrações.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Também é vedado a </span><span class='T2'>CONTRATANTE</span><span class='T1'>, qualquer prática que implique em exploração comercial das soluções da </span><span class='T2'>CONTRATADA</span><span class='T1'>.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATANTE</span><span class='T1'> estará impedida, após a assinatura deste instrumento a fornecer ou oferecer aos funcionários da </span><span class='T2'>CONTRATADA</span><span class='T1'>, condições de trabalho ou a efetuar contratações de funcionários da </span><span class='T2'>CONTRATADA</span><span class='T1'>.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATANTE</span><span class='T1'> em caso de desrespeito a Cláusula acima, sobre oferta de emprego, estará sujeita ao equivalente a 30 vezes o valor do Salário Mínimo vigente na época da ocorrência, salvo nos casos de anuência da </span><span class='T2'>CONTRATADA</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Todas as informações obtidas no sítio &lt;www.</span><span class='T2'>DWONLINE</span><span class='T1'>.com.br&gt; são de uso exclusivo do </span><span class='T2'>CONTRATANTE</span><span class='T1'> para utilização apenas para as finalidades descritas nos termos deste instrumento, sendo que a utilização por outra pessoa ou para finalidade diversa da acordada caracteriza ilícito civil e/ou penal, tornando a prova incontestável para qualquer processo.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>O </span><span class='T2'>CONTRATANTE</span><span class='T1'> responsabiliza-se pelo resguardo de sua senha principal e/ou senhas adicionais, não a repassando a terceiros e estas poderão ser substituídas pelas partes a qualquer momento.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>O </span><span class='T2'>CONTRATANTE</span><span class='T1'> é responsável por possíveis vírus e/ou programas piratas instalados no seu computador que possam de alguma forma furtar sua senha principal e/ou senhas adicionais.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>É vedado ao </span><span class='T2'>CONTRATANTE</span><span class='T1'>, sob pena de arcar com perdas e danos e as demais responsabilidades cíveis e criminais e imediata rescisão deste contrato, se incorrer em qualquer uma das situações abaixo, quais sejam:</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Divulgar a terceiros as informações obtidas através dos serviços prestados, sob qualquer hipótese e sob qualquer forma.<br/><br/>Permitir que pessoas não comprometidas com a confidencialidade operem o sistema para a obtenção e/ou utilização de informações disponibilizadas pela </span><span class='T2'>CONTRATADA</span><span class='T1'>.<br/><br/>Armazenar, divulgar e/ou reproduzir qualquer tela com dados de propriedade das fontes da </span><span class='T2'>CONTRATADA</span><span class='T1'> e/ou afiliados, tanto total como parcialmente.<br/><br/>Utilizar os serviços para obter informações de pessoas físicas e/ou jurídicas com outra finalidade que não seja a descrita nos anexos deste contrato.<br/><br/>Estabelecer convênio de repasse, comercializar e/ou revender quaisquer informações obtidas da </span><span class='T2'>CONTRATADA</span><span class='T1'>.<br/><br/>Utilizar qualquer informação obtida através da </span><span class='T2'>CONTRATADA</span><span class='T1'> para praticar atos ilícitos, constranger ou coagir, de qualquer maneira que seja, pessoas físicas e/ou jurídicas. </span></p><p class='Normal_20__28_Web_29_'><span class='T1'>O </span><span class='T2'>CONTRATANTE</span><span class='T1'> deverá indenizar, regressivamente, a </span><span class='T2'>CONTRATADA</span><span class='T1'> e/ou terceiros, por todas e quaisquer perdas e danos diretos, indiretos, incidentais ou consequências advindas por qualquer forma que seja, administrativa e/ou judicial, de seus atos ou omissões, em violação da lei ou de suas obrigações contratuais, em especial as descritas neste instrumento, no montante da condenação efetivamente paga, mais custas, despesas processuais e honorários advocatícios entre outros </span><span class='T1'>valores despendidos, acrescidos de correção monetária e juros de 1% (um por cento) ao mês pro rata die, mais multa de 20% (vinte por cento), contados desde a data do desembolso até a data do efetivo pagamento. </span></p><p class='Normal_20__28_Web_29_'><span class='T1'>O </span><span class='T2'>CONTRATANTE</span><span class='T1'> compromete-se a pautar o seu relacionamento com seus clientes em princípios éticos e morais em suas relações comerciais e afins.</span></p><p class='Normal_20__28_Web_29_'><span class='Strong'><span class='T1'><br/>7 - DO PRAZO, VIGÊNCIA E RECISÃO</span></span></p><p class='Normal_20__28_Web_29_'><span class='T1'>O presente contrato tem prazo indeterminado e produzirá efeitos jurídicos mesmo depois de cessada a prestação dos serviços.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Não se confunde com os prazos de execução do projeto designados na Proposta Comercial (Anexo ), que por sua vez deverão ser cumpridos integralmente, ressalvadas eventuais prorrogações havidas com a anuência da </span><span class='T2'>CONTRATANTE</span><span class='T1'>.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Em caso de Recisão, deverá a PARTE interessada comunicar por escrito a outra PARTE, com antecedência mínima de 30 dias, a contar da data de encerramento do mês vigente ao pedido, não as desobrigando das responsabilidades assumidas durante a vigência deste contrato, não podendo o </span><span class='T2'>CONTRATANTE</span><span class='T1'> solicitar o reembolso dos créditos não expirados ou existentes.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Parágrafo único. Na hipótese de uma das PARTES serem incapazes de cumprirem suas obrigações, devido a causas alheias à sua vontade, tais como, caso fortuito, incêndio, inundação, guerra, normas e regulamentos, válidos ou inválidos, haverá prorrogação razoável de prazo para o cumprimento pela </span><span class='T2'>CONTRATADA</span><span class='T1'> ou </span><span class='T2'>CONTRATANTE</span><span class='T1'>, não sendo ela responsável pelos atrasos decorrentes.</span></p><p class='Normal_20__28_Web_29_'><span class='Strong'><span class='T3'>As condições comerciais poderão sofrer alterações independente da vigência deste instrumento.</span></span></p><p class='Normal_20__28_Web_29_'><span class='Strong'><span class='T1'><br/>8 - DO SIGILO E DA CONFIDENCIALIDADE</span></span></p><p class='Normal_20__28_Web_29_'><span class='T1'>As partes comprometem-se a manter sigilo sobre todas as informações comerciais, técnicas e afins, bem como sobre a documentação correlata, de qualquer forma fornecidas por uma parte a outra, referentes ao cumprimento do presente contrato, inclusive as relativas aos detentores de senhas dos serviços prestados e a não revelar tais informações, sob qualquer pretexto, salvo quando requisitadas pelos órgãos judiciais competentes.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>As partes obrigam-se a obter de terceiros (sócios, empregados, representantes, OU TODOS OS ENVOLVIDOS NO PROCESSO DE UTILIZAÇÃO, etc.) o compromisso formal de manter a confidencialidade e fazer uso restrito dos serviços prestados que devem, por previsão legal, conhecer e receber informações oriundas deste contrato ou parte dele, sob pena de imediata rescisão deste, além das responsabilidades civis e criminais.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATANTE</span><span class='T1'> declara ter ciência de que na utilização da solução do software </span><span class='T2'>OBJETO</span><span class='T1'> deste instrumento poderá acessar alguns recursos ou arquivos de bibliotecas dos dispositivos utilizados para acesso, para garantir o melhor funcionamento das soluções, sem alterar configurações de segurança, privacidade, ou comprometer o bom funcionamento dos dispositivos.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATANTE</span><span class='T1'> declara ter ciência de que a solução </span><span class='T2'>“DWONLINE”</span><span class='T1'>, pode acessar provedores de dados e ter acesso ao código IP, para o funcionamento seguro do sistema.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>As partes reconhecem e concordam que as Informações confidenciais obtidas uma da outra são de propriedade exclusiva daquela que as forneceu e que este contrato não transfere, nem outorga à outra parte, qualquer título, direito, privilégio, expressa ou implicitamente, nem qualquer licença sob qualquer patente, que, seja ou venha a ser no futuro, de propriedade da parte divulgadora</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Uma das partes somente poderá copiar, reproduzir ou distribuir, em seu todo ou parcialmente, as Informações Confidenciais da outra, mediante prévia e expressa autorização.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A obrigação de não divulgar informações confidenciais obtidas com a presente contratação continuará em vigor, após o encerramento do presente contrato.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A violação da confidencialidade imposta por esta cláusula acarretará à parte infratora o dever de reparar todos os prejuízos decorrentes da divulgação indevida de qualquer informação confidencial obtida, sem prejuízo de eventuais sanções previstas em lei.</span></p><p class='P1'> </p><p class='Normal_20__28_Web_29_'><span class='Strong'><span class='T1'>11 - DISPOSIÇÕES GERAIS</span></span></p><p class='Normal_20__28_Web_29_'><span class='T1'>O </span><span class='T2'>CONTRATANTE</span><span class='T1'> declara expressamente serem verídicos os dados cadastrais inseridos para conclusão da contratação e obriga-se a mantê-los atualizados, comunicando imediatamente qualquer alteração de endereço físico, e-mail, telefone, etc., sob pena de ser considerada válida a última informação cadastral fornecida.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATADA</span><span class='T1'> não se responsabiliza pela incorreta, ou pela má utilização do sistema, ou ainda, pelas consequências geradas pela utilização diversa das estipuladas neste instrumento e a </span><span class='T2'>CONTRATANTE</span><span class='T1'> declara ser a única responsável pelo descumprimento das cláusulas referentes a má utilização do sistema, perante si ou perante terceiros atingidos por práticas de má fé ou outras violações deste instrumento, estando a </span><span class='T2'>CONTRATADA</span><span class='T1'> desobrigada a ressarcir ou indenizar a </span><span class='T2'>CONTRATANTE</span><span class='T1'> ou terceiros afetados seja a que título for, mais ainda, se incorrer nas hipóteses de uso para fins diversos do estipulado neste instrumento, for danificado, modificado, invadido ou alterado, for danificado por motivos de força maior ou utilização com negligência, imprudência ou imperícia ou por outras causas ou vícios divergentes do </span><span class='T2'>OBJETO</span><span class='T1'> deste instrumento.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Para a utilização do </span><span class='T2'>“DWONLINE”</span><span class='T1'> é indispensável  a aceitação das cláusulas deste instrumento.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Caso não esteja de acordo com este documento, a </span><span class='T2'>CONTRATADA</span><span class='T1'> não deve declarar sua aceitação nem instalar ou utilizar as soluções do sítio &lt;www.</span><span class='T2'>DWONLINE</span><span class='T1'>.com.br&gt;.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Este instrumento se aplica a eventuais alterações ou atualizações em todos os sistemas e soluções do sítio &lt;www.</span><span class='T2'>DWONLINE</span><span class='T1'>.com.br&gt;.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATADA</span><span class='T1'> reserva para si a titularidade de todos os direitos que não foram expressamente concedidos ao </span><span class='T2'>CONTRATANTE</span><span class='T1'>.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>As soluções do sítio </span><a href='http://www.dwonline.com.br' class='Internet_20_link'><span class='T1'>www.</span></a><a href='http://www.dwonline.com.br' class='Internet_20_link'><span class='T2'>”DWONLINE”</span></a><a href='http://www.dwonline.com.br' class='Internet_20_link'><span class='T1'>.com.br</span></a><span class='T1'> estão protegidas por leis e tratados de propriedade e direitos autorais.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Eventuais alterações neste contrato serão anunciadas no sítio &lt;www.</span><span class='T2'>”DWONLINE”</span><span class='T1'>.com.br&gt; e poderão ser consultadas a qualquer tempo, para análise de aceitação, por parte da </span><span class='T2'>CONTRATANTE</span><span class='T1'>.  No caso de não aceitação a </span><span class='T2'>CONTRATANTE</span><span class='T1'> deverá notificar a </span><span class='T2'>CONTRATADA</span><span class='T1'> e a prestação dos serviços ficará suspensa até a resolução das questões pendentes.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A </span><span class='T2'>CONTRATADA</span><span class='T1'> fornece atendimento ao </span><span class='T2'>CONTRATANTE</span><span class='T1'> através de e-mail &lt;suporte@</span><span class='T2'>DWONLINE</span><span class='T1'>.com.br&gt; ou telefone disponibilizados no sítio &lt;www.</span><span class='T2'>”DWONLINE”</span><span class='T1'>.com.br&gt; em dias úteis, de segunda a sexta-feira, das 9 às 17 horas, tendo como base o horário oficial de Brasília.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Quaisquer dúvidas referentes a este instrumento deverão ser dirimidas e enviadas através do e-mail para </span><a href='mailto:juridico@DWONLINE.com.br' class='Internet_20_link'><span class='T1'>juridico@</span></a><a href='mailto:juridico@DWONLINE.com.br' class='Internet_20_link'><span class='T2'>DWONLINE</span></a><a href='mailto:juridico@DWONLINE.com.br' class='Internet_20_link'><span class='T1'>.com.br</span></a><span class='T1'>.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>A tolerência ao descumprimento de qualquer das cláusulas deste contrato não constituirá NOVAÇÃO, devendo ser considerado como ato de mera liberalidade da parte que poderá exigir a qualquer tempo o cumprimento integral das cláusulas em questão.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Este contrato obriga as partes e seus sucessores, a qualquer título, sendo as partes responsáveis por seus atos ou omissões de seus respectivos funcionários, administradores ou gestores, terceiros ou prestadores de serviços, contratados ou prepostos, sob qualquer denominação.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Nenhuma das partes poderá, a não ser sob prévia autorização da outra parte, por escrito, transferir, no todo ou em parte, os diretos e obrigações contraídos com o presente contrato.</span></p><p class='Normal_20__28_Web_29_'><span class='Strong'><span class='T1'>12 - DO FORO.</span></span></p><p class='Normal_20__28_Web_29_'><span class='T1'>12.1 - Fica eleito o foro da cidade e comarca de SÃO PAULO, Estado de São Paulo, para dirimir qualquer dúvida oriunda deste contrato, com renúncia de qualquer outro, por mais privilegiado que seja.</span></p><p class='Normal_20__28_Web_29_'><span class='T1'>Assim, por estarem justas e </span><span class='T2'>CONTRATADAS</span><span class='T1'>, as partes aceitam cumprir o presente instrumento e concordam através de manifestação por meio eletrônico.</span></p><p class='Standard'> </p></body></html>

                                        </div>
                                    </div>
                                </div>	
                            </div>
                            <br>
                            <div class='eula-content create-details'>
                                <p>&nbsp;&nbsp;&nbsp;<input type='submit' class='submit active' value='Li e Aceito os termos de uso'></p><br>
                                &nbsp;&nbsp;&nbsp;ou escolha <a href='/login/'>CANCELAR</a> caso você não concorde com os termos legais.
                            </div>
                        </form>
                        <div class='Clear'></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


<script language='javascript' type='text/javascript'>
    $(document).ready(function () {
        $('#trigger').click(function () {
            $('#dialog').dialog();
        });
    });
</script>";
                exit();
            } else {

                // Redireciona
                header('location: ' . $login_uri);
            }
        }

        return;
    }

    /**
     * Envia para uma página qualquer
     *
     * @final
     */
    final protected function goto_page($page_uri = null) {
        if (isset($_GET['url']) && !empty($_GET['url']) && !$page_uri) {
            // Configura a URL
            $page_uri = urldecode($_GET['url']);
        }

        if ($page_uri) {
            // Redireciona
            echo '<meta http-equiv="Refresh" content="0; url=' . $page_uri . '">';
            echo '<script type="text/javascript">window.location.href = "' . $page_uri . '";</script>';
            //header('location: ' . $page_uri);
            return;
        }
    }

    /**
     * Verifica permissões
     *
     * @param string $required A permissão requerida
     * @param array $user_permissions As permissões do usuário
     * @final
     */
    final protected function check_permissions(
    $required = 'any', $user_permissions = array('any')
    ) {
        if (!is_array($user_permissions)) {
            return;
        }

        // Se o usuário não tiver permissão
        if (!in_array($required, $user_permissions)) {
            // Retorna falso
            return false;
        } else {
            return true;
        }
    }

}
