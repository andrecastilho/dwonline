<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<div style="width: 80%; margin-left: 10%;margin-top: 5%">
    <div class="register-box-body">
        <p class="login-box-msg">Registrar Email</p>
        <form method="post" action="inserirPfEmail.php" id="meuForm">

            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_email_cpf">CPF</label>
                <input type="text" class="form-control"   id="tb_pessoa_fisica_mae_cpf" name="tb_pessoa_fisica_email_cpf" placeholder="CPF "/>
                <span class="glyphicon glyphicon-search  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_email_email">Email</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_email_email" placeholder="Email"/>
                <span class="glyphicon glyphicon-user  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_pessoa_fisica_email_dominio">Domínio</label>
                <input type="text" class="form-control"   name="tb_pessoa_fisica_email_dominio" placeholder="Domínio"/>
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

$sql = "INSERT INTO `dataWebProducao`.`tb_pessoa_fisica_email`
(`idtb_pessoa_fisica_email`,
`tb_pessoa_fisica_email_cpf`,
`tb_pessoa_fisica_email_email`,
`tb_pessoa_fisica_email_dominio`,
`tb_pessoa_fisica_email_data`)
VALUES
('',
'" . $_POST['tb_pessoa_fisica_email_cpf'] . "',
'" . $_POST['tb_pessoa_fisica_email_email'] . "',
'" . $_POST['tb_pessoa_fisica_email_dominio'] . "',
'" . $data . "')";

$db_retorno = $db->query($sql);

$fetch_user = $db_retorno->fetchAll();

if ($_POST['tb_pessoa_fisica_email_cpf'] != null) {

    echo "Cadastro  inserido com sucesso !!";
}





