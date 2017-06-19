 
<?php
if (!defined('ABSPATH'))
    exit;
$idVendedor = $_SESSION['userdata']['idtb_usuario'];
$loginEmpresa = $_SESSION['userdata']['tb_empresa_codigo_web_service'];
$cnpjEmpresa = $_SESSION['userdata']['tb_empresa_cnpj'];
$cnpjRedirect = $_GET['cpfcnpj'];
?>

<div class="content-wrapper2"  >

    <section class="content-header">

        <h1>Dashboard
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo HOME_URI ?>/home" style="color: black;"><i class="fa fa-dashboard" style="color: black;"></i> Home</a></li>
            <li class="active">Busca  CPF/CNPJ</li>
        </ol>
    </section>


    <div class="register-box" >
        <div class="register-box">
            <div class="">
                <div class="wrap" >
                    <div class="sidebar-form">
                        <div class="input-group">
                            <input type="text" class="form-control" name='cpfcnpj' onkeypress='mascaraMutuario(this, cpfCnpj)' onblur='clearTimeout()' id="cpf_cnpj" name="cpf_cnpj" placeholder="Digite CPF / CNPJ "/>
                            <input type="hidden" name="loginEmpresa" id="loginEmpresa" value="<?php echo $loginEmpresa; ?>"/>
                            <input type="hidden" name="cnpjEmpresa" id="cnpjEmpresa" value="<?php echo $cnpjEmpresa; ?>"/>
                            <input type="hidden" name="cpf_cnpj_redirect" id="cpf_cnpj_redirect" value="<?php echo $cnpjRedirect; ?>"/>
                            <input type="hidden" name="idtbVendedor" id="idtbVendedor" value="<?php echo $idVendedor; ?>"/>
                            <span class="input-group-btn">
                                <button type='submit' name='buscar' id='buscar' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div id="erroValCnpjCpf" ></div>  
                    <div id="modal" ></div>  
                    <div id="mostraBusca" class="box box-warning" >
                        <div class="box-header with-border">


