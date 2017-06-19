<?php
if (!defined('ABSPATH'))
    exit;
// Carrega todos os métodos do modelo
$modelo->validate_register_form();
$modelo->get_register_form(chk_array($parametros, 1));
?>

<script>
    function chama(email) {
        document.getElementById('cnpj_adm').value = email;
    }
</script>

<section class="content-header">
    <h1>
        Dashboard
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Adm-Empresas</li>
    </ol>
</section>

<div class="register-box">


    <div class="register-logo">
        <a href="<?php echo HOME_URI ?>/home"><b>Data</b>Web</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Administrar empresas</p>
        <div class="wrap">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="cnpj_adm" name="tb_empresa_cnpj" placeholder="CNPJ "/>
                <span class="glyphicon glyphicon-search  form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="buscarRazao" name="buscarRazao" placeholder="Digitar Razão Social "/>
                <span class="glyphicon glyphicon-search  form-control-feedback"></span>
            </div>

            <form method="post" action="">

                <div id="mostraBuscaEmpresa" >


                    <div class="form-group has-feedback">
                        <label for="tb_empresa_cnpj_envio">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj_envio" name="tb_empresa_cnpj_envio" placeholder="CNPJ "/>
                        <span class="glyphicon glyphicon-tree-conifer  form-control-feedback"></span>
                        <div id="infoCnpj"></div>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_matriz">Matriz</label>

                        <!-- select -->
                        <select class="form-control" name="tb_empresa_matriz">
                            <option value="1">Matriz</option>
                            <option value="2">Filial</option>
                        </select>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_nome">Nome</label>
                        <input type="text" class="form-control"  name="tb_empresa_nome" placeholder="Nome "/>
                        <span class="glyphicon glyphicon-tree-conifer  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_fantasia">Fantasia</label>
                        <input type="text" class="form-control"  name="tb_empresa_fantasia" placeholder="Fantasia "/>
                        <span class="glyphicon glyphicon-tree-conifer  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_numero_empregados">Número de empregados</label>
                        <input type="text" class="form-control"  name="tb_empresa_numero_empregados" placeholder="Número de empregados "/>
                        <span class="glyphicon glyphicon-tree-conifer  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_endereco">Endereço</label>
                        <input type="text" class="form-control"  name="tb_empresa_endereco" placeholder="Endereço "/>
                        <span class="glyphicon glyphicon-tree-conifer  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_numero">Número</label>
                        <input type="text" class="form-control"  name="tb_empresa_numero" placeholder="Número "/>
                        <span class="glyphicon glyphicon-tree-conifer  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_complemento">Complemento</label>
                        <input type="text" class="form-control"  name="tb_empresa_complemento" placeholder="Complemento "/>
                        <span class="glyphicon glyphicon-tree-conifer  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_cep">CEP</label>
                        <input type="text" class="form-control"  name="tb_empresa_cep" placeholder="CEP "/>
                        <span class="glyphicon glyphicon-tree-conifer  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_bairro">Bairro</label>
                        <input type="text" class="form-control"  name="tb_empresa_bairro" placeholder="Bairro "/>
                        <span class="glyphicon glyphicon-tree-conifer  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_cidade">Cidade</label>
                        <input type="text" class="form-control"  name="tb_empresa_cidade" placeholder="Cidade "/>
                        <span class="glyphicon glyphicon-tree-conifer  form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="tb_empresa_uf">UF</label>
                        <input type="text" class="form-control"  name="tb_empresa_uf" placeholder="UF "/>
                        <span class="glyphicon glyphicon-tree-conifer  form-control-feedback"></span>
                    </div>


                    <div class="form-group has-feedback">
                        <label for="tb_empresa_id_vendedor">Vendedores</label><br>
                        <select id="tb_empresa_id_vendedor" name="tb_empresa_id_vendedor">
                        </select>
                    </div>


                    <div class="form-group has-feedback">
                        <label for="tb_empresa_valor_pacote">Valor Pacote</label>
                        <input type="text" class="form-control"  name="tb_empresa_valor_pacote" placeholder="Valor Pacote"/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_qtd_contratada">Valor contratados</label>
                        <input type="text" class="form-control"  name="tb_empresa_qtd_contratada" placeholder="Quantidade de Registros"/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                    </div>
                    
                      <div class="form-group has-feedback">
                        <label for="tb_empresa_valor_pacote">Valor consulta WebService</label>
                        <input type="text" class="form-control"  name="tb_credito_custo_empresa_produtos_web_service" placeholder="Valor WebService"/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                    </div>


                    <div class="form-group has-feedback">
                        <label for="tb_empresa_valor_pacote">Valor consulta Online</label>
                        <input type="text" class="form-control"  name="tb_credito_custo_empresa_produtos_online" placeholder="Valor WebService"/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_valor_pacote">Valor consulta Enriquecimento</label>
                        <input type="text" class="form-control"  name="tb_credito_custo_empresa_produtos_enriquecimento" placeholder="Valor WebService"/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                    </div>
                    
                       <div class="form-group has-feedback">
                        <label for="tb_empresa_valor_pacote">Valor consulta Cnf Simples</label>
                        <input type="text" class="form-control"  name="tb_credito_custo_empresa_produtos_cnf_simples" placeholder="Valor WebService"/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                    </div>
                    
                       <div class="form-group has-feedback">
                        <label for="tb_empresa_valor_pacote">Valor consulta Cnf Detalhado</label>
                        <input type="text" class="form-control"  name="tb_credito_custo_empresa_produtos_cnf_detalhado" placeholder="Valor WebService"/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                    </div>
                    
                         <div class="form-group has-feedback">
                        <label for="tb_empresa_valor_pacote">Valor consulta Extração</label>
                        <input type="text" class="form-control"  name="tb_credito_custo_empresa_produtos_extracao" placeholder="Valor WebService"/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                    </div>
                    
