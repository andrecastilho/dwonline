<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
 * 
 */
if (!defined('ABSPATH'))
    exit;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DataWeb | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo HOME_URI ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons 2.0.0 -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
        <!-- Theme style -->
        <link href="<?php echo HOME_URI ?>/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo HOME_URI ?>/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?php echo HOME_URI ?>/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo HOME_URI ?>/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo HOME_URI ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="<?php echo HOME_URI ?>/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo HOME_URI ?>/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo HOME_URI ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue"  >
        <div class="wrapper" style="height: 850px">
            <div class="login-page">
                <div class="register-box-body">
                    <p class="login-box-msg">Entrar no Sistema</p>

                    <form method="post" action="../login/">

                        <div class="form-group has-feedback">
                            <input type="text" class="form-control"  name="tb_usuario_username_email" placeholder="Email "/>
                            <span class="glyphicon glyphicon-envelope  form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" name="tb_usuario_password" placeholder="Senha"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>

                        <div class="col-xs-4" style="text-align: right">

                            <button  id="btnInsertUserLogar" type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                        </div><!-- /.col -->
                        <div class="col" style="text-align: right">
                            <a href="../recuperaSenha.php" >Recuperar Senha</a>
                        </div>

                    </form>
                    <div id="modal" ></div>  
                </div>
            </div>
        </div>
    </body>
</html>
        <script language='JavaScript'>
 //Bloqueador de Tecla CTRL - iceBreaker http://www.icebreaker.com.br/ 
            function checartecla (evt)
                    {if (evt.keyCode == & #39; 17 & #39; )
                            {alert( "& quot; Comando Desativado & quot;" )
                                    return false}
                    return true}
        </script>
        <script src='//code.jquery.com/jquery-1.11.3.min.js'></script>
        <script src='//code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
        <script src='https://code.jquery.com/ui/1.9.1/jquery-ui.js'></script>