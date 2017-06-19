<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<div style="width: 80%; margin-left: 10%;margin-top: 5%">
    <div class="register-box-body">
        <p class="login-box-msg">Registrar Sócio</p>
        <form method="post" action="inserirSocios.php" id="meuForm">

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_socio_cnpj_id">Cnpj</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_socio_cnpj_id" placeholder="Cnpj"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_socio_cpf_id">Cpf</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_socio_cpf_id" placeholder="Cpf"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_socio_participacao">Participaçao em %</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_socio_participacao" placeholder="Participaçao em % "/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_socio_tipo">Tipo</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_socio_tipo" placeholder="Tipo"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="col-xs-2">
                <button   type="submit" class="btn btn-primary btn-block btn-flat" style="background: green; border-color: green">ENVIAR</button>
            </div>

        </form>
    </div>
</div>

<!-- jQuery 2.1.3 -->
<script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!--functions -->
<script src="../dist/js/functions.js" type="text/javascript"></script>

<?php
require_once '../../classes/class-TutsupDB.php';

$db = new TutsupDB();
$data = date('Ymd');

$sql = "INSERT INTO `dataWebProducao`.`tb_pessoa_juridica_socio`
(`idtb_pessoa_juridica_socio`,
`tb_pessoa_juridica_socio_cnpj_id`,
`tb_pessoa_juridica_socio_cpf_id`,
`tb_pessoa_juridica_socio_participacao`,
`tb_pessoa_juridica_socio_tipo`,
`tb_pessoa_juridica_socio_data`)

VALUES
('',
'" . $_POST['tb_pessoa_juridica_socio_cnpj_id'] . "',
'" . $_POST['tb_pessoa_juridica_socio_cpf_id'] . "', 
'" . $_POST['tb_pessoa_juridica_socio_participacao'] . "',
'" . $_POST['tb_pessoa_juridica_socio_tipo'] . "',
'" . $data . "'
        )";

$db_retorno = $db->query($sql);

$fetch_user = $db_retorno->fetchAll();

if ($_POST['tb_pessoa_juridica_socio_cnpj_id'] != null) {

    echo "Cadastro  inserido com sucesso !!";
}











