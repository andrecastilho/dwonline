<?php
if (!defined('ABSPATH'))
    exit();


include 'apoio_relatorios/class/apoio.php';
include 'apoio_relatorios/class/dbClass.php';


$db = new TutsupDB();

$controleCustos = new controleCustos();
$vendedor = $db->anti_injection($_POST['tb_empresa_id_vendedor']);
$empresa = $db->anti_injection($_POST['empresas']);

$saldo = $controleCustos->retornaSaldoAtual($db->anti_injection($empresa));

$usuario = $db->anti_injection($_SESSION['userdata']['idtb_usuario']);
$valor = $db->anti_injection(str_replace(',', '.', $_POST['tb_creditos_qtd']));

if ($valor) {
    $controleCustos->insereCreditoAtualizaSaldoAtual($valor, $vendedor, $empresa, $saldo, $usuario);
}

//print_r($_SESSION['userdata']['tb_empresa_cnpj']);
$this->check_userlogin();
?>
<section class="content-header">
    <h1>
        Dashboard
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo HOME_URI ?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Registro de Usuário</li>
    </ol>
</section>

<div class="register-logo">
    <a href="../index2.html"><b>Data</b>Web</a>
</div>

<div class="register-box" style="height: 900px;">
    <div style="color: white;font: x-large; alignment-adjust: auto;size: 15px">
        CNPJ : <?php echo $_SESSION['userdata']['tb_empresa_cnpj'] ?>
    </div>
    <input type="hidden" value="" id="cnpj_adm">
    <BR>


    <div class="register-box-body" >
        <p class="login-box-msg" >Registrar novos créditos</p>
        <!-- /.register-box -->

        <form method="post" action="" id="meuForm">
            <br>
            <div class="form-group has-feedback">
                <label for="tb_empresa_id_vendedor">Empresas</label><br>
                <select name="empresas" id="empresas" autofocus="autofocus" autocorrect="off" autocomplete="on" class="btn-group">
                    <option value="0">Selecione</option>
                    <?php
                    $db = new DB();
                    $db->conexao();
                    $apoio = new APOIO();
                    $empresas = $apoio->getAllEmpresas();
                    ?>
                </select>

                <br>
                <br>
                <div class="form-group has-feedback">
                    <label for="tb_empresa_id_vendedor">Vendedores</label><br>
                    <select id="tb_empresa_id_vendedor" name="tb_empresa_id_vendedor">
                        <option value=" ">Selecione</option>
                    </select>
                </div>
                <br>
                <input type="text" class="form-control" style="width: 20%"   id="tb_pessoa_fisica_cpf" name="tb_creditos_qtd" placeholder="Quantidade de Créditos "/>

            </div>

            <div class="col-xs-2">
                <button   type="submit" class="btn btn-primary btn-block btn-flat" style="background: green; border-color: green">ENVIAR</button>
            </div>
            <br>
        </form>
    </div>
</div>
<!-- jQuery 2.1.3 -->
<script src="<?php echo HOME_URI ?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!--functions -->
<script src="<?php echo HOME_URI ?>/dist/js/functions.js" type="text/javascript"></script>

<!-- cdn for modernizr, if you haven't included it already -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
<!-- polyfiller file to detect and load polyfills -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
<!--functions -->
<script src="<?php echo HOME_URI ?>/dist/js/functions.js" type="text/javascript"></script>
<script>
    webshims.setOptions('waitReady', false);
    webshims.setOptions('forms-ext', {types: 'date'});
    webshims.polyfill('forms forms-ext');
</script>






