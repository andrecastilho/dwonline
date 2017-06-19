<?php
if (!defined('ABSPATH'))
    exit;

$idVendedor = $_SESSION['userdata']['idtb_usuario'];
$loginEmpresa = $_SESSION['userdata']['tb_empresa_codigo_web_service'];
$cnpjEmpresa = $_SESSION['userdata']['tb_empresa_cnpj'];
$ruaRedirect = $_GET['rua'];
$numeroRedirect = $_GET['numero'];
$bairroRedirect = $_GET['bairro'];
$cidadeRedirect = $_GET['cidade'];
$ufRedirect = $_GET['uf'];
$cepRedirect = $_GET['cep'];
$pessoa = $_GET['pessoa'];
//print_r($_GET);
?>
<div class="content-wrapper2"  >
    <section class="content-header">
        <h1>Dashboard
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo HOME_URI ?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Busca por Endereço</li>
        </ol>
    </section>

    <div class="register-box" >
        <div class="register-box">

            <div class="">
                <div class="wrap" >

                    <div id="resultPad"></div>

                    <div class="sidebar-form">
                        <div class="input-group">
                            <input type="text" style="width: 30%;"class="form-control"  name='enderecoBusca' id="enderecoBusca" placeholder="Digite o endereço "/>
                            <input type="text" style="width: 8%;" class="form-control"  name='enderecoNumeroBusca'  id="enderecoNumeroBusca" placeholder="Nr. "/>
                            <input type="text" style="width: 17%;" class="form-control"  name='enderecoBairroBusca'id="enderecoBairroBusca" placeholder=" Bairro "/>
                            <input type="text" style="width: 25%;" class="form-control"  name='enderecoCidadeBusca'id="enderecoCidadeBusca" placeholder=" Cidade "/>
                            <input type="text" style="width: 5%;" class="form-control"   name='enderecoUfBusca'    id="enderecoUfBusca" placeholder=" UF "/>
                            <input type="text" style="width: 15%;" class="form-control"  name='enderecoCepBusca'id="enderecoCepBusca" placeholder=" CEP "/>

                            <input type="hidden"  name='enderecoBuscaR' value="<?php echo $ruaRedirect; ?>"id="enderecoBuscaR" />
                            <input type="hidden"  name='enderecoNumeroBuscaR' value="<?php echo $numeroRedirect; ?>" id="enderecoNumeroBuscaR" />
                            <input type="hidden"  name='enderecoBairroBuscaR'value="<?php echo $bairroRedirect; ?>" id="enderecoBairroBuscaR"/>
                            <input type="hidden"  name='enderecoCidadeBuscaR'value="<?php echo $cidadeRedirect; ?>" id="enderecoCidadeBuscaR" />
                            <input type="hidden"  name='enderecoUfBuscaR'    value="<?php echo $ufRedirect; ?>" id="enderecoUfBuscaR" />
                            <input type="hidden"  name='enderecoCepBuscaR' value="<?php echo $cepRedirect; ?>"id="enderecoCepBuscaR"/>

                            <input type="hidden" name="loginEmpresa" id="loginEmpresa" value="<?php echo $loginEmpresa; ?>"/>
                            <input type="hidden" name="cnpjEmpresa" id="cnpjEmpresa" value="<?php echo $cnpjEmpresa; ?>"/>
                            <span class="input-group-btn">
                                <button type='submit' name='buscarEndereco' id='buscarEndereco' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>

                        <div id="select_b">
                            <select id="pessoa">
                                <option value="fisica">Pessoa Física</option>
                                <option value="juridica">Pessoa Jurídica</option>
                            </select>
                        </div>
                    </div>

                    <div id="msg"></div>
                    <div id="modal"></div>
                    <div id="mostraBusca" >
                        <section class="content" >
                            <br>
                            <div  id = 'resultado'style = 'padding: 5px;float:left;width: 100%;background-color: white;' >
                                <i  class = 'fa fa-fw fa-phone-square' 
                                    <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd; "> &nbsp; Endereços </h4>
                                    <div id="imagemLoad"><img width="100"src="<?php echo HOME_URI ?>/dist/img/loading.gif"></div>
                                </i>
                                <br><br>
                                <div style='float: left;width: 100%'>
                                    <div style="float: left; width: 29%;text-align: center;">Nome</div>
                                    <div style="float: left;width: 39%;text-align: center;">Endereço</div>
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

<!-- relacionamentos -->
<script src="<?php echo HOME_URI ?>/dist/js/buscaEndereco.js" type="text/javascript"></script>


</div> <!-- .wrap -->
</div>

