<?php
//die(".");
if (!defined('ABSPATH'))
    exit();
// Carrega todos os métodos do modelo
$modelo->validate_register_form();
$modelo->get_register_form(chk_array($parametros, 1));
$perfilSession = $_SESSION['userdata']['tb_usuario_id_perfil'];

if ($perfilSession == '1') { //SISTEMA DM
    $vendedor = "<div class='form-group has-feedback'>" .
            "<label for='tb_usuario_e_vendedor'>É vendedor ?</label>" .
            "<input type='checkbox'  name='tb_usuario_e_vendedor'class='minimal' checked/>" .
            "</div>";

    $option = '         <option value="1">Sistema - DM</option>
                        <option value="2">Master - DM</option>
                        <option value="3">Administrador - Empresa</option>
                        <option value="4">Operacional - Empresa</option>';
} elseif ($perfilSession == '2') {//MASTER DM
    $option = '         <option value="2">Master - DM</option>
                        <option value="3">Administrador - Empresa</option>
                        <option value="4">Operacional - Empresa</option>';
} elseif ($perfilSession == '3') {//MASTER DM
    $option = '         <option value="3">Administrador - Empresa</option>
                        <option value="4">Operacional - Empresa</option>';
} elseif ($perfilSession > '2') {

    $option = '<option value="4">Operacional - Empresa</option>';
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
    <BR>
    <div class="row">
        <div class="col-lg-3 col-xs-6">

            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo $_SESSION['userdata']['tb_empresa_qtd_max_registros'] ?></h3>
                    <br>
                    <p>Qtd.Max Registros</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $_SESSION['userdata']['tb_empresa_qtd_usuarios'] ?><sup style="font-size: 20px"></sup></h3>
                    <br>
                    <p>Qtd. de Usuários</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo $modelo->qtd_user_utilizado_cnpj ?></h3>
                    <br>
                    <p>Qtd. Utilizada</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo ($_SESSION['userdata']['tb_empresa_qtd_usuarios'] - $modelo->qtd_user_utilizado_cnpj) ?></h3>
                    <br>
                    <p>Qtd. Restante</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div><!-- /.row -->



    <div class="register-box-body">
        <p class="login-box-msg">Registrar novo usuário</p>

        <?php if (($_SESSION['userdata']['tb_empresa_qtd_usuarios'] - $modelo->qtd_user_utilizado_cnpj) > 0 || $perfilSession == 1) {
            ?>
            <form method="post" action="" id="meuForm">

                <input type="hidden" id="perfilAtualHidden" value="<?php echo$_SESSION['userdata']['tb_usuario_id_perfil'] ?>"/>

                <div id="cnpjMostrar">
                    <div class="form-group has-feedback">
                        <label for="tb_usuario_cnpj_empresa">CNPJ</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['userdata']['tb_empresa_cnpj'] ?>" id="tb_usuario_cnpj_empresa" name="tb_usuario_cnpj_empresa" placeholder="CNPJ sem pontuação"/>
                        <span class="glyphicon glyphicon-search  form-control-feedback"></span>
                        <div id="infoCnpj"></div>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="tb_usuario_cnpj_empresa">CPF</label>
                    <input type="text" class="form-control"   id="tb_usuario_cpf" name="tb_usuario_cpf" placeholder="CPF ou deixar em branco"/>
                    <span class="glyphicon glyphicon-search  form-control-feedback"></span>
                </div>

                <div id="mostraBuscaPessoa">
                    <div class="form-group has-feedback">
                        <label for="tb_usuario_nome">Nome</label>
                        <input type="text" class="form-control"   name="tb_usuario_nome" placeholder="Nome "/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>

                        <label for="tb_usuario_id_perfil">Perfil</label>
                        <!-- select -->

                        <select class="form-control" name="tb_usuario_id_perfil">
                            <option value="0">Escolha um perfil</option>
                            <?php echo $option; ?>
                        </select>
                    </div>


                    <div class="form-group has-feedback">
                        <label for="tb_usuario_username_email">Email</label>
                        <input type="text" class="form-control"  id="tb_usuario_username_email" name="tb_usuario_username_email" placeholder="Email "/>
                        <div id="infoEmail"></div>
                        <span class="glyphicon glyphicon-cloud  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_usuario_validade">Válido até </label>
                        <input type="date" class=""   name="tb_usuario_validade" placeholder="Válido até  "/>
                        <span class="glyphicon glyphicon-calendar  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="" name="tb_usuario_senha" placeholder="Senha"/>

                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class=""  name="confirma_password" placeholder="Repita a senha"/>

                        <br>
                        <div class="form-group has-feedback">
                            <label for="tb_usuario_ativo">Ativo</label>
                            <input type="checkbox"  name="tb_usuario_ativo"class="minimal" checked/>
                        </div>
                    </div>

                    <?php echo $vendedor; ?>

                </div><!-- MOSTRA DIV -->
                <div class="col-xs-2">
                    <button  id="btnInsertUser" type="submit" class="btn btn-primary btn-block btn-flat">Cadastrar</button>
                </div><!-- /.col -->
                <br>

            </form>

            <div class="col-xs-2">
                <button   id="buscarUser_tb_pessoa_juridica"class="btn btn-primary btn-block btn-flat" style="background: green; border-color: green">Importar</button>
            </div>


            <?php
        } else {

            $this->form_msg = '<p class="form_error">Quantidade de Usuários esgotada.</p>';
            echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>
                      <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                      <span class='sr-only'>Error:</span>
              $this->form_msg
              </div></div></div>";
            return;
        }
        ?>



    </div><!-- /.form-box -->
    <div id="modal" ></div>  
</div><!-- /.register-box -->


<!-- jQuery 2.1.3 -->
<script src="<?php echo HOME_URI ?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!--functions -->
<script src="<?php echo HOME_URI ?>/dist/js/functions.js" type="text/javascript"></script>

<!-- cdn for modernizr, if you haven't included it already -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
<!-- polyfiller file to detect and load polyfills -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
<script>
    webshims.setOptions('waitReady', false);
    webshims.setOptions('forms-ext', {types: 'date'});
    webshims.polyfill('forms forms-ext');
</script>






