<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<div style="width: 80%; margin-left: 10%;margin-top: 5%">
    <div class="register-box-body">
        <p class="login-box-msg">Registrar Sócio</p>
        <form method="post" action="inserirPjSituacaoCadastral.php" id="meuForm">

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_situacao_cnpj">Cnpj</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_situacao_cnpj" placeholder="Cnpj"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="tb_pessoa_juridica_situacao">Situacao</label>
                <input type="text" class="form-control"   name="tb_pessoa_juridica_situacao" placeholder="Situaçao - Ativa ou Baixada"/>
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

$sql = "INSERT INTO `dataWebProducao`.`tb_pessoa_juridica_situacao`
(`idtb_situacao`,
`tb_pessoa_juridica_situacao_cnpj`,
`tb_pessoa_juridica_situacao`,
`tb_pessoa_juridica_data_situacao`)

VALUES
('',
'" . $_POST['tb_pessoa_juridica_situacao_cnpj'] . "',
'" . $_POST['tb_pessoa_juridica_situacao'] . "', 
'" . $data . "'
        )";

$db_retorno = $db->query($sql);

$fetch_user = $db_retorno->fetchAll();

if ($_POST['tb_pessoa_juridica_situacao_cnpj'] != null) {

    echo "Cadastro  inserido com sucesso !!";
}











