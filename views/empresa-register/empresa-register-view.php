<?php
if (!defined('ABSPATH'))
    exit;
// Carrega todos os métodos do modelo
$modelo->validate_register_form();
$modelo->get_register_form(chk_array($parametros, 1));
$idVendedor = $_SESSION['userdata']['idtb_usuario'];
?>
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

<div class="register-box" >

    <div class="register-logo">
        <a href="<?php echo HOME_URI ?>/home"><b>Data</b>Web</a>
    </div>

    <div class="register-box-body" style="height: 1915px;">
        <p class="login-box-msg">Registrar nova empresa</p>
        <div class="wrap" style="height: 900px;">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="cnpj" name="tb_empresa_cnpj" placeholder="CNPJ "/>
                <span class="glyphicon glyphicon-search  form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <div class="col-xs-2">
                    <button   id="buscarEmrepsa"class="btn btn-primary btn-block btn-flat" style="background: green; border-color: green">Importar </button>
                </div>
            </div>

            <form method="post" action="">

                <input type="hidden" id="id_vendedor_hidden" value="<?php echo $idVendedor; ?>" />

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
                        <label for="tb_empresa_numero_empregados">Numero de empregados</label>
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
                        <label for="tb_empresa_complemento">Complento</label>
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
                            <option value=" ">Escolha uma opição</option>
                        </select>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="tb_empresa_valor_pacote">Valor Pacote</label>
                        <input type="text" class="form-control"  name="tb_empresa_valor_pacote" placeholder="Valor Pacote"/>
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
                                                <label for="tb_empresa_qtd_contratada">Quantidade de regitros contratados</label>
                                                <input type="text" class="form-control"  name="tb_empresa_qtd_contratada" placeholder="Quantidade de Registros"/>
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


                    <div class="form-group has-feedback">
                        <label for="tb_empresa_permite_excedente">Permitir excedente</label>
                        <input type="checkbox"  name="tb_empresa_permite_excedente"class="minimal" />
                    </div>

                    <div id="unitario_excedente">
                        <div class="form-group has-feedback">
                            <label for="tb_empresa_unitario_execedente">Valor Unitário Excedente</label>
                            <input type="text" class="form-control"   id="tb_empresa_unitario_execedente" name="tb_empresa_unitario_execedente" placeholder="Valor Unitário do excedente"/>
                            <span class="glyphicon glyphicon-user  form-control-feedback"></span>
                        </div>
                    </div>


                    <div class="form-group has-feedback">
                        <label for="webservice">Acesso WebService</label>
                        <input type="checkbox"  name="webservice"class="minimal" />
                    </div>

                    <div id="hash">
                        <div class="form-group has-feedback">
                            <label for="codigo_web_service">Código de acesso Webservice</label>
                            <input type="text" class="form-control" readonly="true" name="codigo_web_service" value="<?php echo (mt_rand()); ?>"/>
                            <span class="glyphicon .glyphicon-flag  form-control-feedback"></span>
                        </div>
                    </div>


                    <div class="form-group has-feedback">
                        <label for="online">Acesso Online </label>
                        <input type="checkbox"  name="online"class="minimal" checked/>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="enriquecimento">Acesso Enriquecimento / Extração</label>
                        <input type="checkbox"  name="enriquecimento"class="minimal" />
                    </div>


                </div>
                <div class="col-xs-2">
                    <button  id="btnInsertUser" type="submit" class="btn btn-primary btn-block btn-flat">Cadastrar</button>
                </div><!-- /.col -->
        </div>
        </form>

    </div>
    <div id="modal" ></div>  
</div>

<!-- jQuery 2.1.3 -->
<script src="<?php echo HOME_URI ?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>

<!--functions -->
<script src="<?php echo HOME_URI ?>/dist/js/functions.js" type="text/javascript"></script>


</div> <!-- .wrap -->

