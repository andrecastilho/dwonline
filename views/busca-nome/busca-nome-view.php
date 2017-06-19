<?php
if (!defined('ABSPATH'))
    exit;

$idVendedor = $_SESSION['userdata']['idtb_usuario'];
$loginEmpresa = $_SESSION['userdata']['tb_empresa_codigo_web_service'];
$cnpjEmpresa = $_SESSION['userdata']['tb_empresa_cnpj'];
$nome = $_GET['nome'];
//print_r($loginEmpresa);
?>
<div class="content-wrapper2"  >
    <section class="content-header">
        <h1>Dashboard
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo HOME_URI ?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Busca por Nome</li>
        </ol>
    </section>

    <div class="register-box" >
        <div class="register-box">

            <div class="">
                <div class="wrap" >

                    <div id="resultPad"></div>

                    <div class="sidebar-form">
                        <div class="input-group">
                            <input type="text" class="form-control"  name='nomeBusca' id="nomeBusca" placeholder="Digite o nome para busca "/>

                            <input type="hidden" name="loginEmpresa" id="loginEmpresa" value="<?php echo $loginEmpresa; ?>"/>
                            <input type="hidden" name="cnpjEmpresa" id="cnpjEmpresa" value="<?php echo $cnpjEmpresa; ?>"/>
                            <input type="hidden" name="idtbVendedor" id="idtbVendedor" value="<?php echo $idVendedor; ?>"/>
                            <input type="hidden" name="buscaNome" id="buscaNome" value="<?php echo $nome; ?>"/>

                            <span class="input-group-btn">
                                <button type='submit' name='buscarNome' id='buscarNome' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>

                        </div>
                        <select id="pessoa">
                            <option value="fisica">Pessoa Física</option>
                            <option value="juridica">Pessoa Jurídica</option>
                        </select>
                        <select id="nomeFantasia">
                            <option value="nome">Nome </option>
                            <option value="fantasia">Fantasia</option>
                        </select>
                    </div>


                    <div id="mostraBusca" >
                        <section class="content" >
                            <br>
                            <div  id = 'resultado'style = 'padding: 20px;float:left;width: 100%;background-color: white;' >
                                <i  class = 'fa fa-fw fa-phone-square' 
                                    <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd; "> &nbsp; Nomes </h4>
                                    <div id="imagemLoad"><img width="100" src="<?php echo HOME_URI ?>/dist/img/loading.gif"></div>
                                </i>

                                <br>
                                <br>
                                <div style='float: left;width: 100%'>
                                    <div style="float: left; width: 8%;text-align: center;">CPF / CNPJ</div>
                                    <div style="float: left;width: 39%;text-align: center;">Nome</div>
                                    <div style="float: left; width: 40%;text-align: center;">Cidade</div>
                                    <div style="float: left;width: 2%;text-align: center;">Uf</div>
                                </div>
                                <br>
                                <br>

                                <div id="result">
                                    <div id="res">
                                        <br><br>
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

<script src="<?php echo HOME_URI ?>/dist/js/buscaNome.js" type="text/javascript"></script>




</div> <!-- .wrap -->
</div>

