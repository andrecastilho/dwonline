<?php
if (!defined('ABSPATH'))
    exit;

$id_perfil = $_SESSION['userdata']['tb_usuario_id_perfil'];

switch ($id_perfil) {
    case 1:
        $perfil = 'Sistema - DM';

        break;

    case 2:
        $perfil = 'Master - DM';
        break;

    case 3:
        $perfil = 'Administrador Empresa ';
        break;

    case 4:
        $perfil = 'Operacional Empresa';
        break;

    default:
        $this->logout();
        break;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DataWeb | Datamailing</title>
        <link rel='shortcut icon' href='<?php echo HOME_URI ?>/favicon.ico'/>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo HOME_URI ?>/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />    
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


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo HOME_URI ?>/plugins/select-multiple-bootstrap/dist/css/bootstrap-select.css">



        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <div class="wrapper" >

            <header class="main-header">
                <!-- Logo -->
                <a href="" class="logo" style="background-color: #367fa9;">
                    <img style="width: 108%;height: 51px;"src="<?php echo HOME_URI ?>/dist/img/LOGO DWONLINE.png"/>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- Messages: style can be found in dropdown.less-->

                            <li class="dropdown notifications-menu ">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning"><div id="contaNotificacao"></div></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Você tem noticicações</li>
                                    <li class="header" >
                                        <!-- inner menu: contains the actual data -->
                                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                                                <li>
                                                    <div id="notifiContada"></div>

                                                </li>

                                            </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.122px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
                                    </li>

                                </ul>
                            </li>

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">



                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo HOME_URI ?>/dist/img/carinha.png" class="user-image" alt="Usuário"/>
                                    <span class="hidden-xs"><?php echo $_SESSION['userdata']['tb_usuario_nome'] ?></span>

                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo HOME_URI ?>/dist/img/carinha.png" class="img-circle" alt="Usuário" />
                                        <p>
                                            <?php echo $_SESSION['userdata']['tb_usuario_nome']; ?><br> 
                                            <?php echo $perfil; ?>
                                            <small><?php echo $_SESSION['userdata']['tb_usuario_data_cadastro']; ?> </small>
                                            <span class="hidden-xs"><?php echo $_SESSION['userdata']['tb_empresa_nome'] ?></span>

                                            <small><?php echo "Último Ip Registrado -" . $_SESSION['userdata']['tb_usuario_ip']; ?></small></p><br>
                                    </li>
                                    <p style="text-align: center;"> <small><?php echo "Ip Atual -" . $_SERVER['REMOTE_ADDR']; ?></small></p>
                                    <!-- Menu Body -->
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo HOME_URI ?>/profile/" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-left">
                                            <a href="<?php echo HOME_URI ?>/area-restrita" class="btn btn-default btn-flat">  Área Restrita</a>
                                        </div>
                                    </li>
                                    <div class="pull-right">
                                        <a href="<?php echo HOME_URI ?>/login/?sair=true" class="btn btn-default btn-flat">Sair</a>
                                    </div>
                            </li>
                        </ul>
                        </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->

                    <!-- search form -->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">

                        <li class="header">Administrativo</li>
                        <li class="treeview"> 
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>Cadastros</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <?PHP if ($id_perfil == '1' || $id_perfil == '2') { ?>
                                    <li class="active"><a href="<?php echo HOME_URI ?>/empresa-register/"><i class="fa fa-circle-o"></i> + Empresa</a></li>
                                <?php } ?>
                                <?PHP if ($id_perfil == '1' || $id_perfil == '2' || $id_perfil == '3') { ?>
                                    <li><a href="<?php echo HOME_URI ?>/user-register/"><i class="fa fa-circle-o"></i> + Add Usuário</a></li> 
                                <?php } ?>

                                <?PHP if ($id_perfil == '1' || $id_perfil == '2') { ?> 
                                    <a href="#">
                                        <i class="fa fa-files-o"></i>
                                        <span>Edição / Administração</span><i class="fa fa-angle-left pull-right"></i>
                                    </a>

                                    <li><a href="<?php echo HOME_URI ?>/adm-empresas/"><i class="fa fa-circle-o"></i>  Adm. Empresas</a></li>
                                <?PHP } if ($id_perfil == '1' || $id_perfil == '2' || $id_perfil == '3') { ?>
                                    <li><a href="<?php echo HOME_URI ?>/adm-usuarios/"><i class="fa fa-circle-o"></i>  Adm. Usuários</a></li>


                                <?php } ?>
                            </ul>
                        <li>
                            <?php
                            if ($_SESSION['userdata']['tb_empresa_online'] == 'on') {
                                
                            ?>
                                
                            <a href="#" style="background-color: yellowgreen;">
                                <i class="fa fa-th active active" ></i> <span style="color: black;">Buscas</span> <small class="label pull-right bg-green">Novos</small>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo HOME_URI ?>/busca-doc/"><i class="fa fa-circle-o"></i>  CPF / CNPJ</a></li> 
                                <li><a href="<?php echo HOME_URI ?>/busca-tel/"><i class="fa fa-circle-o"></i>  Telefone</a></li> 
                                <li><a href="<?php echo HOME_URI ?>/busca-nome/"><i class="fa fa-circle-o"></i>  Nome</a></li>  
                                <li><a href="<?php echo HOME_URI ?>/busca-endereco/"><i class="fa fa-circle-o"></i>  Endereço</a></li>  
                            </ul>
                        </li>

                        <li  id="busca2">
                            <a href="#" style="background-color: goldenrod;">
                                <i class="fa fa-th active active" ></i> <span style="color: black;">Filtros</span>
                            </a>

                            <ul class="treeview-menu">
                                <br>
                                <li style="text-align: center; font-size: medium;"><div style="width: 100%;"  class="btn btn-primary btn-xsGrande" id="cLocalizacao"><i class="fa fa-fw fa-location-arrow"  style="width: 15px;"></i>&nbsp;Localização &nbsp;</div></li> 
                                <br>
                                <li style="text-align: center;"><div style="width: 100%;"  class="btn btn-primary btn-xsGrande" id="telefones"><i class="fa fa-fw fa-phone-square" style="width: 15px;"></i>&nbsp;Tels Relacionados</div></li> 

                                <li style="text-align: center;" id="liemail"> <br><div style="width: 100%;"  class="btn btn-primary btn-xsGrande" ><i class="fa fa-fw   fa-envelope" style="width: 15px;"></i>&nbsp;Email &nbsp;</div></li>  


                                <li style="text-align: center;" id="liObito"> <br><div style="width: 100%;"  class="btn btn-primary btn-xsGrande" ><i class="fa fa-fw  fa-plus-circle" style="width: 15px;"></i>&nbsp;CNF (Falecidos) &nbsp;</div></li>  

                                <li style="text-align: center;" id="liSitCadast" > <br><div style="width: 100%;"  class="btn btn-primary btn-xsGrande" id="situacaoCadastro"><i class="fa fa-fw  fa-file-text-o" style="width: 15px;"></i>&nbsp;Situação Cadastral &nbsp;</div></li>  
                                <br>
                                <li style="text-align: center;"><div style="width: 100%;"  class="btn btn-primary btn-xsGrande" id="perfilsocial"><i class="fa fa-fw fa-group" style="width: 15px;"></i>&nbsp;Sociodemográfico</div></li>  
                                <br>
                                <li style="text-align: center;"><div style="width: 100%;"  class="btn btn-primary btn-xsGrande" id="perfilconsumo"><i class="fa fa-fw  fa-shopping-cart"  style="width: 15px;"></i>&nbsp;Perfil Consumo &nbsp;</div></li>  
                                <!--
                                <br>
                                <li style="text-align: center;"><div style="width: 100%;" class="btn btn-primary btn-xsGrande" id="pessoasempresasrelacionadas"><i class="fa fa-fw  fa-chain " style="width: 15px;"></i>&nbsp;CPF/CNPJ Relacionadas</div></li>  
                                
                                -->
                                <br>
                                <li style="text-align: center;"><div  style="width: 100%;" class="btn btn-primary btn-xsGrande" id="participacaoempre"><i class="fa fa-fw  fa-paperclip" style="width: 15px;"></i>&nbsp;Part. Societária &nbsp;</div></li>  
                                <!--
                                 <br>
                                 <li style="text-align: center;"><div  style="width: 100%;" class="btn btn-primary btn-xsGrande" id="quemconsultou"><i class="fa fa-fw fa-question" style="width: 15px;"></i>&nbsp;Quem Consultou</div></li>  
                                -->
                            </ul>
                        </li>

                        <?php
                            }
                        if ($_SESSION['userdata']['tb_empresa_enriquecimento'] == 'on') {
                           //print_r($_SESSION['userdata']);
                            ?>
                            <li>
                                <a href="#" style="background-color: brown;">
                                    <i class="fa fa-th active active" ></i> <span style="color: black;">Enriquecimento</span> 
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo HOME_URI ?>/importa-arquivo/"><i class="fa fa-circle-o"></i>  Enriquecimento</a></li> 

                                </ul>
                            </li>

                            <li>
                                <a href="#" style="background-color: whitesmoke;">
                                    <i class="fa fa-th active active" ></i> <span style="color: black;">Extração</span> 
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo HOME_URI ?>/extracao/"><i class="fa fa-circle-o"></i>  Extração</a></li> 

                                </ul>
                            </li>
                              
                            <?php
                        }
                           if ($id_perfil == '1' || $id_perfil == '2') { 
                        ?>
                             <li>
                                <a href="#" style="background-color: coral;">
                                    <i class="fa fa-th active active" ></i> <span style="color: black;">Créditos</span> 
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo HOME_URI ?>/creditos/"><i class="fa fa-circle-o"></i>  Créditos</a></li> 

                                </ul>
                            </li>
                           <?php } ?> 
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside> 
            <!--buscas -->
