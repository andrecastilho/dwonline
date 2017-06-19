<?php
if (!defined('ABSPATH'))
    exit;

$modelo->atualizaMsgVisualizadaEnriquecimento();

$enriquecidos = $modelo->buscaEnriquecidos();

//print_r($enriquecidos);

$option = '<option value="0">Escolha arquivo para filtro</option>';
$option2 = null;

$option2 .= '<option value="0">Escolha Tipo de arquivo </option>';
$option2 .= '<option value="cpf">Arquivo com Cpf</option>';
$option2 .= '<option value="cnpj">Arquivo com Cnpj</option>';
if ($_SESSION['userdata']['tb_usuario_cnpj_empresa'] == '96335712000130' || $_SESSION['userdata']['tb_usuario_cnpj_empresa'] == '06976525000143' || $_SESSION['userdata']['tb_usuario_cnpj_empresa'] == '08260688000150') {
    $option2 .= '<option value="1">Layout 1 - Cob Total </option>';
    $option2 .= '<option value="2">Layout 2 - Data Cob </option>';
    $option2 .= '<option value="3">Layout 3 - Vendas </option>';
    $option2 .= '<option value="4">Layout 4 - Vivo </option>';
    $option2 .= '<option value="5">Layout 5 - Escob </option>';
    $option2 .= '<option value="6">Layout 6 - Intersic </option>';
    $option2 .= '<option value="7">Layout 7 - Somente Telefones </option>';
    $option2 .= '<option value="8">Layout 8 - Bia </option>';
}

foreach ($enriquecidos as $key => $value) {
    if ($value['tb_enriquecimento_filtro'] == '') {

        $option .= '<option value=' . $value['idtb_enriquecimento'] . '> Id: ' . $value['idtb_enriquecimento'] . ' - Nome Arquivo: ' . $value['tb_enriquecimento_arquivo_enviado'] . ' - Data: ' . date('d/m/Y', $value['tb_enriquecimento_data_envio']) . '</option>';
    }
}
$importado = null;
$importado = $_GET['importado'];
if ($importado == 1) {

    echo "<div class='alert alert-success' style='text-align: center' role='alert'>
                      <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                      <span class='sr-only'>Error:</span>
                        Arquivo Importado
                      </div>";
}
?>
<script>
    function marcardesmarcar() {
        if ($("#todos").is(':checked')) {

            $(".desC").attr("checked", true);

        } else {
            $(".desC").attr("checked", false);

        }

    }
