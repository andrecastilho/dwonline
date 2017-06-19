<?php
if (!defined('ABSPATH'))
    exit;

$idVendedor = $_SESSION['userdata']['idtb_usuario'];
$loginEmpresa = $_SESSION['userdata']['tb_empresa_codigo_web_service'];
$cnpjEmpresa = $_SESSION['userdata']['tb_empresa_cnpj'];
$dddRedirect = $_GET['ddd'];
$foneRedirect = $_GET['fone'];
//print_r($loginEmpresa);
?>
<div class="content-wrapper2"  >
    <section class="content-header">
        <h1>Dashboard
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo HOME_URI ?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Busca por Telefone</li>
        </ol>
    </section>


    <div class="register-box" >
        <div class="register-box">

            <div class="">
                <div class="wrap" >

                    <div class="sidebar-form">
                        <div class="input-group">
                            <input type="text" class="form-control" style="float: left;width: 11%" id="dddBusca" placeholder="DDD "/>
                            <input type="text" class="form-control" style="float: right;width: 89%" name='telBusca' id="telBusca" placeholder="Digite o Telefone "/>
                            <input type="hidden" name="loginEmpresa" id="loginEmpresa" value="<?php echo $loginEmpresa; ?>"/>
                            <input type="hidden" name="cnpjEmpresa" id="cnpjEmpresa" value="<?php echo $cnpjEmpresa; ?>"/>
                            <input type="hidden" name="dddBuscaRedirect" id="dddBuscaRedirect" value="<?php echo $dddRedirect; ?>"/>
                            <input type="hidden" name="telBuscaRedirect" id="telBuscaRedirect" value="<?php echo $foneRedirect; ?>"/>
                            <span class="input-group-btn">
                                <button type='submit' name='buscarTelefone' id='buscarTelefone' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                        <select id="pessoa">
                            <option value="fisica">Pessoa Física</option>
                            <option value="juridica">Pessoa Jurídica</option>
                        </select>
                    </div>
                    <div id="msg"></div>
                    <div id="modal"></div>

                    <div id="mostraBusca" >
                        <section class="content" >
                            <br>
                            <div  id = 'resultado'style = 'padding: 5px;float:left;width: 100%;background-color: white;' >
                                <i  class = 'fa fa-fw fa-phone-square' 
                                    <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd; "> &nbsp; Telefones </h4>
                                    <div id="imagemLoad"><img width="100"src="<?php echo HOME_URI ?>/dist/img/loading.gif"></div>
                                </i>


                                <br>
                                <br>
                                <div style='float: left;width: 100%'>
                                    <div style="float: left; width: 8%;text-align: center;">CPF / CNPJ</div>
                                    <div style="float: left;width: 39%;text-align: center;">Nome / Telefone</div>
                                </div>
                                <br>
                                <br>


                                <div id="result">
                                    <div id="res">
                                    </div>
                                    <br>
                                </div><!-- /.box -->
                            </div>
                    </div>
                </div>
            </div><!-- /.box -->
            </section><!-- /.content -->
        </div>
    </div>
</div>

<!-- jQuery 2.1.3 -->
<script src="<?php echo HOME_URI ?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>

<!--buscas -->
<script src="<?php echo HOME_URI ?>/dist/js/buscas.js" type="text/javascript"></script>

<!--relacionamentos -->
<script src="<?php echo HOME_URI ?>/dist/js/buscaTelefone.js" type="text/javascript"></script>




</div> <!-- .wrap -->
</div>

