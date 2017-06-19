<?PHP if ($id_perfil == '1' || $id_perfil == '2') { ?>
    <div class="content-wrapper2"  >
        <div class="register-box" >
            <div class="register-box">
                <div class="">
                    <div class="wrap" >
                        <div class="box-header with-border" style="float: left;width: 50%;">
                            <ul class="list-group">
                                <li class="list-group-item"><a href="<?php echo HOME_URI ?>/apoio_relatorios/buscaDetalhada.php">Busca Detalhada</a><br></li>
                                <li class="list-group-item"><a href="<?php echo HOME_URI ?>/apoio_relatorios/buscaDetalhadoCnf.php">Buscas Detalhada CNF</a><br></li>
                                <li class="list-group-item"><a href="<?php echo HOME_URI ?>//apoio_relatorios/buscaQuantitativaCnf.php">Busca Quantitativa CNF</a><br></li>
                                <li class="list-group-item"><a href="<?php echo HOME_URI ?>//apoio_relatorios/buscaQuantitativaPorEmpresa.php">Saldo Atual</a><br></li>
                                <li class="list-group-item"><a href="<?php echo HOME_URI ?>//apoio_relatorios/buscaQuantitativaPorUser.php">Saldo  por Usuário</a><br></li>
                                <li class="list-group-item"><a href="<?php echo HOME_URI ?>//apoio_relatorios/buscaQuantitativaEmail.php">Busca Quantitativa  Email</a><br></li>
                                <li class="list-group-item"><a href="<?php echo HOME_URI ?>//apoio_relatorios/buscaQuantitativaWebService.php">Busca Quantitativa  WebService</a><br></li>
                                <li class="list-group-item"><a href="<?php echo HOME_URI ?>//apoio_relatorios/buscaDetalhadaWebService.php">Busca Detalhada  WebService</a><br></li>
                                <li class="list-group-item"><a href="<?php echo HOME_URI ?>//apoio_relatorios/buscaConsumoCreditos.php">Consumo Créditos</a><br></li>

                            </ul>

                        </div>
                    </div>
                </div>
            </div><!-- /.box -->
        </div>
    </div>
<?php } else {
    ?>
    <div class="content-wrapper2"  >
        <div class="register-box" >
            <div class="register-box">
                <div class="">
                    <div class="wrap" >
                        <div class="box-header with-border" style="float: left;width: 50%;">
                            Área Restrita
                        </div>
                    </div>
                </div>
            </div><!-- /.box -->
        </div>
    </div>
    <?php
}
?>