</script>
<div class="content-wrapper2"  >
    <div class="register-box">
        <br>
        <br>
        <!-- START ACCORDION & CAROUSEL-->
        <div class="row">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Enriquecimento</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <br>
                    <div id="resposta"></div>
                    <form method="post" action="<?php echo HOME_URI ?>/import/importar.php" enctype="multipart/form-data">
                        <label>Arquivo</label>
                        <div>
                            <input class="btn btn-primary btn-block btn-flat" type="file" name="arquivo" />
                            <br>

                            <label>Descrição:</label>
                            <textarea name="descricao" class="form-control" rows="2" id="descricao"></textarea>

                            <input class="btn btn-primary btn-block btn-flat" style="width: 30%; background-color: green;" type="submit" value="Enviar" />
                            <input class="btn btn-primary btn-block btn-flat" style="width: 50%;"type="hidden" id="extracao"name="extracao" value="enriquecimento"/>

                        </div>
                        <br>
                    </form>
                    <br>
                    <br>


                    <div class="box box-solid"> 
                        <div class="box-header with-border">
                            <div style="float: left;width: 30%;">
                                <label>Arquivo Filtro: </label>
                                <select id="optionFiltros" class="selectpicker">
                                    <?PHP echo $option ?>
                                </select>
                            </div>

                            <div style="float: left;width: 30%;">
                                <label>Arquivo entrada: </label>
                                <select id="optionTipoEntrada" class="selectpicker">
                                    <?PHP echo $option2 ?>
                                </select>
                            </div>
                            <div style="float: left;width: 30%;">
                                <label>Arquivo saida: </label>
                                <select id="optionTipo" class="selectpicker">
                                    <?PHP echo $option2 ?>
                                </select>
                            </div>

                            <div id="botaoSalvar"style="float: right;margin-top: 30px;">
                                <br>
                                <input type="checkbox" id="obProcon" value="SemProcon" style="text-align: left;"/>Telefones sem procon<br> 
                                <br>
                                <input class="btn btn-primary btn-block btn-flat" style="background-color: #003bb3;width: 224px;" type="button" id="salvarFiltros3" value="Salvar" />
                            </div>
                        </div>
                        <br>
                        <br>
                        <div style="width: 50%;float: left;">
                            <input type="checkbox" name="todos" id="todos" value="todos" onclick="marcardesmarcar();" /> Marcar/Desmarcar todos<br><br>
                        </div>
                        <div style="width: 50%;float: right;">
                            <input type="checkbox" name="todos2" id="todos2" value="todos2" onclick="marcardesmarcar2();" /> Marcar/Desmarcar todos<br><br>
                        </div>
                    </div>



                    <div id="mostraFiltrosPj">
                        <div class="col-xs-1 col-lg-3" > Desejado</div>
                        <div class="col-xs-1 col-lg-3" >Campo</div>
                        <div class="col-xs-1 col-lg-2" > Obrigatório</div>
                        <br>

                        <table >
                            <!--cnpj -->
                            <tr>
                                <td>
                                    <div class="checkbox" >
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCnpj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">CNPJ</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCnpj" class="obC" > 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--NOME -->
                            <tr>
                                <td>
                                    <div class="checkbox" >
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desNomePj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Nome</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obNomePj"class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--fantasia -->
                            <tr>
                                <td>
                                    <div class="checkbox" >
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desFantasia" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Fantasia</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obFantasia"class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>


                            <!--matriz -->
                            <tr>
                                <td>
                                    <div class="checkbox" >
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desMatriz" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Matriz</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obMatriz"class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--nascimentopj -->
                            <tr>
                                <td>
                                    <div class="checkbox" >
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desNascimentoPj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Data Abertura</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obNascimentoPj"class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--qtd empregados -->
                            <tr>
                                <td>
                                    <div class="checkbox" >
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desQtdEmpregados" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Qtd. Empregados</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obQtdEmpregados"class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>


                            <!--cnae -->
                            <tr>
                                <td>
                                    <div class="checkbox" >
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCnae" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Cnae</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCnae"class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--des cnae -->
                            <tr>
                                <td>
                                    <div class="checkbox" >
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desDesCnae" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Descrição Cnae</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obDesCnae" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--natureza -->
                            <tr>
                                <td>
                                    <div class="checkbox" >
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desNatureza" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Natureza</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obNatureza" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--Descrição natureza -->
                            <tr>
                                <td>
                                    <div class="checkbox" >
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desDesNatureza" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Descriçao Natureza</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obDesNatureza" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>


                            <!---endereço-->            
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desEnderecoPj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Endereço Pj</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obEnderecoPj" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <select id="enderecosQtdPj" class="selectpicker"  title='Selecione Qtd. Endereço'data-done-button="true">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>

                            <!---numero -->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desNumeroPj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Numero Pj</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obNumeroPj" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!---complemento -->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desComplementoPj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Complemento Pj</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obComplementoPj" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!---Bairro-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desBairroPj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Bairro Pj</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obBairroPj" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!---Cidade-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCidadePj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Cidade Pj</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCidadePj" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--estados -->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desEstadoPj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Estado Pj</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obEstadoPj" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <select id="estadosPj" class="selectpicker" multiple title='Selecione Estado'data-done-button="true">
                                        <option value="*">Todos</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </td>
                            </tr>

                            <!---Cep-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCepPj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Cep Pj</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCepPj" class="obC"> 
                                        </label>
                                    </div>
                                </td> 

                                <td>
                                    <div id="optionCidadesPj"> </div>
                                </td>
                                <td>
                                    <input class="btn btn-primary btn-block btn-flat" id="buscarBairro" value="Buscar Bairro">
                                </td>


                            </tr>


                            <!---situacao-->
                            <tr>

                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desSituacao" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Situacao</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obSituacao" class="obC"> 
                                        </label>
                                    </div>
                                </td>

                                <td>
                                    <div id="optionBairroPj"> </div>
                                </td>

                                <td>
                                    <input class="btn btn-primary btn-block btn-flat" id="incluirFiltroEnd" value="Incluir">
                                </td>


                            </tr>

                            <!---data situacao-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desDataSituacao" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Data Situacao</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obDataSituacao" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <br>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div id="tableFiltroEndEstados" class="col-sm-12" ></div><br>
                                            <div id="tableFiltroEndCidades" class="col-sm-12" ></div><br>
                                            <div id="tableFiltroEndBairros" class="col-sm-12" ></div><br>
                                            <input type="hidden" id="tableFiltroQueryBairros" value=""/><br>
                                        </div>

                                    </div>
                                    </div>
                                </td>
                            </tr>


                            <!---porte-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desPorte" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Porte</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obPorte" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!---f presumido-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desFPresumido" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Faturamento Presumido</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obFPresumido" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>


                            <!--Qtd Proprietarios-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desQtdProprietarios" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Qtd.Proprietarios</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obQtdProprietarios" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>


                            <!--P Consumo-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desPConsumo" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Perfil Consumo</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obPConsumo" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--DDD fone1-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desFone1Pj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">DDD / Fone1</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obFone1Pj" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--DDD fone2-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desFone2Pj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">DDD / Fone2</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obFone2Pj" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>


                            <!--DDD fone3-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desFone3Pj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">DDD / Fone3</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obFone3Pj" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            
                            


                            <!--DDD Cel1-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCel1Pj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">DDD / Cel3</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCel2Pj"  class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--DDD Cel2-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCel2Pj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">DDD / Cel3</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCe2lPj" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--DDD Cel3-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCel3Pj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">DDD / Cel3</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCe3lPj" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            
                                <!--SemProcon-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCel3Pj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Sem Procon</label>&nbsp;
                                    <img src="../dist/img/procon_logo.gif" align="middle" width="30" height="30">
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox"  id="obProcon" value="SemProcon" class="obC">  
                                            
                                        </label>
                                    </div>
                                </td>
                            </tr>


                            <!--Socio-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desSocio" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Sócios</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obSocios" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <td>
                                    <div style="float: right;">
                                        <input class="btn btn-primary btn-block btn-flat" style="background-color: #003bb3;width: 224px;" type="button" id="salvarFiltros" value="Salvar" />
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>

                    <div id="mostraFiltros">
                        <div class="col-xs-1 col-lg-3" > Desejado</div>
                        <div class="col-xs-1 col-lg-3" > Campo</div>
                        <div class="col-xs-1 col-lg-2" > Obrigatório</div>
                        <table style="border:'1'">
                            <!--CPF -->
                            <tr>
                                <td>
                                    <div class="checkbox" >
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCpf" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">CPF</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCpf"  class="obC"> 
                                        </label>
                                    </div>
                                </td>


                                <!--Nome -->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desNome" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Nome</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obNome" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--SEXO -->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desSexo" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Sexo</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obSexo" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--Nascimento -->                        
                            <tr>
                                <td>
                                    <div class="checkbox" >
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desNascimento" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Nascimento </label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obNascimento" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group" style="float: left;">
                                        <input type="text" class="form-control" aria-label="" id="nascimentoDe">
                                        <span class="input-group-addon">anos</span>
                                    </div>
                                    <br>
                                    <br>
                                    <div>A</div>
                                    <div class="input-group" style="float: left;">
                                        <input type="text" class="form-control" aria-label="" id="nascimentoAte">
                                        <span class="input-group-addon">anos</span>
                                    </div>
                                </td>                        </tr>

                            <!--Mãe -->                        
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desMae" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Mãe </label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obMae" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>


                            <!--CBO -->                        
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCbo" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">CBO </label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCbo" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--descrição CBO -->                        
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desDescCbo" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">CBO Descrição </label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obDescCbo" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>


                            <!--RENDA ESTIMADA -->                        
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desRestimada" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Renda Estimada</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obRestimada" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group" style="float: left;">
                                        <span class="input-group-addon">R$</span>
                                        <input type="text" class="form-control" aria-label="Valores em Reais" id="rendaEstimadaDe">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                    <div>A</div>
                                    <div class="input-group" style="float: right;">
                                        <span class="input-group-addon">R$</span>
                                        <input type="text" class="form-control" aria-label="Valores em Reais" id="rendaEstimadaAte">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                </td>
                            <br>
                            <br>
                            <br>
                            <br>
                            </tr>

                            <!--escolaridade -->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desEscolaridade" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Escolaridade </label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obEscolaridade" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <select id="escolaridade" class="selectpicker" multiple title='Selecione Escolaridade'data-done-button="true">
                                        <option value="*">Todos</option>
                                        <option value="1">Fundamental</option>
                                        <option value="2">Médio</option>
                                        <option value="3">Superior</option>
                                        <option value="4">Pós-Graduação</option>
                                        <option value="5">Doutorado</option>
                                        <option value="5">Pos - Doutorado(PHD)</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <!--Classe Social-->                        
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desClaSocial" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Classe Social </label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obClaSocial" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <select id="claSocial" class="selectpicker" multiple title='Selecione Classe Social'data-done-button="true">
                                        <option value="*">Todos</option>
                                        <option value="a1">A1</option>
                                        <option value="a2">A2</option>
                                        <option value="b1">B1</option>
                                        <option value="b2">B2</option>
                                        <option value="c1">C1</option>
                                        <option value="c2">C2</option>
                                        <option value="e">E</option>
                                    </select>

                                </td>
                            </tr>

                            <!--Perfil consumo-->                        
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desPerConsumo" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Perfil Consumo </label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obPerConsumo" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                                <td>

                                </td>
                            </tr>


                            <tr>
                                <!--fone1-->                        
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desFone1" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Fone 1  </label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obFone1" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <select id="DDDsFone" class="selectpicker" multiple title='DDD Telefones e Celulares'data-done-button="true">

                                        <option value="*">Todos</option>
                                        <option value="11">DDD11</option>
                                        <option value="12">DDD12</option>
                                        <option value="13">DDD13</option>
                                        <option value="14">DDD14</option>
                                        <option value="15">DDD15</option>
                                        <option value="16">DDD16</option>
                                        <option value="17">DDD17</option>
                                        <option value="18">DDD18</option>
                                        <option value="19">DDD19</option>
                                        <option value="21">DDD21</option>
                                        <option value="22">DDD22</option>
                                        <option value="24">DDD24</option>
                                        <option value="27">DDD27</option>
                                        <option value="28">DDD28</option>
                                        <option value="31">DDD31</option>
                                        <option value="32">DDD32</option>
                                        <option value="33">DDD33</option>
                                        <option value="34">DDD34</option>
                                        <option value="35">DDD35</option>
                                        <option value="37">DDD37</option>
                                        <option value="38">DDD38</option>
                                        <option value="41">DDD41</option>
                                        <option value="42">DDD42</option>
                                        <option value="43">DDD43</option>
                                        <option value="44">DDD44</option>
                                        <option value="45">DDD45</option>
                                        <option value="46">DDD46</option>
                                        <option value="47">DDD47</option>
                                        <option value="48">DDD48</option>
                                        <option value="49">DDD49</option>
                                        <option value="51">DDD51</option>
                                        <option value="53">DDD53</option>
                                        <option value="54">DDD54</option>
                                        <option value="55">DDD55</option>
                                        <option value="61">DDD61</option>
                                        <option value="62">DDD62</option>
                                        <option value="63">DDD63</option>
                                        <option value="64">DDD64</option>
                                        <option value="65">DDD65</option>
                                        <option value="67">DDD67</option>
                                        <option value="68">DDD68</option>
                                        <option value="69">DDD69</option>
                                        <option value="71">DDD71</option>
                                        <option value="73">DDD73</option>
                                        <option value="74">DDD74</option>
                                        <option value="75">DDD75</option>
                                        <option value="77">DDD77</option>
                                        <option value="79">DDD79</option>                                
                                        <option value="81">DDD81</option>
                                        <option value="82">DDD82</option>
                                        <option value="83">DDD83</option>
                                        <option value="84">DDD84</option>
                                        <option value="85">DDD85</option>
                                        <option value="86">DDD86</option>                                
                                        <option value="87">DDD87</option>
                                        <option value="88">DDD88</option>
                                        <option value="89">DDD89</option>
                                        <option value="91">DDD91</option>
                                        <option value="92">DDD92</option>
                                        <option value="93">DDD93</option>                                
                                        <option value="94">DDD94</option>
                                        <option value="95">DDD95</option>
                                        <option value="96">DDD96</option>
                                        <option value="97">DDD97</option>
                                        <option value="98">DDD98</option>
                                        <option value="99">DDD99</option>                                
                                    </select>
                                </td>
                            </tr>



                            <!--DDD2-->                        

                            <!--fone2-->                        
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desFone2" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Fone 2</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obFone2" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <!--DDD3-->                        

                            <!--fone3-->                        
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desFone3" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Fone 3</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obFone3" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--celddd1-->                        

                            <!--cel1-->                        
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCel1" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Celular 1</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCel1" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--ddd2-->                        


                            <!--fone2 celular-->                        
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCel2" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Celular 2</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCel2" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            <!--ddd3-celular-->                        

                            <!---celular3-->                        
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCel3" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Celular 3</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCel3" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                            </tr>

                             <!--SemProcon-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCel3Pj" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Sem Procon</label>&nbsp;
                                    <img src="../dist/img/procon_logo.gif" align="middle" width="30" height="30">
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox"  id="obProcon" value="SemProcon" class="obC">  
                                            
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            
                            <!---endereço-->            
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desEndereco" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Endereço</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obEndereco" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <select id="enderecosQtd" class="selectpicker"  title='Selecione Qtd. Endereço'data-done-button="true">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>



                            <!--estados -->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desEstado" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Estado </label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obEstado" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <select id="estados" class="selectpicker" multiple title='Selecione Estado'data-done-button="true">
                                        <option value="*">Todos</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </td>
                            </tr>


                            <!---Email-->            
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desEmail" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Email</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obEmail" class="obC"> 
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <select id="qtdEmail" class="selectpicker"  title='Selecione Qtd. Email'data-done-button="true">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>

                            <!---data obito-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desDataObito" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Data Óbito</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obDataObito" class="obC"> 
                                        </label>
                                    </div>
                                </td>

                                </td>
                            </tr>

                            <!---cidade obito-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desCidadeOtibo" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Cidade Óbito</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obCidadeObito" class="obC"> 
                                        </label>
                                    </div>
                                </td>

                                </td>
                            </tr>


                            <!---cidade participação empresarial-->
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label   style="padding-left: 50px;">
                                            <input type="checkbox" id="desPEmpresarial" class="desC">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <label style="padding-left: 50px;">Participação Empresarial</label>
                                </td>
                                <td> 
                                    <div class="checkbox" style="padding-left: 85px;">
                                        <label style="padding-left: 50px;">
                                            <input type="checkbox" id="obPEmpresarial" class="obC"> 
                                        </label>
                                    </div>
                                </td>

                                </td>
                            </tr>
                            <tr>

                                <td>
                                    <div style="float: right;">
                                        <input class="btn btn-primary btn-block btn-flat" style="background-color: #003bb3;width: 224px;" type="button" id="salvarFiltros2" value="Salvar" />
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <!--
                                <td>
                                    <div style="float: right;">
                                        <input class="btn btn-primary btn-block btn-flat" style="background-color: #003bb3;width: 224px;" type="button" id="salvarFiltros" value="Salvar" />
                                    </div>
                                </td>
                                -->
                            </tr>
                        </table>


                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="box box-solid">
                <div class="box-header with-border">

                    <div class="box-body">

                        <div class="list-group">
                            <a href="#" class="list-group-item active">
                                Enriquecidos
                            </a>
                            <?php foreach ($enriquecidos as $key => $val1) { ?>
                                <ul class="list-subject" style="list-style-type: none;">
                                    <!-- FOR EACH SUBJECT -->
                                    <li class="list-subject-item">
                                        <div class="list-subject-header clearfix">
                                            <h4 class="list-subject-name"><?php
                                                echo $val1['tb_enriquecimento_empresa_envio'];
//                            print_r($val1); 
                                                ?></h4>
                                            <div class="list-subject-header-info">
                                                <a href="#" class="list-group-item" style='width: 35%;float: left;'><?PHP echo $val1[0] . "-" . $val1['tb_enriquecimento_user_envio'] . "<br> Inicio " . date("d/m/Y G:i:s", $val1['tb_enriquecimento_data_envio']); ?>
                                                    <?php
                                                    if (isset($val1['tb_enriquecimento_data_final_processamento'])) {
                                                        echo "  <br> Fim " . date("d/m/Y G:i:s", $val1['tb_enriquecimento_data_final_processamento']);
                                                    }
                                                    echo "<br> Descrição: " . substr($val1['tb_enriquecimento_descricao'], 0, 35) . "...";
                                                    ?>
                                                </a>
                                                <input  id="idenriquecimento"type="hidden" value="<?php echo $val1[0]; ?>">

                                            </div>
                                            <div class="list-subject-header-info">
                                                <?php if ($val1[3] == "") { ?>

                                                <?php } else { ?>
                                                    <a  href="<?php echo HOME_URI . "/import/baixarArquivo.php?arquivo=" . HOME_URI . "/import" . substr($val1[3], 1) ?>"class="btn btn-primary btn-block btn-flat" style="width: 20%;height: 42px; border-radius: 25px; background-color: orange;float: left;margin-top: auto;" >Arquivo enviado</a>
                                                <?php } ?>

                                                <?php
                                                if ($val1[4] == "") {

                                                    if (substr($val1['tb_enriquecimento_arquivo_cnpj'], -8) == 'cnpj.csv') {
                                                        ?>
                                                        <a target="_blank"  href="<?php echo HOME_URI . "/" . $val1['tb_enriquecimento_empresa_envio'] . "/" . $val1[5] ?>"class="btn btn-primary btn-block btn-flat" style="width: 20%;height: 42px; border-radius: 25px;background-color: cadetblue; float: left;margin-top: auto;" >Arquivo CNPJ</a>
                                                        <?php
                                                    } else {
                                                        if (!empty($val1[5])) {
                                                            ?>
                                                            <a target="_blank"  href="<?php echo HOME_URI . "/" . $val1['tb_enriquecimento_empresa_envio'] . "/" . $val1[5] ?>"class="btn btn-primary btn-block btn-flat" style="width: 20%;height: 42px; border-radius: 25px;background-color: #FF9233; float: left;margin-top: auto;" >Layout</a>
                                                            <?php
                                                        }
                                                    }
                                                } else {
                                                    ?>

                                                    <a target="_blank"  href="<?php echo HOME_URI . "/" . $val1['tb_enriquecimento_empresa_envio'] . "/" . $val1[4] ?>"class="btn btn-primary btn-block btn-flat" style="width: 20%;height: 42px; border-radius: 25px;background-color: brown; float: left;margin-top: auto;" >Arquivo CPF</a>
                                                <?php } ?>

                                                <?php
//                                                print_r($val1);
                                                if ($val1[5] == "") {
                                                    if ($val1['tb_enriquecimento_filtro'] == "") {
                                                        ?>
                                                        <img src="<?php echo HOME_URI ?>/dist/img/carregando.gif">&nbsp;&nbsp;&nbsp;Arquivo Aguardando Filtro
                                                        <input type="hidden"  id="arquivo" value="<?php echo HOME_URI . "/import" . substr($val1[3], 1) ?>"/>
                                                        <?php
                                                    } else {

                                                        if ($val1['tb_enriquecimento_em_procesamento'] == 1 & $val1['tb_enriquecimento_arquivo_cpf'] == "" | $val1['tb_enriquecimento_arquivo_cpf'] == "") {
                                                            ?>

                                                            <img src="<?php echo HOME_URI ?>/dist/img/carregando.gif">&nbsp;&nbsp;&nbsp;Arquivo em processamento 
                                                            <input type="hidden"  id="arquivo" value="<?php echo HOME_URI . "/import" . substr($val1[3], 1) ?>"/>
                                                            <?php
                                                        }
                                                        if ($val1['tb_enriquecimento_erro']) {
                                                            ?>
                                                            <br><div style="color: red;">Erro no processamento: <?php echo $val1['tb_enriquecimento_erro']; ?> </div><br>
                                                            <a target=""  href="<?php echo HOME_URI . "/pages/php/reiniciarEnriquecimento.php?idtbEnriquecimento=" . $val1[0] ?>"class="btn btn-primary btn-block btn-flat" style="width: 20%;height: 42px; background-color: #FF9233; float: left;margin-top: auto;" >Reiniciar Processamento</a>
                                                            <a target=""  href="<?php echo HOME_URI . "/pages/php/excluirEnriquecimento.php?idtbEnriquecimento=" . $val1[0] ?>"class="btn btn-primary btn-block btn-flat" style="width: 20%;height: 42px; background-color: red; float: left;margin-top: auto;" >Excluir Enriquecimento</a>
                                                        <?php } ?>

                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                    </li>
                                </ul>


                            <?php } ?>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div>
</div>
<div id="buscarBairro"></div>
<input class="btn btn-primary btn-block btn-flat" style="width: 50%;"type="hidden" name="cnpjEmpresa"  id="cnpjEmpresa" value="<?php echo ($_SESSION['userdata']['tb_usuario_cnpj_empresa']) ?>"/>



