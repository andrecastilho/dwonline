<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<div style="width: 80%; margin-left: 10%;margin-top: 5%">
    <div class="register-box-body">
        <p class="login-box-msg">Cadastro Html Email</p>
        <form method="post" action="index.php" id="meuForm">

            <div class="form-group has-feedback">
                <label for="tb_html_email_empresa">Empresa</label>
                <input type="text" class="form-control"   id="tb_html_email_empresa" name="tb_html_email_empresa" placeholder="Empresa "/>
                <span class="glyphicon glyphicon-inbox  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_html_email_nome_layout">Nome Html</label>
                <input type="text" class="form-control"   name="tb_html_email_nome_layout" placeholder="Nome html"/>
                <span class="glyphicon glyphicon-inbox  form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <label for="tb_html_email_html">Html</label>
                <textarea type="text" class="form-control"   name="tb_html_email_html" placeholder="Html">
                </textarea>
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

$sql = "INSERT INTO `dataWebProducao`.`tb_html_email`
(`idtb_html_email`,
`tb_html_email_empresa`,
`tb_html_email_nome_layout`,
`tb_html_email_html`,
`tb_html_email_data`)
VALUES
('',
'" . $_POST['tb_html_email_empresa'] . "',
'" . $_POST['tb_html_email_nome_layout'] . "',
'" . htmlspecialchars($_POST['tb_html_email_html'] ,ENT_QUOTES). "',
'" . $data . "')";

$db_retorno = $db->pdo->exec($sql);



if ($db_retorno) {

    echo "<br><br><h1>Cadastro  inserido com sucesso !!</h1>";
}





