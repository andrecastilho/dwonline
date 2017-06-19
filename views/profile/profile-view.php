<?php
if (!defined('ABSPATH'))
    exit;

include './models/profile/profile-model.php';

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

// Carrega todos os métodos do modelo

$modelo = new ProfileModel();
$idVendedor = $_SESSION['userdata']['idtb_usuario'];
$modelo->atualizaSenhaUser($idVendedor);

// Carrega todos os métodos do modelo
?>
<style type="text/css" media="screen">
    body
    {
        font-family:Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #666666;
    }
    a
    {
        text-decoration: none;
    }
    #slideShow1
    {
        width: 300px;
        height: 300px;
        border: 1px solid #ccc;
        padding: 10px;
        background-color: #fff;
        margin: 10px;
    }
    #slideShow2
    {
        width: 300px;
        height: 300px;
        border: 1px solid #ccc;
        padding: 10px;
        background-color: #fff;
        margin: 10px;
    }
    .pagelinks a
    {
        font-weight: bold;
        color: #666;
    }
    .slideCaption
    {
        background-color: #FFFFCC;
        padding: 4px;
        text-align: center;
        font-weight: bold;
    }
    .pagelinks a.activeSlide
    {
        color: #f90;
    }
    /* this is for IE so the prev/next links can be hovered*/
    .nextSlide,.prevSlide
    {
        background-image: url(images/spacer.gif);
    }
    .nextSlide:hover
    {
        background-image: url(images/nextslide.jpg);
        background-repeat: no-repeat;
        background-position: right bottom;
    }
    .prevSlide:hover
    {
        background-image: url(images/prevslide.jpg);
        background-repeat: no-repeat;
        background-position: left bottom;
    }
    .inputsTooltip
    {
        border: 1px solid #ccc;
        background-color: #eee;
        padding: 4px;
        color: #333;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        filter:alpha(opacity=70);
        -moz-opacity:.70;
        opacity:.70;
    }
    #tooltipURL
    {
        display: none;
    }
</style>
<section class="content-header">
    <h1>
        Dashboard
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo HOME_URI ?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Registro de Empresas</li>
    </ol>
</section>

<div class="register-box">
    <div class="register-box">
        <div class="register-logo">
            <a href="<?php echo HOME_URI ?>/home"><b>Data</b>Web</a>
        </div>

        <div class="register-box-body">
            <h2 class="login-box-msg">Profile</h2>
            <div class="wrap" style="overflow: hidden;">
                <h2> Atualizar Senha</h2>
                <form method="post" action="">
                    <input type="hidden" id="perfilAtualHidden" value="<?php echo $_SESSION['userdata']['tb_usuario_id_perfil'] ?>"/>
                    <div style="float: left;height: 30%;" >
                        <div class="form-group has-feedback">
                            <input type="password" class="" name="tb_usuario_senha" placeholder="Senha"/>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class=""  name="confirma_password" placeholder="Repita a senha"/>
                        </div>
                    </div>
                    <div class="col-xs-2" style="float: right;height: 30%; ">
                        <button  id="btnProfile" type="submit" class="btn btn-primary btn-block btn-flat">Atualizar</button>
                    </div><!-- /.col -->
                </form>
            </div>
        </div>

      

        <div id="modal" ></div>  
    </div>

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo HOME_URI ?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>

    <!--functions -->
    <script src="<?php echo HOME_URI ?>/dist/js/functions.js" type="text/javascript"></script>


</div> <!-- .wrap -->
</div>