<!--
                            <div class="box-header ">
                                <a href="#"><span class="info-box-icon bg-aqua" id="botaoEnviaEmail"><i class="fa fa-envelope-o"></i></span></a>

                                <div class="info-box bg-aqua" id="enviaEmail">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Nome&nbsp;<input type="text" name="enviarPorEmailNome" id="enviarPorEmailNome" style="width: 50%;color: black" /></span>
                                        <span class="info-box-text">Email&nbsp;<input type="text" name="enviarPorEmailEmail" id="enviarPorEmailEmail" style="width: 50%;color: black" /></span>
                                        <div class="col-xs-4">
                                        </div>
                                    </div>

                                    <li style="text-align: center; font-size: medium;"><div style="width: 100%;" class="btn btn-primary btn-xsGrande" id="enviarDadosPorEmail"><i class="fa fa-fw fa-location-arrow" style="width: 15px;"></i>&nbsp;Enviar &nbsp;</div></li>
                                </div>
                                <a href="#"><span class="info-box-icon" style="background-color: brown" id="botaoEnviaSms"><i class="fa fa-comments-o" style="color: whitesmoke"></i></span></a>
                                <div class="info-box bg-red" id="enviaSms">
                                    <div class="info-box-content">
                                        <div class="info-box-content">
                                            <span class="info-box-text">Ceular SMS&nbsp;<input type="text" name="enviarPorEmailNome" id="enviarPorEmailNome" style="width: 50%;" /></span>
                                        </div>
                                    </div>
                                   
                                </div>

                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>

                            </div>-->


                            <section class="content" >


                                <div style="padding: 5px;float:left;width: 49%;height: 50%;border: 1px solid buttonface;  background-color: gainsboro;" >
                                    <div id="infoEmpresa" style="padding: 2px;">
                                        <div id="tb_pessoa_juridica_cnpj" style="font-size: 25px; "></div>
                                        <div  id="tb_pessoa_juridica_nome" style="font-style: italic;font-size: 15px;"></div>
                                        <br>
                                    </div>
                                </div>

                                <div  style="float: right;color: black; width: 50%;height: 91px;border: 1px solid buttonface;background-color: gainsboro;">
                                    <div class="box-header">
                                        <h3 class="box-title" style="color: black;">Consultas em andamento para este CPF/CNPJ:</h3>
                                        <br>
                                        <div  class="btn btn-primary btn-xs" id="cLocalizacaoPage">
                                            <i class="fa fa-fw fa-location-arrow"  style="width: 15px;">
                                            </i>&nbsp;
                                        </div>

                                        <div  class="btn btn-primary btn-xs" id="cEmailPage">
                                            <i class="fa fa-fw   fa-envelope"  style="width: 15px;">
                                            </i>&nbsp;
                                        </div>

                                        <div  class="btn btn-primary btn-xs" id="cObitoPage">
                                            <i class="fa fa-fw  fa-plus-circle"  style="width: 15px;">
                                            </i>&nbsp;
                                        </div>

                                        <div   class="btn btn-primary btn-xs" id="telefonesPage">
                                            <i class="fa fa-fw fa-phone-square" style="width: 15px;">
                                            </i>&nbsp;</div>

                                        <div  class="btn btn-primary btn-xs" id="situacaoCadastroPage">
                                            <i class="fa fa-fw  fa-file-text-o" style="width: 15px;">
                                            </i>&nbsp;</div>

                                        <div  class="btn btn-primary btn-xs" id="perfilsocialPage">
                                            <i class="fa fa-fw fa-group" style="width: 15px;">
                                            </i>&nbsp;</div>


                                        <div  class="btn btn-primary btn-xs" id="perfilconsumoPage">
                                            <i class="fa fa-fw  fa-shopping-cart"  style="width: 15px;">
                                            </i>&nbsp;</div>


                                        <div  class="btn btn-primary btn-xs" id="pessoasempresasrelacionadasPage">
                                            <i class="fa fa-fw  fa-chain " style="width: 15px;">
                                            </i>&nbsp;</div>

                                        <div   class="btn btn-primary btn-xs" id="participacaoemprePage">
                                            <i class="fa fa-fw  fa-paperclip" style="width: 15px;">
                                            </i>&nbsp;</div>

                                        <div   class="btn btn-primary btn-xs" id="quemconsultouPage">
                                            <i class="fa fa-fw fa-question" style="width: 15px;">
                                            </i>&nbsp;</div>
                                    </div>
                                    </ul>
                                </div>

                                <div id="dadosCadastrais"style="padding: 5px;float:left;width: 100%; zoom: 1;  " >


                                    <div id="dadosCadastraisCnpj" style="background-color: antiquewhite;  padding: 9px;">
                                        <BR>
                                        <div class="" style="padding: 2px;float: left;width: 49%;">
                                            <label style="padding-right: 49px"> CNPJ : </label><input class="camposPequenos" id="cnpj1"/>
                                        </div>

                                        <div class="" style="padding: 2px;float: right;width: 49%">
                                            <label style="padding-right: 5px"> Data Abertura :</label> <input   class="camposPequenos" id="dataAbertura"/>
                                        </div>

                                        <div class="" style="padding: 2px;">
                                            <label style="padding-right: 0px">  Razão Social :</label> <input class="camposPequenos" id="razaoSocial"/>
                                        </div>

                                        <div class="" style="padding: 2px;">
                                            <label style="padding-right: 28px"> Fantasia : </label><input class="camposPequenos" id="fantasia"/>
                                        </div>

                                        <div class="" style="padding: 2px;">
                                            <label style="padding-right: 45px"> CNAE :</label> <input class="camposPequenos" id="cnae1"/>
                                        </div>

                                        <div class="" style="padding: 2px;">
                                            <label style="padding-right:0px"> Nat. Jurídica :</label> <input class="camposPequenos" id="naturezaJuridica"/>
                                        </div>
                                        <div class="" style="padding: 2px;">
                                            <label style="padding-right: 0px"> Matriz / Filial : </label>&nbsp;<input  class="camposPequenos"  id="matriz"/>

                                        </div>

                                    </div>

                                    <div id="dadosCadastraisCpf" style="background-color: antiquewhite;">
                                        <BR>
                                        <div class="" style="padding: 2px;float: left;width: 100%;">

                                            <label style="padding-right: 60px"> CPF : </label><input style="width: 20%;"  onfocus="" class="camposPequenos" id="cpf1"/>
                                            <input type="checkbox"  id="masculino"/><label> &nbsp;&nbsp; Masculino  </label>
                                            <input type="checkbox" id="feminino"/><label> &nbsp;&nbsp;Feminino  </label>
                                            <input type="checkbox"  id="indefinido"/><label> &nbsp;&nbsp;Indefinido  </label>
                                        </div>

                                        <div class="" style="padding: 4px;">
                                            <div style="float: left;"><label >Nome</label></div>
                                            <div style="text-align: center;">
                                                <input  style="width: 82%" class="camposPequenos" id="nome"/>
                                            </div>
                                        </div>



                                        <div class="" style="padding: 2px;">
                                            <label >Nascimento :</label> <input  style="width: 10%" class="camposPequenos" id="dataNascimento"/>

                                            <label >  Idade :</label> <input style="width: 5%" class="camposPequenos" id="idade"/>
                                            <label >  Signo :</label> <input style="width: 10%" class="camposPequenos" id="signo"/>
                                        </div>
                                        <br>
                                        <div class="" style="padding: 2px;">
                                            <div style="float: left;"><label >Nome da Mãe:</label></div>
                                            <div style="text-align: center;"><input class="camposPequenos" id="nomeMae" style="width: 80%"/>
                                                <div id="buscaMae" title="Buscar informações Mâe"></div>
                                                <br><br>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div  id = 'localizacao'style = 'padding: 5px;float:left;width: 100%;  background-color: azure; ' >
                                        <i class="fa fa-fw fa-location-arrow"
                                           <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd;"> Endereços </h4>
                                        </i>
                                        <br><br>
                                        <div id="localizacao1">
                                            <div id="local">
                                            </div>
                                            <br>
                                        </div><!-- /.box -->
                                        <!-- /.ENVIO RETRO LOCALIZAÇÃO -->
                                        <div style='float: right'>
                                            <div id='enderecoValido' style='float: left;' ><a class='btn btn-primary btn-xs'> Válido</a></div>
                                            <div id='enderecoInvalido'style='float: left;'><a class='btn btn-danger btn-xs'> Inválido</a></div>
                                            <div id='enderecoOutros' style='float: right'><a class='btn btn-bitbucket btn-xs'> Outros</a></div>
                                        </div>
                                        <br>
                                        <div id='outros'>
                                            <div style='float: left;'><input type='text' id='info' style ='width: 500px;height: 22px;'/>&nbsp;<div id='enviarOutros' style='float: right;'><a class='btn btn-primary btn-xs'> Enviar</a></div>
                                            </div>
                                        </div>

                                        <br>
                                        <!-- /.cadastro de novos endereços -->
                                        <div style="float: right;">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novosEnderecos" data-whatever="@mdo">Add + </button>
                                        </div>

                                        <div class="modal fade" id="novosEnderecos" tabindex="-1" role="dialog" aria-labelledby="novosEnderecosLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" >
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="novosEnderecosLabel">Enviar novo endereço</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">CEP:</label>
                                                                <input class="form-control" id="cepRetro"></input>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Logradouro:</label>
                                                                <input class="form-control" id="endRetro"></input>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Numero:</label>
                                                                <input class="form-control" id="numRetro"></input>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Complemento :</label>
                                                                <input class="form-control" id="complRetro"></input>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Bairro :</label>
                                                                <input class="form-control" id="bairroRetro"></input>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Cidade:</label>
                                                                <input class="form-control" id="cidadeRetro"></input>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">UF:</label>
                                                                <input class="form-control" id="ufRetro"></input>
                                                            </div>
                                                        </form>
                                                        <div id="respostaRetro"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                        <button type="button" class="btn btn-primary" id="enviarEnderecoNovo">Enviar</button> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<div id="scrollTelefone"></div>
                                    <div class='' id='telefone'style='padding: 5px;float:left;width: 100%;' >
                                        <i class="fa fa-fw fa-phone-square"
                                           <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd;"> Telefones </h4>
                                        </i>
                                        <br><br>
                                        <div id="telefone1">
                                            <div id="tel"></div>
                                            <br>
                                        </div>

                                        <!-- /.ENVIO RETRO TELEFONE -->
                                        <div style='float: right'>
                                            <div id='telefoneValido' style='float: left;' ><a class='btn btn-primary btn-xs'> Válido</a></div>
                                            <div id='telefoneInvalido'style='float: left;'><a class='btn btn-danger btn-xs'> Inválido</a></div>
                                            <div id='telefoneOutros' style='float: right'><a class='btn btn-bitbucket btn-xs'> Outros</a></div>
                                        </div>
                                        <br>

                                        <div id="botoesTelefone">
                                            <div style='float: left;'><input type='text' id='infoTelefones' style ='width: 500px;height: 22px;'/>&nbsp;<div id='enviarOutrosTelefones' style='float: right;'><a class='btn btn-primary btn-xs'> Enviar</a></div>
                                                <input type="hidden" id="hiddemTelefoneTipo">
                                            </div>
                                            <div id="cancelarEnvioTelefone">
                                                <a class='btn btn-danger btn-xs'> Cancelar</a>
                                            </div>
                                        </div>
                                        <br>
                                        <!-- /.cadastro de novos endereços -->
                                        <div style="float: right;">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novosTelefones" data-whatever="@mdo">Add + </button>
                                        </div>

                                        <div class="modal fade" id="novosTelefones" tabindex="-1" role="dialog" aria-labelledby="novosTelefonesLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" >
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="novosTelefonesLabel">Enviar novo Telefone</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">DDD:</label>
                                                                <input class="form-control" id="dddRetro"></input>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Telefone:</label>
                                                                <input class="form-control" id="foneRetro"></input>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Operadora:</label>
                                                                <input class="form-control" id="operadoraRetro"></input>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                        <button type="button" class="btn btn-primary" id="enviarTelefoneNovo">Enviar</button> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='' id='outrostelefone'style='padding: 5px;float:left;width: 100%;' >
                                        <i class="fa fa-fw fa-phone-square"
                                           <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd;"> Telefones Relacionados</h4>
                                        </i>
                                        <br><br>
                                        <div id="outrostelefone1">
                                            <div id="outrostel"></div>
                                        </div>
                                    </div>

                                    <div id="scrollEmail"></div>
                                    <div class='' id='email'style='padding: 5px;float:left;width: 100%;' >
                                        <i class='fa fa-fw   fa-envelope'
                                           <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd;"> &nbsp;Email</h4>
                                        </i>
                                        <br><br>
                                        <div id="email1">
                                            <div id="mail"></div>
                                            <br>
                                        </div>

                                        <!-- /.cadastro de novos emails -->
                                        <div style="float: right;">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novosEmails" data-whatever="@mdo">Add + </button>
                                        </div>

                                        <div class="modal fade" id="novosEmails" tabindex="-1" role="dialog" aria-labelledby="novosTelefonesLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" >
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="novosTelefonesLabel">Enviar novo Telefone</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="message-text" class="control-label">Email:</label>
                                                                <input class="form-control" id="emailRetro"></input>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                        <button type="button" class="btn btn-primary" id="enviarEmailNovo">Enviar</button> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="scrollObt"></div>
                                    <div class='' id='obito'style='padding: 5px;float:left;width: 100%;' >
                                        <i class='fa fa-fw  fa-plus-circle'
                                           <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd;"> &nbsp;DATA CNF</h4>
                                        </i>
                                        <br><br>
                                        <div id="obito1">
                                            <div style="float: right;width: 30%">
                                            </div>
                                            <div id="obt"></div>
                                            <div id='cnfPlus'  style='font-size: 15px;'><a href="#">+ Detalhes</a></div>
                                            <br>
                                        </div>
                                    </div>
                                    <div id="scrollSituacao"></div>
                                    <div class="" id="situacao"style="padding: 5px;float:left;width: 100%; zoom:1;" >
                                        <i class="fa fa-fw  fa-file-text-o"
                                           <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd;"> &nbsp;Situação Cadastral</h4>
                                        </i>
                                        <div id="infoTelefoneEmpresa" style="padding: 2px;">
                                            <div class="" style="float: left;width: 49%">
                                                Situação : <A id="tb_pessoa_juridica_situacao"></A>
                                            </div>
                                            <div class="" style="float: left;width: 49%">
                                                Data : <A id="tb_pessoa_juridica_data_situacao"></A>
                                            </div>
                                        </div>
                                        <div style="text-align: right">
                                            <a class="btn btn-primary btn-xs" > Válido</a>
                                            <a class="btn btn-danger btn-xs"> Inválido</a>
                                            <a class="btn btn-bitbucket btn-xs" >Outros</a>
                                        </div>
                                    </div>
                                    <div id="scrollPSocioDemo"></div>
                                    <div class="" id="perfilsocialdiv"style="padding: 5px;float:left;width: 100%;" >
                                        <i class="fa fa-fw fa-group"
                                           <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd;"> &nbsp;Perfil Sociodemográfico</h4>
                                        </i>
                                        <br>
                                        <br>
                                        <!--
                                        <div class="" style="float: left;width: 49%">
                                            Capital Social : <A id="capsocial"></A>
                                        </div>
                                        -->
                                        <div id="perfilSocial"></div>
                                        <div id="perfilSocialMostrar">
                                            <div class="" style="float: left;width: 49%">
                                                Porte : <A id="porte"></A>
                                            </div>

                                            <div class="" style="float: left;width: 49%">
                                                Faturamento anual presumido : <A id="fpresumido"></A>
                                            </div>
                                            <div class="" style="float: left;width: 49%">
                                                Quantidade de Proprietários: <A id="qtdpropietarios"></A>
                                            </div>
                                            <div class="" style="float: left;width: 49%">
                                                Quantidade Funcionários : <A id="qtdfuncionarios"></A>
                                            </div>
                                            <!--
                                              <div class="" style="float: left;width: 49%">
                                              Inscrição Estadual : <A id="inscestadual"></A>
                                              </div>
                                            -->
                                        </div>
                                    </div>
