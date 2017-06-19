<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<div style="width: 80%; margin-left: 10%;margin-top: 5%">
    <div class="register-box-body">
        <p class="login-box-msg">Registrar Perfil Consumo</p>
        <form method="post" action="inserirPjPerfilConsumo.php" id="meuForm">

            <div class="form-group has-feedback">
                <label for="tb_perfil_consumo_cnpj">CPF</label>
                <input type="text" class="form-control"   name="tb_perfil_consumo_cnpj" placeholder="CNPJ "/>
                <span class="glyphicon glyphicon-search  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_perfil_consumo_descricao">Descriçao consumo</label>
                <input type="text" class="form-control"   name="tb_perfil_consumo_descricao" placeholder="Descriçao Consumo"/>
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

$sql = "INSERT INTO `dataWebProducao`.`tb_perfil_consumo_pJ`
(`idtb_perfil_consumo`,
`tb_perfil_consumo_cnpj`,
`tb_perfil_consumo_descricao`)
VALUES
('',
'" . $_POST['tb_perfil_consumo_cnpj'] . "',
'" . $_POST['tb_perfil_consumo_descricao'] . "')";

$db_retorno = $db->query($sql);

$fetch_user = $db_retorno->fetchAll();

if ($_POST['tb_perfil_consumo_cnpj'] != null) {

    echo "Cadastro  inserido com sucesso !!";
}





