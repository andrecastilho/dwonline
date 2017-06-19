<?PHP if ($id_perfil == '1' || $id_perfil == '2') { ?>
    <div class="content-wrapper2"  >
        <div class="register-box" >
            <div class="register-box">
                <div class="">
                    <div class="wrap" >
                        <div class="box-header with-border" style="float: left;width: 50%;">
                            <ul class="list-group">
                                <li class="list-group-item"><a href="<?php echo HOME_URI ?>/crud/?id_perfil=<?php echo $id_perfil ?>">Crud</a><br></li>
                                <li class="list-group-item"><a href="<?php echo HOME_URI ?>/apoio/">Apoio</a><br></li>
                                <li class="list-group-item"><a href="<?php echo HOME_URI ?>/cadastroEmail/?id_perfil=<?php echo $id_perfil ?>">Cadastro html Emails</a><br></li>
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