<div id="scrollPConsumo"></div>
                                    <div class="" id="perfilconsumodiv"style="padding: 5px;float:left;width: 100%; zoom:1;" >
                                        <i class="fa fa-fw  fa-shopping-cart"
                                           <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd;"> &nbsp;Perfil Consumo</h4>
                                        </i>
                                        <br>
                                        <br>
                                        <div  id="perfilConsumo"></div>
                                    </div>

                                    <div class="" id="pessoasempresasrelacionadasdiv"style="padding: 5px;float:left;width: 100%; zoom:1;" >
                                        <i class="fa fa-fw  fa-chain "
                                           <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd;"> &nbsp;CPF/CNPJ Relacionadas</h4> 
                                        </i>
                                        <br>
                                        <br>
                                        <div class="" style="float: left;width: 49%">
                                            Tipo : <A id="capsocial"></A>
                                            Nome : <A id="capsocial"></A>
                                        </div>
                                        <div style="text-align: right">
                                            <a class="btn btn-primary btn-xs" > Válido</a>
                                            <a class="btn btn-danger btn-xs"> Inválido</a>
                                            <a class="btn btn-bitbucket btn-xs" >Outros</a>
                                        </div>
                                    </div>

<div id="scrollPEnpresarial"></div>
                                    <div  id = 'participacaoemprediv'style = 'padding: 5px;float:left;width: 100%; ' >
                                        <i class = 'fa fa-fw  fa-paperclip'
                                           <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd;"> &nbsp; Participação Empresarial </h4>
                                        </i>
                                        <br>
                                        <br>
                                        <br>
                                        <div id="partempreMostrar">
                                            <div id="participacaoemprediv1">
                                                <div id="participacaoempre"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--
                                                                <div class="" id="quemconsultoudiv"style="padding: 5px;float:left;width: 100%; zoom:1;" >
                                                                    <i class="fa fa-list-alt"
                                                                       <h4 style="padding: 10px;width: 100%;border-bottom: 1px solid #0079bd;"> &nbsp;Quem consultou</h4> 
                                                                    </i>
                                    
                                                                    <br>
                                                                    <br>
                                   
                                    <div class="" style="float: left;width: 49%">
                                        Razão  : <A id="capsocial"></A>
                                        Data da Consulta : <A id="capsocial"></A>
                                    </div>
                                    -->
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.box -->
        </section><!-- /.content -->
        <br>
        <br>
    </div>
</div>




<!-- jQuery 2.1.3 -->
<script src="<?php echo HOME_URI ?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>

<!--buscas -->
<script src="<?php echo HOME_URI ?>/dist/js/buscas.js" type="text/javascript"></script>

<script src="<?php echo HOME_URI ?>/dist/js/mascaras.js" type="text/javascript"></script>

<script src="<?php echo HOME_URI ?>/dist/js/retroValidoInvalioOutros.js" type="text/javascript"></script>

<script src="<?php echo HOME_URI ?>/dist/js/load.js" type="text/javascript"></script>

<script>
                                $("#detalheCnf").hide();

</script>