<!--
                    <div class="form-group has-feedback">
                        <label for="tb_empresa_qtd_max_registros">Quantidade de registros utilizados</label>
                        <input type="text" class="form-control"  name="tb_empresa_qtd_max_registros" placeholder="Quantidade de Registros Utilizados"/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_valor_unitario">Valor Unitário</label>
                        <input type="text" class="form-control"  name="tb_empresa_valor_unitario_mostra" placeholder="Valor Unitário"/>
                        <input type="hidden" class="form-control"  name="tb_empresa_valor_unitario" placeholder="Valor Unitário"/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                    </div>

-->
                    <div class="form-group has-feedback">
                        <label for="tb_empresa_qtd_usuarios">Quantidade de Usuários</label>
                        <input type="text" class="form-control"  name="tb_empresa_qtd_usuarios" placeholder="Quantidade de Usuários"/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback" >
                        <label for="excedente">Permite excedente ?</label>
                        <input id="excedente" type="checkbox"  name="excedente"class="minimal" checked/>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_unitario_execedente">Valor Unitário Excedente</label>
                        <input type="text" class="form-control"   id="tb_empresa_unitario_execedente" name="tb_empresa_unitario_execedente" placeholder="Valor Unitário do excedente"/>
                        <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                    </div>                        
                    <div class="form-group has-feedback" >
                        <label for="webservice">WebService</label>
                        <input id="divwebservice" type="checkbox"  name="webservice"class="minimal" checked/>
                    </div>

                    <div id="hash">
                        <div class="form-group has-feedback">
                            <label for="codigo_web_service">Código de acesso Webservice</label>
                            <input type="text" class="form-control" readonly="" name="codigo_web_service" value="<?php echo (mt_rand()); ?>"/>
                            <span class="glyphicon .glyphicon-flag  form-control-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="online">Online</label>
                        <input id="divonline"type="checkbox"  name="online"class="minimal" checked/>

                    </div>

                    <div class="form-group has-feedback">
                        <label for="enriquecimento">Enriquecimento / Extração</label>
                        <input id="divenriquecimento" type="checkbox"  name="enriquecimento"class="minimal" checked/>
                    </div>
                </div>
                <br>
                <div class="col-xs-2" style="float: left;">
                    <button  id="btnAtualizaEmpresa" type="submit" class="btn btn-primary btn-block btn-flat">Atualizar</button>
                </div><!-- /.col -->


            </form>

            <div class="col-xs-2" style="float: left;">
                <button   id="buscarEmrepsa_tb_empresa"class="btn btn-primary btn-block btn-flat" style="background: green; border-color: green">Buscar</button>

            </div>



            <!-- Large modal -->
            <div class="col-xs-2" style="float: left;" id="btnExcluirEmpresa1">
                <button type="button"  class="btn btn-primary btn-block btn-flat" style="background: red; border-color: red" data-toggle="modal" data-target=".bs-example-modal-lg">Excluir</button>
            </div>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <button  id="btnExcluirtEmpresa"  class="btn btn-primary btn-block btn-flat" style="background: red; border-color: red">Sim Excluir esta empresa ? Ou Esc para sair.</button>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>

            <div id="retornoAllEmpresas"></div>

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


    </div><!-- /.form-box -->
    <div id="modal" ></div>
    <div id="retornoExclusao" ></div>
</div><!-- /.register-box -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo HOME_URI ?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!--functions -->
<script src="<?php echo HOME_URI ?>/dist/js/functions.js" type="text/javascript"></script>

<!-- MASK -->
<scrip src="<?php echo HOME_URI ?>/dist/js/jquery.maske.js" type="text/javascript"></scrip>

</div> <!-- .wrap -->
</div>

