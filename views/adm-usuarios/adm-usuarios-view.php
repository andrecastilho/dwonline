
<?php
if (!defined('ABSPATH'))
    exit;

// Carrega todos os métodos do modelo
$modelo->validate_register_form();
$modelo->get_register_form(chk_array($parametros, 1));


//melhorar segurança
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
?>

<!-- cdn for modernizr, if you haven't included it already -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
<!-- polyfiller file to detect and load polyfills -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
<script>
    webshims.setOptions('waitReady', false);
    webshims.setOptions('forms-ext', {types: 'date'});
    webshims.polyfill('forms forms-ext');
</script>

<script>
    function chama(email, empresa) {

        document.getElementById('tb_usuario_username_email_adm').value = email;
    }
</script>


<section class="content-header">
    <h1>
        Dashboard
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo HOME_URI ?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Adm. de Usuários</li>
    </ol>
</section>

<div class="register-logo">
    <a href="../index2.html"><b>Data</b>Web</a>
</div>

<div class="register-box">
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
        <p class="login-box-msg">Administrar usuários</p>

        <form method="post" action="">

            <input type="hidden" id="perfilAtualHidden" value="<?php echo$_SESSION['userdata']['tb_usuario_id_perfil'] ?>"/>

            <div id="cnpjMostrar">
                <div class="form-group has-feedback">
                    <label for="tb_usuario_cnpj_empresa">CNPJ</label>
                    <input type="text" class="form-control" id="cnpj_adm"  name="tb_usuario_cnpj_empresa" value="<?php echo $_SESSION['userdata']['tb_empresa_cnpj'] ?>"placeholder="CNPJ - Apenas numeros "/>
                    <span class="glyphicon glyphicon-search  form-control-feedback"></span>
                    <div id="infoCnpj"></div>
                    <div id="msg"></div>
                </div>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_usuario_username_email">Email</label>
                <input type="text" class="form-control"  id="tb_usuario_username_email_adm" name="tb_usuario_username_email" placeholder="Email "/>
                <span class="glyphicon glyphicon-search  form-control-feedback"></span>
                <div id="infoEmail"></div>
            </div>


            <div id="mostraBuscaPessoa">

                <div class="form-group has-feedback">
                    <label for="tb_usuario_cpf">CPF</label>
                    <input type="text" class="form-control"   id="tb_usuario_cpf_tb_usuario" name="tb_usuario_cpf_tb_usuario" placeholder="CPF "/>
                    <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                </div>


                <div class="form-group has-feedback">
                    <label for="tb_usuario_nome">Nome</label>
                    <input type="text" class="form-control"   name="tb_usuario_nome" placeholder="Nome "/>
                    <span class="glyphicon glyphicon-user  form-control-feedback"></span>


                </div>

                <div class="form-group has-feedback">

                    <label for="tb_usuario_id_perfil">Perfil</label>
                    <!-- select -->
                    <select class="form-control" name="tb_usuario_id_perfil">
                        <option value="0">Escolha um perfil</option>
                        <?php echo $option; ?>
                    </select>
                </div>



                <div class="form-group has-feedback">
                    <label for="tb_usuario_validade">Validade</label>
                    <input type="date" class="form-control"   name="tb_usuario_validade" placeholder="Válido até  "/>
                    <span class="glyphicon glyphicon-calendar  form-control-feedback"></span>
                </div>


                <div class="form-group has-feedback">
                    <input type="password" class="" name="tb_usuario_senha" placeholder="Senha"/>

                </div>
                <div class="form-group has-feedback">
                    <input type="password" class=""  name="confirma_password" placeholder="Repita a senha"/>

                </div>

                <div class="form-group has-feedback">
                    <label for="tb_usuario_ativo">Ativo</label>
                    <input type="checkbox"  name="tb_usuario_ativo"class="minimal" />

                </div>

                <?php echo $vendedor; ?>

            </div>


            <br>
            <div class="col-xs-2" style="float: left;">
                <button  id="btnInsertUser" type="submit" class="btn btn-primary btn-block btn-flat">Atualizar</button>
            </div><!-- /.col -->

        </form>

        <div class="col-xs-2" style="float: left;">
            <button   id="tb_usuario_cpf_tb_usuario_busca_adm" style="background: green; border-color: green" class="btn btn-primary btn-block btn-flat">Buscar</button>
        </div>

        <!-- Large modal -->
        <div class="col-xs-2" style="float: left;" id="btnExcluirUsuario1">
            <button type="button"  class="btn btn-primary btn-block btn-flat" style="background: red; border-color: red" data-toggle="modal" data-target=".bs-example-modal-lg">Excluir</button>
        </div>

        <div class="modal fade bs-example-modal-lg" style="padding-top: 400px;" tabindex="" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" >
                    <button  id="btnExcluirUsuario"  class="btn btn-primary btn-block btn-flat" style="background: red; border-color: red">Sim</button>
                </div>
            </div>
            <div class="modal-dialog modal-lg">
                <div class="modal-content" >
                    <button  id="btnExcluirUsuarioCancelar"  class="btn btn-primary btn-block btn-flat" style="background: green; border-color: green">Não</button>
                </div>
            </div>
        </div>


        <br>
        <br>
        <br>
        <div class="form-group has-feedback">
            <div id="retornoAllusers"></div>
            <table>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr> <tr>
                    <td>&nbsp;</td>
                </tr> <tr>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr> <tr>
                    <td>&nbsp;</td>
                </tr> <tr>
                    <td>&nbsp;</td>
                </tr> <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr> <tr>
                    <td>&nbsp;</td>
                </tr> <tr>
                    <td>&nbsp;</td>
                </tr>                
            </table>
        </div>
    </div>
    <div id="modal" ></div>  

</div>



<!-- jQuery 2.1.3 -->
<script src="<?php echo HOME_URI ?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!--functions -->
<script src="<?php echo HOME_URI ?>/dist/js/functions.js" type="text/javascript"></script>
<!-- UPLOAD DIFY -->
<script src="<?php echo HOME_URI ?>/plugins/upload-dify/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo HOME_URI ?>/plugins/upload-dify/uploadify.css">




<script>
    function str_pad(input, pad_length, pad_string, pad_type) {

        // *     example 1: str_pad('', 30, '-=', 'STR_PAD_LEFT');
        // *     returns 1: '-=-=-=-=-=-foo bar milk'
        // *     example 2: str_pad('foo bar milk', 30, '-', 'STR_PAD_BOTH');
        // *     returns 2: '------foo bar milk-----'

        var half = '',
                pad_to_go;

        var str_pad_repeater = function (s, len) {
            var collect = '',
                    i;

            while (collect.length < len) {
                collect += s;
            }
            collect = collect.substr(0, len);

            return collect;
        };

        input += '';
        pad_string = pad_string !== undefined ? pad_string : ' ';

        if (pad_type != 'STR_PAD_LEFT' && pad_type != 'STR_PAD_RIGHT' && pad_type != 'STR_PAD_BOTH') {
            pad_type = 'STR_PAD_RIGHT';
        }
        if ((pad_to_go = pad_length - input.length) > 0) {
            if (pad_type == 'STR_PAD_LEFT') {
                input = str_pad_repeater(pad_string, pad_to_go) + input;
            } else if (pad_type == 'STR_PAD_RIGHT') {
                input = input + str_pad_repeater(pad_string, pad_to_go);
            } else if (pad_type == 'STR_PAD_BOTH') {
                half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
                input = half + input + half;
                input = input.substr(0, pad_length);
            }
        }

        return input;
    }
</script>
